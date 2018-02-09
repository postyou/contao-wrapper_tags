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
$GLOBALS['TL_LANG']['CTE']['wt_opening_tags'] = array('Opening tags', 'Adds multiple html opening tags to the page.');
$GLOBALS['TL_LANG']['CTE']['wt_closing_tags'] = array('Closing tags', 'Adds multiple html closing tags to the page.');
$GLOBALS['TL_LANG']['CTE']['wrapper_tags'] = 'Wrapper tags';

/*
 * Wrapper tags validation labels
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
 * Opening tags validation labels
 */
$GLOBALS['TL_LANG']['MSC']['wt.errorAttributeNameAlreadyUsed'] = 'The attribute name "%s" used more then once';
$GLOBALS['TL_LANG']['MSC']['wt.errorAttributeNameWithoutValue'] = 'The attribute name "%s" is without a value';
$GLOBALS['TL_LANG']['MSC']['wt.errorAttributeValueWithoutName'] = 'The attribute value "%s" is without a name';
$GLOBALS['TL_LANG']['MSC']['wt.errorAttributeName'] = 'The attribute name "%s" has the wrong semantic. It must begin with a letter ([A-Za-z]) and may be followed by any number of letters, digits ([0-9]), hyphens ("-"), underscores ("_"), colons (":"), and periods ("."). It can also contain Contao insert tags.';
