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

class ContentWrapperStop extends ContentElement
{
    protected $strTemplate = 'ce_wrappertags_stop';

    public function generate()
    {
        if (TL_MODE == 'BE') {
            $objTemplate = new \BackendTemplate('be_wildcard');

            $objTemplate->wildcard = '### Closing tags (id:' . $this->id . ') ###';

            $title = '';

            if (is_array($wrappers = unserialize($this->multiWrapperStop))) {

                foreach ($wrappers as $wrapper) {
                    $title .= '&lt;&#47;' . $wrapper['tag'] . '&gt;' . '<br>';
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
        $this->Template->multiWrapperStop = unserialize($this->multiWrapperStop);
    }
}
