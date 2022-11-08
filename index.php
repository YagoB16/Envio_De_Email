<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Document</title>
</head>

<body>

    <form action="" method="POST">
        <input type="text" name="nome" id="nome" autocomplete="off" placeholder="Nome" required>
        <label for="nome">Nome</label><br>
        <input type="input" name="email" id="email" autocomplete="off" placeholder="email" required>
        <label for="email">Email</label><br>
        <input type="text" name="assunto" id="assunto" autocomplete="off" placeholder="assunto" required>
        <label for="email">Assunto</label><br>
        <input type="text" name="mensagem" id="mensagem" autocomplete="off" placeholder="mensagem" required>
        <label for="email">Mensagem</label><br>
        <input type="submit" value="Enviar" name="enviar-form">
    </form>

    <?php

    use EnviarEmail\EnviarEmail;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require './lib/vendor/autoload.php';
    require_once 'validacao.php';


    $envio = new EnviarEmail();



    ?>
</body>

</html>