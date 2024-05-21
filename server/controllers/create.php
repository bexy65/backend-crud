<?php
require_once '../config/db.php';
require_once '../models/crud.php';


$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    $db = new Database();
    $controller = new Task($db->getConnection());

    $product = $controller->createProduct($name, $price, $category);


    http_response_code($product ? 200 : 500);
    header('Content-Type: application/json');


    if ($product) {
        $response['message'] = $product ? 'Created successfully!' : 'Error on creating an product!';
    }

    return json_encode($response);
}
