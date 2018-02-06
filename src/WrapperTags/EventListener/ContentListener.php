<?php

/*
 * Copyright (C) 2018 Zmyslni
 *
 * @author  Ostrowski Maciej <http://contao-developer.pl>
 * @author  Ostrowski Maciej <maciek@zmyslni.pl>
 * @license LGPL-3.0+
 */

namespace Zmyslny\WrapperTags\EventListener;

use Contao\DataContainer;

/**
 * Class ContentListener
 * @package Zmyslny\WrapperTags\EventListener
 */
class ContentListener extends \tl_content
{
    /**
     * On record save callback.
     *
     * @param $data
     * @param DataContainer $dc
     * @return string
     * @throws \Exception
     */
    public function onSaveCallback($data, DataContainer $dc)
    {
        $tags = deserialize($data);

        foreach ($tags as &$tag) {

            // Validate attributes
            if ($tag['attributes']) {

                $attributes = [];

                foreach ($tag['attributes'] as $attribute) {

                    // The attribute name must not contain any whitespace
                    $attribute['name'] = preg_replace('/\s+/', '', $attribute['name']);
                    $attribute['value'] = trim($attribute['value']);

                    if ('' !== $attribute['name'] && '' === $attribute['value']) {
                        throw new \Exception('The attribute name "' . $attribute['name'] . '" is without a value');
                    }

                    if ('' === $attribute['name'] && '' !== $attribute['value']) {
                        throw new \Exception('The attribute value "' . $attribute['value'] . '" is without a name');
                    }

                    if (is_numeric($attribute['name'])) {
                        throw new \Exception('The attribute name must not be a number');
                    }

                    // Allow attributes with non-empty name & value
                    if ('' !== $attribute['name'] && '' !== $attribute['value']) {
                        $attributes[] = $attribute;
                    }
                }

                $tag['attributes'] = $attributes;
            }
        }

        return serialize($tags);
    }

    /**
     * Set html class on each CTE from list view.
     *
     * Class being set in this function will be set to the next CTE then CTE of $row element. That is why
     * $GLOBALS['WrapperTags']['indents'] array was offset so every cteId point to class of the next element.
     *
     * @param $row
     * @return string
     */
    public function onChildRecordCallback($row)
    {
        if (isset($GLOBALS['WrapperTags']['indents']) && is_array($GLOBALS['WrapperTags']['indents'])) {

            $indent = $GLOBALS['WrapperTags']['indents'][$row['id']];

            if (null !== $indent) {
                $this->setChildRecordClass($indent);
            }
        }

        // standard Contao child-record-callback
        return parent::addCteType($row);
    }


    /**
     * Sets css class into "child_record_class" setting.
     *
     * @param array $indent
     */
    protected function setChildRecordClass($indent)
    {
        $wrapperTagClass = $indent['type'] === 'openingTags' || $indent['type'] === 'closingTags' ? 'wrapper-tag' : '';
        $middleClass = (isset($indent['middle'])) ? ' indent-tags-closing-middle' : '';
        
        $GLOBALS['TL_DCA']['tl_content']['list']['sorting']['child_record_class'] = $indent['value'] > 0 ? 'clear-indent ' . $wrapperTagClass . ' indent indent_' . $indent['value'] . $middleClass . ' ' . $indent['colorize-class'] : 'clear-indent ' . $wrapperTagClass . ' indent_0 ' . $middleClass;
    }
}
