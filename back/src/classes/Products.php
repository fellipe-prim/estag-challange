
<?php 
require('classes/DatabaseConnection.php');

class Products {
    public static function post_products(string $product_name, float $product_price, int $product_amount, int $product_category_code) {
        //  Declaring $myPDO as global inside the function will make every
        //  $myPDO var reference refer to it's global version
        
        //  Imports the myPDO var from the DatabaseConnection.php file, and 
        //  makes a connection with the database
        global $myPDO;    

        $sql  = "INSERT INTO products (name, price, amount, category_code) 
        VALUES ('$product_name', $product_price, $product_amount, $product_category_code)";
        $query = $myPDO->prepare($sql);  //  Prepares the execution of the sql query
        $query->execute();  //  Executes the query

        $request_body_data = [
            'code' => $myPDO->lastInsertId(),
            'name' => $product_name,
            'price' => $product_price,
            'amount' => $product_amount,
            'product_category_code' => $product_category_code
        ];
        //  Returns a string containing the JSON representation of the supplied value. 
        //  If the parameter is an array or object, it will be serialized recursively.
        echo json_encode($request_body_data, JSON_NUMERIC_CHECK);  
    }


    public static function get_products() {
        //  Declaring $myPDO as global inside the function will make every
        //  $myPDO var reference refer to it's global version

        //  Imports the myPDO var from the DatabaseConnection.php file, and 
        //  makes a connection with the database
        global $myPDO;  

        $sql  = "SELECT * FROM products";
        $query = $myPDO->query($sql);  //  Prepares and executes an SQL statement without placeholders
        $query_return = $query->fetchAll(PDO::FETCH_ASSOC); 

        echo json_encode($query_return, JSON_NUMERIC_CHECK);
    }
    

    public static function delete_products(int $product_id){
        //  Declaring $myPDO as global inside the function will make every
        //  $myPDO var reference refer to it's global version
        
        //  Imports the myPDO var from the DatabaseConnection.php file, and 
        //  makes a connection with the database
        global $myPDO;

        $sql = "DELETE FROM products WHERE code = $product_id";
        $query = $myPDO->prepare($sql);  //  Prepares the execution of the query
        $query->execute();  //  Executes the query

        echo json_encode('The product has been removed. ', JSON_NUMERIC_CHECK);
    }
}
//  The Scope Resolution Operator :: is a token that allows access to
//  a constant, static property, or static method of a class or one of
//  its parents
