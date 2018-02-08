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
$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ';{wt_legend:hide},wt_allowed_tags,wt_use_colors,wt_hide_validation_status';

/*
 * Fields
 */
$GLOBALS['TL_DCA']['tl_settings']['fields']['wt_allowed_tags'] =
    array(
        'label' => &$GLOBALS['TL_LANG']['tl_settings']['wt_allowed_tags'],
        'inputType' => 'text',
        'eval' => array('mandatory' => true, 'preserveTags' => true, 'tl_class' => 'long')
    );
$GLOBALS['TL_DCA']['tl_settings']['fields']['wt_use_colors'] =
    array(
        'label' => &$GLOBALS['TL_LANG']['tl_settings']['wt_use_colors'],
        'inputType' => 'checkbox',
        'eval' => array('tl_class' => 'w50')
    );
$GLOBALS['TL_DCA']['tl_settings']['fields']['wt_hide_validation_status'] =
    array(
        'label' => &$GLOBALS['TL_LANG']['tl_settings']['wt_hide_validation_status'],
        'inputType' => 'checkbox',
        'eval' => array('tl_class' => 'w50')
    );
