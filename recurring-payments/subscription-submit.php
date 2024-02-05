<?php
include_once '../common/_tokenizer.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $_auth_token_data = getAuthorizationToken();
    if ($_auth_token_data) {

        $auth_token_data = json_decode($_auth_token_data);
        if (isset($auth_token_data->access_token) && !empty($auth_token_data->access_token)) {
            $charge_response = getSubscriptions($auth_token_data->access_token);
            echo json_encode(array('token' => $auth_token_data->access_token, "authorization_response" => $auth_token_data, 'all_subscription_response' => json_decode($charge_response)));
        } else {
            echo json_encode(array("authorization_response" => $auth_token_data));
        }
    }else{
        echo json_encode(array("authorization_response" => 'Auth token retrieval failed.'));
    }
}





function getSubscriptions($token)
{
    $url = API_BASE_URL . 'subscription';

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

    if (!$head) {
        return FALSE;
    } else {
        return $head;
    }
    return FALSE;
}
