<?php

/**
 * Copyright (C) 2017 Zmyslni
 *
 * @author  Ostrowski Maciej <http://contao-developer.pl>
 * @author  Ostrowski Maciej <maciek@zmyslni.pl>
 * @license LGPL
 */

namespace Zmyslny\WrapperTags;

use Contao\ContentElement;

class ContentClosingTags extends ContentElement
{
    protected $strTemplate = 'ce_wrappertags_closing';

    public function generate()
    {
        if (TL_MODE == 'BE') {
            $objTemplate = new \BackendTemplate('be_wildcard');

            $objTemplate->wildcard = '### Closing tags (id:' . $this->id . ') ###';

            $title = '';

            if (is_array($tags = unserialize($this->closingTags))) {

                foreach ($tags as $tag) {
                    $title .= '&lt;&#47;' . $tag['tag'] . '&gt;' . '<br>';
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
        $this->Template->closingTags = unserialize($this->closingTags);
    }
}
