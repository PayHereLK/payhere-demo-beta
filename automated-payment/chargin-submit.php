<?php
include_once '../common/_tokenizer.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $time = microtime(true);
    $_auth_token_data = getAuthorizationToken();
    $auth_token_data = json_decode($_auth_token_data);

    if (isset($auth_token_data->access_token) && !empty($auth_token_data->access_token)) {
        $charge_response = submitCharge($auth_token_data->access_token);
        echo json_encode(array('token' => $auth_token_data->access_token, "authorization_response" => $auth_token_data, 'charging_submit_response' => json_decode($charge_response)));
    } else {
        echo json_encode(array("authorization_response" => $auth_token_data));
    }
}


function submitCharge($token)
{
    $url = API_BASE_URL . 'payment/charge';

    $headers = array(
        'Authorization: Bearer ' . $token,
        'Content-Type: application/json'
    );
    $fields = array(
        'order_id' => 'Order' . $_POST['order_id'] != '' ? $_POST['order_id'] : rand(10000, 99999),
        'items' => $_POST['items'] != '' ? $_POST['items'] : 'Taxi Hire 123',
        'currency' => $_POST['currency'],
        'amount' => doubleval($_POST['amount']) > 0 ? $_POST['amount'] : 100,
        'customer_token' => $_POST['customer_token'],
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, (json_encode($fields)));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $head = curl_exec($ch);
    curl_close($ch);

    if (!$head) {
        return FALSE;
    } else {
        return $head;
    }
    return FALSE;
}
