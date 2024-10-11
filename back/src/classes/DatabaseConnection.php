
<?php

$HOSTNAME = "pgsql_desafio";
$DATABASE = "applicationphp";
$USER = "root";
$PASSWORD = "root";

$myPDO = new PDO("pgsql:host=$HOSTNAME;dbname=$DATABASE", $USER, $PASSWORD);

if (!$myPDO){
    echo "Unable to connect. ";
}
