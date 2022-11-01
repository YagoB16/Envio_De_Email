<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    date_default_timezone_set('America/Sao_Paulo');


    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require './lib/vendor/autoload.php';

    //Variáveis do Formulário
    $assunto = $_POST['assunto'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $mensagem = $_POST['mensagem'];
    $data_envio = date('d/m/Y');
    $hora_envio = date('H:i:s');

    //Estilização de e-mail
    $arquivo = "
    <style type='text/css'>
    body {
        margin: 0px;
        font-family: Verdane;
        font-size: 12px;
        color: #6F30AB;
    }
   
</style>
<html>
<body style='padding: 50px; font-family: Arial, Helvetica, sans-serif;'>
    <div style='border: 0.1px solid black; padding: 30px; text-align:center; background:#C18EE2;'>
        <h1 style='font-size: 40px;'>Olá</h1>
    </div>
    <div style='border: 1px solid; text-align:start; padding: 13px; background-color: aliceblue;'>
        <div style='padding: 30px 0 40px 10px; font-size: 23px;'>Olá, você recebeu um aviso de $nome</div>
        <div style='padding:0 0 20px 10px; font-size: 23px;'>Telefone para contato: $telefone</div>
        <div style='text-align: center; font-size:30px;'>Mensagem</div>
        <div style='color:black; text-align: start; font-size:18px; padding: 10px 10px; border:2px solid #6F30AB; border-radius: 10px; '>$mensagem</div>
    </div>
</body>
</html>
    ";

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP(); //Definiu o tipo de protocolo que será usado para envio do e-mail
        $mail->SMTPAuth = true; //Habilitar autenticação SMTP(Simple Mail Transfer Protocol)

        $mail->Username = 'shaolinmataporco696@gmail.com'; //E-mail que será utilizado para comunicação
        $mail->Password = 'ghoronxkamiplpsh'; //Senha para autorização de uso, "necessária autenticação em 2 fatores na conta Google e criar uma "senha de apps" para usar especificamente para SMTP" 

        $mail->SMTPSecure = 'tls';

        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;

        //Remetente
        $mail->setFrom('shaolinmataporco696@gmail.com', 'Shaolin Contatos'); //primeiro paramêtro será o e-mail do remetente, segundo paramêtro será o nome que identifica o e-mail enviado

        //Destinatário
        $mail->addAddress($email, $nome);

        //Conteúdo da mensagem

        $mail->isHTML(true);
        $mail->Subject = $assunto; // Assunto do e-mail
        $mail->Body = $arquivo; // Mensagem com maior volume 


        $mail->AltBody = 'Este é o corpo da mensagem para e-mails sem html disponivel';

        //Enviar
        $mail->send();

        echo "<script>alert('Mensagem enviada com sucesso!');</script>";
        echo " <h2>Olá, seu aviso foi enviado para o e-mail digitado no formulário.</h2>";
        echo "<meta http-equiv='refresh' content='5;URL=index.html'>";
    } catch (Exception $e) {
        echo "Mensagem não foi enviada. Mailer error: {$mail->ErrorInfo}";
    }
    ?>
    <div>

    </div>
</body>

</html>