<?php
include "conexao.php";

$id_cliente = intval($_GET["id"]);

$query_escrita = "DELETE FROM clientes WHERE id=$id_cliente";

// poderia apenas escrever lá dentro da função query(), 
// mas não é tão versátil e vísivel
$query_para_deletar = $mysqli -> query($query_escrita) or die($mysqli -> error);

if($query_para_deletar){
    sleep(3);
    header("Location: lista_de_clientes.php");
}

?>