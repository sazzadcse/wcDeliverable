<div data-id="fee_settings" class="wcdeliverable_tab_body">
    <div class="tab_body_title">
        <h1><?php _e('Custom Price Settings', 'wcdeliverable'); ?></h1>
    </div>

    <div class="wcdeliverable_form_group">
        <div class="label_title">
            <h4><?php _e('Active First Order Discount', 'wcdeliverable'); ?></h4>
        </div>

        <div class="label_content ">
            <div class="wcdeliverable_list_items">
                <div class="wcdeliverable_item">
                    <label class="toggle_switch">
                        <input id="enable_first_order_discount" class="wcdeliverable_default_checked"
                            name="enable_first_order_discount" type="checkbox" value="yes"
                            <?php echo !empty($this->wcdeliverable_settings) && isset($this->wcdeliverable_settings['enable_first_order_discount']) ? 'checked' : ''; ?>>
                        <span class="slider round"></span>
                    </label>
                </div>
                <small class="wcdeliverable-hints">Turn on the swith to enable first order discount.</small>
            </div>
        </div>
    </div>

    <div class="wcdeliverable_form_group">
        <div class="label_title">
            <h4><?php _e('Label of First Order Discount', 'wc-deliverable'); ?></h4>
        </div>

        <div class="label_content ">
            <div class="wcdeliverable_list_items">
                <div class="wcdeliverable_item">
                    <input class="wcdeliverable_text_control h50" type="text" name="first_order_discount_label" id=""
                        value="<?php echo !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['first_order_discount_label']) ? $this->wcdeliverable_settings['first_order_discount_label'] : ''; ?>"
                        placeholder="">
                </div>
                <small class="wcdeliverable-hints">Customer first order discount price label.</small>
            </div>
        </div>
    </div>

    <div class="wcdeliverable_form_group">
        <div class="label_title">
            <h4><?php _e('First Order Discount Amount', 'wc-delivearble'); ?></h4>
        </div>

        <div class="label_content ">
            <div class="wcdeliverable_list_items">
                <div class="wcdeliverable_item">
                    <input class="wcdeliverable_text_control h50" type="number" name="first_order_discount" id=""
                        value="<?php echo !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['first_order_discount']) ? $this->wcdeliverable_settings['first_order_discount'] : ''; ?>"
                        placeholder="">
                </div>
                <small class="wcdeliverable-hints">First order discount value in percentage.</small>
            </div>
        </div>
    </div>

    <div class="wcdeliverable_form_group">
        <div class="label_title">
            <h4><?php _e('Active Dine-In Extra Price?', 'wcdeliverable'); ?></h4>
        </div>

        <div class="label_content ">
            <div class="wcdeliverable_list_items">
                <div class="wcdeliverable_item">
                    <label class="toggle_switch">
                        <input id="enable_dinein_extra_fee" class="wcdeliverable_default_checked"
                            name="enable_dinein_extra_fee" type="checkbox" value="yes"
                            <?php echo !empty($this->wcdeliverable_settings) && isset($this->wcdeliverable_settings['enable_dinein_extra_fee']) ? 'checked' : ''; ?>>
                        <span class="slider round"></span>
                    </label>
                </div>
                <small class="wcdeliverable-hints">Turn on the switch to enable extra charge for dine-in order.</small>
            </div>
        </div>
    </div>

    <div class="wcdeliverable_form_group">
        <div class="label_title">
            <h4><?php _e('Label of Dine-In Extra Price', 'wc-deliverable'); ?></h4>
        </div>

        <div class="label_content ">
            <div class="wcdeliverable_list_items">
                <div class="wcdeliverable_item">
                    <input class="wcdeliverable_text_control h50" type="text" name="dinein_extra_fee_label"
                        value="<?php echo !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['dinein_extra_fee_label']) ? $this->wcdeliverable_settings['dinein_extra_fee_label'] : ''; ?>"
                        >
                </div>
                <small class="wcdeliverable-hints">Dine-in extra charge label.</small>
            </div>
        </div>
    </div>

    <div class="wcdeliverable_form_group">
        <div class="label_title">
            <h4><?php _e('Dine-In Extra Price', 'wc-deliverable'); ?></h4>
        </div>

        <div class="label_content ">
            <div class="wcdeliverable_list_items">
                <div class="wcdeliverable_item">
                    <input class="wcdeliverable_text_control h50" type="number" name="dinein_extra_fee" id=""
                        value="<?php echo !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['dinein_extra_fee']) ? $this->wcdeliverable_settings['dinein_extra_fee'] : ''; ?>"
                        placeholder="">
                </div>
                <small class="wcdeliverable-hints">Exta charge for dine-in in percentage.</small>
            </div>
        </div>
    </div>

</div>