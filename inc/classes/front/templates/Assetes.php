<?php

namespace Inc\classes\front\templates;

use Inc\classes\front\controller\AssetsController;

class Assetes extends AssetsController
{
    public function register()
    {
        add_action("wp_enqueue_scripts", array($this, 'addAsset'));
    }

    public function addAsset($links)
    {
        wp_enqueue_script('jquery');
        wp_register_script("date",$this->plugin_assets_path."/inc/assets/js/datepicker.js", array('jquery'), 1.1, true);
        wp_enqueue_script("date");
    }
}
