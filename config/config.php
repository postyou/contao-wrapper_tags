<?php

/**
 * Copyright (C) 2017 Zmyslni
 *
 * @author  Ostrowski Maciej <http://contao-developer.pl>
 * @author  Ostrowski Maciej <maciek@zmyslni.pl>
 * @license LGPL
 */

/**
 * Content elements
 */
$GLOBALS['TL_CTE']['wrapperTags']['openingTags'] = 'ContentOpeningTags';
$GLOBALS['TL_CTE']['wrapperTags']['closingTags'] = 'ContentClosingTags';
$GLOBALS['TL_WRAPPERS']['start'][] = 'openingTags';
$GLOBALS['TL_WRAPPERS']['stop'][] = 'closingTags';