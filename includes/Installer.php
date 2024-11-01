<?php

namespace SpringDevs\SMS;

/**
 * Class Installer
 * @package WPGenerator
 */
class Installer
{
    /**
     * Run the installer
     *
     * @return void
     */
    public function run()
    {
        $this->requirements();
        $this->create_tables();
    }

    /**
     * some requirement actions after activate plugin
     */
    public function requirements()
    {
        /* Woocommerce Tab */
        if (!get_option("user_sms_notification")) {
            add_option("user_sms_notification", "all");
        }

        if (!get_option("new_order_sms_notification")) {
            add_option("new_order_sms_notification", ["customers", "admin"]);
        }

        if (!get_option("sms_order_status_notifications")) {
            add_option("sms_order_status_notifications", ["processing", "completed", "cancelled", "refunded"]);
        }
        /* End of Woocommerce Tab */

        /* Template Tab */
        if (!get_option("admin_new_order_sms_template")) {
            add_option("admin_new_order_sms_template", "You received a order (#[_order_id]) from [_billing_format_name] .");
        }

        if (!get_option("new_order_sms_template")) {
            add_option("new_order_sms_template", "Your order #[_order_id] has been received . now it is under [_order_status] . [_products_with_price].");
        }

        if (!get_option("order_pending_payment_template")) {
            add_option("order_pending_payment_template", "Recently , you have created an order #[_order_id]. But your order status is pending payment. You need to pay now.");
        }

        if (!get_option("order_processing_template")) {
            add_option("order_processing_template", "Your order #[_order_id] has been received . now it is under Processing . for any query , call us : +8801XXXXXXXXX");
        }

        if (!get_option("order_on_hold_template")) {
            add_option("order_on_hold_template", "Your order #[_order_id] has been received . now it is [_order_status]. for any query , call us : +8801XXXXXXXXX");
        }

        if (!get_option("order_complete_template")) {
            add_option("order_complete_template", "Your order #[_order_id] is now completed. for any query , call us : +8801XXXXXXXXX");
        }

        if (!get_option("order_cancell_template")) {
            add_option("order_cancell_template", "Your order #[_order_id] is [_order_status]. for any query , call us : +8801XXXXXXXXX");
        }

        if (!get_option("order_refund_template")) {
            add_option("order_refund_template", "Your order #[_order_id] is refunded . for any query , call us : +8801XXXXXXXXX");
        }

        if (!get_option("order_failed_template")) {
            add_option("order_failed_template", "Your order #[_order_id] is failed . for any query , call us : +8801XXXXXXXXX");
        }
        /* End of Template Tab */
    }

    /**
     * Create necessary database tables
     *
     * @return void
     */
    public function create_tables()
    {
        if (!function_exists('dbDelta')) {
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        }
    }
}
