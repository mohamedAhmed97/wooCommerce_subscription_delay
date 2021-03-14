<?php

namespace Inc\classes\front\templates;

class Subscription
{

    public function intercept_wc_template($template, $template_name, $template_path)
    {
        if ('view-subscription.php' === basename($template)) {
            $template = trailingslashit(plugin_dir_path(dirname(__FILE__, 4))) . 'woocommerce-subscriptions/myaccount/view-subscription.php';
        }

        return $template;
    }


    public function register()
    {
        add_filter('woocommerce_locate_template', array($this, 'intercept_wc_template'), 10, 3);
    }
}
