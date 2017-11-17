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
    'Zmyslni\ContentWrapperStart' => 'system/modules/wrapper_tags/elements/ContentWrapperStart.php',
    'Zmyslni\ContentWrapperStop' => 'system/modules/wrapper_tags/elements/ContentWrapperStop.php'

));

/**
 * Register the templates
 */
TemplateLoader::addFiles(array(
    'ce_wrappertags_start' => 'system/modules/wrapper_tags/templates/',
    'ce_wrappertags_stop' => 'system/modules/wrapper_tags/templates/'
));

