<?php

/**
 * Copyright (C) 2017 Zmyslni
 *
 * @author  Ostrowski Maciej <http://contao-developer.pl>
 * @author  Ostrowski Maciej <maciek@zmyslni.pl>
 * @license LGPL
 */

namespace Zmyslni;

use Contao\ContentElement;

class ContentWrapperStart extends ContentElement
{
    protected $strTemplate = 'ce_wrappertags_start';

    public function generate()
    {
        if (TL_MODE == 'BE') {
            $objTemplate = new \BackendTemplate('be_wildcard');

            $objTemplate->wildcard = '### Opening tags (id:' . $this->id . ') ###';

            $title = '';

            if (is_array($wrappers = unserialize($this->multiWrapperStart))) {

                foreach ($wrappers as $wrapper) {
                    $title .= '&lt;' . $wrapper['tag'] . '&gt;' . (($wrapper['id']) ? ' id: ' . $wrapper['id'] : '') . (($wrapper['class']) ? (($wrapper['id']) ? ' |' : '') . ' class: ' . $wrapper['class'] : '') . '<br>';
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
        $this->Template->multiWrapperStart = unserialize($this->multiWrapperStart);
    }
}
