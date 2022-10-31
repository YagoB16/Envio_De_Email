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
            color: #666666;
        }
    
        a {
            color: #666666;
            text-decoration: none;
        }
    
        a:hover {
            color: #FF0000;
            text-decoration: none;
        }
    </style>
    <html>
    <table width='510' border='1' cellpadding='1' cellspacing='1' bgcolor='#CCCCCC'>
       
            <td>
                <tr>
                    <td width='500'>Nome:$nome</td>
                </tr>
    
                <tr>
                    <td width='320'>E-mail:<b>$email</b></td>
                </tr>
    
                <tr>
                    <td width='320'>Telefone:<b>$telefone</b></td>
                </tr>
                  
                <tr>
                    <td width='320'>Mensagem:$mensagem</td>
                </tr>
    
            </td>
        
    
        <tr>
            <td>Este e-mail foi enviado em <b>$data_envio</b> às <b>$hora_envio</b></td>
        </tr>
    </table>
    
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