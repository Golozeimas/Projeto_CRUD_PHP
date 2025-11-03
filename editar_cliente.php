<?php
include ("conexao.php");

$id = intval($_GET["id"]); // função que vai pegar o id do cliente, e formata em número inteiro

$sql_clintes = "SELECT * FROM clientes WHERE id = '$id'";

$query = $mysqli -> query($sql_clintes) or die($mysqli-> error);

if(count($_POST) > 0){
    $nome = $_POST["nome"];
    $email = $_POST["email"];

    $query_para_dar_update = "UPDATE clientes SET nome = $nome, email = $email  WHERE id='$id' ";

    $update_do_cliente = $mysqli -> query($query_para_dar_update) or die($mysqli -> error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Editar clientes </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="justify-content-center d-flex align-items-center" style="height:100dvh;">
        <div class="d-block border p-3 m-2 " style="height:400px; width:400px;">
            <form method="POST" class="form-row">
                <label for="nome">A</label>
                <br>
                <input type="text" class="form-control" name="nome">
                <br>
                <div class="col">
                <label for="email">B</label>
                <br>
                <input class="form-control"type="text" name="email" >
                </div>
                <br>
                <div class="col">
                <label for="data_nascimento">C</label>
                <br>
                <input class="form-control" type="text" name="data_nascimento">
                </div>
                <br>
                <div class="col">
                <label for="telefone">D</label>
                <input class="form-control" type="text" name="telefone">
                </div>
                <br>
                <div class="col align-items-center justify-content-center d-flex">
                <button class="btn btn-primary" type="submit"> Atualizar dados</button>
                </div>      
            </form>
        </div>
</body>
</html>