<?php
// check base path.
if (!defined ('WPINC')) {
    die;
}

if (!class_exists ('wcDeliveriableFrontend')) {
    class wcDeliveriableFrontend {

        public $utils;
        public $wcdeliverable_settings = array();
          
        public function __construct (){
            $this->utils = new wcDeliverableUtils();
            $this->wcdeliverable_settings = get_option('wcdeliverable_settings', false);
            
            new wcDeliverableFrontendAjax($this);
            add_action ('wp_enqueue_scripts', array($this, 'wcdeliverable_frontend_enqueue'));

            $enable_delivery_or_takeaway = !empty($this->wcdeliverable_settings) && isset($this->wcdeliverable_settings['wcdeliverable_enable_delivery_or_takeaway']) ? 'yes' : 'no'; 

            if( 'yes' ==  $enable_delivery_or_takeaway ){
                add_action('woocommerce_after_order_notes', array($this, 'wcdeliverable_add_custom_field'));
                add_action('woocommerce_checkout_process', array($this, 'wcdeliverable_checkout_field_process'));
                add_action('woocommerce_checkout_update_order_meta', array( $this,'wcdeliverable_checkout_field_update_order_meta'));
            }

            $enable_first_order_discount = !empty($this->wcdeliverable_settings) && isset($this->wcdeliverable_settings['enable_first_order_discount']) ? 'yes' : 'no'; 

            if( 'yes' == $enable_first_order_discount ){
                add_action('woocommerce_cart_calculate_fees', array( $this,'discount_based_on_customer_first_order'), 10, 1);
            }

           
        }

        public function wcdeliverable_frontend_enqueue ($page) {
            $this->utils->enqueue_style('frontend', 'frontend.css');
            $this->utils->enqueue_script('frontend', 'frontend.js', array('jquery'));
        }

        public function wcdeliverable_add_custom_field($checkout){

            $order_type_label  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['wcdeliverable_order_type_label']) ? $this->wcdeliverable_settings['wcdeliverable_order_type_label'] : 'Order Type';

            $delivery_option_label  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['wcdeliverable_delivery_option_label']) ? $this->wcdeliverable_settings['wcdeliverable_delivery_option_label'] : 'Delivery';

            $takeaway_option_label = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['wcdeliverable_takeaway_option_label']) ? $this->wcdeliverable_settings['wcdeliverable_takeaway_option_label'] : 'Takeaway';

            echo '<div id="wcdeliverable_custom_checkout_field">';

            woocommerce_form_field(
                'wcdeliverable_ordertype_selection_box',
                array(
                    'type' => 'select',
                    'class' => array(
                        'wcdeliverable_ordertype_selection_box'
                    ),
                    'label' => __( $order_type_label),
                    'placeholder' => __( $order_type_label ),
                    
                    'options' => array(
                         '' => __('Choose Order type'),
                        'delivery' => __($delivery_option_label),
                        'takeaway' => __( $takeaway_option_label)
                    ),

                    'required' => true,
                ),
                $checkout->get_value('wcdeliverable_ordertype_selection_box')
            );

            echo '</div>';

           
            // Schedule Date and Time
            $wcdeliverable_schedules = array();
            $wcdeliverable_sunday_time = '';
            $wcdeliverable_saturday_time = '';
            $wcdeliverable_monday_time = '';
            $wcdeliverable_tuesday_time = '';
            $wcdeliverable_wednesday_time = '';
            $wcdeliverable_thursday_time = '';
            $wcdeliverable_friday_time = '';
            $wcdeliverable_schedules[]= 'Select Time Slot';

            $wcdeliverable_saturday  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['wcdeliverable_saturday']) ? $this->wcdeliverable_settings['wcdeliverable_saturday'] : ''; 
            $saturday_open_hour_start  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['saturday_open_hour_start']) ? $this->wcdeliverable_settings['saturday_open_hour_start'] : ''; 
            $saturday_open_hour_end  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['saturday_open_hour_end']) ? $this->wcdeliverable_settings['saturday_open_hour_end'] : ''; 

            if( !empty( $wcdeliverable_saturday )){
                if( !empty( $saturday_open_hour_start ) && !empty(  $saturday_open_hour_end )  ){
                    $wcdeliverable_saturday_time =  ' -- ' . $saturday_open_hour_start . ' - ' . $saturday_open_hour_end;
                }
                
                $store_slot_one = ucfirst( $wcdeliverable_saturday )  . $wcdeliverable_saturday_time;

                $wcdeliverable_schedules[$store_slot_one] =  $store_slot_one ; 
            }

            $wcdeliverable_sunday  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['wcdeliverable_sunday']) ? $this->wcdeliverable_settings['wcdeliverable_sunday'] : ''; 
            $sunday_open_hour_start  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['sunday_open_hour_start']) ? $this->wcdeliverable_settings['sunday_open_hour_start'] : ''; 
            $sunday_open_hour_end  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['sunday_open_hour_end']) ? $this->wcdeliverable_settings['sunday_open_hour_end'] : ''; 

            if( !empty( $wcdeliverable_sunday )){
                if( !empty( $sunday_open_hour_start ) && !empty(  $sunday_open_hour_end )  ){
                    $wcdeliverable_sunday_time =  ' -- ' . $sunday_open_hour_start . ' - ' . $sunday_open_hour_end;
                }
                $store_slot_two = ucfirst( $wcdeliverable_sunday )  . $wcdeliverable_sunday_time;

                $wcdeliverable_schedules[$store_slot_two] = $store_slot_two ; 
            }

            $wcdeliverable_monday  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['wcdeliverable_monday']) ? $this->wcdeliverable_settings['wcdeliverable_monday'] : ''; 
            $monday_open_hour_start  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['monday_open_hour_start']) ? $this->wcdeliverable_settings['monday_open_hour_start'] : ''; 
            $monday_open_hour_end  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['monday_open_hour_end']) ? $this->wcdeliverable_settings['monday_open_hour_end'] : ''; 

            if( !empty( $wcdeliverable_monday )){
                if( !empty( $monday_open_hour_start ) && !empty(  $monday_open_hour_end )  ){
                    $wcdeliverable_monday_time =  ' -- ' . $monday_open_hour_start . ' - ' . $monday_open_hour_end;
                }
                $store_slot_three = ucfirst( $wcdeliverable_monday )  . $wcdeliverable_monday_time;

                $wcdeliverable_schedules[$store_slot_three] = $store_slot_three; 
            }

            $wcdeliverable_tuesday  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['wcdeliverable_tuesday']) ? $this->wcdeliverable_settings['wcdeliverable_tuesday'] : ''; 
            $tuesday_open_hour_start  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['tuesday_open_hour_start']) ? $this->wcdeliverable_settings['tuesday_open_hour_start'] : ''; 
            $tuesday_open_hour_end  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['tuesday_open_hour_end']) ? $this->wcdeliverable_settings['tuesday_open_hour_end'] : ''; 

            if( !empty( $wcdeliverable_tuesday )){
                if( !empty( $tuesday_open_hour_start ) && !empty(  $tuesday_open_hour_end )  ){
                    $wcdeliverable_tuesday_time =  ' -- ' . $tuesday_open_hour_start . ' - ' . $tuesday_open_hour_end;
                }

                $store_slot_four = ucfirst( $wcdeliverable_tuesday )  . $wcdeliverable_tuesday_time;
                $wcdeliverable_schedules[$store_slot_four] = $store_slot_four; 
            }

            $wcdeliverable_wednesday  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['wcdeliverable_wednesday']) ? $this->wcdeliverable_settings['wcdeliverable_wednesday'] : ''; 
            $wednesday_open_hour_start  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['wednesday_open_hour_start']) ? $this->wcdeliverable_settings['wednesday_open_hour_start'] : ''; 
            $wednesday_open_hour_end  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['wednesday_open_hour_end']) ? $this->wcdeliverable_settings['wednesday_open_hour_end'] : ''; 

            if( !empty( $wcdeliverable_wednesday )){
                if( !empty( $wednesday_open_hour_start ) && !empty(  $wednesday_open_hour_end )  ){
                    $wcdeliverable_wednesday_time =  ' -- ' . $wednesday_open_hour_start . ' - ' . $wednesday_open_hour_end;
                }

                $store_slot_five = ucfirst( $wcdeliverable_wednesday )  . $wcdeliverable_wednesday_time;

                $wcdeliverable_schedules[$store_slot_five] =  $store_slot_five; 
            }

            $wcdeliverable_thursday  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['wcdeliverable_thursday']) ? $this->wcdeliverable_settings['wcdeliverable_thursday'] : ''; 
            $thursday_open_hour_start  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['thursday_open_hour_start']) ? $this->wcdeliverable_settings['thursday_open_hour_start'] : ''; 
            $thursday_open_hour_end  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['thursday_open_hour_end']) ? $this->wcdeliverable_settings['thursday_open_hour_end'] : ''; 

            if( !empty( $wcdeliverable_thursday )){
                if( !empty( $thursday_open_hour_start ) && !empty(  $thursday_open_hour_end )  ){
                    $wcdeliverable_thursday_time =  ' -- ' . $thursday_open_hour_start . ' - ' . $thursday_open_hour_end;
                }
                $store_slot_six = ucfirst( $wcdeliverable_thursday )  . $wcdeliverable_thursday_time;
                $wcdeliverable_schedules[$store_slot_six] = $store_slot_six;
            }

            $wcdeliverable_friday  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['wcdeliverable_friday']) ? $this->wcdeliverable_settings['wcdeliverable_friday'] : ''; 
            $friday_open_hour_start  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['friday_open_hour_start']) ? $this->wcdeliverable_settings['friday_open_hour_start'] : ''; 
            $friday_open_hour_end  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['friday_open_hour_end']) ? $this->wcdeliverable_settings['friday_open_hour_end'] : ''; 

            if( !empty( $wcdeliverable_friday )){
                if( !empty( $friday_open_hour_start ) && !empty(  $friday_open_hour_end )  ){
                    $wcdeliverable_friday_time =  ' -- ' . $friday_open_hour_start . ' - ' . $friday_open_hour_end;
                }
                $store_slot_seven = ucfirst( $wcdeliverable_friday )  . $wcdeliverable_friday_time; 
                $wcdeliverable_schedules[ $store_slot_seven] =  $store_slot_seven;
            }


            $delivery_date_time_label  = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['wcdeliverable_delivery_date_time_label']) ? $this->wcdeliverable_settings['wcdeliverable_delivery_date_time_label'] : 'Delivery Date & Time';

        echo '<div id="wcdeliverable_custom_checkout_schedule">';
            woocommerce_form_field(
                'wcdeliverable_order_schedule',
                array(
                    'type' => 'select',
                    'class' => array(
                        'wcdeliverable_order_schedule'
                    ),
                    'label' => __( $delivery_date_time_label),
                    'placeholder' => __( $delivery_date_time_label),
                    
                    'options' => $wcdeliverable_schedules,

                    'required' => true,
                ),
                $checkout->get_value('wcdeliverable_order_schedule')
            );

            echo '</div>';
        }

        public function wcdeliverable_checkout_field_process(){
            // Show an error message if the field is not set.
            if (!$_POST['wcdeliverable_ordertype_selection_box']) wc_add_notice(__('Please enter value!'), 'error');
            if (!$_POST['wcdeliverable_order_schedule']) wc_add_notice(__('Please enter value!'), 'error');
        }

        public function wcdeliverable_checkout_field_update_order_meta( $order_id ){
           
            if (!empty($_POST['wcdeliverable_ordertype_selection_box'])) {
                update_post_meta($order_id, 'delivery_type', sanitize_text_field($_POST['wcdeliverable_ordertype_selection_box']));
            }

            if (!empty($_POST['wcdeliverable_order_schedule'])) {

                update_post_meta($order_id, 'delivery_schedule', sanitize_text_field($_POST['wcdeliverable_order_schedule']));
            }


        }

        public function discount_based_on_customer_first_order( $cart_object ){
            global $woocommerce;

            if ( is_admin() && ! defined( 'DOING_AJAX' ) )
                return;  
        
            // Getting "completed" customer orders
            $customer_orders = get_posts( array(
                'numberposts' => -1,
                'meta_key'    => '_customer_user',
                'meta_value'  => get_current_user_id(),
                'post_type'   => 'shop_order', // WC orders post type
                'post_status' => 'wc-completed' // Only orders with status "completed"
            ) );
        
            // Orders count
            $customer_orders_count = count($customer_orders);
        
            // The cart total
            $cart_total = WC()->cart->get_total(); // or WC()->cart->get_total_ex_tax()
        
            // First customer order
            $first_order_discount = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['first_order_discount']) ? $this->wcdeliverable_settings['first_order_discount'] : 40;

            $first_order_discount_label = !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['first_order_discount_label']) ? $this->wcdeliverable_settings['first_order_discount_label'] : 'First Order Discount';

            if( empty($customer_orders) || $customer_orders_count == 0 ){
                $percentage = $first_order_discount / 100;
                $discount_text = __($first_order_discount_label, 'wc-deliverable');
                $discount =  - (( $woocommerce->cart->cart_contents_total + $woocommerce->cart->shipping_total ) * $percentage);
            } 
            
        
            // Apply discount
            if( ! empty( $discount ) ){
                // Note: Last argument is related to applying the tax (false by default)
                $cart_object->add_fee( $discount_text, $discount, false);
            }
        }

    }
}

new wcDeliveriableFrontend();
