<?php
$custom2 = $_POST['custom_2'];
session_id( $custom2 );
session_start();
$_SESSION['customer_token'] = $_POST['customer_token'];
$_SESSION['post_values'] = serialize($_POST);

file_put_contents('./log_'.date("j.n.Y").'.log', [json_encode($_POST).''.PHP_EOL], FILE_APPEND);