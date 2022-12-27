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
define('MAIL_PASS', '');


class EnviarEmail extends PHPMailer
{
    public function __construct()
    {
        $this->envioSmtp();
    }

    protected function parserString($array)
    {
        $string = '';
        foreach ($array as $key => $value) {
            $string .= str_replace('[' . $key . ']', $value, $string);
        }
        return $string;
    }

    protected function envioSmtp()
    {
        //Caso não tenha erro irá executar 
        if (!isset($this->erro)) {

            $nomeSobrenome = $_POST['nome'];

            $this->dadosEnvio['nomeSobrenome'] = $_POST['nome'];

            //$this->dadosEnvio['name'] = $nomeSobrenome[1]; Ajustar para trazer apenas o nome

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

        $array = array(
            "nome" => $this->dadosEnvio['name'],
            "nomeSobrenome" => $this->dadosEnvio['nomeSobrenome'],
            "mensagem" => $this->dadosEnvio['message']
        );

        $email = fopen('./template.html', 'r+');
        $conteudo = fread($email, filesize('./template.html'));
        $nome = str_replace('[nome]', $array["nome"], $conteudo);
        $nomeSobre = str_replace('[nome_sobrenome]', $array["nomeSobrenome"], $nome);
        $mensagem = str_replace('[mensagem]', $array["mensagem"], $nomeSobre);

        $this->mail->msgHTML($mensagem);

        fclose($email);

        //Necessário ajustar para orientação a objeto, utilizar uma função já criada acima 'parserString()'



        if (!$this->mail->send()) {
            echo 'Não foi possível enviar a mensagem.<br>';
        } else {
            echo "";
        }
    }
}
