<?php

/**
 * Copyright (C) 2017 Zmyslni
 *
 * @author  Ostrowski Maciej <http://contao-developer.pl>
 * @author  Ostrowski Maciej <maciek@zmyslni.pl>
 * @license LGPL-3.0+
 */

namespace Zmyslny\WrapperTags;

use Contao\ContentElement;

class ContentOpeningTags extends ContentElement
{
    protected $strTemplate = 'ce_wrappertags_opening';

    public function generate()
    {
        if (TL_MODE == 'BE') {
            $objTemplate = new \BackendTemplate('be_wildcard');

            $objTemplate->wildcard = '### Opening tags (id:' . $this->id . ') ###';

            $title = '';

            if (is_array($tags = unserialize($this->openingTags))) {

                foreach ($tags as $tag) {
                    $title .= '&lt;' . $tag['tag'] . '&gt;' . (($tag['id']) ? ' id: ' . $tag['id'] : '') . (($tag['class']) ? (($tag['id']) ? ' |' : '') . ' class: ' . $tag['class'] : '') . '<br>';
                }

            } else {
                $title = '<span class="tl_red">Data corrupted</span>';
            }

            $objTemplate->title = $title;

            return $objTemplate->parse();
        }

        return parent::generate();
    }

    protected function compile()
    {
        $this->Template->openingTags = unserialize($this->openingTags);
    }
}
