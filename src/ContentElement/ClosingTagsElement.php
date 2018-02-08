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

class ClosingTagsElement extends ContentElement
{
    /**
     * Template.
     *
     * @var string
     */
    protected $strTemplate = 'ce_wt_closing_tags';

    /**
     * Display a wildcard in the back end.
     *
     * @return string
     */
    public function generate()
    {
        $this->wt_closing_tags = deserialize($this->wt_closing_tags);

        // Tags data is incorrect
        if (!is_array($this->wt_closing_tags)) {
            $this->wt_closing_tags = array();
        }

        if (TL_MODE === 'BE') {

            $template = new BackendTemplate('be_wildcard_closing_tags');
            $template->wildcard = '### Closing tags (id:' . $this->id . ') ###';

            $template->tags = $this->wt_closing_tags;
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
        $this->Template->tags = deserialize($this->wt_closing_tags);
    }
}
