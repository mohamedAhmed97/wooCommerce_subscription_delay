<?php

namespace Inc\classes\admin\API;

class SettingsApi
{
    public $admin_page = array();
    public $admin_subpages = array();
    public function register()
    {
        if (!empty($this->admin_page)) {
            add_action("admin_menu", array($this, "addAdminMenu"));
        }
    }
    // add pages to my admin_page 
    public function addPages(array $pages)
    {
        $this->admin_page = $pages;
        return $this;
    }

    #with subpage function which add subpage
    public function withSubpage(string $title = null)
    {
        if (empty($this->admin_page)) {
            return $this;
        }
        $admin_page = $this->admin_page[0];

        $sub_page = array(
            [
                'parent_slug' => $admin_page["menu_slug"],
                'page_title' => $admin_page["page_title"],
                'menu_title' => ($title) ? $title : $admin_page["menu_title"],
                'capability' => $admin_page["capability"],
                'menu_slug' => $admin_page["menu_slug"],
                'callback' => $admin_page["callback"]

            ],
        );
        $this->admin_subpages = $sub_page;
        return $this;
    }

    #add subPage
    public function addSubPages(array $pages)
    {
        $this->admin_subpages = array_merge($this->admin_subpages, $pages);
        return $this;
    }

    public function addAdminMenu()
    {
        foreach ($this->admin_page as $page) {
            add_menu_page(
                $page['page_title'],
                $page['menu_title'],
                $page['capability'],
                $page['menu_slug'],
                $page['callable'],
                $page['icon_url']
            );
        }

        foreach ($this->admin_subpages as $page) {
            add_submenu_page(
                $page['parent_slug'],
                $page['page_title'],
                $page['menu_title'],
                $page['capability'],
                $page['menu_slug'],
                $page['callback']
            );
        }
    }
}
