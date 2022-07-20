<div data-id="opening_schedules" class="wcdeliverable_tab_body">
    <div class="tab_body_title">
        <h1><?php _e('Opening Schedule Settings', 'wcdeliverable'); ?></h1>
    </div>
    <div class="title-wrapper">
        <h4 class="weeakday-title"><?php _e('Weekday', 'wcdeliverable'); ?></h4>
        <h4 class="open_form"><?php _e('Opening Hour (From)', 'wcdeliverable'); ?></h4>
        <h4 class="open_to"><?php _e('Opening Hour (To)', 'wcdeliverable'); ?></h4>
    </div>

    <div class="wcdeliverable_form_group2">
        <div class="label_content2">
            <div class="wcdeliverable_input_wrapper">
                <div class="wcdeliverable_inputs">
                    <div style="width: 11%;">
                        <input type="checkbox" class="wcdeliverable-weak-common" name="wcdeliverable_sunday"
                            value="sunday" <?php echo 'sunday' == $wcdeliverable_sunday? 'checked' : ''; ?>>
                        <label for="wcdeliverable_sunday">Sunday</label>
                    </div>
                    <input class="disabled-day wcdeliverable_text_control h50" type="time" name="sunday_open_hour_start" id=""
                        value="<?php echo !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['sunday_open_hour_start']) ? $this->wcdeliverable_settings['sunday_open_hour_start'] : ''; ?>"
                        disabled>
                    <input class="disabled-day wcdeliverable_text_control wcdeliverable_tt_custom h50" type="time"
                        name="sunday_open_hour_end" id=""
                        value="<?php echo !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['sunday_open_hour_end']) ? $this->wcdeliverable_settings['sunday_open_hour_end'] : ''; ?>"
                        disabled>
                </div>
            </div>
        </div>
    </div>

    <div class="wcdeliverable_form_group2">
        <div class="label_content2">
            <div class="wcdeliverable_input_wrapper">
                <div class="wcdeliverable_inputs">
                    <div style="width: 11%;">
                        <input class="wcdeliverable-weak-common" type="checkbox" name="wcdeliverable_monday"
                            value="monday" <?php echo 'monday' == $wcdeliverable_monday? 'checked' : ''; ?>>
                        <label for="wcdeliverable_monday">Monday</label>
                    </div>
                    <input class="disabled-day wcdeliverable_text_control h50" type="time" name="monday_open_hour_start"
                        value="<?php echo !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['monday_open_hour_start']) ? $this->wcdeliverable_settings['monday_open_hour_start'] : ''; ?>" disabled>
                    <input class="disabled-day wcdeliverable_text_control wcdeliverable_tt_custom h50" type="time"
                        name="monday_open_hour_end" id=""
                        value="<?php echo !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['monday_open_hour_end']) ? $this->wcdeliverable_settings['monday_open_hour_end'] : ''; ?>"
                        disabled>
                </div>
            </div>
        </div>
    </div>

    <div class="wcdeliverable_form_group2">
        <div class="label_content2">
            <div class="wcdeliverable_input_wrapper">
                <div class="wcdeliverable_inputs">
                    <div style="width: 11%;">
                        <input class="wcdeliverable-weak-common" type="checkbox" name="wcdeliverable_tuesday"
                            value="tuesday" <?php echo 'tuesday' == $wcdeliverable_tuesday? 'checked' : ''; ?>>
                        <label for="wcdeliverable_tuesday">Tuesday</label>
                    </div>
                    <input class="disabled-day wcdeliverable_text_control h50" type="time"
                        name="tuesday_open_hour_start" id=""
                        value="<?php echo !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['tuesday_open_hour_start']) ? $this->wcdeliverable_settings['tuesday_open_hour_start'] : ''; ?>"
                        disabled>
                    <input class="disabled-day wcdeliverable_text_control wcdeliverable_tt_custom h50" type="time"
                        name="tuesday_open_hour_end" id=""
                        value="<?php echo !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['tuesday_open_hour_end']) ? $this->wcdeliverable_settings['tuesday_open_hour_end'] : ''; ?>"
                        disabled>
                </div>
            </div>
        </div>
    </div>

    <div class="wcdeliverable_form_group2">
        <div class="label_content2">
            <div class="wcdeliverable_input_wrapper">
                <div class="wcdeliverable_inputs">
                    <div style="width: 11%;">
                        <input class="wcdeliverable-weak-common" type="checkbox" name="wcdeliverable_wednesday"
                            value="wednesday" <?php echo 'wednesday' == $wcdeliverable_wednesday? 'checked' : ''; ?>>
                        <label for="wcdeliverable_wednesday">Wednesday</label>
                    </div>
                    <input class="disabled-day wcdeliverable_text_control h50" type="time"
                        name="wednesday_open_hour_start" id=""
                        value="<?php echo !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['wednesday_open_hour_start']) ? $this->wcdeliverable_settings['wednesday_open_hour_start'] : ''; ?>"
                        disabled>
                    <input class="disabled-day wcdeliverable_text_control wcdeliverable_tt_custom h50" type="time"
                        name="wednesday_open_hour_end" id=""
                        value="<?php echo !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['wednesday_open_hour_end']) ? $this->wcdeliverable_settings['wednesday_open_hour_end'] : ''; ?>"
                        disabled>
                </div>
            </div>
        </div>
    </div>

    <div class="wcdeliverable_form_group2">
        <div class="label_content2">
            <div class="wcdeliverable_input_wrapper">
                <div class="wcdeliverable_inputs">
                    <div style="width: 11%;">
                        <input class="wcdeliverable-weak-common" type="checkbox" name="wcdeliverable_thursday"
                            value="thursday" <?php echo 'thursday' == $wcdeliverable_thursday? 'checked' : ''; ?>>
                        <label for="wcdeliverable_thursday">Thursday</label>
                    </div>
                    <input class="disabled-day wcdeliverable_text_control h50" type="time"
                        name="thursday_open_hour_start" id=""
                        value="<?php echo !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['thursday_open_hour_start']) ? $this->wcdeliverable_settings['thursday_open_hour_start'] : ''; ?>"
                        disabled>
                    <input class="disabled-day wcdeliverable_text_control wcdeliverable_tt_custom h50" type="time"
                        name="thursday_open_hour_end" id=""
                        value="<?php echo !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['thursday_open_hour_end']) ? $this->wcdeliverable_settings['thursday_open_hour_end'] : ''; ?>"
                        disabled>
                </div>
            </div>
        </div>
    </div>

    <div class="wcdeliverable_form_group2">
        <div class="label_content2">
            <div class="wcdeliverable_input_wrapper">
                <div class="wcdeliverable_inputs">
                    <div style="width: 11%;">
                        <input class="wcdeliverable-weak-common" type="checkbox" name="wcdeliverable_friday"
                            value="friday" <?php echo 'friday' == $wcdeliverable_friday? 'checked' : ''; ?>>
                        <label for="wcdeliverable_friday">Friday</label>
                    </div>
                    <input class="disabled-day wcdeliverable_text_control h50" type="time" name="friday_open_hour_start"
                        value="<?php echo !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['friday_open_hour_start']) ? $this->wcdeliverable_settings['friday_open_hour_start'] : ''; ?>"
                        disabled>
                    <input class="disabled-day wcdeliverable_text_control wcdeliverable_tt_custom h50" type="time"
                        name="friday_open_hour_end"
                        value="<?php echo !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['friday_open_hour_end']) ? $this->wcdeliverable_settings['friday_open_hour_end'] : ''; ?>"
                        disabled>
                </div>
            </div>
        </div>
    </div>

    <div class="wcdeliverable_form_group2">
        <div class="label_content2">
            <div class="wcdeliverable_input_wrapper">
                <div class="wcdeliverable_inputs">
                    <div style="width: 11%;">
                        <input class="wcdeliverable-weak-common" type="checkbox" name="wcdeliverable_saturday"
                            value="saturday" <?php echo 'saturday' == $wcdeliverable_saturday? 'checked' : ''; ?>>
                        <label for="wcdeliverable_saturday">Saturday</label>
                    </div>
                    <input class="wcdeliverable_text_control disabled-day h50" type="time"
                        name="saturday_open_hour_start" id=""
                        value="<?php echo !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['saturday_open_hour_start']) ? $this->wcdeliverable_settings['saturday_open_hour_start'] : ''; ?>"
                        disabled>
                    <input class="wcdeliverable_text_control disabled-day wcdeliverable_tt_custom h50" type="time"
                        name="saturday_open_hour_end" id=""
                        value="<?php echo !empty($this->wcdeliverable_settings) && !empty($this->wcdeliverable_settings['saturday_open_hour_end']) ? $this->wcdeliverable_settings['saturday_open_hour_end'] : ''; ?>"
                        disabled>
                </div>
            </div>
        </div>
    </div>

</div>