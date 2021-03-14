<?php

/**
 * author:mohamed ahmed
 * version:1.0.1
 * plugin Name:subscription delay
 * description:make a delay for your subscriptions
 */

use Inc\Active;
use Inc\Deactive;

define('WP_ListCSV_PATH', plugin_dir_path(__FILE__));
define('WP_ListCSV_FILE', __FILE__);
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
