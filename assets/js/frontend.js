
'use strict';
var $ = jQuery;

var $wcdeliverableFrontend = {
    wcdeliverable_settings_form  : "#wcdeliverable_settings_form",
    
    init_wcdeliverable_frontend: function(){   
        jQuery(document).ready(function($) {
           
         // Trigger Opening Schedules
            $wcdeliverableFrontend.handle_order_type();
          
        });
    },

    //Handle Opening Schedules
    handle_order_type: function () {
        $("#wcdeliverable_custom_checkout_schedule").hide();

        $('#wcdeliverable_custom_checkout_field select').change(function () {
            $("#wcdeliverable_custom_checkout_schedule").show();
        });

    },




};

//load js for backend
$wcdeliverableFrontend. init_wcdeliverable_frontend();