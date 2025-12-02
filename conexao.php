<?php
$user = "root";
$password ="123456";
$host = "localhost";
$db = "crud_clientes";

$mysqli = new mysqli($host, $user, $password, $db);

if($mysqli -> connect_errno){
    echo "número do erro: (". $mysqli -> connect_errno.")".  $mysqli -> connect_error;
    die();
}

function formatar_data($data_nascimento){
    return $data_nascimento =  implode("/",array_reverse(explode("-",$data_nascimento)));
}

function formatar_telefone($telefone){
    $ddd = substr($telefone, 0, 2);
    $parte1 = substr($telefone,2 , 6 );
    $parte2 = substr($telefone, 7);
    return $telefone = "($ddd) $parte1-$parte2";
}
?>