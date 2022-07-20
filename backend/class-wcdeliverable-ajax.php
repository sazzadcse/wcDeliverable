<?php

// check base path.
if (!defined('WPINC')) {
    die;
}

if (!class_exists('wcDeliverableAdminAjax')) {
    class wcDeliverableAdminAjax {

        public $admin_class;

        public function __construct( $admin_obj ) {
            $this->admin_class = $admin_obj;
            add_action( 'wp_ajax_wcdeliverable_save_settings', array($this, 'wcdeliverable_save_settings') );

        }

        public function wcdeliverable_save_settings() {
            include_once WCDELIVERABLE_PATH . "backend/api/save_settings.php";
            wp_die();
        }

        

    }
}
