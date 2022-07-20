<?php

// check base path.
if (!defined ('WPINC')) {
    die;
}

if (!class_exists ('wcDeliverableFrontendAjax')) {

    class wcDeliverableFrontendAjax {

        public $frontend_class;

        public function __construct ($frontend_obj) {
            $this->frontend_class = $frontend_obj;
        }



    }

}