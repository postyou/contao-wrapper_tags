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
$GLOBALS['TL_DCA']['tl_content']['list']['sorting']['child_record_callback'] = array('Zmyslny\WrapperTags\EventListener\ContentListener', 'onChildRecordCallback');
$GLOBALS['TL_DCA']['tl_content']['list']['sorting']['header_callback'] = array('Zmyslny\WrapperTags\EventListener\ContentListener', 'onHeaderCallback');

/*
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_content']['palettes']['openingTags'] = '{type_legend},type;{wrapperTags_legend},openingTags;{template_legend:hide},customTpl;{invisible_legend:hide},invisible,start,stop';
$GLOBALS['TL_DCA']['tl_content']['palettes']['closingTags'] = '{type_legend},type;{wrapperTags_legend},closingTags;{template_legend:hide},customTpl;{invisible_legend:hide},invisible,start,stop';

/*
 * Fields
 */
$GLOBALS['TL_DCA']['tl_content']['fields']['openingTags'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['openingTags'],
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
                'label' => &$GLOBALS['TL_LANG']['tl_content']['wrapperTagsTag'],
                'inputType' => 'select',
                'options_callback' => array('Zmyslny\WrapperTags\EventListener\ContentListener', 'getTags'),
            ),
            'attributes' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_content']['wrapperTagsAttributes'],
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
                            'label' => &$GLOBALS['TL_LANG']['tl_content']['wrapperTagsAttributesName'],
                            'inputType' => 'text',
                            'exclude' => true,
                            'eval' => array('allowHtml' => false)
                        ),
                        'value' => array
                        (
                            'label' => &$GLOBALS['TL_LANG']['tl_content']['wrapperTagsAttributesValue'],
                            'inputType' => 'text',
                            'exclude' => true,
                            'eval' => array('allowHtml' => false)
                        ),
                    ),
                ),
            ),
            'class' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_content']['wrapperTagsClass'],
                'exclude' => true,
                'inputType' => 'text',
                'eval' => array('allowHtml' => false)
            )
        )
    ),
    'sql' => 'blob NULL'
);
$GLOBALS['TL_DCA']['tl_content']['fields']['closingTags'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['closingTags'],
    'exclude' => true,
    'inputType' => 'multiColumnWizard',
    'eval' => array
    (
        'mandatory' => true,
        'columnsCallback' => array('Zmyslny\WrapperTags\EventListener\ContentListener', 'onClosingTagsColumnsCallback'),
        'buttons' => array('new' => false),
        'dragAndDrop' => true
    ),
    'sql' => 'blob NULL'
);


/**
 * stylesheets & javascripts
 */
if (TL_MODE === 'BE') {

    $min = $GLOBALS['TL_CONFIG']['debugMode'] ? '' : '.min';
    $version = version_compare(VERSION, '4.4', '>=') ? '-c44' : '-c35';

    if ('flexible' === $GLOBALS['TL_CONFIG']['backendTheme']) {
        $GLOBALS['TL_CSS']['wtgs'] = '/system/modules/wrapper_tags/assets/wrapper-tags-flexible' . $version . $min . '.css';
    } else {
        $GLOBALS['TL_CSS']['wtgs'] = '/system/modules/wrapper_tags/assets/wrapper-tags-default' . $version . $min . '.css';
    }

    // only for CTEs list view
    if (\Input::get('do') === 'article' && \Input::get('table') === 'tl_content' && \Input::get('act') !== 'edit') {
        $GLOBALS['TL_JAVASCRIPT']['wtgs'] = 'system/modules/wrapper_tags/assets/wrapper-tags' . $min . '.js';
    }
}

