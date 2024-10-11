
<?php 
require('classes/DatabaseConnection.php');

class Categories {
    public static function post_categories(string $name, float $tax) {
        //  Declaring $myPDO as global inside the function will make every
        //  $myPDO var reference refer to it's global version
        
        //  Imports the myPDO var from the DatabaseConnection.php file, and 
        //  makes a connection with the database
        global $myPDO;    

        $sql  = "INSERT INTO categories (name, tax) VALUES ('$name', $tax)";
        $query = $myPDO->prepare($sql);  //  Prepares the execution of the query
        $query->execute();  //  Executes the query

        $request_body_data = [
            'code' => $myPDO->lastInsertId(),
            'name' => $name,
            'tax' => $tax
        ];
        //  Returns a string containing the JSON representation of the supplied value. 
        //  If the parameter is an array or object, it will be serialized recursively.
        echo json_encode($request_body_data, JSON_NUMERIC_CHECK);  
    }


    public static function get_categories() {
        //  Declaring $myPDO as global inside the function will make every
        //  $myPDO var reference refer to it's global version

        //  Imports the myPDO var from the DatabaseConnection.php file, and 
        //  makes a connection with the database
        global $myPDO;  

        $sql  = "SELECT * FROM categories";
        $query = $myPDO->query($sql);  //  Prepares and executes an SQL statement without placeholders
        $query_return = $query->fetchAll(PDO::FETCH_ASSOC); 

        echo json_encode($query_return, JSON_NUMERIC_CHECK);
    }
    

    public static function delete_categories(int $category_id){
        //  Declaring $myPDO as global inside the function will make every
        //  $myPDO var reference refer to it's global version
        
        //  Imports the myPDO var from the DatabaseConnection.php file, and 
        //  makes a connection with the database
        global $myPDO;

        $sql = "DELETE FROM categories WHERE code = $category_id";
        $query = $myPDO->prepare($sql);  //  Prepares the execution of the query
        $query->execute();  //  Executes the query

        echo json_encode('The category has been removed. ', JSON_NUMERIC_CHECK);
    }
}
//  The Scope Resolution Operator :: is a token that allows access to
//  a constant, static property, or static method of a class or one of
//  its parents
