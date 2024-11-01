<?php

namespace SpringDevs\SMS\Illuminate;

/**
 * Class Template
 * @package SpringDevs\SMS\Illuminate
 */
class Template
{
    public static function filter_content($content, $order_id)
    {
        $order = wc_get_order($order_id);
        preg_match_all("/\[([^\]]*)\]/", $content, $matches);
        $matches = $matches[1];

        foreach ($matches as $match) {
            if ("_order_id" === $match) {
                $content = str_replace('[' . $match . ']', $order_id, $content);
            } elseif ("_order_status" === $match) {
                $content = str_replace('[' . $match . ']', $order->get_status(), $content);
            } elseif ("_billing_format_address" === $match) {
                $content = str_replace('[' . $match . ']', $order->get_formatted_billing_address(), $content);
            } elseif ("_shipping_format_address" === $match) {
                $content = str_replace('[' . $match . ']', $order->get_formatted_shipping_address(), $content);
            } elseif ("_billing_format_name" === $match) {
                $content = str_replace('[' . $match . ']', $order->get_formatted_billing_full_name(), $content);
            } elseif ("_site_title" === $match) {
                $content = str_replace('[' . $match . ']', get_bloginfo('name'), $content);
            } elseif ("_site_url" === $match) {
                $content = str_replace('[' . $match . ']', network_site_url('/'), $content);
            } elseif ("_shipping_method" === $match) {
                $content = str_replace('[' . $match . ']', $order->get_shipping_method(), $content);
            } elseif ("_order_total" === $match) {
                $content = str_replace('[' . $match . ']', $order->get_formatted_order_total(), $content);
            } elseif ("_order_date" === $match) {
                $content = str_replace('[' . $match . ']', $order->get_date_created(), $content);
            } elseif ("_products_with_price" === $match) {
                $items_with_price = "";
                foreach ($order->get_items() as $order_item) {
                    $items_with_price .= $order_item->get_name() . " (" . get_woocommerce_currency() . $order->get_item_total($order_item) . "), ";
                }
                $content = str_replace('[' . $match . ']', $items_with_price, $content);
            } elseif ("_products_with_qty_price" === $match) {
                $items_with_price = "";
                foreach ($order->get_items() as $order_item) {
                    $items_with_price .= $order_item->get_name() . " (Qty-" . $order_item->get_quantity() . ', ' . get_woocommerce_currency() . $order->get_item_total($order_item) . "), ";
                }
                $content = str_replace('[' . $match . ']', $items_with_price, $content);
            }
        }
        return $content;
    }
}
