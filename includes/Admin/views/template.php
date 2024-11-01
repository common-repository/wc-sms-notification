<div class="wrap">
    <h2><?php esc_attr_e('SMS Settings', 'sdevs_sms'); ?></h2>
    <?php include_once 'navs.php'; ?>
    <form method="POST">
        <?php wp_nonce_field('sdevs-sms-template-formnonce'); ?>
        <div class="card" style="max-width: 100%;">
            <h2 class="title"><?php _e('TEMPLATE SETTINGS', 'sdevs_sms'); ?></h2>
            <p>
                <strong><?php _e('Available template tags', 'sdevs_sms'); ?>: </strong><br><br>
                <code>[_order_id]</code>,
                <code>[_billing_format_address]</code>,
                <code>[_shipping_format_address]</code>,
                <code>[_billing_format_name]</code>,
                <code>[_site_title]</code>,
                <code>[_site_url]</code>,
                <code>[_shipping_method]</code>,
                <code>[_order_total]</code>,
                <code>[_order_status]</code>,
                <code>[_order_date]</code>,
                <code>[_products_with_price]</code>,
                <code>[_products_with_qty_price]</code>
            </p>
            <table class="form-table" role="presentation">
                <tbody>
                    <tr>
                        <th scope="row">
                            <label for="admin_new_order_sms_template"><?php _e('New Order (admin)', 'sdevs_sms'); ?></label>
                        </th>
                        <td>
                            <textarea name="admin_new_order_sms_template" id="admin_new_order_sms_template" cols="50" rows="5" required><?php echo esc_html(get_option('admin_new_order_sms_template')); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="new_order_sms_template"><?php _e('New Order (customers)', 'sdevs_sms'); ?></label>
                        </th>
                        <td>
                            <textarea name="new_order_sms_template" id="new_order_sms_template" cols="50" rows="5" required><?php echo esc_html(get_option('new_order_sms_template')); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="order_pending_payment_status"><?php _e('Order Status (Pending payment)', 'sdevs_sms'); ?></label>
                        </th>
                        <td>
                            <textarea name="order_pending_payment_status" id="order_pending_payment_status" cols="50" rows="5" required><?php echo esc_html(get_option('order_pending_payment_template')); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="order_processing_status"><?php _e('Order Status (Processing)', 'sdevs_sms'); ?></label>
                        </th>
                        <td>
                            <textarea name="order_processing_status" id="order_processing_status" cols="50" rows="5" required><?php echo esc_html(get_option('order_processing_template')); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="order_on_hold_status"><?php _e('Order Status (On hold)', 'sdevs_sms'); ?></label>
                        </th>
                        <td>
                            <textarea name="order_on_hold_status" id="order_on_hold_status" cols="50" rows="5" required><?php echo esc_html(get_option('order_on_hold_template')); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="order_complete_status"><?php _e('Order Status (Completed)', 'sdevs_sms'); ?></label>
                        </th>
                        <td>
                            <textarea name="order_complete_status" id="order_complete_status" cols="50" rows="5" required><?php echo esc_html(get_option('order_complete_template')); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="order_cancell_status"><?php _e('Order Status (Cancelled)', 'sdevs_sms'); ?></label>
                        </th>
                        <td>
                            <textarea name="order_cancell_status" id="order_cancell_status" cols="50" rows="5" required><?php echo esc_html(get_option('order_cancell_template')); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="order_refund_status"><?php _e('Order Status (Refunded)', 'sdevs_sms'); ?></label>
                        </th>
                        <td>
                            <textarea name="order_refund_status" id="order_refund_status" cols="50" rows="5" required><?php echo esc_html(get_option('order_refund_template')); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="order_failed_status"><?php _e('Order Status (Failed)', 'sdevs_sms'); ?></label>
                        </th>
                        <td>
                            <textarea name="order_failed_status" id="order_failed_status" cols="50" rows="5" required><?php echo esc_html(get_option('order_failed_template')); ?></textarea>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php submit_button(); ?>
    </form>
</div>
