<?php

namespace cpt\rel\includes;

/**
 * Class for creating a dashboard submenu
 */
class Submenu{
    // Constructor
    public function __construct(){
        add_action('admin_menu', [$this, 'register_submenu']);
    }

    // Register submenu
    public function register_submenu(){
        add_submenu_page(
            CPT_REL_SUBMENU,
            __('CPT Relations','cpt-relations'),
            __('CPT Relations','cpt-relations'),
            'manage_options',
            'cpt-relations',
            [$this, 'submenu_page_callback']
        );
    }

    // Callback, show view
    public function submenu_page_callback(){
        include_once (CPT_REL_PATH. '/views/backend/main-screen.php');
    }
}