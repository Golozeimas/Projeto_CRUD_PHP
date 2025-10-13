<?php
$user = "root";
$password = "";
$host = "localhost";
$db = "crud_clientes";

$mysqli = new mysqli($host,$user, $password,$db);

if($mysqli -> connect_errno){
    echo "número do erro: (". $mysqli -> connect_errno.")".  $mysqli -> connect_error;
    die();
}
?>