<?php

require_once('db_connect.php');

session_start();

if(isset($_POST['back'])):
    header('location: index.php');
endif;

if(isset($_GET['id'])):
    $id = mysqli_escape_string($connect,$_GET['id']);
    $sql = "SELECT * FROM clientes WHERE id = '$id'";
    $resultado = mysqli_query($connect,$sql);
    $dados = mysqli_fetch_array($resultado);
    $nome = $dados['nome'];
    $sobrenome = $dados['sobrenome'];
    $idade = $dados['idade'];
    $email = $dados['email'];
endif;

if(isset($_POST['nome'])):
    if(isset($_POST['editar'])):
        $nome = mysqli_escape_string($connect, $_POST['nome']);
        $sobrenome = mysqli_escape_string($connect, $_POST['sobrenome']);
        $email = mysqli_escape_string($connect, $_POST['email']);
        $idade = mysqli_escape_string($connect, $_POST['idade']);

        if(empty($nome) || empty($sobrenome) || empty($idade) || empty($email)):
            echo "<li>Os campos não podem estar vazios</li>";
        
        else:
            $sql = "UPDATE clientes SET nome = '$nome', sobrenome = '$sobrenome', email = '$email', idade = '$idade' where id ='$id'";
            if($resultado = mysqli_query($connect, $sql)):
                header('location: index.php');
                $_SESSION['mensagem'] ='Atualizado com sucesso';
            else:
                header('location: index.php');
                $_SESSION['mensagem'] ='Erro ao atualizar';
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
    

</head>
<body>
    
    <header class="container d-grid gap-2 col-12 mx-auto my-5">
        <h1>Editar Clientes</h1>
        <form action="" method="POST">
            <div class="row">
                <div class="form-floating mb-3 col-6">
                    <input type="text" class="form-control border border-dark" id="nome" placeholder="José" name="nome" value="<?php echo $nome?>">
                    <label for="floatingInput">Nome</label>
                </div>
                <div class="form-floating mb-3 col-6">
                    <input type="text" class="form-control border border-dark" id="sobrenome" placeholder="Silva Alves"name="sobrenome"value="<?php echo $sobrenome?>">
                    <label for="floatingInput">Sobrenome</label>
                </div>
                <div class="form-floating mb-3 col-4">
                    <input type="text" class="form-control border border-dark" id="Idade" placeholder="24" name="idade" value="<?php echo $idade?>">
                    <label for="floatingInput">Idade</label>
                </div>
                <div class="form-floating mb-3 col-8">
                    <input type="email" class="form-control border border-dark" id="email" placeholder="admi@example.com" name="email" value="<?php echo $email?>">
                    <label for="floatingInput">Email</label>
                </div>
                <input type="hidden" name="value=<?php echo $id?>">
            </div>
            <button type="submit" class="btn btn-warning col-2" name="editar">Editar</button>
            <button type="submit" class="btn btn-secondary col-2" name="back">Voltar Para Lista</button>
        </form>
    </header>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

</body>
</html>