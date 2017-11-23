<?php

/**
 * Copyright (C) 2017 Zmyslni
 *
 * @author  Ostrowski Maciej <http://contao-developer.pl>
 * @author  Ostrowski Maciej <maciek@zmyslni.pl>
 * @license LGPL
 */

$tl_content = &$GLOBALS['TL_DCA']['tl_content'];

$GLOBALS['TL_DCA']['tl_content']['list']['sorting']['child_record_callback'] = array('tl_content_wrapper_tags', 'childRecordCallback');

$tl_content['list']['sorting']['header_callback'] = array('tl_content_wrapper_tags', 'validateAndFixIndents');

$tl_content['palettes']['openingTags'] = '{type_legend},type;{wrappertags_legend},openingTags;{template_legend:hide},customTpl;{invisible_legend:hide},invisible,start,stop';
$tl_content['palettes']['closingTags'] = '{type_legend},type;{wrappertags_legend},closingTags;{template_legend:hide},customTpl;{invisible_legend:hide},invisible,start,stop';

$tl_content['fields']['openingTags'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['openingTags'],
    'exclude' => true,
    'inputType' => 'multiColumnWizard',
    'eval' => array('mandatory' => true, 'columnsCallback' => array('tl_content_wrapper_tags', 'openingTagsCallback')),
    'sql' => 'blob NULL'
);

$tl_content['fields']['closingTags'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['closingTags'],
    'exclude' => true,
    'inputType' => 'multiColumnWizard',
    'eval' => array('mandatory' => true, 'columnsCallback' => array('tl_content_wrapper_tags', 'closingTagsCallback')),
    'sql' => 'blob NULL'
);

class tl_content_wrapper_tags extends tl_content
{

    public function childRecordCallback($arrRow)
    {
        if (isset($GLOBALS['WrapperTags']['indents']) && is_array($GLOBALS['WrapperTags']['indents'])) {

            $indent = $GLOBALS['WrapperTags']['indents'][$arrRow['id']];

            if ($indent !== null) {
                $middleClass = (isset($indent['middle'])) ? ' indent-tags-closing-middle' : '';
                $GLOBALS['TL_DCA']['tl_content']['list']['sorting']['child_record_class'] = $indent['value'] > 0 ? 'clear-indent indent-tags indent-tags-' . $indent['value'] . $middleClass : 'clear-indent' . $middleClass;
            }
        }

        // standard Contao child-record-callback
        return parent::addCteType($arrRow);
    }

    /**
     * @return array
     */
    public function getTags()
    {
        return array('div', 'span', 'article', 'p', 'pre', 'aside', 'ul', 'ol', 'li');
    }

