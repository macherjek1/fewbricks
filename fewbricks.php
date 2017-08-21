<?php
/*
Plugin Name: Fewbricks
Plugin URI: https://github.com/macherjek1/mj-fewbricks
Description: Fewbricks with Page Builder
Author: Björn Folbert,Kevin Regenrek
Version: 1.0.0
Author URI: http://folbert.com
License: GPLv3
*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

define('FEWBRICKS_PLUGIN_PATH', rtrim(plugin_dir_path(__FILE__),'/'));

$fewbricks_lib_path = FEWBRICKS_PLUGIN_PATH . '/lib/';
require_once($fewbricks_lib_path . 'fewbricks.php');

add_action('after_setup_theme', function() {
    fewbricks\fewbricks::construct();
});

/**
 * Update related stuff
 */
require_once($fewbricks_lib_path . 'wp-autoupdate.php');

add_action('init', function() {

    // set auto-update params
    $plugin_current_version = '1.6';
    $plugin_remote_path = 'http://fewbricks.folbert.com/update/update.php';
    $plugin_slug = plugin_basename(__FILE__);
    $license_user = 'null';
    $license_key = 'null';

    // only perform Auto-Update call if a license_user and license_key is given
    if ($license_user && $license_key && $plugin_remote_path) {
        new wp_autoupdate ($plugin_current_version, $plugin_remote_path, $plugin_slug, $license_user, $license_key);
    }

});
