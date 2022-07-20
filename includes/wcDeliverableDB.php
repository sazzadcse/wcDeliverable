<?php

// check base path..
if (!defined('WPINC')) {
    die;
}

if (!class_exists('wcDeliverableDB')) {
    class wcDeliverableDB {

        public $admin_class;
        public $wpdb;

        public function __construct($admin_obj) {
            $this->admin_class = $admin_obj;
        }
    }
}
