<?php

/**
 * Copyright (C) 2018 Zmyslni
 *
 * @author  Ostrowski Maciej <http://contao-developer.pl>
 * @author  Ostrowski Maciej <maciek@zmyslni.pl>
 * @license LGPL-3.0+
 */

/*
 * CTE name labels.
 */
$GLOBALS['TL_LANG']['CTE']['openingTags'] = array('Opening tags', 'Adds multiple html opening tags to the page.');
$GLOBALS['TL_LANG']['CTE']['closingTags'] = array('Closing tags', 'Adds multiple html closing tags to the page.');
$GLOBALS['TL_LANG']['CTE']['wrapperTags'] = 'Wrapper tags';

/*
 * CTE labels.
 */
$GLOBALS['TL_LANG']['MSC']['wt.dataCorrupted'] = 'Corrupted data';
$GLOBALS['TL_LANG']['MSC']['wrapperTagsStatus'] = 'Validation';
$GLOBALS['TL_LANG']['MSC']['wrapperTagsStatusOk'] = 'ok';
$GLOBALS['TL_LANG']['MSC']['wrapperTagsDataCorrupted'] = 'Corrupted data';
$GLOBALS['TL_LANG']['MSC']['wrapperTagsValidationError'] = 'Validation error';
$GLOBALS['TL_LANG']['MSC']['wrapperTagsStatusClosingNoOpening'] = 'Error: Closing tag "&lt;/%s&gt;" (id:%d) is without opening tag.';
$GLOBALS['TL_LANG']['MSC']['wrapperTagsStatusOpeningNoClosing'] = 'Error: Opening tag "&lt;%s&gt;" (id:%d) is without closing tag.';
$GLOBALS['TL_LANG']['MSC']['wrapperTagsStatusOpeningWrongPairing'] = 'Error: Opening tag "&lt;%s&gt;" (id:%d) is paired with closing tag "&lt;/%s&gt;" (id:%d).';
$GLOBALS['TL_LANG']['MSC']['wrapperTagsStatusOpeningWrongPairingWithOther'] = 'Error: Opening tag "&lt;%s&gt;" (id:%d) is paired with wrong closing element "%s" (id:%d).';
$GLOBALS['TL_LANG']['MSC']['wrapperTagsStatusClosingWrongPairingWithOther'] = 'Error: Closing tag "&lt;%s&gt;" (id:%d) is paired with wrong opening element "%s" (id:%d).';
$GLOBALS['TL_LANG']['MSC']['wrapperTagsStatusClosingWrongPairingNeedSplit'] = 'Error: Closing tags (id:%d) is paired with many smaller opening tags. First one is to big (id:%d).';
