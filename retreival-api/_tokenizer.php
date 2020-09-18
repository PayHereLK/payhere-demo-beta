<?php
function getAuthorizationToken()
{

    $url = 'https://sandbox.payhere.lk/merchant/v1/oauth/token';

    if (!empty($_REQUEST['app_id']) && !empty($_REQUEST['app_secret'])) {
        $_SESSION['app_id'] = $_REQUEST['app_id'];
        $_SESSION['app_secret'] = $_REQUEST['app_secret'];
        $bs64 = base64_encode($_REQUEST['app_id'] . ':' . $_REQUEST['app_secret']);
    } else {
        if (isset($_SESSION['app_id']) && isset($_SESSION['app_secret'])) {
            $bs64 = base64_encode($_SESSION['app_id'] . ':' . $_SESSION['app_secret']);
        } else {
            $bs64 = 'NE9WeDNIVUx1S1c0SjlMZzF2clJyZDNIQzo0OWFNb0Z3WjFqVThRamh6d3NkRERwNGVaRUNJVEE0ckg0Zlhub2RjbWpNag==';
        }
    }

    $headers = array(
        'Authorization: Basic ' . $bs64,
        'Content-Type: application/x-www-form-urlencoded'
    );
    $fields = array(
        'grant_type' => 'client_credentials',
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $head = curl_exec($ch);
    curl_close($ch);

    if ($head) {
        return $head;
    }
    return FALSE;
}