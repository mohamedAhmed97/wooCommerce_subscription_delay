<?php

namespace Inc\classes\front\templates;

class Button
{
    public function addCancelButton($subscription)
    {
        $actions = wcs_get_all_user_actions_for_subscription($subscription, get_current_user_id());
        if (!empty($actions)) {
            foreach ($actions as $key => $action) {
                if (strtolower($action['name']) == "cancel") {
                    $cancelLink = esc_url($action['url']);
                    echo "<a href='$cancelLink' class='button cancel'>delay</a>";
                }
            }
        }
    }

    function eg_remove_my_subscriptions_button($actions, $subscription)
    {
        $actions['name'] = array(
            'url'  => 'the_action_url',
            'name' =>__('delay', 'woocommerce-subscriptions'),
        );
        return $actions;
    }
    public function register()
    {   //wcs_view_subscription_actions
        add_action('woocommerce_my_subscriptions_actions', array($this, 'addCancelButton'), 10);
        add_filter('wcs_view_subscription_actions', array($this, 'eg_remove_my_subscriptions_button'), 100, 2);
    }
}
