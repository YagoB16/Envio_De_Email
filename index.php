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
        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome" autocomplete="off" placeholder="Nome"><br><br>

        <label for="email">Email</label>
        <input type="input" name="email" id="email" autocomplete="off" placeholder="email"><br><br>

        <label for="email">Assunto</label>
        <input type="text" name="assunto" id="assunto" autocomplete="off" placeholder="assunto"><br><br>

        <label for="email">Mensagem</label>
        <input type="text" name="mensagem" id="mensagem" autocomplete="off" placeholder="mensagem"><br><br>

        <input type="submit" value="Enviar" name="submit">
    </form>

    <?php

    use EnviarEmail\EnviarEmail;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require './lib/vendor/autoload.php';
    require_once 'validacao.php';


    $envio = new EnviarEmail();

    if (!isset($envio->erro)) {
        $envio->disparaEmail();
    }
    
    ?>

    <?php if(isset($envio->erro)):?>
        <ul>
        <?php foreach($envio->erro as $erro):?>
            <li><?= $erro; ?></li>
        <?php endforeach; ?>
        </ul>
    <?php endif;?>
    
</body>

</html>