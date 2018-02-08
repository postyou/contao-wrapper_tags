<?php

/*
 * Copyright (C) 2018 Zmyslni
 *
 * @author  Ostrowski Maciej <http://contao-developer.pl>
 * @author  Ostrowski Maciej <maciek@zmyslni.pl>
 * @license LGPL-3.0+
 */


$GLOBALS['TL_LANG']['tl_content']['wt_opening_tags'] = array('Otwieranie znaczników', 'Wybierz znaczniki do otwarcia. W odpowiadającym elemencie treści [Domykanie znaczników] ta struktura musi być odwzorowana. Każdy otwarty znacznik np. &lt;DIV&gt; musi mieć domknięty znacznik &lt;/DIV&gt;');
$GLOBALS['TL_LANG']['tl_content']['wt_closing_tags'] = array('Domykanie znaczników', 'Wybierz te znaczniki, które znajdują się w odpowiadającym elemencie treści [Otwieranie znaczników].');
$GLOBALS['TL_LANG']['tl_content']['wt_tag'] = array('Znacznik', 'Wybierz znacznik');
$GLOBALS['TL_LANG']['tl_content']['wt_class'] = array('Class', 'Wpisz klasy');
$GLOBALS['TL_LANG']['tl_content']['wrappertags_legend'] = 'Ustawienia HTML-owych znaczników';


/**
 * Wrapper-tags status messages
 */
$GLOBALS['TL_LANG']['MSC']['wt.statusTitle'] = 'Struktura';
$GLOBALS['TL_LANG']['MSC']['wt.statusOk'] = 'poprawna';
$GLOBALS['TL_LANG']['MSC']['wt.dataCorrupted'] = 'Dane są uszkodzone';
$GLOBALS['TL_LANG']['MSC']['wt.validationError'] = 'Błąd walidacji';
$GLOBALS['TL_LANG']['MSC']['wt.statusClosingNoOpening'] = 'Błąd: Domknięcie znacznika "&lt;/%s&gt;" (id:%d) nie ma znacznika otwierającego.';
$GLOBALS['TL_LANG']['MSC']['wt.statusOpeningNoClosing'] = 'Błąd: Otwarcie znacznika "&lt;%s&gt;" (id:%d) nie ma domknięcia.';
$GLOBALS['TL_LANG']['MSC']['wt.statusOpeningWrongPairing'] = 'Błąd: Otwarcie znacznika "&lt;%s&gt;" (id:%d) jest sparowane z domknięciem "&lt;/%s&gt;" (id:%d)';
$GLOBALS['TL_LANG']['MSC']['wt.statusOpeningWrongPairingWithOther'] = 'Błąd: Otwarcie znacznika "&lt;%s&gt;" (id:%d) jest sparowane z niewłaściwym elementem domykającym "%s" (id:%d).';
$GLOBALS['TL_LANG']['MSC']['wt.statusClosingWrongPairingWithOther'] = 'Błąd: Domknięcie znacznika "&lt;%s&gt;" (id:%d) jest sparowane z niewłaściwym elementem otwierającym "%s" (id:%d).';
$GLOBALS['TL_LANG']['MSC']['wt.statusClosingWrongPairingNeedSplit'] = 'Błąd: Domknięcie znacznika (id:%d) jest sparowane z wieloma mniejszymi otwarciami. Pierwsze z nich jest za duże (id:%d).';
