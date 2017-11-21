<?php

/**
 * Copyright (C) 2017 Zmyslni
 *
 * @author  Ostrowski Maciej <http://contao-developer.pl>
 * @author  Ostrowski Maciej <maciek@zmyslni.pl>
 * @license LGPL
 */

$GLOBALS['TL_LANG']['tl_content']['openingTags'] = ['Opening tags', 'Choose opening tags. In corresponding content element named [Closing Tags] You will have to match this structure. So every opened &lt;DIV&gt; will have closing &lt;/DIV&gt;'];
$GLOBALS['TL_LANG']['tl_content']['closingTags'] = ['Closing tags', 'Choose closing tags that match structure in corresponding [Opening Tags] content element.'];
$GLOBALS['TL_LANG']['tl_content']['wrappertags_legend'] = 'Wrapper tags settings';
$GLOBALS['TL_LANG']['tl_content']['wrapperTagsTag'] = ['Tag', 'Select html tag'];
$GLOBALS['TL_LANG']['tl_content']['wrapperTagsClass'] = ['Class', 'Type in html classes'];
$GLOBALS['TL_LANG']['tl_content']['wrapperTagsId'] = ['Id', 'Type in id value'];

/**
 * Wrapper-tags status messages
 */
$GLOBALS['TL_LANG']['MSC']['wrapperTagsStatusOk'] = 'Opening tags match closing tags';
$GLOBALS['TL_LANG']['MSC']['wrapperTagsDataCorrupted'] = 'Data corrupted';
$GLOBALS['TL_LANG']['MSC']['wrapperTagsStatusClosingNoOpening'] = 'Error: Closing tag "&lt;/%s&gt;" (id:%d) is without opening tag.';
$GLOBALS['TL_LANG']['MSC']['wrapperTagsStatusOpeningNoClosing'] = 'Error: Opening tag "&lt;%s&gt;" (id:%d) is without closing tag.';
$GLOBALS['TL_LANG']['MSC']['wrapperTagsStatusOpeningWrongPairing'] = 'Error: Opening tag "&lt;%s&gt;" (id:%d) is paired with closing tag "&lt;/%s&gt;" (id:%d)';
