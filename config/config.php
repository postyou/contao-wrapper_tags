<?php

/**
 * Copyright (C) 2017 Zmyslni
 *
 * @author  Ostrowski Maciej <http://contao-developer.pl>
 * @author  Ostrowski Maciej <maciek@zmyslni.pl>
 * @license LGPL-3.0+
 */


/**
 * Extension version
 */
@define('WRAPPER_TAGS_VERSION', '1.2');
@define('WRAPPER_TAGS_BUILD', '0');


/**
 * Content elements
 */
$GLOBALS['TL_CTE']['wrapperTags']['openingTags'] = 'ContentOpeningTags';
$GLOBALS['TL_CTE']['wrapperTags']['closingTags'] = 'ContentClosingTags';
$GLOBALS['TL_WRAPPERS']['start'][] = 'openingTags';
$GLOBALS['TL_WRAPPERS']['stop'][] = 'closingTags';


/**
 * TL_CONFIG
 */

$GLOBALS['TL_CONFIG']['wrapperTagsUseColors'] = true;

$GLOBALS['TL_CONFIG']['wrapperTagsAllowedTags']
    = '<div><span><article><aside>'
    . '<ul><ol><li>';
