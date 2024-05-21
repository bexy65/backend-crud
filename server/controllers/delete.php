<?php
require_once '../config/db.php';
require_once '../models/crud.php';

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];

    $db = new Database();
    $controller = new Task($db->getConnection());

    $product = $controller->deleteProduct($name);

    http_response_code($product ? 200 : 500);
    header('Content-Type: application/json');

    $response['message'] = $product ? 'Product deleted successfully.' : 'Failed to delete product.';

    if ($product) {
        $response['product'] = $product;
    }

    return json_encode($response);
}
