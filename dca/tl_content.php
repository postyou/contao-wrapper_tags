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

$tl_content['palettes']['wrapperStart'] = '{type_legend},type;{mutliwrapper_legend},multiWrapperStart;{template_legend:hide},customTpl;';
$tl_content['palettes']['wrapperStop'] = '{type_legend},type;{mutliwrapper_legend},multiWrapperStop;{template_legend:hide},customTpl;';

$tl_content['fields']['multiWrapperStart'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['multiWrapperStart'],
    'exclude' => true,
    'inputType' => 'multiColumnWizard',
    'eval' => array('mandatory' => true, 'columnsCallback' => array('tl_content_cte_wrapper', 'multiWrapperStartCallback')),
    'sql' => 'blob NULL'
);

$tl_content['fields']['multiWrapperStop'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['multiWrapperStop'],
    'exclude' => true,
    'inputType' => 'multiColumnWizard',
    'eval' => array('mandatory' => true, 'columnsCallback' => array('tl_content_cte_wrapper', 'multiWrapperStopCallback')),
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
     * Provides columnsCallback for multiColumnWizard field 'multiWrapperStop'
     *
     * @return array
     */
    public function multiWrapperStopCallback()
    {
        return array(
            'tag' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_content']['multiWrapperTag'],
                'inputType' => 'select',
                'options_callback' => array('tl_content_cte_wrapper', 'getTags'),
                'eval' => array('style' => 'width:100px;margin-right:10px;', 'tl_class' => 'w50 clr'),
            )
        );
    }

    /**
     * Provides columnsCallback for multiColumnWizard field 'multiWrapperStart'
     *
     * @return array
     */
    public function multiWrapperStartCallback()
    {
        return array(
            'tag' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_content']['multiWrapperTag'],
                'inputType' => 'select',
                'options_callback' => array('tl_content_cte_wrapper', 'getTags'),
                'eval' => array('style' => 'width:100px;margin-right:5px;'),
            ),
            'class' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_content']['multiWrapperClass'],
                'exclude' => true,
                'inputType' => 'text',
                'eval' => array('style' => 'width:100px;margin-right:5px;'),
            ),
            'id' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_content']['multiWrapperId'],
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
        $ctes = ContentModel::findBy(array('tl_content.pid=?', 'tl_content.invisible!=?', "tl_content.type IN ('wrapperStart','wrapperStop')"), array($dc->id, '1'));

        if (is_null($ctes) || !$ctes instanceof \Model\Collection) {
            // no wrapper_tags in article
            return $add;
        }

        $statusTitle = $GLOBALS['TL_LANG']['CTE']['cteWrapper'];
        $openedTagsStack = array();
        $status = array();

        foreach ($ctes as $index => $cte) {

            if ('wrapperStart' === $cte->type) {

                // every opened tag put on stack

                $startTags = unserialize($cte->multiWrapperStart);

                if (!is_array($startTags)) {
                    $status[$statusTitle] = '<span class="tl_red">Data corrupted</span>';
                    break;
                }

                foreach ($startTags as $index => $tag) {
                    $openedTagsStack[] = array($cte->id, $tag, $index);
                }

            } else {

                // every closing tag in cte should have corresponding opening tag

                $closingTags = unserialize($cte->multiWrapperStop);
                if (!is_array($closingTags)) {
                    $status[$statusTitle] = '<span class="tl_red">Data corrupted</span>';
                    break;
                }

                if (count($openedTagsStack) === 0) {
                    $status[$statusTitle] = '<span class="tl_red">Error: Closing tag "' . $closingTags[0]['tag'] . '" (id:' . $cte->id . ') is without opening tag</span>';
                    break;
                }

                foreach ($closingTags as $closingTag) {

                    $openedTag = array_pop($openedTagsStack);

                    if ($closingTag['tag'] !== $openedTag[1]['tag']) {
                        $status[$statusTitle] = '<span class="tl_red">Error: Opening tag "' . $openedTag[1]['tag'] . '"  (id:' . $openedTag[0] . ') is paired with closing tag "' . $closingTag['tag'] . '" (id:' . $cte->id . ')</span>';
                        break 2;
                    }
                }
            }
        }

        if (count($status) === 0) {
            if (count($openedTagsStack)) {
                $openedTag = array_pop($openedTagsStack);
                $status[$statusTitle] = '<span class="tl_red">Error: Opening tag "' . $openedTag[1]['tag'] . '" (id:' . $openedTag[0] . ') is without closing tag</span>';
            } else {
                $status[$statusTitle] = 'Opening tags match closing tags';
            }
        }

        return $add + $status;
    }
}