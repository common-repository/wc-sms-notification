<?php

namespace SpringDevs\SMS\Illuminate;

/**
 * Class Order
 * @package SpringDevs\SMS\Illuminate
 */
class Order
{
    public function __construct()
    {
        add_action('woocommerce_order_status_changed', [$this, "order_status_changed"]);
    }

    public function order_status_changed($order_id)
    {
        $order = wc_get_order($order_id);
        $status_notifications = get_option("sms_order_status_notifications", []);

        if ("ask_checkout" === get_option("user_sms_notification", "all")) {
            $order_notification = get_post_meta($order_id, "_sms_order_notification", true);
            if ("yes" != $order_notification) return;
        }

        switch ($order->get_status()) {
            case "pending";
                if (in_array("pending_payment", $status_notifications)) SMS::pending_order_sms($order_id);
                break;
            case "processing";
                if (in_array("processing", $status_notifications)) SMS::processing_order_sms($order_id);
                break;
            case "on-hold";
                if (in_array("on_hold", $status_notifications)) SMS::onhold_order_sms($order_id);
                break;
            case "completed";
                if (in_array("completed", $status_notifications)) SMS::completed_order_sms($order_id);
                break;
            case "cancelled";
                if (in_array("cancelled", $status_notifications)) SMS::cancelled_order_sms($order_id);
                break;
            case "failed";
                if (in_array("failed", $status_notifications)) SMS::failed_order_sms($order_id);
                break;
            case "refunded";
                if (in_array("refunded", $status_notifications)) SMS::refunded_order_sms($order_id);
                break;
        }
    }
}
