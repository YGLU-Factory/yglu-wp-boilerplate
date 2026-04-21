<?php
/**
 * Plugin Name: YGLU Wordpress
 * Plugin URI: https://tuyglu.com/
 * Description: Conecta tu Wordpress a YGLU para enviar determinados sets de datos. Es necesario disponer de una cuenta de YGLU activa para su funcionamiento.
 * Version: 1.0
 * Requires at least: 4.7
 * Tested up to: 6.9
 * Author: YGLU Factory
 * Author URI: https://tuyglu.com/
 **/

define("YGWP_PLUGIN_PATH", plugin_dir_path(__FILE__));
define("YGWP_PLUGIN_URL", plugin_dir_url(__FILE__));
define("YGWP_PLUGIN_SLUG", "yglu");

require_once YGWP_PLUGIN_PATH . "admin.php";

register_activation_hook(__FILE__, "ygwp_activate_plugin");
function ygwp_activate_plugin() {
    global $wp_version;
    if (version_compare($wp_version, '4.7', '<')) {
        deactivate_plugins(plugin_basename(__FILE__));
        wp_die('YGLU Wordpress necesita WordPress 4.7 o superior.');
    }
}

function ygwp_get_url($file) {
    return YGWP_PLUGIN_URL . $file;
}

function ygwp_get_path($file) {
    return YGWP_PLUGIN_PATH . $file;
}

function ygwp_enqueue_styles() {
    wp_enqueue_style("yg-style", ygwp_get_url("style.css"), array(), filemtime(ygwp_get_path("style.css")));
}

function ygwp_enqueue_scripts() {
    wp_enqueue_script("yg-script", ygwp_get_url("script.js"), array("jquery"), filemtime(ygwp_get_path("script.js")));
}

add_action("wp_enqueue_scripts", "ygwp_enqueue_styles");
add_action("wp_enqueue_scripts", "ygwp_enqueue_scripts");

