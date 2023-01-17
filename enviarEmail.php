<?php

namespace EnviarEmail;

error_reporting(0);

use PHPMailer\PHPMailer\PHPMailer;

require_once './lib/vendor/autoload.php';

require_once __DIR__ . './enviarEmail.php';

define('MAIL_HOST', 'smtp.gmail.com');
define('MAIL_PORT', 587);
define('MAIL_USER', '');
define('MAIL_PASS', '');

class EnviarEmail extends PHPMailer
{
    public function __construct()
    {
        $this->envioSmtp();
    }

    public function parserString($array, $string)
    {
        foreach ($array as $key => $value) {
            $string = str_replace([$key], $value, $string);
        }
        return $string;

    }
    protected function envioSmtp()
    {

        //Caso não tenha erro irá executar
        if (!isset($this->erro)) {

            $primeiroNome = (explode(" ", trim($_POST['nome'])));
            $this->dadosEnvio['nome_sobrenome'] = $_POST['nome'];
            $this->dadosEnvio['nome'] = $primeiroNome[0]; //Ajustar para trazer apenas o nome
            $this->dadosEnvio['email'] = $_POST['email'];
            $this->dadosEnvio['subject'] = $_POST['assunto'];
            $this->dadosEnvio['message'] = $_POST['mensagem'];
        }

        //Dados que serão alterados no template 
        $arra = [
            '[nome]' => $this->dadosEnvio['nome'],
            '[mensagem]' => $this->dadosEnvio['message'],
            '[nome_sobrenome]' => $this->dadosEnvio['nome_sobrenome'],
        ];


        $email = fopen('./template.html', 'r+'); // Abertura do Template que irá sofrer alterações nos dados 
        $conteudo = fread($email, filesize('./template.html')); //Atribuindo o conteúdo que há no template para uma variável que sofrerá alterações futuras 
        $mensagem = $this->parserString($arra, $conteudo); //Aqui os dados sofrerão o parserString, para receber seus valores passados atráves do input feito no formulário 
        $conteudo_mensagem = $mensagem; // Conteúdo alterado e pronto para ser utilizado
        fclose($email); //Fechar o Template após ajustes necessários


        $this->mail = new PHPMailer(true);
        $this->mail->CharSet = 'UTF-8';
        $this->mail->isSMTP();
        $this->mail->SMTPAuth = true;
        $this->mail->SMTPSecure = 'tls'; // Criptografia do envio SSL também é aceito
        $this->mail->Username = MAIL_USER; // Autenticação do Email
        $this->mail->Password = MAIL_PASS;
        $this->mail->Port = MAIL_PORT;
        $this->mail->Host = MAIL_HOST;

        //Define o Remetente
        $this->mail->setFrom('goyagoba@gmail.com', 'Inscrição Realizada');

        //Define email para resposta
        $this->mail->addReplyTo('goyagoba@gmail.com');

        //Define o assunto do email
        $this->mail->Subject = '🚨' . ($this->dadosEnvio['subject']);

        //Define o email em cópia
        $this->mail->addBCC('ybarbosa1608@gmail.com', 'Cópia de ' . ($this->dadosEnvio['subject']));

        // Define o destinatário
        $this->mail->AddAddress($this->dadosEnvio['email']);

        // Seta o formato do e-mail para aceitar conteúdo HTML
        $this->mail->isHTML(true);

        $this->mail->MsgHTML($conteudo_mensagem);

        if (!$this->mail->send()) {
            echo 'Não foi possível enviar a mensagem.<br>';
        } else {
            echo "";
        }
    }
}
