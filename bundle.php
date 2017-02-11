<?php
/*
Plugin Name:        Bundle
Plugin URI:         http://github.com/soberwp/bundle
Description:        WordPress plugin to enable plugin activation using a JSON, YAML or PHP file
Version:            1.0.1
Author:             Sober
Author URI:         http://github.com/soberwp/
License:            MIT License
License URI:        http://opensource.org/licenses/MIT
GitHub Plugin URI:  soberwp/bundle
GitHub Branch:      master
*/
namespace Sober\Bundle;

use Sober\Bundle\Loader;

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
    new Loader();
});
