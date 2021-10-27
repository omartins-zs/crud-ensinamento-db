<?php
$pdo = new PDO('mysql:host=localhost;dbname=crud-ensinamento', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $pdo->exec("DELETE FROM pessoas WHERE id=$id");
    echo 'deletado com sucesso o id: ' . $id;
}

// Insert
if (isset($_POST['nome'])) {
    $sql = $pdo->prepare("INSERT INTO pessoas VALUES (null,?,?)");
    $sql->execute(array($_POST['nome'], $_POST['email']));
    echo 'inserido com sucesso';
}

// Comando para atualizar.

// Refresh faz automatico as MUDANÇAS

$nome = 'Felipe'; /* Nome para a troca no banco */
$pdo->exec("UPDATE pessoas SET nome='$nome' WHERE id=12") /*Deve sempre indicar o "id" devido ser sistema simples */

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta charset="UTF-8">

    <title>Cadastro Pessoas</title>

    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">


    <!-- video font awesome -->

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="form">

            <form class="form-group" action="" method="post">


                <div class="row">
                    <div class="col">
                        <label for="InputNome" class="form-label">Nome:</label>
                        <input type="text" class="form-control" name="InputNome" id="InputNome" placeholder="Digite seu nome">
                    </div>
                    <div class="col">
                        <label for="InputEmail" class="form-label">Email:</label>
                        <input type="email" class="form-control" name="InputEmail" id="InputEmail" placeholder="name@example.com">
                    </div>
                </div>

                <input type="submit" value="Enviar"><br>
                <?php
                $sql = $pdo->prepare("SELECT * FROM pessoas");
                $sql->execute();

                $fetchClientes = $sql->fetchAll();

                foreach ($fetchClientes as $key => $value) {
                    echo '<a  href="?delete=' . $value['id'] . '" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>' . $value['nome'] . ' | ' . $value['email'];
                    echo '<br>';
                    echo '<hr>';
                }
                ?>
            </form>


        </div>
    </div>

</body>

</html>