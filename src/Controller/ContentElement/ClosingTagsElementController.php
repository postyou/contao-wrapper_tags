<?php

/**
 * Copyright (C) 2023 Postyou
 */

namespace Postyou\ContaoWrapperTags\Controller\ContentElement;

use Contao\BackendTemplate;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\Template;
use Contao\ContentModel;
use Contao\System;
use Contao\StringUtil;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsContentElement(type: 'wrapper_tag_stop', category:'wrapper_tags', template:'ce_wt_closing_tags')]
class ClosingTagsElementController extends AbstractContentElementController
{

    protected function getResponse(Template $template, ContentModel $model, Request $request): Response
    {

        $model->wt_closing_tags = StringUtil::deserialize($model->wt_closing_tags);

        // Tags data is incorrect
        if (!is_array($model->wt_closing_tags)) {
            $model->wt_closing_tags = array();
        }

        if (System::getContainer()->get('contao.routing.scope_matcher')->isBackendRequest($request)) {

            $template = new BackendTemplate('be_wildcard_closing_tags');
            $template->wildcard = '### ' . $GLOBALS['TL_LANG']['CTE']['wt_closing_tags'][0] . ' (id:' . $model->id . ') ###';
            $template->tags = $model->wt_closing_tags;


            return $template->parse();
        }

        $template->tags = $model->wt_closing_tags;

        return $template->getResponse();
    }


}
