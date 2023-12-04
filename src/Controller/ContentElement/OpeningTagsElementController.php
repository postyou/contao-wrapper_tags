<?php

/**
 * Copyright (C) 2023 Postyou
 */

namespace Postyou\ContaoWrapper_Tags\Controller\ContentElement;

use Contao\BackendTemplate;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Contao\ContentModel;
use Contao\System;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Contao\CoreBundle\InsertTag\InsertTagParser;
use Contao\StringUtil;

#[AsContentElement(type: 'wrapper_tag_start', category:'texts', template:'ce_wt_opening_tags')]
class OpeningTagsElementController extends AbstractContentElementController
{

    private InsertTagParser $insertTagParser;
    
    public function __construct(InsertTagParser $insertTagParser)
    {
        $this->insertTagParser = $insertTagParser;
    }


    protected function getResponse(FragmentTemplate $template, ContentModel $model, Request $request): Response
    {
        return $template->getResponse();

        $model->wt_opening_tags = StringUtil::deserialize($model->wt_opening_tags);

        // Tags data is incorrect
        if (!is_array($model->wt_opening_tags)) {
            $model->wt_opening_tags = array();
        }

        if (System::getContainer()->get('contao.routing.scope_matcher')->isBackendRequest($request)) {

            $template = new BackendTemplate('be_wildcard_opening_tags');
            $template->wildcard = '### ' . $GLOBALS['TL_LANG']['CTE']['wt_opening_tags'][0] . ' (id:' . $model->id . ') ###';
            $template->tags = $model->wt_opening_tags;

            return $template->parse();
        }

        // Compile insert tags in the attribute name
        foreach ($model->wt_opening_tags as $i => $tag) {
            if ($tag['attributes']) {
                foreach ($tag['attributes'] as $t => $attribute) {
                    $attribute['name'] = $this->insertTagParser->replace($attribute['name']);

                    $tags[$i]['attributes'][$t] = $attribute;
                }
            } 
            $styles = StringUtil::deserialize($model->styleManager);
            if ($styles && $i == 0) {
                foreach ($styles as $class) {
                    if (!$tags[$i]['class']) {
                        $tags[$i]['class'] = '';
                    }
                    $tags[$i]['class'] .= ' '.$class;
                } 
               
            }
        }
        $template->tags = $tags;


        return $template->getResponse();
    }

}
