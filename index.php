<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//db.onlinewebfonts.com/c/3ee28cd1f75331502eb4d62fa3e142c9?family=Exquisite+Corpse" rel="stylesheet" type="text/css" />
    <link href="//db.onlinewebfonts.com/c/6b43dc31ba4fb1a3478a21e4118a54bc?family=Ravenscroft" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="./css/style.css">
    <link rel="shortcut icon" href="image/chapeu-de-bruxa.png">
    <title>Formulário</title>
    <script src="./js/sweetalert2.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</head>

<body class="container-body">
    <header class="container-header">
        <h1>Formulario Halloween</h1>
    </header>
    <main class="container-main">
        <div class="div-bio">
            <h2>Seja Bem-vindo</h2>
            <p>Olá, me chamo Yago Barbosa, fiz esse projeto de formulário como forma de
                estudo sobre
                PHPMailer, uma biblioteca da linguagem PHP para envio de e-mails com segurança. </p>
            <p>Halloween, ou Dia das Bruxas, é uma celebração popular de culto aos mortos
                comemorada anualmente no
                dia 31 de outubro. A cultura de celebração do Halloween é muito forte em países de língua
                anglo-saxônica, sobretudo nos Estados Unidos. Com o tempo, o feriado ganhou popularidade e hoje é
                comemorado, ainda que em menor escala, em boa parte do mundo.</p>
        </div>
        <div class="div-form">
            <form action="" name="form_contato" method="post" autocomplete="off">

                <div class="form__group field">
                    <input type="input" class="form__field" name="nome" id="nome" autocomplete="off" placeholder="Nome" maxlength="65">

                    <label for="nome" class="form__label">Nome</label>
                </div>

                <div class="form__group field">
                    <input type="input" class="form__field" name="email" id="email" placeholder="Email">
                    <label for="email" class="form__label">Email Destinatario</label>
                </div>

                <div class="form__group field">
                    <input type="text" class="form__field" name="assunto" id="assunto" placeholder="Assunto" maxlength="35">
                    <label for="assunto" class="form__label">Assunto</label>
                </div>

                <div class="msg-box">
                    <label for="mensagem" style="font-family: Exquisite Corpse;">Mensagem</label>
                    <textarea name="mensagem" id="msg" cols="10" rows="5" placeholder="Sua mensagem"></textarea>
                </div>
                <div class="btn">
                    <button type="submit" name="submit" class="custom-btn btn-11">Enviar</button>
                </div>
            </form>
            <div>
                <?php

                use EnviarEmail\EnviarEmail;
                use PHPMailer\PHPMailer\PHPMailer;
                use PHPMailer\PHPMailer\Exception;

                require './lib/vendor/autoload.php';
                require_once 'validacao.php';


                $envio = new EnviarEmail();

                if (!isset($envio->erro)) {
                    $envio->disparaEmail();
                    echo "<script type='text/javascript'>
                    Swal.fire({
                    icon: 'success',
                    title: 'Enviado',
                    text: 'Email enviado com sucesso',
                    showConfirmButton: false,
                    timer: 2500
                    });
                    </script>";
                } else {
                    echo "<script type='text/javascript'>
                    Swal.fire({
                    icon: 'error',
                    title: 'Por favor, revise seus dados',
                    showConfirmButton: false,
                    timer: 2500
                    });
                    </script>";
                }

                ?>
                <?php if (isset($envio->erro)) : ?>
                    <h1>Houve erro nas informações</h1>
                    <ul>
                        <?php foreach ($envio->erro as $erro) : ?>
                            <li><?= $erro; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </main>
    <footer class="container-footer">
        <div class="fundo">
            <div class="bruxa">
                <img id="logo-footer" src="image/bruxa.png" alt="">
            </div>
        </div>
    </footer>

</body>

</html>