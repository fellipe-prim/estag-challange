<?php

//Underscores for variables and functions, 
//camelCase for Methods, 
//and PascalCase for Classes, as stated in this PHP documentation page (userlandnaming.rules)
// There is this RFC: wiki.php.net/rfc/class-naming-acronyms – 

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

date_default_timezone_set('America/Sao_Paulo');

// require('classes/DatabaseConnection.php');
require('classes/RequestHandler.php');

// exemplo de fetch
// $statement1 = $myPDO->query("SELECT * FROM categories");
// $data = $statement1->fetch();