    /**
     * Provides columnsCallback for multiColumnWizard field 'closingTags'
     *
     * @return array
     */
    public function closingTagsCallback()
    {
        return array(
            'tag' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_content']['wrapperTagsTag'],
                'inputType' => 'select',
                'options_callback' => array('tl_content_wrapper_tags', 'getTags'),
                'eval' => array('style' => 'width:100px;margin-right:10px;', 'tl_class' => 'w50 clr'),
            )
        );
    }

    /**
     * Provides columnsCallback for multiColumnWizard field 'openingTags'
     *
     * @return array
     */
    public function openingTagsCallback()
    {
        return array(
            'tag' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_content']['wrapperTagsTag'],
                'inputType' => 'select',
                'options_callback' => array('tl_content_wrapper_tags', 'getTags'),
                'eval' => array('style' => 'width:100px;margin-right:5px;'),
            ),
            'class' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_content']['wrapperTagsClass'],
                'exclude' => true,
                'inputType' => 'text',
                'eval' => array('style' => 'width:100px;margin-right:5px;'),
            ),
            'id' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_content']['wrapperTagsId'],
                'exclude' => true,
                'inputType' => 'text',
                'eval' => array('style' => 'width:100px;margin-right:5px;'),
            )
        );
    }


    /**
     * Checks whether every start wrapper has its corresponding stop wrapper.
     *
     * @param $add
     * @param DataContainer $dc
     * @return array
     */
    public function validateAndFixIndents($add, DataContainer $dc)
    {
        // check whether there is any published wrapper-tags cte
        $result = $this->Database
            ->prepare("
                SELECT id
                FROM `tl_content`
                WHERE pid = ? AND invisible != ? AND type IN ('openingTags','closingTags')
                ")
            ->execute($dc->id, '1');

        if ($result->numRows === 0) {

            // no published wrapper-tags elements in this article
            return $add;
        }

        // get all content elements from this article
        $query = '
            SELECT id, type, openingTags, closingTags, invisible
            FROM `tl_content`
            WHERE pid = ? 
            ORDER BY sorting ASC
        ';

        $stmt = $this->Database->prepare($query);

        // ! do not set limit - validation needs all elements

        $result = $stmt->execute($dc->id);

        $statusTitle = $GLOBALS['TL_LANG']['CTE']['wrapperTags'];
        $status = array();

        if ($result->numRows === 0) {
            $status[$statusTitle] = '<span class="tl_red">' . $GLOBALS['TL_LANG']['MSC']['wrapperTagsValidationError'] . '</span>';
            return $add + $status;
        }

        /*
         * There are some wrapper-tags elements so validate their structure and correct indents
         */

        $ctes = $result->fetchAllAssoc();
        unset($result); // free memory

        $indentLevel = 0;
        $openStack = array();
        $status = array();

        // helps to show only the first error
        $hasError = false;

        foreach ($ctes as $cte) {

            $isWrapperStart = in_array($cte['type'], $GLOBALS['TL_WRAPPERS']['start']);
            $isWrapperStop = in_array($cte['type'], $GLOBALS['TL_WRAPPERS']['stop']);
            $isVisible = $cte['invisible'] !== '1';

            if ($isWrapperStart) {

                if ('openingTags' !== $cte['type']) {

                    if ($isVisible) {

                        // put wrapper start (whatever type it is) on stack
                        $openStack[] = array(
                            'id' => $cte['id'],
                            'type' => $cte['type']
                        );

                        $GLOBALS['WrapperTags']['indents'][$cte['id']] = array('type' => $cte['type'], 'value' => $indentLevel);
                        ++$indentLevel;

                    } else {

                        $GLOBALS['WrapperTags']['indents'][$cte['id']] = array('type' => $cte['type'], 'value' => $indentLevel);
                    }

                } else {

                    if ($isVisible) {

                        // every opened tag from openingTags put on stack

                        $startTags = unserialize($cte['openingTags']);

                        if (!$hasError) {
                            if (!is_array($startTags)) {
                                $status[$statusTitle] = '<span class="tl_red">' . $GLOBALS['TL_LANG']['MSC']['wrapperTagsDataCorrupted'] . '</span>';
                                $hasError = true;
                            }
                        }

                        $openStack[] = array(
                            'id' => $cte['id'],
                            'type' => 'openingTags',
                            'tags' => $startTags,
                            'count' => count($startTags)
                        );

                        $GLOBALS['WrapperTags']['indents'][$cte['id']] = array('type' => $cte['type'], 'value' => $indentLevel);
                        ++$indentLevel;

                    } else {

                        $GLOBALS['WrapperTags']['indents'][$cte['id']] = array('type' => $cte['type'], 'value' => $indentLevel);
                    }
                }

            } elseif ($isWrapperStop) {

                if ('closingTags' !== $cte['type']) {

                    if ($isVisible) {

                        $openingTags = $openStack[count($openStack) - 1];

                        if (!$hasError) {

                            // Last opened wrapper is of type 'openingTags'. Because now we are stepping on closing element
                            // not of type 'closingTags' so the pairing is wrong.
                            if ($openingTags !== null && $openingTags['type'] === 'openingTags') {

                                $status[$statusTitle] = '<span class="tl_red">' . sprintf($GLOBALS['TL_LANG']['MSC']['wrapperTagsStatusOpeningWrongPairingWithOther'], $openingTags['tags'][count($openingTags['tags']) - 1]['tag'], $openingTags['id'], $GLOBALS['TL_LANG']['CTE'][$cte['type']][0], $cte['id']) . '</span>';
                                $hasError = true;
                            }
                        }

                        array_pop($openStack);
                        --$indentLevel;
                    }

                    $GLOBALS['WrapperTags']['indents'][$cte['id']] = array('type' => $cte['type'], 'value' => $indentLevel);

                } else {

                    $GLOBALS['WrapperTags']['indents'][$cte['id']] = array('type' => $cte['type'], 'value' => ($indentLevel > 1 ? $indentLevel - 1 : 0));

                    if (!$isVisible) {

                        $GLOBALS['WrapperTags']['indents'][$cte['id']]['value'] += $indentLevel > 0 ? 1 : 0;

                    } else {

                        $closingTags = unserialize($cte['closingTags']);

                        if (!$hasError) {
                            if (!is_array($closingTags)) {
                                $status[$statusTitle] = '<span class="tl_red">' . $GLOBALS['TL_LANG']['MSC']['wrapperTagsDataCorrupted'] . '</span>';
                                $hasError = true;
                            }
                        }

                        if (count($openStack) === 0) {
                            // case 1: no more opened tags on stack

                            if (!$hasError) {
                                $status[$statusTitle] = '<span class="tl_red">' . sprintf($GLOBALS['TL_LANG']['MSC']['wrapperTagsStatusClosingNoOpening'], $closingTags[count($closingTags) - 1]['tag'], $cte['id']) . '</span>';
                                $hasError = true;
                            }

                        } elseif ('openingTags' !== $openStack[count($openStack) - 1]['type']) {
                            // case 2: closing element is paired with wrong opening element - it is not of type 'openingTags'

                            $openingTags = array_pop($openStack);

                            if (!$hasError) {
                                $status[$statusTitle] = '<span class="tl_red">' . sprintf($GLOBALS['TL_LANG']['MSC']['wrapperTagsStatusClosingWrongPairingWithOther'], $closingTags[0]['tag'], $cte['id'], $GLOBALS['TL_LANG']['CTE'][$openingTags['type']][0], $openingTags['id']) . '</span>';
                                $hasError = true;
                            }

                            --$indentLevel;

                        } else {
                            // case 3: proper pairing with type 'openingTags'

                            if ($openStack[count($openStack) - 1]['count'] >= count($closingTags)) {
                                // case 3.1: ONE big openingTags element paired with ONE or MORE smaller closingTags elements

                                $openingWasPaired = false;

                                foreach ($closingTags as $closingTag) {

                                    if (count($openStack) === 0) {

                                        if (!$hasError) {
                                            $status[$statusTitle] = '<span class="tl_red">' . sprintf($GLOBALS['TL_LANG']['MSC']['wrapperTagsStatusClosingNoOpening'], $closingTag['tag'], $cte['id']) . '</span>';
                                            $hasError = true;
                                        }

                                        break;
                                    }

                                    $openingTag = array_pop($openStack[count($openStack) - 1]['tags']);

                                    if ($closingTag['tag'] !== $openingTag['tag']) {

                                        if (!$hasError) {
                                            $status[$statusTitle] = '<span class="tl_red">' . sprintf($GLOBALS['TL_LANG']['MSC']['wrapperTagsStatusOpeningWrongPairing'], $openingTag['tag'], $openStack[count($openStack) - 1]['id'], $closingTag['tag'], $cte['id']) . '</span>';
                                            $hasError = true;
                                        }
                                    }

                                    if (count($openStack[count($openStack) - 1]['tags']) === 0) {

                                        array_pop($openStack);
                                        --$indentLevel;

                                        $openingWasPaired = true;
                                    }
                                }

                                if (!$openingWasPaired) {
                                    // closingTag element was not the last one, it is the middle closingTags element
                                    $GLOBALS['WrapperTags']['indents'][$cte['id']]['middle'] = true;
                                }

                            } else {
                                // case 3.2: MANY small openingTags elements paired with ONE bigger closingTags element

                                $indentDown = 0;
                                $lastPairedId = 0;
                                $lastElementWasPaired = false;
                                $openingTagsPaired = array();

                                foreach ($closingTags as $closingTag) {

                                    if (count($openStack) === 0) {

                                        if (!$hasError) {
                                            $status[$statusTitle] = '<span class="tl_red">' . sprintf($GLOBALS['TL_LANG']['MSC']['wrapperTagsStatusClosingNoOpening'], $closingTag['tag'], $cte['id']) . '</span>';
                                            $hasError = true;
                                        }

                                        break;

                                    } else {
                                        $lastElementWasPaired = false;
                                    }

                                    $openingTags = &$openStack[count($openStack) - 1];

                                    if ($ctes[$openingTags['id']]['invisible'] != '1') {

                                        $openingTag = array_pop($openingTags['tags']);
                                        $lastPairedId = (int)$openingTags['id'];

                                        if ($closingTag['tag'] !== $openingTag['tag']) {

                                            if (!$hasError) {
                                                $status[$statusTitle] = '<span class="tl_red">' . sprintf($GLOBALS['TL_LANG']['MSC']['wrapperTagsStatusOpeningWrongPairing'], $openingTag['tag'], $openingTags['id'], $closingTag['tag'], $cte['id']) . '</span>';
                                                $hasError = true;
                                            }
                                        }

                                        if (count($openingTags['tags']) === 0) {

                                            $openingTagsPaired[$openingTags['id']] = $openingTags;
                                            array_pop($openStack);
                                            $lastElementWasPaired = true;

                                            ++$indentDown;
                                        }
                                    }
                                }

                                // Last paired opening tags element is still has not paired, has single html tag left
                                if (!$lastElementWasPaired) {

                                    if (!$hasError) {
                                        $status[$statusTitle] = '<span class="tl_red">' . sprintf($GLOBALS['TL_LANG']['MSC']['wrapperTagsStatusClosingWrongPairingNeedSplit'], $cte['id'], $openStack[count($openStack) - 1]['id']) . '</span>';
                                        $hasError = true;
                                    }

                                    ++$indentDown;
                                }

                                $indentLevel = $indentLevel - $indentDown;
                                $GLOBALS['WrapperTags']['indents'][$cte['id']] = array('type' => $cte['type'], 'value' => $indentLevel);

                                // iterate backwards and correct indents
                                $ids = array_keys($GLOBALS['WrapperTags']['indents']);
                                for ($i = count($ids) - 2; $i >= 0; --$i) {

                                    if ($ids[$i] === $lastPairedId) {
                                        break;
                                    }

                                    $element = &$GLOBALS['WrapperTags']['indents'][$ids[$i]];
                                    $element['value'] = $element['value'] - $indentDown + 1;

                                    if (isset($openingTagsPaired[$ids[$i]])) {
                                        --$indentDown;
                                    }
                                }

                            }
                        }

                    }
                }

            } else {

                // not a wrapper element
                $GLOBALS['WrapperTags']['indents'][$cte['id']] = array('type' => $cte['type'], 'value' => $indentLevel);
            }

        }

        if (!$hasError) {

            if (count($openStack)) {

                // check whether there is openingTags element on stack
                for ($i = count($openStack) - 1; $i >= 0; --$i) {

                    if ($openStack[$i]['type'] === 'openingTags') {

                        $status[$statusTitle] = '<span class="tl_red">' . sprintf($GLOBALS['TL_LANG']['MSC']['wrapperTagsStatusOpeningNoClosing'], $openStack[$i]['tags'][count($openStack[$i]['tags']) - 1]['tag'], $openStack[$i]['id']) . '</span>';
                        $hasError = true;
                        break;
                    }
                }
            }
        }

        if (!$hasError) {
            $status[$statusTitle] = $GLOBALS['TL_LANG']['MSC']['wrapperTagsStatusOk'];
        }

        /*
         * Indents will be used in childRecordCallback.
         *
         * First element child_record_class must be set before child_record_callback is called, e.g. in this function.
         */

        if (class_exists('ReflectionClass')) {

            $reflectionClass = new ReflectionClass('DC_Table');
            $reflectionProperty = $reflectionClass->getProperty('limit');
            $reflectionProperty->setAccessible(true);
            $limit = $reflectionProperty->getValue($dc);

            if (strlen($limit)) {
                $limit = explode(',', $limit);
                $offset = (int)$limit[0];

                // set first child_record_class when paging
                if ($offset > 0) {
                    $index = 1;
                    $firstElementOnPage = $offset + 1;
                    foreach ($GLOBALS['WrapperTags']['indents'] as $indent) {
                        if ($index === $firstElementOnPage) {
                            $middleClass = (isset($indent['middle'])) ? ' indent-tags-closing-middle' : '';
                            $GLOBALS['TL_DCA']['tl_content']['list']['sorting']['child_record_class'] = $indent['value'] > 0 ? 'clear-indent indent-tags indent-tags-' . $indent['value'] . $middleClass : 'clear-indent' . $middleClass;
                            break;
                        }
                        ++$index;
                    }
                }
            }
        }

        /*
         * When we set child_record_class in child_record_callback, it will be set for the next element then element
         * for which that function is called. So indent values must be offset. Every element id must point to the indent
         * value of the next element.
         */

        end($GLOBALS['WrapperTags']['indents']);
        $lastKey = key($GLOBALS['WrapperTags']['indents']);
        $lastIndent = $GLOBALS['WrapperTags']['indents'][$lastKey];

        $reversed = array_reverse($GLOBALS['WrapperTags']['indents'], true);

        foreach ($reversed as $id => &$indent) {
            $nowIndent = $indent;
            $indent = $lastIndent;
            $lastIndent = $nowIndent;
        }

        $GLOBALS['WrapperTags']['indents'] = array_reverse($reversed, true);

        return $add + $status;
    }

}