<?php

require 'class.facebook.php';

header('Content-Type: application/json');

if (isset($_REQUEST['access_token'], $_REQUEST['active']) && $_REQUEST['access_token'] != '') {
    $fb = new Facebook;
    $fb->access_token = $_REQUEST['access_token'];
    $fb->is_shielded = filter_var($_REQUEST['active'], FILTER_VALIDATE_BOOLEAN) ? 'true' : 'false';
    $result = $fb->requestShield();
    if ($result['success']) {
        $status = $result['is_shielded'] ? 'turn on' : 'Turn off';
        echo json_encode(['type' => 'success', 'title' => 'Success', 'message' => 'Done ' . $status . ' Image protection.'], JSON_PRETTY_PRINT);
    } else {
        echo json_encode(['type' => 'error', 'title' => 'Error', 'message' => 'Please enter Access token.'], JSON_PRETTY_PRINT);
    }
} else {
    echo json_encode(['type' => 'error', 'title' => 'Error', 'message' => 'Please enter Access token.'], JSON_PRETTY_PRINT);
}