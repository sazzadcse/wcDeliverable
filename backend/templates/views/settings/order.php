<div data-id="order_settings" class="wcdeliverable_tab_body">
    <div class="tab_body_title">
        <h1><?php _e('Order Settings', 'wcdeliverable'); ?></h1>
    </div>

    <div class="wcdeliverable_form_group">
        <div class="label_title">
            <h4><?php _e('Active Delivery/Takeaway?', 'wcdeliverable'); ?></h4>
        </div>

        <div class="label_content ">
            <div class="wcdeliverable_list_items">
                <div class="wcdeliverable_item">
                    <label class="toggle_switch">
                        <input id="wcdeliverable_enable_delivery_or_takeaway" class="wcdeliverable_default_checked"
                            name="wcdeliverable_enable_delivery_or_takeaway" type="checkbox" value="yes"
                            <?php echo !empty($this->wcdeliverable_settings) && isset($this->wcdeliverable_settings['wcdeliverable_enable_delivery_or_takeaway']) ? 'checked' : ''; ?>>
                        <span class="slider round"></span>
                    </label>
                </div>
                <small class="wcdeliverable-hints">Trun on the switch to delivery or picks orderd product from a takeaway location.</small>
            </div>
        </div>
    </div>

    <div class="wcdeliverable_form_group">
        <div class="label_title">
            <h4><?php _e('Label of Order Type', 'storefusion'); ?></h4>
        </div>

        <div class="label_content ">
            <div class="wcdeliverable_list_items">
                <div class="wcdeliverable_item">
                    <input class="wcdeliverable_text_control h50" type="text" name="wcdeliverable_order_type_label"
                        id=""
                        value="<?php echo !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['wcdeliverable_order_type_label']) ? $this->wcdeliverable_settings['wcdeliverable_order_type_label'] : ''; ?>">
                </div>
                <small class="wcdeliverable-hints">Label of Order type</small>
            </div>
        </div>
    </div>

    <div class="wcdeliverable_form_group">
        <div class="label_title">
            <h4><?php _e('Label of Delivery Option', 'wc-deliverable'); ?></h4>
        </div>

        <div class="label_content ">
            <div class="wcdeliverable_list_items">
                <div class="wcdeliverable_item">
                    <input class="wcdeliverable_text_control h50" type="text" name="wcdeliverable_delivery_option_label"
                        id=""
                        value="<?php echo !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['wcdeliverable_delivery_option_label']) ? $this->wcdeliverable_settings['wcdeliverable_delivery_option_label'] : ''; ?>"
                        placeholder="">
                </div>
                <small class="wcdeliverable-hints">Label of Order type delivery select option.</small>
            </div>
        </div>
    </div>

    <div class="wcdeliverable_form_group">
        <div class="label_title">
            <h4><?php _e('Label of Takeaway Option', 'store-slots'); ?></h4>
        </div>

        <div class="label_content ">
            <div class="wcdeliverable_list_items">
                <div class="wcdeliverable_item">
                    <input class="wcdeliverable_text_control h50" type="text" name="wcdeliverable_takeaway_option_label"
                        id="wcdeliverable_takeaway_option_label"
                        value="<?php echo !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['wcdeliverable_takeaway_option_label']) ? $this->wcdeliverable_settings['wcdeliverable_takeaway_option_label'] : ''; ?>"
                        placeholder="">
                </div>
                <small class="wcdeliverable-hints">Label of Order type takeaway select option.</small>
            </div>
        </div>
    </div>

    <div class="wcdeliverable_form_group">
        <div class="label_title">
            <h4><?php _e('Label of Dine-In Option', 'wc-deliverable'); ?></h4>
        </div>

        <div class="label_content ">
            <div class="wcdeliverable_list_items">
                <div class="wcdeliverable_item">
                    <input class="wcdeliverable_text_control h50" type="text" name="wcdeliverable_dinein_option_label"
                        id="wcdeliverable_dinein_option_label"
                        value="<?php echo !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['wcdeliverable_dinein_option_label']) ? $this->wcdeliverable_settings['wcdeliverable_dinein_option_label'] : ''; ?>"
                        placeholder="">
                </div>
                <small class="wcdeliverable-hints">Label of Order type dine-in select option.</small>
            </div>
        </div>
    </div>

    <div class="wcdeliverable_form_group">
        <div class="label_title">
            <h4><?php _e('Label of Delivery Date & Time', 'wc-deliverable'); ?></h4>
        </div>

        <div class="label_content ">
            <div class="wcdeliverable_list_items">
                <div class="wcdeliverable_item">
                    <input class="wcdeliverable_text_control h50" type="text"
                        name="wcdeliverable_delivery_date_time_label" id="wcdeliverable_delivery_date_time_label"
                        value="<?php echo !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['wcdeliverable_delivery_date_time_label']) ? $this->wcdeliverable_settings['wcdeliverable_delivery_date_time_label'] : ''; ?>"
                        placeholder="">
                </div>
                <small class="wcdeliverable-hints">Label of Delivery Time Slot</small>
            </div>
        </div>
    </div>

</div>