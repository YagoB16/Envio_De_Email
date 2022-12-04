<?php

namespace EnviarEmail;

error_reporting(0);

use PHPMailer\PHPMailer\{PHPMailer, Exception};
use verificaDados\ValidaDados\ValidaDados as VerificaDadosValidaDadosValidaDados;

require_once './lib/vendor/autoload.php';
require_once 'verificaDados.php';

define('MAIL_HOST', 'smtp.gmail.com');
define('MAIL_PORT',   587);
define('MAIL_USER',  'goyagoba@gmail.com');
define('MAIL_PASS', 'slvqfybstibjstgh');


class EnviarEmail extends PHPMailer
{
    public function __construct()
    {
        $this->envioSmtp();
    }



    protected function envioSmtp()
    {
        if (!isset($this->erro)) {

            $this->dadosEnvio['name'] = $_POST['nome'];
            $this->dadosEnvio['email'] = $_POST['email'];
            $this->dadosEnvio['subject'] = $_POST['assunto'];
            $this->dadosEnvio['message'] = $_POST['mensagem'];
        }


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


        //Incluir arquivo com html para email
        ob_start();
        include("./teste.html");
        $conteudo = ob_get_clean();



        $this->mail->msgHTML($conteudo);


        if (!$this->mail->send()) {
            echo 'Não foi possível enviar a mensagem.<br>';
        } else {
            echo "";
        }
    }
}
