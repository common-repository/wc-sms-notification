<?php

namespace SpringDevs\SMS\Ajax;

/**
 * Form Class
 */
class Form
{

    /**
     * Initialize the class
     */
    public function __construct()
    {
        add_action('wp_ajax_sms_setup_form', [$this, 'save_setup_data']);
    }

    public function save_setup_data()
    {
        if (isset($_POST['nonce']) && wp_verify_nonce($_POST['nonce'], 'sdevs-sms-setup-formnonce')) {

            $verify = $this->verify($_POST['data']);
            if (!$verify['result']) {
                return wp_send_json([
                    "type" => "error",
                    "msg" => __($verify['msg'], "sdevs_sms"),
                ]);
            }

            foreach ($_POST['data'] as $key => $value) {
                update_option($key, $value);
            }

            wp_send_json([
                "type" => "success",
                "msg" => __("Saved SuccessFully", "sdevs_sms"),
            ]);
        }
    }

    public function verify($post_data)
    {
        return apply_filters('sms_verify_api_' . $post_data['sms_service'], ['result' => true], $post_data);
    }
}
