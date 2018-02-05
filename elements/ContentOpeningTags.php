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
    /**
     * Template.
     *
     * @var string
     */
    protected $strTemplate = 'ce_wrapper_tags_opening';

    /**
     * Display a wildcard in the back end.
     *
     * @return string
     */
    public function generate()
    {
        $this->openingTags = deserialize($this->openingTags);

        // Tags data is incorrect
        if (!is_array($this->openingTags)) {
            $this->openingTags = array();
        }

        if (TL_MODE === 'BE') {

            $template = new BackendTemplate('be_wildcard_tags_opening');
            $template->wildcard = '### Opening tags (id:' . $this->id . ') ###';

            $template->tags = $this->openingTags;
            $template->version = version_compare(VERSION, '3.5', '>') ? 'version-over-35' : 'version-35';

            return $template->parse();
        }

        return parent::generate();
    }

    /**
     * Compile element data.
     */
    protected function compile()
    {
        $tags = $this->openingTags;

        // Compile insert tags in attr name and sanitize it
        foreach ($tags as $i => $tag) {
            if ($tag['attributes']) {
                foreach ($tag['attributes'] as $t => $attribute) {
                    $attribute['name'] = StringUtil::generateAlias(static::replaceInsertTags($attribute['name']));

                    $tags[$i]['attributes'][$t] = $attribute;
                }
            }
        }

        $this->Template->tags = $tags;
    }
}
