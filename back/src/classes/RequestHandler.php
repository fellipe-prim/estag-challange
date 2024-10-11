<?php
require('classes/DatabaseConnection.php');
require('classes/Categories.php');
require('classes/Products.php');
// require('classes/Orders.php');
// require('classes/OrderItem.php');


$request_method = $_SERVER['REQUEST_METHOD'];  //  Returns the request method
if (isset($_SERVER['REDIRECT_URL'])) {
    $redirect_url = explode('/', $_SERVER['REDIRECT_URL']);

    $endpoint = $redirect_url[1];
    $item_id = $redirect_url[2] ?? null;
}

$request_info = [
    'METHOD' => $request_method,
    'ENDPOINT' => $endpoint ?? null,
    'ID_TO_CONSULT' => $item_id ?? null,
    'PARAMS' => $_REQUEST,
    'BODY' => json_decode(file_get_contents('php://input'), true) ?? null,
];

$name = $request_info['BODY']['name'] ?? null ;  //  Gets the name from the body, if it doesn't exists, will return null
$tax = $request_info['BODY']['tax'] ?? null;

$product_price = $request_info['BODY']['price'] ?? null;
$product_amount = $request_info['BODY']['amount'] ?? null;
$product_category_code = $request_info['BODY']['product_category_code'] ?? null;

if($endpoint == 'categories'){  //  Don't allow any operation run if the endpoint != 'categories'
    switch ($request_method) {
        case 'GET':
            Categories::get_categories();
            break;
    
        case 'POST':
            http_response_code(201);
            Categories::post_categories($name, $tax);
        break;
    
        case 'DELETE':
            Categories::delete_categories($item_id);
        break;
        
        default:
            http_response_code(405);
            echo json_encode([
                'status' => 405,
                'message' => 'Method not allowed'
            ]);
        break;
    }
} 


elseif ($endpoint=="products"){
    switch ($request_method) {
        case 'GET':
            Products::get_products();
            break;
    
        case 'POST':
            http_response_code(201);
            Products::post_products($name, $product_price, $product_amount, $product_category_code);
        break;
    
        case 'DELETE':
            Products::delete_products($item_id);
        break;
        
        default:
            http_response_code(405);
            echo json_encode([
                'status' => 405,
                'message' => 'Method not allowed',
            exit
            ]);
        break;
    }
}


// elseif($endpoint=){

// }


 else {
    echo "Invalid endpoint";
}



