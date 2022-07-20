<?php

// check base path.
if (!defined('WPINC')) {
    die;
}

if (!class_exists('wcDeliverableAdmin')) {
    class wcDeliverableAdmin {

        public $utils;
        public $db;
        public $wcdeliverable_settings = array();

        public function __construct()
        {
            $this->utils = new wcDeliverableUtils();

            add_action("admin_menu", array($this, 'wcdeliverable_admin_menu'));
            add_action('admin_enqueue_scripts', array($this, 'wcdeliverable_admin_enqueue'));
            add_action('plugin_action_links_' . WCDELIVERABLE_BASE_PATH, array($this, 'wcdeliverable_action_links'));
            $this->db = new wcDeliverableDB($this);
            new wcDeliverableAdminAjax($this);
            $this->wcdeliverable_settings = get_option('wcdeliverable_settings', false);

            add_action('add_meta_boxes', [$this, 'order_meta_boxes']);
            add_action('save_post', [$this, 'save_order_meta_boxes'], 10, 2);

            $enable_dinein_extra_fee = !empty($this->wcdeliverable_settings) && isset($this->wcdeliverable_settings['enable_dinein_extra_fee']) ? 'yes' : 'no'; 

            if( 'yes' == $enable_dinein_extra_fee ){
                //add_action('woocommerce_before_calculate_totals', [$this, 'wcdeliverable_dinein_fee'], 10, 2);
                add_action('woocommerce_order_after_calculate_totals', [$this, 'wcdeliverable_dinein_fee'], 10, 2);
            }
            
        }


        public function wcdeliverable_action_links($links)
        {
            $settings_url = add_query_arg('page', 'wcdeliverable', get_admin_url() . 'admin.php');
            $setting_arr = array('<a href="' . esc_url($settings_url) . '">Dashboard</a>');
            $links = array_merge($setting_arr, $links);
            return $links;
        }

        public function wcdeliverable_admin_menu()
        {
            $icon_url = 'dashicons-cart';
            add_menu_page(
                "wcDeliverable", 
                "wcDeliverable", 
                'manage_options', 
                "wcdeliverable", 
                [$this, 'wcdeliverable_admin_dashboard'], 
                $icon_url, 6
            );
        }

        public function wcdeliverable_admin_enqueue($page)
        {
            if ($page == "toplevel_page_wcdeliverable") {
                $this->utils->enqueue_style('select2', 'select2.min.css');
                $this->utils->enqueue_style('toastr', 'toastr.min.css');
                $this->utils->enqueue_style('admin', 'admin.css');

                $this->utils->enqueue_script('select2', 'select2.min.js', array('jquery'));
                $this->utils->enqueue_script('toastr', 'toastr.min.js', array('jquery'));
                $this->utils->enqueue_script('admin', 'admin.js', array('jquery'));
            }
        }


        public function wcdeliverable_admin_dashboard() {
            $wcdeliverable_saturday  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['wcdeliverable_saturday']) ? $this->wcdeliverable_settings['wcdeliverable_saturday'] : ''; 
            $wcdeliverable_sunday  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['wcdeliverable_sunday']) ? $this->wcdeliverable_settings['wcdeliverable_sunday'] : ''; 
            $wcdeliverable_monday  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['wcdeliverable_monday']) ? $this->wcdeliverable_settings['wcdeliverable_monday'] : ''; 
            $wcdeliverable_tuesday  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['wcdeliverable_tuesday']) ? $this->wcdeliverable_settings['wcdeliverable_tuesday'] : ''; 
            $wcdeliverable_wednesday  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['wcdeliverable_wednesday']) ? $this->wcdeliverable_settings['wcdeliverable_wednesday'] : ''; 
            $wcdeliverable_thursday  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['wcdeliverable_thursday']) ? $this->wcdeliverable_settings['wcdeliverable_thursday'] : ''; 
            $wcdeliverable_friday  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['wcdeliverable_friday']) ? $this->wcdeliverable_settings['wcdeliverable_friday'] : ''; 

            $saturday_open_hour_start  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['saturday_open_hour_start']) ? $this->wcdeliverable_settings['saturday_open_hour_start'] : ''; 
            $saturday_open_hour_end  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['saturday_open_hour_end']) ? $this->wcdeliverable_settings['saturday_open_hour_end'] : '';
            
            $sunday_open_hour_start  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['sunday_open_hour_start']) ? $this->wcdeliverable_settings['sunday_open_hour_start'] : ''; 
            $sunday_open_hour_end  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['sunday_open_hour_end']) ? $this->wcdeliverable_settings['sunday_open_hour_end'] : ''; 

            $monday_open_hour_start  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['monday_open_hour_start']) ? $this->wcdeliverable_settings['monday_open_hour_start'] : ''; 
            $monday_open_hour_end  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['monday_open_hour_end']) ? $this->wcdeliverable_settings['monday_open_hour_end'] : ''; 

            $tuesday_open_hour_start  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['tuesday_open_hour_start']) ? $this->wcdeliverable_settings['tuesday_open_hour_start'] : ''; 
            $tuesday_open_hour_end  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['tuesday_open_hour_end']) ? $this->wcdeliverable_settings['tuesday_open_hour_end'] : ''; 

            $wednesday_open_hour_start  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['wednesday_open_hour_start']) ? $this->wcdeliverable_settings['wednesday_open_hour_start'] : ''; 
            $wednesday_open_hour_end  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['wednesday_open_hour_end']) ? $this->wcdeliverable_settings['wednesday_open_hour_end'] : '';

            $thursday_open_hour_start  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['thursday_open_hour_start']) ? $this->wcdeliverable_settings['thursday_open_hour_start'] : ''; 
            $thursday_open_hour_end  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['thursday_open_hour_end']) ? $this->wcdeliverable_settings['thursday_open_hour_end'] : ''; 

            $friday_open_hour_start  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['friday_open_hour_start']) ? $this->wcdeliverable_settings['friday_open_hour_start'] : ''; 
            $friday_open_hour_end  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['friday_open_hour_end']) ? $this->wcdeliverable_settings['friday_open_hour_end'] : ''; 
            
            //load view
            include_once WCDELIVERABLE_PATH . "backend/templates/dashboard.php";
        }

        public function order_meta_boxes($post_type)
        {
            add_meta_box(
                'wcdeliverable_metabox',
                __('Delivery Date & Time', 'store-slots'),
                [$this, 'wcdeliverable_meta_box_markup'],
                'shop_order',
                'advanced',
                'high',
                null
            );
        }

        public function wcdeliverable_meta_box_markup($post)
        {
            wp_nonce_field('wcdeliverable_metabox', 'wcdeliverable_metabox_nonce');

            $delivery_type = get_post_meta($post->ID, 'delivery_type', true);
            $delivery_schedule = get_post_meta($post->ID, 'delivery_schedule', true);

            // Schedule Date and Time
            $wcdeliverable_schedules = array();
            $wcdeliverable_sunday_time = '';
            $wcdeliverable_saturday_time = '';
            $wcdeliverable_monday_time = '';
            $wcdeliverable_tuesday_time = '';
            $wcdeliverable_wednesday_time = '';
            $wcdeliverable_thursday_time = '';
            $wcdeliverable_friday_time = '';
            $wcdeliverable_schedules[] = 'Select Time Slot';

            $wcdeliverable_saturday  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['wcdeliverable_saturday']) ? $this->wcdeliverable_settings['wcdeliverable_saturday'] : '';
            $saturday_open_hour_start  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['saturday_open_hour_start']) ? $this->wcdeliverable_settings['saturday_open_hour_start'] : '';
            $saturday_open_hour_end  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['saturday_open_hour_end']) ? $this->wcdeliverable_settings['saturday_open_hour_end'] : '';

            if (!empty($wcdeliverable_saturday)) {
                if (!empty($saturday_open_hour_start) && !empty($saturday_open_hour_end)) {
                    $wcdeliverable_saturday_time =  ' -- ' . $saturday_open_hour_start . ' - ' . $saturday_open_hour_end;
                }

                $store_slot_one = ucfirst($wcdeliverable_saturday)  . $wcdeliverable_saturday_time;

                $wcdeliverable_schedules[$store_slot_one] =  $store_slot_one;
            }

            $wcdeliverable_sunday  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['wcdeliverable_sunday']) ? $this->wcdeliverable_settings['wcdeliverable_sunday'] : '';
            $sunday_open_hour_start  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['sunday_open_hour_start']) ? $this->wcdeliverable_settings['sunday_open_hour_start'] : '';
            $sunday_open_hour_end  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['sunday_open_hour_end']) ? $this->wcdeliverable_settings['sunday_open_hour_end'] : '';

            if (!empty($wcdeliverable_sunday)) {
                if (!empty($sunday_open_hour_start) && !empty($sunday_open_hour_end)) {
                    $wcdeliverable_sunday_time =  ' - ' . $sunday_open_hour_start . ' - ' . $sunday_open_hour_end;
                }
                $store_slot_two = ucfirst($wcdeliverable_sunday)  . $wcdeliverable_sunday_time;

                $wcdeliverable_schedules[$store_slot_two] = $store_slot_two;
            }

            $wcdeliverable_monday  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['wcdeliverable_monday']) ? $this->wcdeliverable_settings['wcdeliverable_monday'] : '';
            $monday_open_hour_start  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['monday_open_hour_start']) ? $this->wcdeliverable_settings['monday_open_hour_start'] : '';
            $monday_open_hour_end  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['monday_open_hour_end']) ? $this->wcdeliverable_settings['monday_open_hour_end'] : '';

            if (!empty($wcdeliverable_monday)) {
                if (!empty($monday_open_hour_start) && !empty($monday_open_hour_end)) {
                    $wcdeliverable_monday_time =  ' -- ' . $monday_open_hour_start . ' - ' . $monday_open_hour_end;
                }
                $store_slot_three = ucfirst($wcdeliverable_monday)  . $wcdeliverable_monday_time;

                $wcdeliverable_schedules[$store_slot_three] = $store_slot_three;
            }

            $wcdeliverable_tuesday  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['wcdeliverable_tuesday']) ? $this->wcdeliverable_settings['wcdeliverable_tuesday'] : '';
            $tuesday_open_hour_start  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['tuesday_open_hour_start']) ? $this->wcdeliverable_settings['tuesday_open_hour_start'] : '';
            $tuesday_open_hour_end  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['tuesday_open_hour_end']) ? $this->wcdeliverable_settings['tuesday_open_hour_end'] : '';

            if (!empty($wcdeliverable_tuesday)) {
                if (!empty($tuesday_open_hour_start) && !empty($tuesday_open_hour_end)) {
                    $wcdeliverable_tuesday_time =  ' -- ' . $tuesday_open_hour_start . ' - ' . $tuesday_open_hour_end;
                }

                $store_slot_four = ucfirst($wcdeliverable_tuesday)  . $wcdeliverable_tuesday_time;
                $wcdeliverable_schedules[$store_slot_four] = $store_slot_four;
            }

            $wcdeliverable_wednesday  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['wcdeliverable_wednesday']) ? $this->wcdeliverable_settings['wcdeliverable_wednesday'] : '';
            $wednesday_open_hour_start  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['wednesday_open_hour_start']) ? $this->wcdeliverable_settings['wednesday_open_hour_start'] : '';
            $wednesday_open_hour_end  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['wednesday_open_hour_end']) ? $this->wcdeliverable_settings['wednesday_open_hour_end'] : '';

            if (!empty($wcdeliverable_wednesday)) {
                if (!empty($wednesday_open_hour_start) && !empty($wednesday_open_hour_end)) {
                    $wcdeliverable_wednesday_time =  ' -- ' . $wednesday_open_hour_start . ' - ' . $wednesday_open_hour_end;
                }

                $store_slot_five = ucfirst($wcdeliverable_wednesday)  . $wcdeliverable_wednesday_time;

                $wcdeliverable_schedules[$store_slot_five] =  $store_slot_five;
            }

            $wcdeliverable_thursday  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['wcdeliverable_thursday']) ? $this->wcdeliverable_settings['wcdeliverable_thursday'] : '';
            $thursday_open_hour_start  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['thursday_open_hour_start']) ? $this->wcdeliverable_settings['thursday_open_hour_start'] : '';
            $thursday_open_hour_end  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['thursday_open_hour_end']) ? $this->wcdeliverable_settings['thursday_open_hour_end'] : '';

            if (!empty($wcdeliverable_thursday)) {
                if (!empty($thursday_open_hour_start) && !empty($thursday_open_hour_end)) {
                    $wcdeliverable_thursday_time =  ' -- ' . $thursday_open_hour_start . ' - ' . $thursday_open_hour_end;
                }
                $store_slot_six = ucfirst($wcdeliverable_thursday)  . $wcdeliverable_thursday_time;
                $wcdeliverable_schedules[$store_slot_six] = $store_slot_six;
            }

            $wcdeliverable_friday  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['wcdeliverable_friday']) ? $this->wcdeliverable_settings['wcdeliverable_friday'] : '';
            $friday_open_hour_start  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['friday_open_hour_start']) ? $this->wcdeliverable_settings['friday_open_hour_start'] : '';
            $friday_open_hour_end  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['friday_open_hour_end']) ? $this->wcdeliverable_settings['friday_open_hour_end'] : '';

            if (!empty($wcdeliverable_friday)) {
                if (!empty($friday_open_hour_start) && !empty($friday_open_hour_end)) {
                    $wcdeliverable_friday_time =  ' -- ' . $friday_open_hour_start . ' - ' . $friday_open_hour_end;
                }
                $store_slot_seven = ucfirst($wcdeliverable_friday)  . $wcdeliverable_friday_time;
                $wcdeliverable_schedules[$store_slot_seven] =  $store_slot_seven;
            }

            $delivery_option_label  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['wcdeliverable_delivery_option_label']) ? $this->wcdeliverable_settings['wcdeliverable_delivery_option_label'] : 'Delivery';

            $takeaway_option_label = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['wcdeliverable_takeaway_option_label']) ? $this->wcdeliverable_settings['wcdeliverable_takeaway_option_label'] : 'Takeaway';

            $dinein_option_label = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['wcdeliverable_dinein_option_label']) ? $this->wcdeliverable_settings['wcdeliverable_dinein_option_label'] : 'Dine-In';


            ?>
            <div class="wcdeliverable-wrapper">
                <select class="wcdeliverable_ordertype_selection_box" name="wcdeliverable_ordertype_selection_box" id="wcdeliverable_ordertype_frontend_box" style="width:100%;">
                    <option value="delivery" <?php echo 'delivery' == $delivery_type ? 'selected' : '';  ?>> <?php echo $delivery_option_label; ?></option>
                    <option value="takeaway" <?php echo 'takeaway' == $delivery_type ? 'selected' : '';  ?>><?php echo $takeaway_option_label; ?></option>
                    <option value="dine_in" <?php echo 'dine_in' == $delivery_type ? 'selected' : '';  ?>> <?php  echo  $dinein_option_label; ?> </option>
                </select>

                <select class="wcdeliverable_order_schedule" name="wcdeliverable_order_schedule" id="wcdeliverable_order_schedule" style="width:100%; margin-top:15px">
                    <?php foreach ($wcdeliverable_schedules as $wcdeliverable_schedule) : ?>
                        <option value="<?php echo $wcdeliverable_schedule; ?>" <?php echo $delivery_schedule ==  $wcdeliverable_schedule ? 'selected' : ''; ?>> <?php echo $wcdeliverable_schedule; ?> </option>
                    <?php endforeach; ?>
                </select>

            </div>
            <?php
        }

        public function save_order_meta_boxes($post_id) {
            if (!isset($_POST['wcdeliverable_metabox_nonce'])) {
                return $post_id;
            }

            $nonce = $_POST['wcdeliverable_metabox_nonce'];

            if (!wp_verify_nonce($nonce, 'wcdeliverable_metabox')) {
                return $post_id;
            }

            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
                return $post_id;
            }

            if (isset($_POST['wcdeliverable_ordertype_selection_box'])) {
                update_post_meta($post_id, 'delivery_type', $_POST['wcdeliverable_ordertype_selection_box']);
            }

            if (isset($_POST['wcdeliverable_order_schedule'])) {
                update_post_meta($post_id, 'delivery_schedule', $_POST['wcdeliverable_order_schedule']);
            }
        }

        public function wcdeliverable_dinein_fee($and_taxes, $order)
        {
            $order_type = '';

            if (isset($_POST['wcdeliverable_ordertype_selection_box'])) {
                 $order_type = $_POST['wcdeliverable_ordertype_selection_box'];
            }

            if( $order_type != 'dine_in'){
                return;
            }


            if (did_action('woocommerce_order_after_calculate_totals') >= 2)
                return;

            $dinein_extra_fee_label = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['dinein_extra_fee_label']) ? $this->wcdeliverable_settings['dinein_extra_fee_label'] : 'Dine-In Service Charge';

            $dinein_extra_fee = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['dinein_extra_fee']) ? $this->wcdeliverable_settings['dinein_extra_fee'] : 10;

            $percentage = $dinein_extra_fee / 100; // Fee percentage

            $fee_data   = array(
                'name'       => __($dinein_extra_fee_label),
                'amount'     => wc_format_decimal($order->get_total() * $percentage),
                'tax_status' => 'none',
                'tax_class'  => ''
            );

            $fee_items  = $order->get_fees(); // Get price

            // Add price
            if (empty($fee_items)) {
                $item = new WC_Order_Item_Fee(); // Get an empty instance object

                $item->set_name($fee_data['name']);
                $item->set_amount($fee_data['amount']);
                $item->set_tax_class($fee_data['tax_class']);
                $item->set_tax_status($fee_data['tax_status']);
                $item->set_total($fee_data['amount']);

                $order->add_item($item);
                $item->save(); 
            }
            // Update price
            else {
                foreach ($fee_items as $item_id => $item) {
                    if ($item->get_name() === $fee_data['name']) {
                        $item->set_amount($fee_data['amount']);
                        $item->set_tax_class($fee_data['tax_class']);
                        $item->set_tax_status($fee_data['tax_status']);
                        $item->set_total($fee_data['amount']);
                        $item->save();
                    }
                }
            }
        }
    }
}


new wcDeliverableAdmin();
