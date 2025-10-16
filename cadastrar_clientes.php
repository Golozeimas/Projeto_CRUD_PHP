<?php

$sucesso = false;
$erro = false;
$nome = $_POST["nome"];
$email = $_POST["email"];
$data_nascimento = $_POST["data_nascimento"];
$telefone = $_POST["telefone"];

function limparTelefone($str){
    return preg_replace("/[^0-9]/","",$str);
}


if(isset($_POST)){

    if(empty($nome)){
        $erro = "Insira um nome para continuar!"; // se entrar aqui vira verdadeiro
    }
    
    if(empty($email)){
        $erro = "Insira um e-mail para continuar!";
    }
    if(empty($data_nascimento)){ // dados obrigatórios
        $erro = "Insira a sua data de nascimento";
    }
    if($erro){ // vai se tornar verdadeiro, se entrar em alguns dos blocos acima
        // echo "<p><b>ERRO:$erro</b></p>";
    } else{
        $sucesso = "Os dados foram enviado com sucesso!";
        if(!empty($data_nascimento)){
            $temp = explode("/", $data_nascimento);
            if(count($temp) == 3){
            // explode, tira os '/', fica assim (21,10,2005)
            // array_reverse, reverte fica assim 2005,10,21
            // implode, junta os arrays com um separador, '2005-10-21'
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
            <div class="d-block p-3 m-2 row" style="height: 400px; width: 300px;">
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
                            <input type="text"placeholder="(dia/mês/ano)" name="data_nascimento" class="form-control" >
                    </div>
                    <br>
                    <div class="col">
                        <label for=""> Telefone: </label>
                        <br>
                        <input type="text" name="telefone" placeholder="(99) 91111-1111" class="form-control">
                    </div>
                    <br>
                    <?php if ($erro) { ?>
                    <div class="alert alert-danger">
                        <?php echo $erro ?>
                    </div>
                    <?php } ?>
                    <?php if($sucesso) {?>
                        <div class="alert alert-success">
                        <?php echo $sucesso?>
                    </div>
                    <?php }?>
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