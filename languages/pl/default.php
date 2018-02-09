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
$GLOBALS['TL_LANG']['CTE']['wt_opening_tags'] = array('Otwieranie znaczników', 'Dodaje wiele otwarć znaczników do strony.');
$GLOBALS['TL_LANG']['CTE']['wt_closing_tags'] = array('Domykanie znaczników', 'Dodaje wiele domknięć znaczników do strony.');
$GLOBALS['TL_LANG']['CTE']['wrapper_tags'] = 'HTML-owe znaczniki';

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
$GLOBALS['TL_LANG']['MSC']['wt.errorAttributeNameAlreadyUsed'] = 'The attribute name "%s" used more then once';
$GLOBALS['TL_LANG']['MSC']['wt.errorAttributeNameWithoutValue'] = 'The attribute name "%s" is without a value';
$GLOBALS['TL_LANG']['MSC']['wt.errorAttributeValueWithoutName'] = 'The attribute value "%s" is without a name';
$GLOBALS['TL_LANG']['MSC']['wt.errorAttributeName'] = 'The attribute name "%s" has the wrong semantic. It must begin with a letter ([A-Za-z]) and may be followed by any number of letters, digits ([0-9]), hyphens ("-"), underscores ("_"), colons (":"), and periods ("."). It can also contain Contao insert tags.';


/**
 * Wrapper-tags status messages
 */
//$GLOBALS['TL_LANG']['MSC']['wt.statusTitle'] = 'Struktura';
//$GLOBALS['TL_LANG']['MSC']['wt.statusOk'] = 'poprawna';
//$GLOBALS['TL_LANG']['MSC']['wt.dataCorrupted'] = 'Dane są uszkodzone';
//$GLOBALS['TL_LANG']['MSC']['wt.validationError'] = 'Błąd walidacji';
//$GLOBALS['TL_LANG']['MSC']['wt.statusClosingNoOpening'] = 'Błąd: Domknięcie znacznika "&lt;/%s&gt;" (id:%d) nie ma znacznika otwierającego.';
//$GLOBALS['TL_LANG']['MSC']['wt.statusOpeningNoClosing'] = 'Błąd: Otwarcie znacznika "&lt;%s&gt;" (id:%d) nie ma domknięcia.';
//$GLOBALS['TL_LANG']['MSC']['wt.statusOpeningWrongPairing'] = 'Błąd: Otwarcie znacznika "&lt;%s&gt;" (id:%d) jest sparowane z domknięciem "&lt;/%s&gt;" (id:%d)';
//$GLOBALS['TL_LANG']['MSC']['wt.statusOpeningWrongPairingWithOther'] = 'Błąd: Otwarcie znacznika "&lt;%s&gt;" (id:%d) jest sparowane z niewłaściwym elementem domykającym "%s" (id:%d).';
//$GLOBALS['TL_LANG']['MSC']['wt.statusClosingWrongPairingWithOther'] = 'Błąd: Domknięcie znacznika "&lt;%s&gt;" (id:%d) jest sparowane z niewłaściwym elementem otwierającym "%s" (id:%d).';
//$GLOBALS['TL_LANG']['MSC']['wt.statusClosingWrongPairingNeedSplit'] = 'Błąd: Domknięcie znacznika (id:%d) jest sparowane z wieloma mniejszymi otwarciami. Pierwsze z nich jest za duże (id:%d).';
