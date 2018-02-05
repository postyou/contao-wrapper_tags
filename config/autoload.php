<?php

/**
 * Copyright (C) 2017 Zmyslni
 *
 * @author  Ostrowski Maciej <http://contao-developer.pl>
 * @author  Ostrowski Maciej <maciek@zmyslni.pl>
 * @license LGPL-3.0+
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array('Zmyslny\WrapperTags'));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
    // Content elements
    'Zmyslny\WrapperTags\ContentOpeningTags' => 'system/modules/wrapper_tags/elements/ContentOpeningTags.php',
    'Zmyslny\WrapperTags\ContentClosingTags' => 'system/modules/wrapper_tags/elements/ContentClosingTags.php'

));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array(
    'ce_wrapper_tags_opening' => 'system/modules/wrapper_tags/templates/',
    'ce_wrapper_tags_closing' => 'system/modules/wrapper_tags/templates/',
    'be_wildcard_tags_opening' => 'system/modules/wrapper_tags/templates/',
    'be_wildcard_tags_closing' => 'system/modules/wrapper_tags/templates/'
));

