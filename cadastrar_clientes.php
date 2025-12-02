<?php
include ("conexao.php");

$sucesso = false;
$erro = false;

function limparTelefone($str){
    return preg_replace("/[^0-9]/","",$str);
}

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

            $sql_query = "INSERT INTO clientes (nome,email,telefone,data_nascimento,data_cadastro) VALUES ('$nome', '$email', '$telefone', 
            '$data_nascimento', NOW())";

            // envia os dados para o banco de dados
            $dados_enviados = $mysqli -> query($sql_query) or die($mysqli->error); 

            // a conexão chama o mysqli e podemos usar no formato orientado ou funcional
            if($dados_enviados){
                $sucesso = "Os dados foram enviado com sucesso!";
                unset($_POST); // limpa o formulário
                sleep(5);
                header("Location: lista_de_clientes.php");
                exit;
            } else{
                $sucesso = null;
                $erro = "dados não foram enviados!";
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
    <title> Cadastro de clientes </title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center" style="height: 100dvh;">
            <div class="d-block p-3 m-2 row" style="height: 400px; width: 400px;">
                <form method="POST" >
                <div class="form-row">
                    <div class="col">
                            <label for="nome">Nome: </label>
                            <br>
                            <input type="text" name="nome" value="<?php if(isset($_POST['nome'])) echo $nome;  // mantém o campo se já tiver sido digitado ?>" class="form-control">
                    </div>
                    <br>
                    <div class="col">
                            <label for="email">Email:</label>
                            <br>
                            <input type="text" name="email" value="<?php if(isset($_POST['email'])) echo $email;?>" class="form-control">
                    </div>
                    <br>
                    <div class="col">
                            <label for="data_nascimento"> Data de nascimento: </label>
                            <br>
                            <input type="text" name="data_nascimento" placeholder="XX/XX/XXXX" value="<?php if(isset($_POST['data_nascimento'])) echo $data_nascimento;?>" class="form-control">
                    </div>
                    <br>
                    <div class="col">
                        <label for="telefone"> Telefone: </label>
                        <br>
                        <input type="text" name="telefone" placeholder="(00) 00000-0000" value="<?php if(isset($_POST['telefone'])) echo $telefone ;?>" class="form-control">
                    </div>
                    <br>
                    <div class="col align-items-center justify-content-center d-flex">
                        <button class="btn btn-primary"  type="submit" >
                            Enviar dados
                        </button>
                    </div>
                </div>
                </form>
                <br>
                <?php if($erro) { ?>
                <div class="alert alert-danger">
                    <?php echo $erro; ?>
                </div>
                <?php }  ?>
                <?php if($sucesso) { ?>
                <div class="alert alert-success">
                    <?php echo $sucesso; ?>
                </div>
                <?php }  ?>
            </div>
            </div>
        </body>

</html>