<?php
include_once '../common/_tokenizer.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $time = microtime(true);
    $_auth_token_data = getAuthorizationToken();
    if ($_auth_token_data) {
        $auth_token_data = json_decode($_auth_token_data);
        $charge_response = getSubscription($auth_token_data->access_token);

        echo json_encode(array("authorization_response" => $auth_token_data, 'subscription_payment_response' => json_decode($charge_response)));
    } else {
        echo json_encode(array("authorization_response" => 'Auth token retrieval failed.'));
    }
}


function getSubscription($token)
{
    $subscription_id = $_POST['subscription_id'];
    $url = API_BASE_URL . "subscription/$subscription_id/payments";

    $headers = array(
        'Authorization: Bearer ' . $token,
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $head = curl_exec($ch);
    curl_close($ch);

    if ($head) {
        return $head;
    }
    return FALSE;
}
