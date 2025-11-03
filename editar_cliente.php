<?php
include ("conexao.php");

function limparTelefone($str){
    return preg_replace("/[^0-9]/","",$str);
}

$erro = false;

$sucesso = false;

$id = intval($_GET["id"]); // função que vai pegar o id do cliente, e formata em número inteiro

$sql_clintes = "SELECT * FROM clientes WHERE id = '$id' ";

$query = $mysqli -> query($sql_clintes) or die($mysqli-> error);

$lista_de_clientes = $query -> fetch_assoc();

$lista_de_clientes['data_nascimento'] = formatar_data($lista_de_clientes['data_nascimento']);
$lista_de_clientes['telefone'] = formatar_telefone($lista_de_clientes['telefone']);

if(count($_POST) > 0){
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $data_nascimento = $_POST["data_nascimento"];
    $telefone = $_POST["telefone"];

    if(empty($nome)){
        $erro = "Insira um nome para continuar!"; // se entrar aqui vira verdadeiro
    }
    elseif(empty($email)){
        $erro = "Insira um e-mail para continuar!";
    }
    elseif(empty($data_nascimento)){ // dados obrigatórios
        $erro = "Insira a sua data de nascimento";
    }
    else{
        if(!empty($data_nascimento)){
            // explode, tira os '/', fica assim (21,10,2005)
            // array_reverse, reverte fica assim 2005,10,21
            // implode, junta os arrays com um separador, '2005-10-21'
            $temp = explode("/", $data_nascimento);
            if(count($temp) === 3){
            $formatar_americano = implode("-",array_reverse($temp));
            $data_nascimento = $formatar_americano; 
            }else{
                $erro = "A data de nascimento deve ser seguida, dia/mês/ano";
                $sucesso = null;
            }
        }
        if(!empty($telefone)){
            $telefone = limparTelefone($telefone);
        }elseif(strlen($telefone) != 11){
                    $erro = "digite o telefone, seguindo o padrão desejado, (00) 00000-0000";
                    $sucesso = null;
                    }
        
        if(!empty($email)){
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                $email = $email;
            }else{
                $erro = "o e-mail -> $email não é valido";
                $sucesso = null;
            }
        }
        if($erro){
        }else{ // caso seja diferente de erro, vai entrar no bloco de código

            $sql_query = "UPDATE clientes SET nome = '$nome', telefone = '$telefone', email = '$email', data_nascimento = '$data_nascimento' 
            WHERE id = '$id' ";
            
            $dados_atualizados = $mysqli -> query($sql_query) or die($mysqli->error); 
            // a conexão chama o mysqli e podemos usar no formato orientado ou funcional
            if($dados_atualizados){
                $sucesso = "Os dados foram atualizados com sucesso!";
                unset($_POST); // limpa o formulário
            } else{
                $sucesso = null;
                $erro = "dados não foram atualizado!";
            }

        }
    }
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
        <div class="d-block p-3 m-2 " style="height:400px; width:400px;">
            <form method="POST" class="form-row">
                <label for="nome">Nome: </label>
                <br>
                <input type="text" value="<?php echo $lista_de_clientes['nome'];?>" class="form-control" name="nome">
                <br>
                <div class="col">
                <label for="email">Email: </label>
                <br>
                <input class="form-control"type="text" value="<?php echo $lista_de_clientes['email'];?>" name="email" >
                </div>
                <br>
                <div class="col">
                <label for="data_nascimento">Data de nascimento: </label>
                <br>
                <input class="form-control" type="text" value="<?php echo $lista_de_clientes['data_nascimento'];?>" name="data_nascimento">
                </div>
                <br>
                <div class="col">
                <label for="telefone">Telefone: </label>
                <input class="form-control" type="text" value="<?php echo $lista_de_clientes['telefone'];?>" name="telefone">
                </div>
                <br>
                <div class="col align-items-center justify-content-center d-flex">
                <button class="btn btn-primary" onclick="atualizar_Pagina()" type="submit"> Atualizar dados</button>
                </div>      
            </form>
            <br>
                <?php if($erro) { ?>
                <div class="alert alert-danger">
                    <?php echo $erro;?>
                </div>
                <?php }  ?>
                <?php if($sucesso) { ?>
                <div class="alert alert-success">
                    <?php echo $sucesso;?>
                </div>
                <?php }  ?>
        </div>
        <script>
            function atualizar_Pagina(){
                setTimeout(()=>{
                window.location.reload()
                }, 5000);
            }
        </script>
</body>
</html>