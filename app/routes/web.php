<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/controllers/ControllerConverter.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['value'])) {
    $response = ControllerConverter::moneyConverter($_POST['value']);
    echo json_encode($response);
}
