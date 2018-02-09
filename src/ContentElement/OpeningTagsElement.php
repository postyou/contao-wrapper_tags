<?php

/**
 * Copyright (C) 2018 Zmyslni
 *
 * @author  Ostrowski Maciej <http://contao-developer.pl>
 * @author  Ostrowski Maciej <maciek@zmyslni.pl>
 * @license LGPL-3.0+
 */

namespace Zmyslny\WrapperTags\ContentElement;

use Contao\BackendTemplate;
use Contao\ContentElement;

class OpeningTagsElement extends ContentElement
{
    /**
     * Template.
     *
     * @var string
     */
    protected $strTemplate = 'ce_wt_opening_tags';

    /**
     * Display a wildcard in the back end.
     *
     * @return string
     */
    public function generate()
    {
        $this->wt_opening_tags = deserialize($this->wt_opening_tags);

        // Tags data is incorrect
        if (!is_array($this->wt_opening_tags)) {
            $this->wt_opening_tags = array();
        }

        if (TL_MODE === 'BE') {

            $template = new BackendTemplate('be_wildcard_opening_tags');
            $template->wildcard = '### Opening tags (id:' . $this->id . ') ###';

            $template->tags = $this->wt_opening_tags;
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
        $tags = $this->wt_opening_tags;

        // Compile insert tags in attr name and sanitize it
        foreach ($tags as $i => $tag) {
            if ($tag['attributes']) {
                foreach ($tag['attributes'] as $t => $attribute) {
                    $attribute['name'] = static::replaceInsertTags($attribute['name']);

                    $tags[$i]['attributes'][$t] = $attribute;
                }
            }
        }

        $this->Template->tags = $tags;
    }
}
