<?php
/**
* Plugin Name: YGLU
* Plugin URI: https://tuyglu.com/
* Description: Conecta su sitio a YGLU
* Version: 0.1
* Author: YGLU Factory
* Author URI: https://tuyglu.com/
**/

define("YG_PLUGIN_PATH", plugin_dir_path(__FILE__));
define("YG_PLUGIN_URL", plugin_dir_url(__FILE__));
define("YG_PLUGIN_SLUG", "yglu");

require_once YG_PLUGIN_PATH . "admin.php";

register_activation_hook(__FILE__, "activatePlugin");
function activatePlugin() {

}

function get_url($file) {
    return YG_PLUGIN_URL . $file;
}

function get_path($file) {
    return YG_PLUGIN_PATH . $file;
}

function enqueue_yg_styles() {
    wp_enqueue_style("yg-style", get_url("style.css"), array(), filemtime(get_path("style.css")));
}

function enqueue_yg_scripts() {
    wp_enqueue_script("yg-script", get_url("script.js"), array("jquery"), filemtime(get_path("script.js")));
}

add_action("wp_enqueue_scripts", "enqueue_yg_styles");
add_action("wp_enqueue_scripts", "enqueue_yg_scripts");

