<?php

namespace SpringDevs\SMS\Admin;

/**
 * Admin Pages Handler
 *
 * Class Menu
 * @package SpringDevs\SMS\Admin
 */
class Menu
{
    /**
     * Menu constructor.
     */
    public function __construct()
    {
        add_action('admin_menu', [$this, 'admin_menu']);
    }

    /**
     * Register our menu page
     *
     * @return void
     */
    public function admin_menu()
    {
        add_menu_page(__('SMS', 'sdevs_sms'), __('SMS', 'sdevs_sms'), 'manage_options', 'sdevs-sms-setup', false, 'dashicons-email-alt2', 50);
        $setup_hook = add_submenu_page('sdevs-sms-setup', __('Setup', 'sdevs_sms'), __('Setup', 'sdevs_sms'), 'manage_options', 'sdevs-sms-setup', [$this, 'setup_page']);
        $woocommerce_hook = add_submenu_page('sdevs-sms-setup', __('WooCommerce', 'sdevs_sms'), __('WooCommerce', 'sdevs_sms'), 'manage_options', 'sdevs-sms-woocommerce', [$this, 'woocommerce_page']);
        $template_hook = add_submenu_page('sdevs-sms-setup', __('Template', 'sdevs_sms'), __('Template', 'sdevs_sms'), 'manage_options', 'sdevs-sms-template', [$this, 'template_page']);
        add_action('load-' . $setup_hook, [$this, 'init_hooks']);
        add_action('load-' . $woocommerce_hook, [$this, 'init_hooks']);
        add_action('load-' . $template_hook, [$this, 'init_hooks']);
    }

    /**
     * Initialize our hooks for the admin page
     *
     * @return void
     */
    public function init_hooks()
    {
        add_action('admin_enqueue_scripts', [$this, 'enqueue_scripts']);
    }

    /**
     * Load scripts and styles for the app
     *
     * @return void
     */
    public function enqueue_scripts()
    {
        // wp_enqueue_style( 'admin' );
        wp_enqueue_script('sms_admin_js');
        wp_enqueue_script('sms_app_js');
        wp_localize_script('sms_app_js', 'sms_helper_obj', [
            'nonce' => wp_create_nonce('sdevs-sms-setup-formnonce'),
            'ajax_url' => admin_url('admin-ajax.php')
        ]);
    }

    /**
     * Handles the setup page
     *
     * @return void
     */
    public function setup_page()
    {
        include 'views/setup.php';
    }

    /**
     * Handles the woocommerce page
     *
     * @return void
     */
    public function woocommerce_page()
    {
        include 'views/woocommerce.php';
    }

    /**
     * Handles the template page
     *
     * @return void
     */
    public function template_page()
    {
        include 'views/template.php';
    }
}
