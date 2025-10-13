<?php
include "conexao.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Cadastro de clientes </title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center" style="height: 100dvh;">
            <div class="d-block p-3 m-2 row border border-danger" style="height: 400px; width: 300px;">
                <form method="POST">
                <div class="form-row">
                    <div class="col">
                            <label for="nome">Nome: </label>
                            <br>
                            <input type="text" name="nome" class="form-control">
                    </div>
                     <br>
                    <div class="col">
                            <label for="email">Email:</label>
                            <br>
                            <input type="text" name="email" class="form-control">
                    </div>
                    <br>
                    <div class="col">
                            <label for="">Data de nascimento:</label>
                            <br>
                            <input type="date" name="data_nascimento" class="form-control">
                    </div>
                    <br>
                    <div class="col">
                        <label for=""> Telefone: </label>
                        <br>
                        <input type="text" name="telefone" class="form-control">
                    </div>
                    <br>
                    <div class="col align-items-center justify-content-center d-flex">
                        <button class="btn btn-primary" type="submit">
                            Enviar dados
                        </button>
                    </div>
                </div>
                </form>
            </div>
        </body>

</html>