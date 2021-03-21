<?php

/**
 * author:mohamed ahmed
 * version:1.0.1
 * plugin Name:subscription delay
 * description:make a delay for your subscriptions
 */

use Inc\Active;
use Inc\Deactive;

define('WP_DELAY_FILE', __FILE__);
if (!defined('ABSPATH')) {
    die;
}
#check for vender/autoload
if (file_exists(dirname(__FILE__) . "/vendor/autoload.php")) {
    require_once dirname(__FILE__) . "/vendor/autoload.php";
}
if (class_exists('Inc\\Init')) {
    Inc\Init::registerServices();
}
if (!class_exists('Wp_delay')) {
    class Wp_delay
    {
        function __construct()
        {
            register_activation_hook(WP_DELAY_FILE, 'delay_plugin_activate');
            register_deactivation_hook(WP_DELAY_FILE, 'delay_plugin_deactivate');
        }
        //activate
        function listcsv_plugin_activate()
        {
            Active::active();
        }
        //deactivate
        function listcsv_plugin_deactivate()
        {
            Deactive::deactive();
        }
    }
}
