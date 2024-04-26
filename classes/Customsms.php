<?php

class Customsms {
    private $_CI;
    var $AUTH_KEY = "YTAzOTRlMDAzZjcyN2ViMElELTY4YmI2MDQzNWUxZTRmYTBhMDRlZWM1NjczZjNjYzhi"; 
    var $url = "https://bulkdev.swifttdial.com:2778/api/outbox/create"; 
    
    // function __construct() {
    //     $this->_CI =& get_instance();
    //     $this->session_name = $this->_CI->setting_model->getCurrentSessionName();
    // }

    function sendSMS($to, $message) {
        $apiKey = $this->AUTH_KEY;
        $url = $this->url;

        if (!preg_match('/^254/', $to)) {
            $to = '254' . ltrim($to, '0');
        }

        $bodyRequest = array(
            "profile_code" => "2311282",
            "messages" => array(
                array(
                    "recipient" => $to,
                    "message" => $message,
                    "message_type" => 1,
                    "req_type" => 1,
                    "external_id" => "external_id"
                )
            ),
            "dlr_callback_url" => "https://posthere.io/"
        );
        $payload = json_encode($bodyRequest);
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 15,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'x-api-key: ' . $apiKey
            ),
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
        
    }
}
?>
