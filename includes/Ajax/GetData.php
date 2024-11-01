<?php

namespace SpringDevs\SMS\Ajax;

/**
 * GetData Class
 */
class GetData
{

    /**
     * Initialize the class
     */
    public function __construct()
    {
        add_action('wp_ajax_sms_setup_form_data', [$this, 'get_setup_data']);
    }

    public function get_setup_data()
    {
        if (is_admin()) {
            $providers = [
                [
                    'name' => 'twilio',
                    'label' => __('Twilio', 'sdevs_sms')
                ],
                [
                    'name' => 'elitbuzz',
                    'label' => __('ElitBuzz', 'sdevs_sms')
                ],
            ];
            $fields = [
                'twilio' => [
                    'settings' => [
                        [
                            'name' => 'twilio_sid',
                            'label' => __('Account SID', 'sdevs_sms'),
                            'type' => 'text',
                            'value' => get_option('twilio_sid', null),
                            'placeholder' => null,
                            'required' => true,
                        ],
                        [
                            'name' => 'twilio_token',
                            'label' => __('Account Token', 'sdevs_sms'),
                            'type' => 'text',
                            'value' => get_option('twilio_token', null),
                            'placeholder' => null,
                            'required' => true,
                        ],
                    ],
                    'sending' => [
                        [
                            'name' => 'twilio_sending_phone',
                            'label' => __('Sender phone number', 'sdevs_sms'),
                            'type' => 'text',
                            'value' => get_option('twilio_sending_phone', null),
                            'placeholder' => null,
                            'required' => true,
                        ],
                        [
                            'name' => 'admin_phone_numbers',
                            'label' => __('Admin phone', 'sdevs_sms'),
                            'type' => 'text',
                            'value' => get_option('admin_phone_numbers', null),
                            'placeholder' => __('type multiple numbers with coma', 'sdevs_sms'),
                            'required' => true,
                        ],
                    ]
                ],
                'elitbuzz' => [
                    'settings' => [
                        [
                            'name' => 'elitbuzz_apikey',
                            'label' => __('API Key', 'sdevs_sms'),
                            'type' => 'text',
                            'value' => get_option('elitbuzz_apikey', null),
                            'placeholder' => null,
                            'required' => true,
                        ],
                    ],
                    'sending' => [
                        [
                            'name' => 'elitbuzz_sender_id',
                            'label' => __('Sender ID', 'sdevs_sms'),
                            'type' => 'text',
                            'value' => get_option('elitbuzz_sender_id', null),
                            'placeholder' => null,
                            'required' => true,
                        ],
                        [
                            'name' => 'admin_phone_numbers',
                            'label' => __('Admin phone', 'sdevs_sms'),
                            'type' => 'text',
                            'value' => get_option('admin_phone_numbers', null),
                            'placeholder' => __('type multiple numbers with coma', 'sdevs_sms'),
                            'required' => true,
                        ],
                    ],
                ]
            ];

            $setup_fields = [
                'provider' => $providers,
                'fields' => $fields,
                'sms_service' => get_option('sms_service', 'twilio')
            ];
            $setup_fields = apply_filters('sms_provider_fields', $setup_fields);
            wp_send_json($setup_fields);
        }
    }
}
