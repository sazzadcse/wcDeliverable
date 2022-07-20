<div id="wceazy_main">
    <div id="wceazy_module_list">

        <div class="wceazy_module_list_header">
            <div class="wceazy_module_left_header">
                <p> wcDeliverable<span><?php echo WCDELIVERABLE_VERSION; ?></span> </p>
            </div>
            <div class="wceazy_module_right_header">
                <p class="get_pro">
                    <a href="#" target="_blank">Document</a>
                </p>
            </div>
        </div>

        <div class="wceazy_module_title">
            <h2>wcDeliverable for WooCommerce Schedule Order</h2>
        </div>


        <div class="wceazy_module_list_breadcrumb">
            <div class="wceazy_module_filter">
                <ul>
                    <li class="active" data-tab_name="order_settings">Order Settings</li>
                    <li data-tab_name="schedule_settings">Schedule Settings</li>
                    <li data-tab_name="fee_settings">Custom Price Settings</li>
                </ul>
            </div>

        </div>



        <div class="wceazy_module_list_items">
            <div id="wcdeliverable_dashboard">

                <form class="wcdeliverable-settings-form" id="wcdeliverable_settings_form">

                    <div class="wcdeliverable_content_wrapper">

                        <div class="wcdeliverable_bottom_form">
                            <div class="content_wrapper">

                                <div id="order_settings" class="wceazy_module_item wcDeliverable-show-tab">
                                    <?php include_once WCDELIVERABLE_PATH . "backend/templates/views/settings/order.php"; ?>
                                </div>

                                <div id="schedule_settings" class="wceazy_module_item wcDeliverable-hide-tab">
                                    <?php include_once WCDELIVERABLE_PATH . "backend/templates/views/settings/schedule.php"; ?>
                                </div>

                                <div id="fee_settings" class="wceazy_module_item wcDeliverable-hide-tab">
                                    <?php include_once WCDELIVERABLE_PATH . "backend/templates/views/settings/price.php"; ?>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="wcdeliverable_footer">

                        <button type="submit" class="wcdeliverable-btn"> <?php _e('Save Settings', 'wcdeliverable'); ?>
                        </button>

                    </div>

                </form>

            </div>
            <!--/.wcdeliverable_dashboard-->

        </div>


    </div>
</div>