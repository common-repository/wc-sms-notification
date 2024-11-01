<?php

namespace SpringDevs\SMS\Frontend;

use SpringDevs\SMS\Illuminate\SMS;

/**
 * Class Checkout
 * @package SpringDevs\SMS\Frontend
 */
class Checkout
{
    public function __construct()
    {
        add_filter("woocommerce_checkout_fields", [$this, "change_billing_fields"]);
        add_action('woocommerce_checkout_update_order_meta', [$this, "save_checkout_data"]);
        add_action('woocommerce_before_thankyou', array($this, 'send_sms_after_new_order'));
    }

    public function change_billing_fields($fields): array {
        if ("ask_checkout" === get_option("user_sms_notification", "all")) {
            $fields['billing']['sms_order_notification'] = [
                'label'        => get_option("checkout_checkbox_field_txt", __('I want to be notified about any changes in the order via SMS', 'sdevs_sms')),
                'type'         => 'checkbox',
                'required'     => false,
                'class'        => ['form-row-wide'],
                'default'      => get_option("checkout_field_default_selected", "no") == "yes" ? 1 : '',
                'priority'     => 100
            ];
        }
        return $fields;
    }

    public function save_checkout_data($order_id)
    {
        if (isset($_POST['sms_order_notification']) && "ask_checkout" === get_option("user_sms_notification", "all")) {
            update_post_meta($order_id, "_sms_order_notification", "yes");
        } else {
            update_post_meta($order_id, "_sms_order_notification", "no");
        }
    }

    public function send_sms_after_new_order($order_id)
    {
        if (!$order_id) return;
        $is_new_order_sms_send = get_post_meta($order_id, "_new_order_sms_send", true);
        if (!$is_new_order_sms_send) {
            if (in_array("customers", get_option("new_order_sms_notification", []))) {
                if ("ask_checkout" === get_option("user_sms_notification", "all")) {
                    $order_notification = get_post_meta($order_id, "_sms_order_notification", true);
                    if ("yes" === $order_notification) {
                        SMS::new_order_sms($order_id);
                    }
                } else {
                    SMS::new_order_sms($order_id);
                }
            }
            if (in_array("admin", get_option("new_order_sms_notification", []))) {
                SMS::new_order_sms_admin($order_id);
            }
            update_post_meta($order_id, "_new_order_sms_send", time());
        }
    }
}
