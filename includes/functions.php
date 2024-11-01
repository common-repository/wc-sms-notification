<?php

function sdevs_send_sms($phone_number, $content)
{
    $provider = get_option("sms_service", "twilio");
    do_action("sdevs_send_sms_" . $provider, $phone_number, $content);
}
