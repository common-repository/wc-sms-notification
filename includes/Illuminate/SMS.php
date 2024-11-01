<?php

namespace SpringDevs\SMS\Illuminate;

/**
 * Class SMS
 * @package SpringDevs\SMS\Illuminate
 */
class SMS
{

    public static function formate_number($phone_number, $country_code)
    {
        $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
        $swissNumberProto = $phoneUtil->parse($phone_number, $country_code);
        return $phoneUtil->format($swissNumberProto, \libphonenumber\PhoneNumberFormat::E164);
    }

    public static function new_order_sms_admin($order_id)
    {
        $order_sms_template = get_option("admin_new_order_sms_template");
        $content = Template::filter_content($order_sms_template, $order_id);
        $admin_phone_numbers = get_option("admin_phone_numbers");
        if ($admin_phone_numbers) {
            $admin_phone_numbers = explode(",", $admin_phone_numbers);
            foreach ($admin_phone_numbers as $admin_phone_number) {
                sdevs_send_sms($admin_phone_number, $content);
            }
        }
    }

    public static function new_order_sms($order_id)
    {
        $new_order_sms_template = get_option("new_order_sms_template");
        $content = Template::filter_content($new_order_sms_template, $order_id);
        $order = wc_get_order($order_id);

        $phone_number = SMS::formate_number($order->get_billing_phone(), $order->get_billing_country());
        sdevs_send_sms($phone_number, $content);
    }

    public static function pending_order_sms($order_id)
    {
        $pending_order_sms_template = get_option("order_pending_payment_template");
        $content = Template::filter_content($pending_order_sms_template, $order_id);
        $order = wc_get_order($order_id);

        $phone_number = SMS::formate_number($order->get_billing_phone(), $order->get_billing_country());
        sdevs_send_sms($phone_number, $content);
    }

    public static function processing_order_sms($order_id)
    {
        $pending_order_sms_template = get_option("order_processing_template");
        $content = Template::filter_content($pending_order_sms_template, $order_id);
        $order = wc_get_order($order_id);

        $phone_number = SMS::formate_number($order->get_billing_phone(), $order->get_billing_country());
        sdevs_send_sms($phone_number, $content);
    }

    public static function onhold_order_sms($order_id)
    {
        $onhold_order_sms_template = get_option("order_on_hold_template");
        $content = Template::filter_content($onhold_order_sms_template, $order_id);
        $order = wc_get_order($order_id);

        $phone_number = SMS::formate_number($order->get_billing_phone(), $order->get_billing_country());
        sdevs_send_sms($phone_number, $content);
    }

    public static function completed_order_sms($order_id)
    {
        $order_sms_template = get_option("order_complete_template");
        $content = Template::filter_content($order_sms_template, $order_id);
        $order = wc_get_order($order_id);

        $phone_number = SMS::formate_number($order->get_billing_phone(), $order->get_billing_country());
        sdevs_send_sms($phone_number, $content);
    }

    public static function cancelled_order_sms($order_id)
    {
        $order_sms_template = get_option("order_cancell_template");
        $content = Template::filter_content($order_sms_template, $order_id);
        $order = wc_get_order($order_id);

        $phone_number = SMS::formate_number($order->get_billing_phone(), $order->get_billing_country());
        sdevs_send_sms($phone_number, $content);
    }

    public static function failed_order_sms($order_id)
    {
        $order_sms_template = get_option("order_failed_template");
        $content = Template::filter_content($order_sms_template, $order_id);
        $order = wc_get_order($order_id);

        $phone_number = SMS::formate_number($order->get_billing_phone(), $order->get_billing_country());
        sdevs_send_sms($phone_number, $content);
    }

    public static function refunded_order_sms($order_id)
    {
        $order_sms_template = get_option("order_refund_template");
        $content = Template::filter_content($order_sms_template, $order_id);
        $order = wc_get_order($order_id);

        $phone_number = SMS::formate_number($order->get_billing_phone(), $order->get_billing_country());
        sdevs_send_sms($phone_number, $content);
    }
}
