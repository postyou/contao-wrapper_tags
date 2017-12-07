<?php

/**
 * Copyright (C) 2017 Zmyslni
 *
 * @author  Ostrowski Maciej <http://contao-developer.pl>
 * @author  Ostrowski Maciej <maciek@zmyslni.pl>
 * @license LGPL-3.0+
 */


$GLOBALS['TL_LANG']['tl_content']['openingTags'] = array('Otwieranie znaczników', 'Wybierz znaczniki do otwarcia. W odpowiadającym elemencie treści [Domykanie znaczników] ta struktura musi być odwzorowana. Każdy otwarty znacznik np. &lt;DIV&gt; musi mieć domknięty znacznik &lt;/DIV&gt;');
$GLOBALS['TL_LANG']['tl_content']['closingTags'] = array('Domykanie znaczników', 'Wybierz te znaczniki, które znajdują się w odpowiadającym elemencie treści [Otwieranie znaczników].');
$GLOBALS['TL_LANG']['tl_content']['wrapperTagsTag'] = array('Znacznik', 'Wybierz znacznik');
$GLOBALS['TL_LANG']['tl_content']['wrapperTagsClass'] = array('Class', 'Wpisz klasy');
$GLOBALS['TL_LANG']['tl_content']['wrapperTagsId'] = array('Id', 'Wpisz wartość id');
$GLOBALS['TL_LANG']['tl_content']['wrappertags_legend'] = 'Ustawienia HTML-owych znaczników';


/**
 * Wrapper-tags status messages
 */
$GLOBALS['TL_LANG']['MSC']['wrapperTagsStatusOk'] = 'Struktura znaczników jest poprawna';
$GLOBALS['TL_LANG']['MSC']['wrapperTagsDataCorrupted'] = 'Dane są uszkodzone';
$GLOBALS['TL_LANG']['MSC']['wrapperTagsValidationError'] = 'Błąd walidacji';
$GLOBALS['TL_LANG']['MSC']['wrapperTagsStatusClosingNoOpening'] = 'Błąd: Domknięcie znacznika "&lt;/%s&gt;" (id:%d) nie ma znacznika otwierającego.';
$GLOBALS['TL_LANG']['MSC']['wrapperTagsStatusOpeningNoClosing'] = 'Błąd: Otwarcie znacznika "&lt;%s&gt;" (id:%d) nie ma domknięcia.';
$GLOBALS['TL_LANG']['MSC']['wrapperTagsStatusOpeningWrongPairing'] = 'Błąd: Otwarcie znacznika "&lt;%s&gt;" (id:%d) jest sparowane z domknięciem "&lt;/%s&gt;" (id:%d)';
$GLOBALS['TL_LANG']['MSC']['wrapperTagsStatusOpeningWrongPairingWithOther'] = 'Błąd: Otwarcie znacznika "&lt;%s&gt;" (id:%d) jest sparowane z niewłaściwym elementem domykającym "%s" (id:%d).';
$GLOBALS['TL_LANG']['MSC']['wrapperTagsStatusClosingWrongPairingWithOther'] = 'Błąd: Domknięcie znacznika "&lt;%s&gt;" (id:%d) jest sparowane z niewłaściwym elementem otwierającym "%s" (id:%d).';
$GLOBALS['TL_LANG']['MSC']['wrapperTagsStatusClosingWrongPairingNeedSplit'] = 'Błąd: Domknięcie znacznika (id:%d) jest sparowane z wieloma mniejszymi otwarciami. Pierwsze z nich jest za duże (id:%d).';
