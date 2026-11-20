<?php
/**
 * Plugin Name: GCL Elements
 * Description: Gulf Coast Local's custom Breakdance elements, macros and presets (Element Studio save location).
 * Author: Gulf Coast Local
 * Version: 1.2.0
 * Requires Plugins: breakdance
 * Update URI: https://github.com/GulfCoastLocal/gcl-elements
 */

namespace GclElements;

use function Breakdance\Util\getDirectoryPathRelativeToPluginFolder;
use YahnisElsts\PluginUpdateChecker\v6\PucFactory;

if (!defined('ABSPATH')) {
    exit;
}

/*
 * Updates: checks GitHub releases of GulfCoastLocal/gcl-elements and installs
 * the attached gcl-elements.zip through the normal WordPress plugin updater.
 */
$gcl_puc_loader = __DIR__ . '/lib/plugin-update-checker/plugin-update-checker.php';
if (file_exists($gcl_puc_loader)) {
    require_once $gcl_puc_loader;
    $gcl_update_checker = PucFactory::buildUpdateChecker(
        'https://github.com/GulfCoastLocal/gcl-elements/',
        __FILE__,
        'gcl-elements'
    );
    $gcl_update_checker->setBranch('main');
    $gcl_update_checker->getVcsApi()->enableReleaseAssets('/gcl-elements\.zip($|[?&#])/i');
}

add_action('breakdance_loaded', function () {
    if (!function_exists('\Breakdance\ElementStudio\registerSaveLocation')) {
        return;
    }

    \Breakdance\ElementStudio\registerSaveLocation(
        getDirectoryPathRelativeToPluginFolder(__DIR__) . '/elements',
        'GclElements',
        'element',
        'GCL Elements',
        false
    );

    \Breakdance\ElementStudio\registerSaveLocation(
        getDirectoryPathRelativeToPluginFolder(__DIR__) . '/macros',
        'GclElements',
        'macro',
        'GCL Macros',
        false
    );

    \Breakdance\ElementStudio\registerSaveLocation(
        getDirectoryPathRelativeToPluginFolder(__DIR__) . '/presets',
        'GclElements',
        'preset',
        'GCL Presets',
        false
    );
}, 9);
