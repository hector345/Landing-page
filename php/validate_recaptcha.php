<?php

function validateRecaptcha($recaptchaResponse) {
    $secretKey = $_ENV['RECAPTCHA_SECRET'];
    $url = $_ENV['RECAPTCHA_URL'];
    $data = [
        'secret' => $secretKey,
        'response' => $recaptchaResponse
    ];

    $options = [
        'http' => [
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        ]
    ];

    $context  = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    $result = json_decode($response);

    return $result->success;
}
?>
