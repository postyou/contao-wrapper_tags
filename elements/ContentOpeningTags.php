<?php

/**
 * Copyright (C) 2017 Zmyslni
 *
 * @author  Ostrowski Maciej <http://contao-developer.pl>
 * @author  Ostrowski Maciej <maciek@zmyslni.pl>
 * @license LGPL-3.0+
 */

namespace Zmyslny\WrapperTags;

use Contao\BackendTemplate;
use Contao\ContentElement;
use Contao\StringUtil;

class ContentOpeningTags extends ContentElement
{
    protected $strTemplate = 'ce_wrapper_tags_opening';

    /**
     * Tags stored.
     *
     * @var array
     */
    protected $tags;

    public function generate()
    {
        $this->tags = unserialize($this->openingTags);

        // tags field is incorrect
        if (!is_array($this->tags)) {
            $this->tags = null;
            return;
        }

        if (TL_MODE === 'BE') {

            $template = new BackendTemplate('be_wildcard_wrapper_tags');
            $template->wildcard = '### Opening tags (id:' . $this->id . ') ###';

            $tags = [];

            foreach ($this->tags as $tag) {

                // compile attributes
                if ($tag['attributes']) {

                    $attributes = [];

                    foreach ($tag['attributes'] as $attribute) {
                        $attribute['name'] = StringUtil::generateAlias($attribute['name']);

                        if (!empty($attribute['name']) && strlen($attribute['value'])) {
                            $attributes[] = $attribute;
                        }
                    }

                    $tag['attributes'] = $attributes;
                }

                $tags[] = $tag;


                if (isset($tag['attributes'])) {
                    $oneAdded = false;
                    foreach ($tag['attributes'] as $attribute) {
                        if (!empty($attribute['name']) && strlen($attribute['value'])) {
                            $attributes .= ($oneAdded ? ',' : '') . ' <span class="tl_gray" style="margin-right: 2px;">' . StringUtil::generateAlias(($attribute['name'])) . ':</span>' . $attribute['value'];
                            $oneAdded = true;
                        }
                    }
                }

                $fullAttributes = ''
                    . (($tag['class']) ? ' <span class="tl_gray" style="margin-right: 2px;">class:</span>' . $tag['class'] : '')
                    . (($attributes) ? (($tag['class']) ? ',' : '') . $attributes : '')
                    . (($tag['style']) ? '<span class="tl_gray" style="margin-right: 2px;">' . (($tag['class']) || ($attributes) ? ',' : '') . ' style:</span>*' : '');

                $fontSize = (version_compare(VERSION, '3.5', '>') ? '.875' : '.75');

                if ($fullAttributes) {
                    $title .= '<tr><td style="padding-bottom:5px;font-size:' . $fontSize . 'rem;text-align:right;padding-right:5px;vertical-align: top;">&lt;' . $tag['tag'] . ' </td><td style="font-size:' . $fontSize . 'rem;padding-bottom:5px;">' . $fullAttributes . '&gt;</td></tr>';
                } else {
                    $title .= '<tr><td style="padding-bottom:5px;font-size:' . $fontSize . 'rem;text-align:right;vertical-align: top;">&lt;' . $tag['tag'] . '&gt;</td><td></td></tr>';
                }

            }

            $template->tags = $tags;
            $template->fontSize = (version_compare(VERSION, '3.5', '>') ? '.875' : '.75');

            return $template->parse();
        }

        return parent::generate();
    }

    protected function compile()
    {
        // compile insert tags in attr name & value
        foreach ($this->tags as &$tag) {
            if ($tag['attributes']) {
                foreach ($tag['attributes'] as $index => &$attribute) {
                    $attribute['name'] = StringUtil::generateAlias(static::replaceInsertTags($attribute['name']));
                    $attribute['value'] = static::replaceInsertTags($attribute['value']);
                }
                unset($attribute);
            }
        }
        unset($tag);

        $this->Template->tags = $this->tags;
    }
}
