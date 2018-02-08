<?php

/*
 * Copyright (C) 2018 Zmyslni
 *
 * @author  Ostrowski Maciej <http://contao-developer.pl>
 * @author  Ostrowski Maciej <maciek@zmyslni.pl>
 * @license LGPL-3.0+
 */

/*
 * Register the namespaces
 */
ClassLoader::addNamespaces(array('Zmyslny\WrapperTags'));

/*
 * Register the classes
 */
ClassLoader::addClasses(array
(
    // Content elements
    'Zmyslny\WrapperTags\ContentOpeningTags' => 'system/modules/wrapper_tags/elements/ContentOpeningTags.php',
    'Zmyslny\WrapperTags\ContentClosingTags' => 'system/modules/wrapper_tags/elements/ContentClosingTags.php',

    // Event listeners
    'Zmyslny\WrapperTags\EventListener\ContentListener' => 'system/modules/wrapper_tags/src/EventListener/ContentListener.php'
));

/*
 * Register the templates
 */
TemplateLoader::addFiles(array(
    'ce_wt_opening_tags' => 'system/modules/wrapper_tags/templates/',
    'ce_wt_closing_tags' => 'system/modules/wrapper_tags/templates/',
    'be_wildcard_opening_tags' => 'system/modules/wrapper_tags/templates/',
    'be_wildcard_closing_tags' => 'system/modules/wrapper_tags/templates/'
));
