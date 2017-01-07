<?php
/*
Plugin Name:        Themer
Plugin URI:         http://github.com/soberwp/themer
Description:        WordPress plugin to create theme configs using JSON files
Version:            1.0.0
Author:             Sober
Author URI:         http://github.com/soberwp/
License:            MIT License
License URI:        http://opensource.org/licenses/MIT
GitHub Plugin URI:  soberwp/themer
GitHub Branch:      master
*/
namespace Sober\Themer;

use Sober\Themer\Loader;
use Sober\Themer\Instance;

/**
 * Restrict direct access to file
 */
if (!defined('ABSPATH')) {
    die;
}

/**
 * Require Composer PSR-4 autoloader, fallback dist/autoload.php
 */
if (file_exists($composer = __DIR__ . '/vendor/autoload.php')) {
    require $composer;
} else {
    require __DIR__ . '/dist/autoload.php';
}

/**
 * Hook into add_action and initialise Loader class
 */
add_action('after_setup_theme', function () {
    $GLOBALS['sober_themer_config'] = new Loader();
});

/**
 * Functions
 */
function template($request, $view = false)
{
    return (new Instance($request, $output = false, $view))->returns();
}

function template_e($request, $output = false, $view = false)
{
    echo (new Instance($request, $output, $view))->echos();
}

function template_debug()
{
    echo (new Instance($request = false, $output = false, $view = false))->debug();
}

