<?php

/*
 * Copyright (C) 2018 Zmyslni
 *
 * @author  Ostrowski Maciej <http://contao-developer.pl>
 * @author  Ostrowski Maciej <maciek@zmyslni.pl>
 * @license LGPL-3.0+
 */

/*
 * CTE labels
 */
$GLOBALS['TL_LANG']['CTE']['wt_opening_tags'] = array('Opening tags', 'Adds multiple opened html tags to the page.');
$GLOBALS['TL_LANG']['CTE']['wt_closing_tags'] = array('Closing tags', 'Adds multiple closed html tags to the page.');
$GLOBALS['TL_LANG']['CTE']['wt_complete_tags'] = array('Complete tags', 'Adds multiple complete html tags to the page.');
$GLOBALS['TL_LANG']['CTE']['wrapper_tags'] = 'Wrapper tags';

/*
 * Wrapper tags structure validation statuses
 */
$GLOBALS['TL_LANG']['MSC']['wt.dataCorrupted'] = 'Corrupted data';
$GLOBALS['TL_LANG']['MSC']['wt.statusTitle'] = 'Wrapper tags';
$GLOBALS['TL_LANG']['MSC']['wt.statusOk'] = 'ok';
$GLOBALS['TL_LANG']['MSC']['wt.validationError'] = 'Validation error';
$GLOBALS['TL_LANG']['MSC']['wt.statusClosingNoOpening'] = 'Error: Closing tag "&lt;/%s&gt;" (id:%d) is without opening tag.';
$GLOBALS['TL_LANG']['MSC']['wt.statusOpeningNoClosing'] = 'Error: Opening tag "&lt;%s&gt;" (id:%d) is without closing tag.';
$GLOBALS['TL_LANG']['MSC']['wt.statusOpeningWrongPairing'] = 'Error: Opening tag "&lt;%s&gt;" (id:%d) is paired with closing tag "&lt;/%s&gt;" (id:%d).';
$GLOBALS['TL_LANG']['MSC']['wt.statusOpeningWrongPairingWithOther'] = 'Error: Opening tag "&lt;%s&gt;" (id:%d) is paired with wrong closing element "%s" (id:%d).';
$GLOBALS['TL_LANG']['MSC']['wt.statusClosingWrongPairingWithOther'] = 'Error: Closing tag "&lt;%s&gt;" (id:%d) is paired with wrong opening element "%s" (id:%d).';
$GLOBALS['TL_LANG']['MSC']['wt.statusClosingWrongPairingNeedSplit'] = 'Error: Closing tags (id:%d) is paired with many smaller opening tags. First one is to big (id:%d).';

/*
 * Opening tags widget validation errors
 */
$GLOBALS['TL_LANG']['MSC']['wt.errorAttributeNameAlreadyUsed'] = 'The attribute with a name "%s" is used more then once';
$GLOBALS['TL_LANG']['MSC']['wt.errorAttributeNameWithoutValue'] = 'The attribute with a name "%s" has no value entered';
$GLOBALS['TL_LANG']['MSC']['wt.errorAttributeValueWithoutName'] = 'The attribute with a value "%s" has no name entered';
$GLOBALS['TL_LANG']['MSC']['wt.errorAttributeName'] = 'The attribute name "%s" has the wrong syntax. It must begin with a letter ([A-Za-z]) and may be followed by any number of letters, digits ([0-9]), hyphens ("-"), underscores ("_"), colons (":"), and periods ("."). It can also contain Contao insert tags.';
