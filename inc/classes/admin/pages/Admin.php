<?php

namespace Inc\classes\admin\pages;

use Inc\classes\admin\API\SettingsApi;
use Inc\classes\admin\controller\BaseController;
use Inc\classes\admin\controller\TemplateController;

class Admin extends BaseController
{
    public $settings;
    public $template;
    public $page = array();
    public $sub_menu = array();
    public function __construct()
    {
        parent::__construct();
        $this->settings = new SettingsApi();
        $this->template = new TemplateController();
        $this->pages = array(
            [
                'page_title' => "subscription",
                'menu_title' => "Subscription",
                'capability' => "manage_options",
                'menu_slug' => "subscription_slug",
                'callable' => array($this, "pageTemplate"),
                'icon_url' => "dashicons-admin-home"
            ],
        );
        $this->sub_menu = array(
            [
                'parent_slug' => "subscription_slug",
                'page_title' => "manage delay",
                'menu_title' => "subscription_delay",
                'capability' => "manage_options",
                'menu_slug' => "subscription_slug",
                'callback' =>  array($this->template, "product"),
            ],

        );
    }
    public function register()
    {
        $this->settings->addPages($this->pages)
            ->withSubpage('Dashboard')
            ->addSubPages($this->sub_menu)
            ->register();
    }
}
