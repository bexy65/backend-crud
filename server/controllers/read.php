<?php
require_once '../config/db.php';
require_once '../models/crud.php';

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $name = $_GET['name'];
    $db = new Database();
    $controller = new Task($db->getConnection());

    $product = $controller->getProduct($name);


    http_response_code($product ? 200 : 500);
    header('Content-Type: application/json');

    $response['message'] = $product ? 'Product' : 'No product found.';

    if ($product) {
        $response['product'] = $product;
    }

    return json_encode($response);
}
