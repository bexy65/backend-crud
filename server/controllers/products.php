<?php
require_once '../config/db.php';
require_once '../models/crud.php';

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $db = new Database();
    $controller = new Task($db->getConnection());

    $product = $controller->getProducts();


    http_response_code($product ? 200 : 500);
    header('Content-Type: application/json');
    // header('Access-Control-Allow-Origin: *');

    $response['message'] = $product ? 'Product' : 'No product found.';

    if ($product) {
        $response['products'] = $product;
    }

    echo json_encode($response);
}
