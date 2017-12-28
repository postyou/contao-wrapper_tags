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
use Contao\StringUtil;

class ContentOpeningTags extends ContentElement
{
    protected $strTemplate = 'ce_wrappertags_opening';

    public function generate()
    {
        if (TL_MODE == 'BE') {

            $objTemplate = new \BackendTemplate('be_wildcard_wrapper_tags');
            $objTemplate->wildcard = '### Opening tags (id:' . $this->id . ') ###';

            $title = '<table><tbody>';

            if (is_array($tags = unserialize($this->openingTags))) {

                foreach ($tags as $tag) {

                    $attributes = '';

                    if (isset($tag['attributes'])) {
                        $oneAdded = false;
                        foreach ($tag['attributes'] as $attribute) {
                            if (!empty($attribute['name']) && strlen($attribute['value'])) {
                                $attributes .= ($oneAdded ? ',' : '') . ' <span class="tl_gray" style="margin-right: 2px;">' . StringUtil::generateAlias(($attribute['name'])) . ':</span>' . $attribute['value'];
                                $oneAdded = true;
                            }
                        }
                    }

                    $fullAttributes = ''
                        . (($tag['class']) ? ' <span class="tl_gray" style="margin-right: 2px;">class:</span>' . $tag['class'] : '')
                        . (($attributes) ? (($tag['class']) ? ',' : '') . $attributes : '')
                        . (($tag['style']) ? '<span class="tl_gray" style="margin-right: 2px;">' . (($tag['class']) || ($attributes) ? ',' : '') . ' style:</span>*' : '');

                    $fontSize = (version_compare(VERSION, '3.5', '>') ? '.875' :  '.75' );

                    if ($fullAttributes) {
                        $title .= '<tr><td style="padding-bottom:5px;font-size:' . $fontSize . 'rem;text-align:right;padding-right:5px;vertical-align: top;">&lt;' . $tag['tag'] . ' </td><td style="font-size:' . $fontSize . 'rem;padding-bottom:5px;">' . $fullAttributes . '&gt;</td></tr>';
                    } else {
                        $title .= '<tr><td style="padding-bottom:5px;font-size:' . $fontSize . 'rem;text-align:right;vertical-align: top;">&lt;' . $tag['tag'] . '&gt;</td><td></td></tr>';
                    }
                }

                $title .= '</tbody></table>';

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
