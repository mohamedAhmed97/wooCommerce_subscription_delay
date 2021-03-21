<?php

namespace Inc\classes\front\templates;

use  Inc\classes\front\controller\DateController;

class DelayButton
{
    function add_delay_button($actions, $subscription)
    {
        $actions['delay'] = array(
            'url'  => '',
            'name' => __('delay', 'woocommerce-subscriptions'),
        );
        return $actions;
    }
    public function edit_schedule_next_payment()
    {   global $wp;
        $subscription = wcs_get_subscription($wp->query_vars['view-subscription'] ); 
        if ($_POST['submit']) {
            $delay_date = $_POST['date'] . " " . date("h:i:s");
            update_post_meta($subscription->ID, '_schedule_next_payment', $delay_date);
        }
    }


    function edit_subscription_before($subscription)
    {   
        $nextdate = explode(" ", $subscription->schedule_next_payment)[0];
        $diff = DateController::calcuate_date($nextdate);
        if ($diff > 3) {
            add_filter('wcs_view_subscription_actions', array($this, 'add_delay_button'), 100, 2);
            
        } else {
            remove_filter('wcs_view_subscription_actions', array($this, 'add_delay_button'));
        }
    }
    public function register()
    {
        add_action('woocommerce_subscription_before_actions', array($this, 'edit_subscription_before'));
        add_action('wp', array($this, 'edit_schedule_next_payment'));
        
    }
}
