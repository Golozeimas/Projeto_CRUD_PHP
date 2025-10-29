<?php
include ("conexao.php");

$query_para_ler_as_linhas ="SELECT * FROM clientes"; // seleciono todas as colunas da tabela "clientes"

$query_clientes = $mysqli -> query($query_para_ler_as_linhas) or die ($mysqli -> error); // é basicamente a query

$numero_de_clientes = $query_clientes -> num_rows; // retorna quantas linhas tem nessa query

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <a href="cadastrar_clientes.php" class="link-dark text-decoration-none m-2 text-white btn btn-primary rounded"> Voltar</a>
    <br>
    <div class="container bg-success text-white p-4 rounded rounded-4 align-items-center justify-content-center d-flex">
        <h1>Lista de clientes cadastrados</h1>
    </div>
    <br>
    <div class="container">
    <table class="table table-striped table-bordered">
        <thead class="align-items-center">
            <th class="text-success">
                ID
            </th>

            <th class="text-success">
                Nome
            </th>

            <th class="text-success">
                E-mail
            </th>

            <th class="text-success">
                Telefone
            </th>

            <th class="text-success">
                Nascimento
            </th>

            <th class="text-success">
                Data
            </th>
            <th class="text-success">
                Editar e deletar
            </th>
        </thead>

        <tbody>
            <?php if($numero_de_clientes == 0 ){?>
            <tr>
            <td colspan="7"> Nenhum cliente cadastrado </td>
            </tr>
            <?php } else {
                while($cliente = $query_clientes -> fetch_assoc()){
                    if(!empty($cliente["telefone"])){
                        $ddd = substr($cliente["telefone"], 0, 2);
                        $parte1 = substr($cliente["telefone"],2 , 6 );
                        $parte2 = substr($cliente["telefone"], 7);
                        $telefone = "($ddd) $parte1-$parte2";
                    }else{
                        $telefone = "não foi informado o telefone";
                    }
                    
                    if(!empty($cliente["data_nascimento"])){
                        $arrays = explode("-",$cliente["data_nascimento"]);
                        $pos_explode = array_reverse($arrays);
                        $data_nascimento = implode("/", $pos_explode);
                    }else{
                        $data_nascimento = "ocorreu algum erro, verifique novamente";
                    }
                    $data_cadastro = date("d/m/y H:i:s",strtotime($cliente["data_cadastro"]));
            ?>
            <tr>
            <td><?php echo $cliente["id"]?></td>
            <td><?php echo $cliente["nome"]?></td>
            <td><?php echo $cliente["email"]?></td>
            <td><?php echo $telefone?></td>
            <td><?php echo $data_nascimento?></td>
            <td><?php echo $data_cadastro?></td>
            <td>
                <a class="link-primary text-decoration-none"  href="editar_cliente.php?=<?php echo $cliente["id"]?>">Editar</a>
                <span> | </span>
                <a class="link-danger text-decoration-none" href="deletar_cliente.php?=<?php echo $cliente["id"]?>">Deletar </a>
            </td>
            </tr>
            <?php } 
            }
            ?>
        </tbody>
    </table>
    </div>
</body>
</html>