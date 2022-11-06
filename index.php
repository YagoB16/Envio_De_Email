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

    <?php

    use EnviarEmail\EnviarEmail;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require './lib/vendor/autoload.php';
    require_once 'validacao.php';

    $envio = new EnviarEmail;
    $envio->model();
    
    $envio->envioSmtp();
    var_dump($envio);
    
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <input type="text" name="nome" id="nome" autocomplete="off" placeholder="Nome">
        <label for="nome">Nome</label>
        <input type="input" name="email" id="email" autocomplete="off" placeholder="email">
        <label for="email">Email</label>
        <input type="input" name="assunto" id="assunto" autocomplete="off" placeholder="assunto">
        <label for="email">assunto</label>
        <input type="input" name="mensagem" id="mensagem" autocomplete="off" placeholder="mensagem">
        <label for="email">mensagem</label>
        <input type="submit" value="enviar" name="enviar-form">
    </form>
</body>

</html>