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
class ContentListener
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
}
