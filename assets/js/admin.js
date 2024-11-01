jQuery(document).ready(function ($) {
    if ($('input[name=user_sms_notification]:checked').val() == 'ask_checkout') {
        $(".checkout-customer-fields").show();
    } else {
        $(".checkout-customer-fields").hide();
    }
    $('input[name=user_sms_notification]').change(() => {
        if ($('input[name=user_sms_notification]:checked').val() == 'ask_checkout') {
            $(".checkout-customer-fields").show();
        } else {
            $(".checkout-customer-fields").hide();
        }
    });
});