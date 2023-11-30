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
$GLOBALS['TL_LANG']['CTE']['wt_opening_tags'] = array('&Ouml;ffnende Elemente', 'F&uuml;gt mehrere &ouml;ffnende HTML Elementen der Seite hinzu.');
$GLOBALS['TL_LANG']['CTE']['wt_closing_tags'] = array('Schlie&szlig;ende Elemente', 'F&uuml;gt mehrere schlie&szlig;ende HTML Elementen der Seite hinzu.');
$GLOBALS['TL_LANG']['CTE']['wt_complete_tags'] = array('Alleinstehende Elemente', 'F&uuml;gt mehrere alleinstehende HTML Elemente der Seite hinzu.');
$GLOBALS['TL_LANG']['CTE']['wrapper_tags'] = 'Wrapper Elemente';

/*
 * Wrapper tags structure validation statuses
 */
$GLOBALS['TL_LANG']['MSC']['wt.dataCorrupted'] = 'Fehlerhafte Daten';
$GLOBALS['TL_LANG']['MSC']['wt.statusTitle'] = 'Wrapper Elemente';
$GLOBALS['TL_LANG']['MSC']['wt.statusOk'] = 'ok';
$GLOBALS['TL_LANG']['MSC']['wt.validationError'] = 'Validierungsfehler';
$GLOBALS['TL_LANG']['MSC']['wt.statusClosingNoOpening'] = 'Fehler: Schlie&szlig;endes Element "&lt;/%s&gt;" (id:%d) besitzt kein &Ouml;ffnendes Element.';
$GLOBALS['TL_LANG']['MSC']['wt.statusOpeningNoClosing'] = 'Fehler: &Ouml;ffnendes Element "&lt;%s&gt;" (id:%d) besitzt kein schlie&szlig;endes Element.';
$GLOBALS['TL_LANG']['MSC']['wt.statusOpeningWrongPairing'] = 'Fehler: &Ouml;ffnendes Element "&lt;%s&gt;" (id:%d) wurde mit schlie&szlig;endem Element "&lt;/%s&gt;" (id:%d) verkn&uuml;pft.';
$GLOBALS['TL_LANG']['MSC']['wt.statusOpeningWrongPairingWithOther'] = 'Fehler: &Ouml;ffnendes Element "&lt;%s&gt;" (id:%d) besitzt das falsche schlie&szlig;ende Element "%s" (id:%d).';
$GLOBALS['TL_LANG']['MSC']['wt.statusClosingWrongPairingWithOther'] = 'Fehler: Schlie&szlig;endes Element "&lt;%s&gt;" (id:%d) besitzt das falsche &Ouml;ffnende Element "%s" (id:%d).';
$GLOBALS['TL_LANG']['MSC']['wt.statusClosingWrongPairingNeedSplit'] = 'Fehler: Schlie&szlig;ende Elemente (id:%d) sind mit vielen kleineren &Ouml;ffnenden Elemente verkn&uuml;pft. Das Beginnende ist zu gro&szlig; (id:%d).';

/*
 * Opening tags widget validation errors
 */
$GLOBALS['TL_LANG']['MSC']['wt.errorAttributeNameAlreadyUsed'] = 'Das Attribut mit dem Namen "%s" wurde mehr als einmal benutzt';
$GLOBALS['TL_LANG']['MSC']['wt.errorAttributeNameWithoutValue'] = 'Dem Attribut mit dem Namen "%s" wurde kein Wert zugewiesen';
$GLOBALS['TL_LANG']['MSC']['wt.errorAttributeValueWithoutName'] = 'Dem Attribut mit dem Wert "%s" wurde kein Name zugewiesen';
$GLOBALS['TL_LANG']['MSC']['wt.errorAttributeName'] = 'Das Attribut mit dem Namen "%s" wurde mit fehlerhafter Syntax eingegeben. Es muss mit einem Buchstaben ([A-Za-z]) beginnen gefolgt von beliebiger Anzahl weiterer Buchstaben, Zahlen ([0-9]), Bindestriche ("-"), Unterstriche ("_"), Doppelpunkte (":"), und Punkten ("."). Au&szlig;erdem k&Ouml;nnen Contao Insert Tags verwendet werden.';
