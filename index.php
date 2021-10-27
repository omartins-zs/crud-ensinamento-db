<?php
$pdo = new PDO('mysql:host=localhost;dbname=crud-ensinamento', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $pdo->exec("DELETE FROM pessoas WHERE id=$id");
    echo '<div class="alert alert-danger d-flex align-items-center">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
  <div>
    deletado com sucesso o id:
  </div>';
}

// Insert
if (isset($_POST['nome'])) {
    $sql = $pdo->prepare("INSERT INTO pessoas VALUES (null,?,?)");
    $sql->execute(array($_POST['nome'], $_POST['email']));
    echo '<div class="alert alert-success d-flex align-items-center">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
  <div>
    inserido com sucesso
  </div>
</div>';
}

// Comando para atualizar.

// Refresh faz automatico as MUDANÇAS


$nome = 'Jorge'; /* Nome para a troca no banco */
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
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </symbol>
        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
        </symbol>
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </symbol>
    </svg>

    <title>CRUD De Pessoas</title>
</head>

<body>

    <div class="container">

        <form class="form-group" action="" method="post">
            <div class="content-form">
                <div class="row">
                    <div class="col">
                        <label for="nome" class="form-label">Nome:</label>
                        <input type="text" class="form-control" name="nome" id="nome" placeholder="Digite seu nome">
                    </div>
                    <div class="col">
                        <label for="email" class="form-label">Email:</label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="name@example.com"><br>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" value="Enviar">Cadastrar</button><br><br>

                <?php
                $sql = $pdo->prepare("SELECT * FROM pessoas");
                $sql->execute();

                $fetchClientes = $sql->fetchAll();

                foreach ($fetchClientes as $key => $value) {
                    echo '<a href="?delete=' . $value['id'] . '" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>' . $value['nome'] . ' | ' . $value['email'];
                    echo '<br>';
                    echo '<hr>';
                }
                ?>
            </div>
        </form>
    </div>
</body>

</html>