<?php

/**
 * Copyright (C) 2017 Zmyslni
 *
 * @author  Ostrowski Maciej <http://contao-developer.pl>
 * @author  Ostrowski Maciej <maciek@zmyslni.pl>
 * @license LGPL
 */

/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array('Zmyslni'));

/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
    // Content elements
    'Zmyslni\ContentOpeningTags' => 'system/modules/wrapper_tags/elements/ContentOpeningTags.php',
    'Zmyslni\ContentClosingTags' => 'system/modules/wrapper_tags/elements/ContentClosingTags.php'

));

/**
 * Register the templates
 */
TemplateLoader::addFiles(array(
    'ce_wrappertags_opening' => 'system/modules/wrapper_tags/templates/',
    'ce_wrappertags_closing' => 'system/modules/wrapper_tags/templates/'
));

