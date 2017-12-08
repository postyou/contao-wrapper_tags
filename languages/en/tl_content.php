<?php

/**
 * Copyright (C) 2017 Zmyslni
 *
 * @author  Ostrowski Maciej <http://contao-developer.pl>
 * @author  Ostrowski Maciej <maciek@zmyslni.pl>
 * @license LGPL-3.0+
 */


$GLOBALS['TL_LANG']['tl_content']['openingTags'] = array('Opening tags', 'Choose html tags to open. In corresponding content element named [Closing Tags] you will have to match this structure. So every opened &lt;div&gt; should have closing &lt;/div&gt;');
$GLOBALS['TL_LANG']['tl_content']['closingTags'] = array('Closing tags', 'Choose html tags to close that match structure in corresponding [Opening Tags] content element.');
$GLOBALS['TL_LANG']['tl_content']['wrapperTagsTag'] = array('Tag', 'Select html tag');
$GLOBALS['TL_LANG']['tl_content']['wrapperTagsClass'] = array('Class', 'Type in html classes');
$GLOBALS['TL_LANG']['tl_content']['wrapperTagsId'] = array('Id', 'Type in html id value');
$GLOBALS['TL_LANG']['tl_content']['wrapperTagsStyle'] = array('Style', 'Type in css styles');
$GLOBALS['TL_LANG']['tl_content']['wrappertags_legend'] = 'Wrapper tags settings';


/**
 * Wrapper-tags status messages
 */
$GLOBALS['TL_LANG']['MSC']['wrapperTagsStatusOk'] = 'Opening tags match closing tags.';
$GLOBALS['TL_LANG']['MSC']['wrapperTagsDataCorrupted'] = 'Corrupted data';
$GLOBALS['TL_LANG']['MSC']['wrapperTagsValidationError'] = 'Validation error';
$GLOBALS['TL_LANG']['MSC']['wrapperTagsStatusClosingNoOpening'] = 'Error: Closing tag "&lt;/%s&gt;" (id:%d) is without opening tag.';
$GLOBALS['TL_LANG']['MSC']['wrapperTagsStatusOpeningNoClosing'] = 'Error: Opening tag "&lt;%s&gt;" (id:%d) is without closing tag.';
$GLOBALS['TL_LANG']['MSC']['wrapperTagsStatusOpeningWrongPairing'] = 'Error: Opening tag "&lt;%s&gt;" (id:%d) is paired with closing tag "&lt;/%s&gt;" (id:%d).';
$GLOBALS['TL_LANG']['MSC']['wrapperTagsStatusOpeningWrongPairingWithOther'] = 'Error: Opening tag "&lt;%s&gt;" (id:%d) is paired with wrong closing element "%s" (id:%d).';
$GLOBALS['TL_LANG']['MSC']['wrapperTagsStatusClosingWrongPairingWithOther'] = 'Error: Closing tag "&lt;%s&gt;" (id:%d) is paired with wrong opening element "%s" (id:%d).';
$GLOBALS['TL_LANG']['MSC']['wrapperTagsStatusClosingWrongPairingNeedSplit'] = 'Error: Closing tags (id:%d) is paired with many smaller opening tags. First one is to big (id:%d).';
