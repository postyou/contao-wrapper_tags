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
$GLOBALS['TL_LANG']['MSC']['wt.statusTitle'] = 'HTML-owe znaczniki';
$GLOBALS['TL_LANG']['MSC']['wt.statusOk'] = 'ok';
$GLOBALS['TL_LANG']['MSC']['wt.validationError'] = 'Błąd walidacji';
$GLOBALS['TL_LANG']['MSC']['wt.statusClosingNoOpening'] = 'Błąd: Domknięcie znacznika "&lt;/%s&gt;" (id:%d) bez znacznika otwierającego.';
$GLOBALS['TL_LANG']['MSC']['wt.statusOpeningNoClosing'] = 'Błąd: Otwarcie znacznika "&lt;%s&gt;" (id:%d) bez domknięcia.';
$GLOBALS['TL_LANG']['MSC']['wt.statusOpeningWrongPairing'] = 'Błąd: Otwarcie znacznika "&lt;%s&gt;" (id:%d) jest sparowane z domknięciem "&lt;/%s&gt;" (id:%d)';
$GLOBALS['TL_LANG']['MSC']['wt.statusOpeningWrongPairingWithOther'] = 'Błąd: Otwarcie znacznika "&lt;%s&gt;" (id:%d) jest sparowane z niewłaściwym elementem domykającym "%s" (id:%d).';
$GLOBALS['TL_LANG']['MSC']['wt.statusClosingWrongPairingWithOther'] = 'Błąd: Domknięcie znacznika "&lt;%s&gt;" (id:%d) jest sparowane z niewłaściwym elementem otwierającym "%s" (id:%d).';
$GLOBALS['TL_LANG']['MSC']['wt.statusClosingWrongPairingNeedSplit'] = 'Błąd: Domknięcie znacznika (id:%d) jest sparowane z wieloma mniejszymi otwarciami. Pierwsze z nich jest zbyt liczne (id:%d).';

/*
 * Opening tags widget validation errors
 */
$GLOBALS['TL_LANG']['MSC']['wt.errorAttributeNameAlreadyUsed'] = 'Nazwa atrybutu "%s" jest już użyta.';
$GLOBALS['TL_LANG']['MSC']['wt.errorAttributeNameWithoutValue'] = 'Atrybut "%s" nie ma wpisanej wartości.';
$GLOBALS['TL_LANG']['MSC']['wt.errorAttributeValueWithoutName'] = 'Atrybut o wartości "%s" nie ma wpisanej nazwy.';
$GLOBALS['TL_LANG']['MSC']['wt.errorAttributeName'] = 'Nazwa atrybutu "%s" jest błędna. Musi zaczynać się od litery ([A-Za-z]) potem może zawierać dowolną ilość liter, cyfr ([0-9]), myślników ("-"), podkreśleń ("_"), średników (":") oraz kropek ("."). Może również zawierać Contao-we insert-tagi.';
