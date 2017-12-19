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

            $objTemplate = new \BackendTemplate('be_wildcard_wrapper_tags');
            $objTemplate->wildcard = '### Opening tags (id:' . $this->id . ') ###';

            $title = '';

            if (is_array($tags = unserialize($this->openingTags))) {

                foreach ($tags as $tag) {
                    $title .= '&lt;' . $tag['tag']
                        . (($tag['id']) ? ' <span class="tl_gray">id:</span> ' . $tag['id'] : '')
                        . (($tag['class']) ? '<span class="tl_gray">' . (($tag['id']) ? ',' : '') . ' class:</span> ' . $tag['class'] : '')
                        . (($tag['style']) ? '<span class="tl_gray">' . (($tag['id']) || ($tag['class']) ? ',' : '') . ' style:</span> *' : '')
                        . '&gt;' . '<br>';
                }

            } else {
                $title = '<span class="tl_red">' . $GLOBALS['TL_LANG']['MSC']['wrapperTagsDataCorrupted'] . '</span>';
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
