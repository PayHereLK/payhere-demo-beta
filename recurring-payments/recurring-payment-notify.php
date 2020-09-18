<?php
$custom2 = $_POST['custom_2'];
session_id($custom2);
session_start();

if (isset($_SESSION['post_values'])) {
    $_prev_data = $_SESSION['post_values'];
    $_SESSION['post_values'] = array_merge($_prev_data, [array('time' => time(), 'data' => serialize($_POST))]);
} else {
    $_SESSION['post_values'] = [array('time' => time(), 'data' => serialize($_POST))];
}


file_put_contents('./log_' . date("j.n.Y") . '.log', [json_encode($_POST) . '' . PHP_EOL], FILE_APPEND);