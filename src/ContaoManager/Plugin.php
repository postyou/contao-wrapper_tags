<?php
/**
 * This file is part of Postyou Wrapper Tags.
 *
 * @package     contao-wrapper_tags
 * @license     AGPL-3.0
 * @author      Mario Gienapp <https://github.com/thedyingmountain>
 * @copyright   Postyou <https://www.postyou.de/>
 */
declare(strict_types=1);

namespace Postyou\ContaoWrapper_Tags\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Postyou\ContaoWrapper_Tags\ContaoWrapper_Tags;


class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(ContaoWrapper_Tags::class)
                ->setLoadAfter([ContaoCoreBundle::class])
                ->setReplace(['wrapper_tags']),
        ];
    }

}
