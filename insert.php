<?php

require_once('db_connect.php');

session_start();

if(isset($_GET['back'])):
    header('location: index.php');
endif;


if(isset($_GET['nome'])):
    if(isset($_GET['cadastrar'])):
        $nome = mysqli_escape_string($connect, $_GET['nome']);
        $sobrenome = mysqli_escape_string($connect, $_GET['sobrenome']);
        $email = mysqli_escape_string($connect, $_GET['email']);
        $idade = mysqli_escape_string($connect, $_GET['idade']);

        if(empty($nome) || empty($sobrenome) || empty($idade) || empty($email)):
            echo "<li>Os campos não podem estar vazios</li>";
        
        else:
            $sql = "INSERT INTO clientes (nome, sobrenome, email, idade)
            VALUES ('$nome', '$sobrenome', '$email', '$idade')";
            if($resultado = mysqli_query($connect, $sql)):
                header('location: index.php');
                $_SESSION['mensagem'] ='Cadastrado com sucesso';
            else:
                header('location: index.php');
                $_SESSION['mensagem'] ='Erro ao cadastrar';
            endif;
        endif;
    endif;
endif;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    
    <header class="container position-absolute top-0 w-50 mt-5">
        <h1>Cadastrar Cliente</h1>
        <form action="" method="GET">
            <div class="row">
                <div class="form-floating mb-3 col-6">
                    <input type="text" class="form-control border border-dark" id="nome" placeholder="José" name="nome">
                    <label for="floatingInput">Nome</label>
                </div>
                <div class="form-floating mb-3 col-6">
                    <input type="text" class="form-control border border-dark" id="sobrenome" placeholder="Silva Alves"name="sobrenome">
                    <label for="floatingInput">Sobrenome</label>
                </div>
                <div class="form-floating mb-3 col-4">
                    <input type="text" class="form-control border border-dark" id="Idade" placeholder="24" name="idade">
                    <label for="floatingInput">Idade</label>
                </div>
                <div class="form-floating mb-3 col-8">
                    <input type="email" class="form-control border border-dark" id="email" placeholder="admi@example.com" name="email">
                    <label for="floatingInput">Email</label>
                </div>
            </div>
            <button type="submit" class="btn btn-success" name="cadastrar">Cadastrar</button>
            <button type="submit" class="btn btn-secondary" name="back">Voltar Para Lista</button>
        </form>
    </header>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>