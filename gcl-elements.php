<?php
/**
 * Plugin Name: GCL Elements
 * Description: Element Studio save location for Gulf Coast Local's custom Breakdance elements, macros and presets.
 * Author: Gulf Coast Local
 * Version: 1.0.0
 * Requires Plugins: breakdance
 */

namespace GclElements;

use function Breakdance\Util\getDirectoryPathRelativeToPluginFolder;

if (!defined('ABSPATH')) {
    exit;
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
