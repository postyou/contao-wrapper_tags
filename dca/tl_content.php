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
        $ctes = ContentModel::findBy(array('tl_content.pid=?', 'tl_content.invisible=?', "tl_content.type IN ('wrapperStart','wrapperStop')"), array($dc->id, ''));

        if (is_null($ctes) || !$ctes instanceof \Model\Collection) {
            // no wrappers in article
            return $add;
        }

        $headerTitle = $GLOBALS['TL_LANG']['CTE']['cteWrapper'];
        $wrapperStatus = array();
        $stack = array();

        foreach ($ctes as $index => $cte) {

            if ('wrapperStart' === $cte->type) {
                $stack[] = [$cte->id, 'wrapperStart', unserialize($cte->multiWrapperStart)];
            } else {
                // wrapperStop, check related wrapperStart

                if (count($stack) === 0) {
                    $wrapperStatus[$headerTitle] = '<span class="tl_red">Closing tags (id:' . $cte->id . ') without opening tags</span>';
                    break;
                }

                $start = array_pop($stack);

                // check tags matching

                $startTags = $start[2];
                $stopTags = unserialize($cte->multiWrapperStop);

                foreach ($stopTags as $stopTag) {
                    $startTag = array_pop($startTags);
                    if ($stopTag['tag'] !== $startTag['tag']) {
                        $wrapperStatus[$headerTitle] = '<span class="tl_red">Closing tags (id:' . $cte->id . ') are not matching structure of opening tags (id:' . $start[0] . ')</span>';
                        break 2;
                    }
                }

                // start wrapper has more tags than stop wrapper
                if (count($startTags)) {
                    $wrapperStatus[$headerTitle] = '<span class="tl_red">Closing tags (id:' . $cte->id . ') are not matching structure of opening tags (id:' . $start[0] . ')</span>';
                    break;
                }
            }
        }

        if (count($wrapperStatus) === 0) {
            if (count($stack)) {
                $wrapperStatus[$headerTitle] = '<span class="tl_red">Opening tags (id:' . array_pop($stack)[0] . ') without closing tags</span>';
            } else {
                $wrapperStatus[$headerTitle] = 'Opening tags match closing tags';
            }
        }

        return $add + $wrapperStatus;
    }
}