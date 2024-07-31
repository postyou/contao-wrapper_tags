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
use Contao\StringUtil;
use Contao\System;
use Symfony\Component\HttpFoundation\Request;

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
        $this->wt_closing_tags = StringUtil::deserialize($this->wt_closing_tags);

        // Tags data is incorrect
        if (!is_array($this->wt_closing_tags)) {
            $this->wt_closing_tags = array();
        }

        if (System::getContainer()->get('contao.routing.scope_matcher')->isBackendRequest(System::getContainer()->get('request_stack')->getCurrentRequest() ?? Request::create(''))) {

            $template = new BackendTemplate('be_wildcard_closing_tags');
            $template->wildcard = '### ' . $GLOBALS['TL_LANG']['CTE']['wt_closing_tags'][0] . ' (id:' . $this->id . ') ###';

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
        $this->Template->tags = $this->wt_closing_tags;
    }
}
