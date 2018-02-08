<?php

/*
 * Copyright (C) 2018 Zmyslni
 *
 * @author  Ostrowski Maciej <http://contao-developer.pl>
 * @author  Ostrowski Maciej <maciek@zmyslni.pl>
 * @license LGPL-3.0+
 */

/*
 * Extension version
 */
@define('WRAPPER_TAGS_VERSION', '2.0');
@define('WRAPPER_TAGS_BUILD', '0');

/*
 * Content elements
 */
$GLOBALS['TL_CTE']['wrapper_tags']['wt_opening_tags'] = 'Zmyslny\WrapperTags\ContentElement\OpeningTagsElement';
$GLOBALS['TL_CTE']['wrapper_tags']['wt_closing_tags'] = 'Zmyslny\WrapperTags\ContentElement\ClosingTagsElement';

/*
 * Wrappers
 */
$GLOBALS['TL_WRAPPERS']['start'][] = 'wt_opening_tags';
$GLOBALS['TL_WRAPPERS']['stop'][] = 'wt_closing_tags';

/*
 * Config
 */
$GLOBALS['TL_CONFIG']['wt_use_colors'] = true;
$GLOBALS['TL_CONFIG']['wt_hide_validation_status'] = false;
$GLOBALS['TL_CONFIG']['wt_allowed_tags']
    = '<div><span><article><aside>'
    . '<ul><ol><li>';
