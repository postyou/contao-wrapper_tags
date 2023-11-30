<?php

/**
 * Copyright (C) 2023 Postyou
 */

namespace Postyou\ContaoWrapper_Tags\Controller\ContentElement;

use Contao\BackendTemplate;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\Template;
use Contao\ContentModel;
use Contao\System;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Contao\CoreBundle\InsertTag\InsertTagParser;
use Contao\StringUtil;

#[AsContentElement(category:'wrapper_tags', template:'ce_wt_complete_tags')]
class CompleteTagsElementController extends AbstractContentElementController
{

    private InsertTagParser $insertTagParser;
    
    public function __construct(InsertTagParser $insertTagParser)
    {
        $this->insertTagParser = $insertTagParser;
    }

    protected function getResponse(Template $template, ContentModel $model, Request $request): Response
    {

        $model->wt_complete_tags = StringUtil::deserialize($model->wt_complete_tags);

        // Tags data is incorrect
        if (!is_array($model->wt_complete_tags)) {
            $model->wt_complete_tags = array();
        }

        if (TL_MODE === 'BE') {

            $template = new BackendTemplate('be_wildcard_complete_tags');
            $template->wildcard = '### ' . $GLOBALS['TL_LANG']['CTE']['wt_complete_tags'][0] . ' (id:' . $model->id . ') ###';

            $template->tags = $model->wt_complete_tags;

            return $template->parse();
        }

        /** @var array $tags */
        $tags = $model->wt_complete_tags;

        // Compile insert tags in the attribute name
        foreach ($tags as $i => $tag) {
            if ($tag['attributes']) {
                foreach ($tag['attributes'] as $t => $attribute) {
                    $attribute['name'] = $this->insertTagParser->replace($attribute['name']);

                    $tags[$i]['attributes'][$t] = $attribute;
                }
            }
        }

        $template->tags = $tags;


        return $template->getResponse();
    }
}
