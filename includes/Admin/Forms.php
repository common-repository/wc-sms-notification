<?php

namespace SpringDevs\SMS\Admin;

/**
 * Form Handler
 *
 * Class Forms
 * @package SpringDevs\SMS\Admin
 */
class Forms
{
    public function __construct()
    {
        add_action("admin_init", [$this, 'handling_form']);
    }

    public function handling_form()
    {
        $this->woocommerce_setup();
        $this->template_form();
    }

    public function woocommerce_setup()
    {
        if (isset($_POST['user_sms_notification']) && isset($_POST['_wpnonce']) && wp_verify_nonce($_POST['_wpnonce'], 'sdevs-sms-woocommerce-formnonce')) {
            $user_sms_notification = sanitize_text_field($_POST['user_sms_notification']);
            update_option("user_sms_notification", $user_sms_notification);
            if (isset($_POST['checkout_field_default_selected'])) {
                update_option("checkout_field_default_selected", "yes");
            } else {
                update_option("checkout_field_default_selected", "no");
            }
            if (isset($_POST['new_order_sms_notification']) && is_array($_POST['new_order_sms_notification'])) {
                update_option("new_order_sms_notification", $_POST['new_order_sms_notification']);
            } else {
                update_option("new_order_sms_notification", []);
            }
            $checkout_checkbox_field_txt = sanitize_text_field($_POST['checkout_checkbox_field_txt']);
            update_option('checkout_checkbox_field_txt', $checkout_checkbox_field_txt);
            if (isset($_POST['sms_order_status_notifications']) && is_array($_POST['sms_order_status_notifications'])) {
                update_option("sms_order_status_notifications", $_POST['sms_order_status_notifications']);
            } else {
                update_option("sms_order_status_notifications", []);
            }
            add_action('admin_notices', function (): void {
                $class = 'notice notice-success';
                $message = __('Settings saved !!', 'sdevs_sms');
                printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));
            });
        }
    }

    public function template_form()
    {
        if (isset($_POST['order_pending_payment_status']) && isset($_POST['_wpnonce']) && wp_verify_nonce($_POST['_wpnonce'], 'sdevs-sms-template-formnonce')) {
            $admin_new_order_sms_template   =   sanitize_text_field($_POST['admin_new_order_sms_template']);
            $new_order_sms_template         =   sanitize_text_field($_POST['new_order_sms_template']);
            $order_pending_payment_status   =   sanitize_text_field($_POST['order_pending_payment_status']);
            $order_processing_status        =   sanitize_text_field($_POST['order_processing_status']);
            $order_on_hold_status           =   sanitize_text_field($_POST['order_on_hold_status']);
            $order_complete_status          =   sanitize_text_field($_POST['order_complete_status']);
            $order_cancell_status           =   sanitize_text_field(($_POST['order_cancell_status']));
            $order_refund_status            =   sanitize_text_field($_POST['order_refund_status']);
            $order_failed_status            =   sanitize_text_field($_POST['order_failed_status']);

            update_option("admin_new_order_sms_template",   $admin_new_order_sms_template);
            update_option("new_order_sms_template",         $new_order_sms_template);
            update_option("order_pending_payment_template", $order_pending_payment_status);
            update_option("order_processing_template",      $order_processing_status);
            update_option("order_on_hold_template",         $order_on_hold_status);
            update_option("order_complete_template",        $order_complete_status);
            update_option("order_cancell_template",         $order_cancell_status);
            update_option("order_refund_template",          $order_refund_status);
            update_option("order_failed_template",          $order_failed_status);

            add_action('admin_notices', function (): void {
                $class = 'notice notice-success';
                $message = __('Settings saved !!', 'sdevs_sms');
                printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));
            });
        }
    }
}
