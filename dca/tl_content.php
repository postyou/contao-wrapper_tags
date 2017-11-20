<?php

/**
 * Copyright (C) 2017 Zmyslni
 *
 * @author  Ostrowski Maciej <http://contao-developer.pl>
 * @author  Ostrowski Maciej <maciek@zmyslni.pl>
 * @license LGPL
 */

$tl_content = &$GLOBALS['TL_DCA']['tl_content'];

$tl_content['list']['sorting']['header_callback'] = array('tl_content_cte_wrapper', 'validate');

$tl_content['palettes']['openingTags'] = '{type_legend},type;{wrappertags_legend},openingTags;{template_legend:hide},customTpl;';
$tl_content['palettes']['closingTags'] = '{type_legend},type;{wrappertags_legend},closingTags;{template_legend:hide},customTpl;';

$tl_content['fields']['openingTags'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['openingTags'],
    'exclude' => true,
    'inputType' => 'multiColumnWizard',
    'eval' => array('mandatory' => true, 'columnsCallback' => array('tl_content_cte_wrapper', 'openingTagsCallback')),
    'sql' => 'blob NULL'
);

$tl_content['fields']['closingTags'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['closingTags'],
    'exclude' => true,
    'inputType' => 'multiColumnWizard',
    'eval' => array('mandatory' => true, 'columnsCallback' => array('tl_content_cte_wrapper', 'closingTagsCallback')),
    'sql' => 'blob NULL'
);

class tl_content_cte_wrapper extends Backend
{

    /**
     * @return array
     */
    public function getTags()
    {
        return array('div', 'span', 'article', 'p', 'pre', 'aside', 'ul', 'ol', 'li');
    }

    /**
     * Provides columnsCallback for multiColumnWizard field 'closingTags'
     *
     * @return array
     */
    public function closingTagsCallback()
    {
        return array(
            'tag' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_content']['wrapperTagsTag'],
                'inputType' => 'select',
                'options_callback' => array('tl_content_cte_wrapper', 'getTags'),
                'eval' => array('style' => 'width:100px;margin-right:10px;', 'tl_class' => 'w50 clr'),
            )
        );
    }

    /**
     * Provides columnsCallback for multiColumnWizard field 'openingTags'
     *
     * @return array
     */
    public function openingTagsCallback()
    {
        return array(
            'tag' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_content']['wrapperTagsTag'],
                'inputType' => 'select',
                'options_callback' => array('tl_content_cte_wrapper', 'getTags'),
                'eval' => array('style' => 'width:100px;margin-right:5px;'),
            ),
            'class' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_content']['wrapperTagsClass'],
                'exclude' => true,
                'inputType' => 'text',
                'eval' => array('style' => 'width:100px;margin-right:5px;'),
            ),
            'id' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_content']['wrapperTagsId'],
                'exclude' => true,
                'inputType' => 'text',
                'eval' => array('style' => 'width:100px;margin-right:5px;'),
            )
        );
    }


    /**
     * Checks whether every start wrapper has its corresponding stop wrapper.
     *
     * @param $add
     * @param DataContainer $dc
     * @return array
     */
    public function validate($add, DataContainer $dc)
    {
        $ctes = ContentModel::findBy(array('tl_content.pid=?', 'tl_content.invisible!=?', "tl_content.type IN ('openingTags','closingTags')"), array($dc->id, '1'));

        if (is_null($ctes) || !$ctes instanceof \Model\Collection) {
            // no wrapper_tags in article
            return $add;
        }

        $statusTitle = $GLOBALS['TL_LANG']['CTE']['wrapperTags'];
        $openedTagsStack = array();
        $status = array();

        foreach ($ctes as $index => $cte) {

            if ('openingTags' === $cte->type) {

                // every opened tag put on stack

                $startTags = unserialize($cte->openingTags);

                if (!is_array($startTags)) {
                    $status[$statusTitle] = '<span class="tl_red">Data corrupted</span>';
                    break;
                }

                foreach ($startTags as $index => $tag) {
                    $openedTagsStack[] = array($cte->id, $tag, $index);
                }

            } else {

                // every closing tag in cte should have corresponding opening tag

                $closingTags = unserialize($cte->closingTags);
                if (!is_array($closingTags)) {
                    $status[$statusTitle] = '<span class="tl_red">Data corrupted</span>';
                    break;
                }

                if (count($openedTagsStack) === 0) {
                    $status[$statusTitle] = '<span class="tl_red">Error: Closing tag "&lt;/' . $closingTags[0]['tag'] . '&gt;" (id:' . $cte->id . ') is without opening tag.</span>';
                    break;
                }

                foreach ($closingTags as $closingTag) {

                    $openedTag = array_pop($openedTagsStack);

                    if ($openedTag === null) {
                        $status[$statusTitle] = '<span class="tl_red">Error: Closing tag &lt;/"' . $closingTag['tag'] . '&gt;" (id:' . $cte->id . ') is without opening tag.</span>';
                        break 2;
                    }

                    if ($closingTag['tag'] !== $openedTag[1]['tag']) {
                        $status[$statusTitle] = '<span class="tl_red">Error: Opening tag "&lt;' . $openedTag[1]['tag'] . '&gt;"  (id:' . $openedTag[0] . ') is paired with closing tag "&lt;/' . $closingTag['tag'] . '&gt;" (id:' . $cte->id . ').</span>';
                        break 2;
                    }
                }
            }
        }

        if (count($status) === 0) {
            if (count($openedTagsStack)) {
                $openedTag = array_pop($openedTagsStack);
                $status[$statusTitle] = '<span class="tl_red">Error: Opening tag "&lt;' . $openedTag[1]['tag'] . '&gt;" (id:' . $openedTag[0] . ') is without closing tag.</span>';
            } else {
                $status[$statusTitle] = 'Opening tags match closing tags';
            }
        }

        return $add + $status;
    }
}