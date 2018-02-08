<?php

/*
 * Copyright (C) 2018 Zmyslni
 *
 * @author  Ostrowski Maciej <http://contao-developer.pl>
 * @author  Ostrowski Maciej <maciek@zmyslni.pl>
 * @license LGPL-3.0+
 */

/*
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ';{wrapperTags_legend:hide},wrapperTagsAllowedTags,wrapperTagsUseColors,wrapperTagsHideValidationStatus';

/*
 * Fields
 */
$GLOBALS['TL_DCA']['tl_settings']['fields']['wrapperTagsAllowedTags'] =
    array(
        'label' => &$GLOBALS['TL_LANG']['tl_settings']['wrapperTagsAllowedTags'],
        'inputType' => 'text',
        'eval' => array('mandatory' => true, 'preserveTags' => true, 'tl_class' => 'long')
    );
$GLOBALS['TL_DCA']['tl_settings']['fields']['wrapperTagsUseColors'] =
    array(
        'label' => &$GLOBALS['TL_LANG']['tl_settings']['wrapperTagsUseColors'],
        'inputType' => 'checkbox',
        'eval' => array('tl_class' => 'w50')
    );
$GLOBALS['TL_DCA']['tl_settings']['fields']['wrapperTagsHideValidationStatus'] =
    array(
        'label' => &$GLOBALS['TL_LANG']['tl_settings']['wrapperTagsHideValidationStatus'],
        'inputType' => 'checkbox',
        'eval' => array('tl_class' => 'w50')
    );
