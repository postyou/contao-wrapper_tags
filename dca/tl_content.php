<?php

/*
 * Copyright (C) 2018 Zmyslni
 *
 * @author  Ostrowski Maciej <http://contao-developer.pl>
 * @author  Ostrowski Maciej <maciek@zmyslni.pl>
 * @license LGPL-3.0+
 */

/*
 * List
 */

use Contao\Input;

$GLOBALS['TL_DCA']['tl_content']['list']['sorting']['child_record_callback'] = array('Zmyslny\WrapperTags\EventListener\ContentListener', 'onChildRecordCallback');
$GLOBALS['TL_DCA']['tl_content']['list']['sorting']['header_callback'] = array('Zmyslny\WrapperTags\EventListener\ContentListener', 'onHeaderCallback');

/*
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_content']['palettes']['wt_opening_tags'] = '{type_legend},type;{wt_legend},wt_opening_tags;{template_legend:hide},customTpl;{invisible_legend:hide},invisible,start,stop';
$GLOBALS['TL_DCA']['tl_content']['palettes']['wt_closing_tags'] = '{type_legend},type;{wt_legend},wt_closing_tags;{template_legend:hide},customTpl;{invisible_legend:hide},invisible,start,stop';
$GLOBALS['TL_DCA']['tl_content']['palettes']['wt_complete_tags'] = '{type_legend},type;{wt_legend},wt_complete_tags;{template_legend:hide},customTpl;{invisible_legend:hide},invisible,start,stop';

/*
 * Fields
 */
$GLOBALS['TL_DCA']['tl_content']['fields']['wt_opening_tags'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['wt_opening_tags'],
    'exclude' => true,
    'inputType' => 'multiColumnWizard',
    'save_callback' => array(array('Zmyslny\WrapperTags\EventListener\ContentListener', 'onSaveCallback')),
    'eval' => array
    (
        'mandatory' => true,
        'dragAndDrop' => true,
        'columnFields' => array
        (
            'tag' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_content']['wt_tag'],
                'inputType' => 'select',
                'options_callback' => array('Zmyslny\WrapperTags\EventListener\ContentListener', 'getTags'),
            ),
            'attributes' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_content']['wt_attribute'],
                'exclude' => true,
                'inputType' => 'multiColumnWizard',
                'eval' => array
                (
                    'tl_class' => 'attributes',
                    'dragAndDrop' => true,
                    'allowHtml' => false,
                    'columnFields' => array
                    (
                        'name' => array
                        (
                            'label' => &$GLOBALS['TL_LANG']['tl_content']['wt_attribute_name'],
                            'inputType' => 'text',
                            'exclude' => true,
                            'eval' => array('allowHtml' => false)
                        ),
                        'value' => array
                        (
                            'label' => &$GLOBALS['TL_LANG']['tl_content']['wt_attribute_value'],
                            'inputType' => 'text',
                            'exclude' => true,
                            'eval' => array('allowHtml' => false)
                        ),
                    ),
                ),
            ),
            'class' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_content']['wt_class'],
                'exclude' => true,
                'inputType' => 'text',
                'eval' => array('allowHtml' => false)
            )
        )
    ),
    'sql' => 'blob NULL'
);
$GLOBALS['TL_DCA']['tl_content']['fields']['wt_closing_tags'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['wt_closing_tags'],
    'exclude' => true,
    'inputType' => 'multiColumnWizard',
    'eval' => array
    (
        'mandatory' => true,
        'columnsCallback' => array('Zmyslny\WrapperTags\EventListener\ContentListener', 'onClosingTagsColumnsCallback'),
        // 'buttons' => array('new' => true),
        'dragAndDrop' => true
    ),
    'sql' => 'blob NULL'
);
$GLOBALS['TL_DCA']['tl_content']['fields']['wt_complete_tags'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['wt_complete_tags'],
    'exclude' => true,
    'inputType' => 'multiColumnWizard',
    'save_callback' => array(array('Zmyslny\WrapperTags\EventListener\ContentListener', 'onSaveCallback')),
    'eval' => array
    (
        'mandatory' => true,
        'dragAndDrop' => true,
        'columnFields' => array
        (
            'tag' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_content']['wt_tag'],
                'inputType' => 'select',
                'options_callback' => array('Zmyslny\WrapperTags\EventListener\ContentListener', 'getTags'),
            ),
            'void' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_content']['wt_void'],
                'exclude' => true,
                'inputType' => 'checkbox'
            ),
            'attributes' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_content']['wt_attribute'],
                'exclude' => true,
                'inputType' => 'multiColumnWizard',
                'eval' => array
                (
                    'tl_class' => 'attributes',
                    'dragAndDrop' => true,
                    'allowHtml' => false,
                    'columnFields' => array
                    (
                        'name' => array
                        (
                            'label' => &$GLOBALS['TL_LANG']['tl_content']['wt_attribute_name'],
                            'inputType' => 'text',
                            'exclude' => true,
                            'eval' => array('allowHtml' => false)
                        ),
                        'value' => array
                        (
                            'label' => &$GLOBALS['TL_LANG']['tl_content']['wt_attribute_value'],
                            'inputType' => 'text',
                            'exclude' => true,
                            'eval' => array('allowHtml' => false)
                        ),
                    ),
                ),
            ),
            'class' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_content']['wt_class'],
                'exclude' => true,
                'inputType' => 'text',
                'eval' => array('allowHtml' => false)
            )
        )
    ),
    'sql' => 'blob NULL'
);

/*
 * Add stylesheet & javascript to back end.
 */
if (TL_MODE === 'BE') {

    $min = $GLOBALS['TL_CONFIG']['debugMode'] ? '' : '.min';
    $version = version_compare(VERSION, '4.4', '>=') ? '-c44' : '-c35';

    if ('flexible' === $GLOBALS['TL_CONFIG']['backendTheme']) {
        $GLOBALS['TL_CSS']['wt_css'] = '/system/modules/wrapper_tags/assets/wrapper-tags-flexible' . $version . $min . '.css';
    } else {
        $GLOBALS['TL_CSS']['wt_css'] = '/system/modules/wrapper_tags/assets/wrapper-tags-default' . $version . $min . '.css';
    }

    // Only for CTEs list view
    if (Input::get('do') === 'article' && Input::get('table') === 'tl_content' && Input::get('act') !== 'edit') {
        $GLOBALS['TL_JAVASCRIPT']['wt_js'] = 'system/modules/wrapper_tags/assets/wrapper-tags' . $min . '.js';
    }
}

