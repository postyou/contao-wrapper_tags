<?php

/**
 * Copyright (C) 2018 Zmyslni
 *
 * @author  Ostrowski Maciej <http://contao-developer.pl>
 * @author  Ostrowski Maciej <maciek@zmyslni.pl>
 * @license LGPL-3.0+
 */

namespace Zmyslny\WrapperTags;

use Contao\BackendTemplate;
use Contao\ContentElement;

class ContentClosingTags extends ContentElement
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
        $this->closingTags = deserialize($this->closingTags);

        // Tags data is incorrect
        if (!is_array($this->closingTags)) {
            $this->closingTags = array();
        }

        if (TL_MODE === 'BE') {

            $template = new BackendTemplate('be_wildcard_tags_closing');
            $template->wildcard = '### Closing tags (id:' . $this->id . ') ###';

            $template->tags = $this->closingTags;
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
    }
}
