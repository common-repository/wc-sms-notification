<div class="wrap">
    <h2><?php esc_attr_e('SMS Settings', 'sdevs_sms'); ?></h2>
    <?php include_once 'navs.php'; ?>
    <form method="POST">
        <?php wp_nonce_field('sdevs-sms-woocommerce-formnonce'); ?>
        <div class="card" style="max-width: 100%;">
            <h2 class="title"><?php _e('WOOCOMMERCE SETTINGS', 'sdevs_sms') ?></h2>
            <table class="form-table" role="presentation">
                <tbody>
                    <tr>
                        <th scope="row">
                            <label><?php _e('Send SMS notifications to customers', 'sdevs_sms'); ?></label>
                        </th>
                        <td>
                            <fieldset>
                                <label>
                                    <input type="radio" name="user_sms_notification" value="all" class="regular-text" <?php if ("all" === get_option("user_sms_notification", "all")) echo "checked"; ?> /> <?php _e('All customers', 'sdevs_sms'); ?>
                                </label>
                                <br>
                                <label>
                                    <input type="radio" name="user_sms_notification" value="ask_checkout" class="regular-text" <?php if ("ask_checkout" === get_option("user_sms_notification", "all")) echo "checked"; ?> /> <?php _e('Only customers who ask for it in checkout', 'sdevs_sms'); ?>
                                </label>
                            </fieldset>
                        </td>
                    </tr>
                    <tr class="checkout-customer-fields">
                        <th scope="row">
                            <label for="checkout_field_default_selected"><?php _e('Selected', 'sdevs_sms') ?></label>
                        </th>
                        <td>
                            <label>
                                <input type="checkbox" name="checkout_field_default_selected" id="checkout_field_default_selected" value="yes" class="regular-text" <?php if ("yes" === get_option("checkout_field_default_selected", "no")) echo "checked"; ?> />
                                <?php _e('Show checkbox selected by default', 'sdevs_sms'); ?>
                            </label>
                        </td>
                    </tr>
                    <tr class="checkout-customer-fields">
                        <th scope="row">
                            <label for="checkout_checkbox_field_txt"><?php _e('Checkbox text', 'sdevs_sms'); ?></label>
                        </th>
                        <td>
                            <textarea name="checkout_checkbox_field_txt" name="checkout_checkbox_field_txt" id="checkout_checkbox_field_txt" cols="50" rows="5"><?php echo esc_html(get_option("checkout_checkbox_field_txt", __('I want to be notified about any changes in the order via SMS', 'sdevs_sms'))); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label><?php _e('SMS notifications for new order', 'sdevs_sms'); ?></label>
                        </th>
                        <td>
                            <fieldset>
                                <label>
                                    <input type="checkbox" name="new_order_sms_notification[]" value="customers" class="regular-text" <?php if (in_array("customers", get_option("new_order_sms_notification", []))) echo "checked"; ?> />
                                    <?php _e('Enable new order notification [ customers ]', 'sdevs_sms'); ?>
                                </label>
                            </fieldset>
                            <fieldset>
                                <label>
                                    <input type="checkbox" name="new_order_sms_notification[]" value="admin" class="regular-text" <?php if (in_array("admin", get_option("new_order_sms_notification", []))) echo "checked"; ?> />
                                    <?php _e('Enable new order notification [Admin]', 'sdevs_sms'); ?>
                                </label>
                            </fieldset>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label><?php _e('SMS notifications for the following order status changes', 'sdevs_sms'); ?></label>
                        </th>
                        <td>
                            <fieldset>
                                <label>
                                    <input type="checkbox" name="sms_order_status_notifications[]" value="pending_payment" class="regular-text" <?php if (in_array("pending_payment", get_option("sms_order_status_notifications", []))) echo "checked"; ?> />
                                    <?php _e('Pending payment', 'sdevs_sms'); ?>
                                </label><br>
                                <label>
                                    <input type="checkbox" name="sms_order_status_notifications[]" value="processing" class="regular-text" <?php if (in_array("processing", get_option("sms_order_status_notifications", []))) echo "checked"; ?> />
                                    <?php _e('Processing', 'sdevs_sms'); ?>
                                </label><br>
                                <label>
                                    <input type="checkbox" name="sms_order_status_notifications[]" value="on_hold" class="regular-text" <?php if (in_array("on_hold", get_option("sms_order_status_notifications", []))) echo "checked"; ?> />
                                    <?php _e('On hold', 'sdevs_sms'); ?>
                                </label><br>
                                <label>
                                    <input type="checkbox" name="sms_order_status_notifications[]" value="completed" class="regular-text" <?php if (in_array("completed", get_option("sms_order_status_notifications", []))) echo "checked"; ?> />
                                    <?php _e('Completed', 'sdevs_sms'); ?>
                                </label><br>
                                <label>
                                    <input type="checkbox" name="sms_order_status_notifications[]" value="cancelled" class="regular-text" <?php if (in_array("cancelled", get_option("sms_order_status_notifications", []))) echo "checked"; ?> />
                                    <?php _e('Cancelled', 'sdevs_sms'); ?>
                                </label><br>
                                <label>
                                    <input type="checkbox" name="sms_order_status_notifications[]" value="refunded" class="regular-text" <?php if (in_array("refunded", get_option("sms_order_status_notifications", []))) echo "checked"; ?> />
                                    <?php _e('Refunded', 'sdevs_sms'); ?>
                                </label><br>
                                <label>
                                    <input type="checkbox" name="sms_order_status_notifications[]" value="failed" class="regular-text" <?php if (in_array("failed", get_option("sms_order_status_notifications", []))) echo "checked"; ?> />
                                    <?php _e('Failed', 'sdevs_sms'); ?>
                                </label><br>
                            </fieldset>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php submit_button(); ?>
    </form>

</div>
