<?php

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');

require_once '../models/Product.php';

require_once '../utils/parse.php';

$method = $_SERVER['REQUEST_METHOD'];

$productModel = new Product();

switch($method) {
    case 'GET': {
        if(strlen($_REQUEST['id']) > 0) echo json_encode($productModel->show((int)$_REQUEST['id']));
        else echo json_encode($productModel->index());

        break;
    }
    case 'POST': {
        $body = parseBody(file_get_contents('php://input'));

        if(
            is_null($body['idCategory']) ||
            is_null($body['idBrand']) ||
            is_null($body['idProduct']) ||
            is_null($body['description']) ||
            is_null($body['stock']) ||
            is_null($body['name']) ||
            is_null($body['amount']) 
        ) header("HTTP/1.0 404 Not Found");
        else echo json_encode($productModel->add($body));

        break;
    }
    case 'PUT': {
        $body = parseBody(file_get_contents('php://input'));

        if(
            strlen($_REQUEST['id']) <= 0 ||
            is_null($body['idCategory']) ||
            is_null($body['idBrand']) ||
            is_null($body['idProduct']) ||
            is_null($body['description']) ||
            is_null($body['stock']) ||
            is_null($body['name']) ||
            is_null($body['amount']) 
        ) header("HTTP/1.0 404 Not Found");
        else echo json_encode($productModel->update((int)$_REQUEST['id'], $body));

        break;
    }
    case 'DELETE': {
        if(strlen($_REQUEST['id']) > 0) echo json_encode($productModel->remove((int)$_REQUEST['id']));
        else header("HTTP/1.0 404 Not Found");
        
        break;
    }
    default: {
        header("HTTP/1.0 404 Not Found");

        break;
    }
}
