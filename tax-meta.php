<?php
/*
Plugin Name: Tax Meta
Plugin URI: http://example.com/
Description: Demonstration of creating tax meta field.
Version: 1.0
Author: sadat himel
Author URI: http://example.com/
License: GPLv2 or later
Text Domain: tax-meta
Domain Path: /languages
*/

function taxm_load_textdomain(){
    load_plugin_textdomain( 'tax-meta', false, dirname(__FILE__) . "/languages");
}
add_action( 'plugin_loaded', 'taxm_load_textdomain' );