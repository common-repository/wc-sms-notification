<?php

namespace SpringDevs\SMS\Illuminate;

/**
 * Class Providers
 * @package SpringDevs\SMS\Illuminate
 */
class Providers
{
    public function __construct()
    {
        add_action('sdevs_send_sms_twilio', [$this, 'send_sms_twilio'], 10, 2);
        add_action('sdevs_send_sms_elitbuzz', [$this, 'send_sms_elitbuzz'], 10, 2);
    }

    public function send_sms_elitbuzz($phone_number, $content)
    {
        $url = "https://880sms.com/smsapi";
        $data = [
            "api_key" => get_option("elitbuzz_apikey", null),
            "type" => "text/unicode",
            "contacts" => $phone_number,
            "senderid" => get_option("elitbuzz_sender_id", null),
            "msg" => $content,
        ];

//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_POST, 1);
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//        $response = curl_exec($ch);
//        curl_close($ch);

        $response = wp_remote_post($url, $data);
        return wp_remote_retrieve_body($response);
    }

    public function send_sms_twilio($phone_number, $content)
    {
        $sid = get_option("twilio_sid");
        $token = get_option("twilio_token");

        $url = 'https://api.twilio.com/2010-04-01/Accounts/' . $sid . '/Messages.json';
        $myvars = 'To=' . $phone_number . '&Body=' . $content . '&From=' . get_option("twilio_sending_phone_number");

//        $ch = curl_init($url);
//        curl_setopt($ch, CURLOPT_POST, 1);
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $myvars);
//        curl_setopt($ch, CURLOPT_USERPWD, $sid . ':' . $token);
//        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
//        curl_setopt($ch, CURLOPT_HEADER, 0);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        $response = curl_exec($ch);
//        $response = json_decode($response);

        $response = wp_remote_get($url);
        return wp_remote_retrieve_body($response);
    }
}
