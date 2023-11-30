<?php

/*
 * Copyright (C) 2018 Zmyslni
 *
 * @author  Ostrowski Maciej <http://contao-developer.pl>
 * @author  Ostrowski Maciej <maciek@zmyslni.pl>
 * @license LGPL-3.0+
 */



/*
 * Wrappers
 */
$GLOBALS['TL_WRAPPERS']['start'][] = 'wt_opening_tags';
$GLOBALS['TL_WRAPPERS']['stop'][] = 'wt_closing_tags';
$GLOBALS['TL_WRAPPERS']['single'][] = 'wt_complete_tags';

/*
 * Config
 */
$GLOBALS['TL_CONFIG']['wt_use_colors'] = true;
$GLOBALS['TL_CONFIG']['wt_hide_validation_status'] = false;
$GLOBALS['TL_CONFIG']['wt_allowed_tags']
    = '<div><span><article><aside>'
    . '<ul><ol><li>';
