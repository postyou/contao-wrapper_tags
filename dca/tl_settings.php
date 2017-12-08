<?php

/**
 * Copyright (C) 2017 Zmyslni
 *
 * @author  Ostrowski Maciej <http://contao-developer.pl>
 * @author  Ostrowski Maciej <maciek@zmyslni.pl>
 * @license LGPL-3.0+
 */


$tl_settings = &$GLOBALS['TL_DCA']['tl_settings'];

$tl_settings['palettes']['default'] .= ';{wrapper-tags_legend:hide},wrapperTagsAllowedTags,wrapperTagsUseColors,wrapperTagsHideValidationStatus';

$tl_settings['fields']['wrapperTagsAllowedTags'] = array
(
    'label' => &$GLOBALS['TL_LANG']['tl_settings']['wrapperTagsAllowedTags'],
    'inputType' => 'text',
    'eval' => array('preserveTags' => true, 'tl_class' => 'long')
);

$tl_settings['fields']['wrapperTagsUseColors'] = array
(
    'label' => &$GLOBALS['TL_LANG']['tl_settings']['wrapperTagsUseColors'],
    'inputType' => 'checkbox',
    'eval' => array('tl_class' => 'w50')
);

$tl_settings['fields']['wrapperTagsHideValidationStatus'] = array
(
    'label' => &$GLOBALS['TL_LANG']['tl_settings']['wrapperTagsHideValidationStatus'],
    'inputType' => 'checkbox',
    'eval' => array('tl_class' => 'w50')
);