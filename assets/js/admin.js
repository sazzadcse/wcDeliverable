/**master script for dashboard */
'use strict';
var $ = jQuery;

var $wcdeliverableAdmin = {
    wcdeliverable_settings_form  : "#wcdeliverable_settings_form",
    
    init_wcdeliverable_admin: function(){   
        jQuery(document).ready(function($) {
            $('.wcdeliverable_select2').select2();

            // toaster configuration
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            

            //for toggle tabs
            let $filterScope = $('.wceazy_module_filter > ul > li');
            if ($filterScope.length > 0) {
                $($filterScope).on('click', function () {

                    if ($($filterScope).find('active')) {
                        $($filterScope).removeClass('active');
                    }

                    let $this = this;
                    $($this).addClass('active');

                    let $tab_name = $($this).attr('data-tab_name').toLowerCase();
                    $('.wceazy_module_item').addClass('wcDeliverable-hide-tab');
                    $('#'+$tab_name).removeClass('wcDeliverable-hide-tab');
                    $('#'+$tab_name).addClass('wcDeliverable-show-tab');

                });
            }

            // Trigger Opening Schedules
            $wcdeliverableAdmin.handle_opening_schedules();

            // submit One click checkout setting form
            $($wcdeliverableAdmin.wcdeliverable_settings_form).on( 'submit', function(e){
                $wcdeliverableAdmin.submit_wcdeliverable_settings(e);
            });
                   
        });
    },

    //Handle Opening Schedules
    handle_opening_schedules: function () {

        // for opening schedules
        var checkBoxElements = $('.wcdeliverable-weak-common');
        if( checkBoxElements.length > 0 ){
            checkBoxElements.each(function( index, item ){
                if( $(item).prop("checked") == true ){
                    $(item).parents(".wcdeliverable_inputs").find(".wcdeliverable_text_control").removeClass("disabled-day");
                    $(item).parents(".wcdeliverable_inputs").find(".wcdeliverable_text_control").prop("disabled", false);
                }
            });
        }
       
        // for default opening schedules
        $('input.wcdeliverable-weak-common').change(function () {

            //check input
            if ( $(this).prop("checked") == true) {
                $(this).parents(".wcdeliverable_inputs").find(".wcdeliverable_text_control").removeClass("disabled-day");
                $(this).parents(".wcdeliverable_inputs").find(".wcdeliverable_text_control").prop("disabled", false);
                      
            } else {
                $(this).parents(".wcdeliverable_inputs").find(".wcdeliverable_text_control").addClass("disabled-day");
                $(this).parents(".wcdeliverable_inputs").find(".wcdeliverable_text_control").prop("disabled", true);
            }

        });

    },

    // submit settings from
    submit_wcdeliverable_settings : function (e) {
        e.preventDefault();
        let $submit_button = $('.wcdeliverable-btn');
        $submit_button.text( 'Please Wait....' );
        $submit_button.addClass( 'wc-deliverable-btn-disabled' );
        $submit_button.prop( 'disabled', true );

        let $post_data = {'action': 'wcdeliverable_save_settings', 'data': $($wcdeliverableAdmin.wcdeliverable_settings_form).serializeArray()};

        $.ajax({
            url: ajaxurl,
            type: "POST",
            data: $post_data,
            success: function(res){
                var $obj = JSON.parse(res);
                if ($obj.status == 'true') {
                    Command: toastr["success"]("Settings Saved Successfully!");
                    $submit_button.text('Save Settings');
                    $submit_button.removeClass('wc-deliverable-btn-disabled');
                    $submit_button.prop('disabled', false);
                }else{
                    Command: toastr["error"]("Failed, Please try again!");
                    $submit_button.text('Save Settings');
                    $submit_button.removeClass('wc-deliverable-btn-disabled');
                    $submit_button.prop('disabled', false);
                    console.log('Oops: something is wrong please try later!');
                }
            }
        });
    }


};

//load js for backend
$wcdeliverableAdmin. init_wcdeliverable_admin();