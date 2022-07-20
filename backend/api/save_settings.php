<?php

$result = array();

//Check if user has manage option capabilities 
if (current_user_can('manage_options')) {


    $post_data = array();
    $final_data = array();

    if (isset($_REQUEST) && $_REQUEST['data']) {

        $post_data = $_REQUEST['data'];

        //generate final post data
        foreach ($post_data as $item) {
            $final_data[$item['name']] = $item['value'];
        }

    } else {
        $result = array("status" => 'false');
    }
   
    if ($this->admin_class->utils->save_settings($final_data)) {
        $result = array("status" => 'true');
    } else {
        $result = array("status" => 'false');
    }
} else {
    $result = array("status" => 'false');
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
