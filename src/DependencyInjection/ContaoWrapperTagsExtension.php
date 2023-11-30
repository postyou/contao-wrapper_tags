<?php
/**
 * This file is part of Postyou Wrapper Tags.
 *
 * @package     contao-wrapper_tags
 * @license     AGPL-3.0
 * @author      Mario Gienapp <https://github.com/thedyingmountain>
 * @copyright   Postyou <https://www.postyou.de/>
 */

namespace Postyou\ContaoWrapperTags\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class ContaoWrapperTagsExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../Resources/config')
        );

        $loader->load('services.yml');

    }
}