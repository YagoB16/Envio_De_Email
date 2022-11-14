<?php

namespace EnviarEmail;

error_reporting(0);

use PHPMailer\PHPMailer\{PHPMailer, Exception};

require_once './lib/vendor/autoload.php';

define('MAIL_HOST', 'smtp.gmail.com');
define('MAIL_PORT',   587);
define('MAIL_USER',  'goyagoba@gmail.com');
define('MAIL_PASS', 'alqezukuhvoahupl');

class EnviarEmail extends PHPMailer
{

    public function __construct()
    {

        $this->mail = new PHPMailer(true);
        $this->model();
    }

    public function disparaEmail()
    {
        $this->envioSmtp();
    }

    protected function parserString($array, $string)
    {

        foreach ($array as $key => $value) {
            $string = str_replace('[' . $key . ']', $value, $string);
        }
        return $string;
    }

    protected function valida_email($email)
    {
        if (function_exists('filter_var')) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE) {
                return false;
            } else {
                return true;
            }
        } else {
            if (preg_match('/^(?:[\w\!\#\$\%\&\'\\+\-\/\=\?\^\`\{\|\}\~]+\.)[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', $email) == 1) {
                return true;
            } else {
                return false;
            }
        }
    }

    private function model()
    {

        $nomeSobrenome =  (explode(" ", trim($_POST['nome'])));

        // Validar nome, email, subject e mensagem
        if (isset($_POST['submit'])) {
            $erro = array();
            if (
                (!isset($_POST['nome'])) ||
                (empty($_POST['nome'])) ||
                (strlen($_POST['nome']) < 3)
            ) {
                $this->erro[] = 'Nome inválido';
            }
            if (
                (count($nomeSobrenome) <= 1)
            ) {
                $this->erro[] = 'Insira o sobrenome';
            }

            if (
                (!isset($_POST['email'])) ||
                (empty($_POST['email'])) ||
                ($this->valida_email($_POST['email']) == false)
            ) {
                $this->erro[] = 'Email inválido';
            }

            if (
                (!isset($_POST['assunto'])) ||
                (empty($_POST['assunto']))
            ) {
                $this->erro[] = 'Informe o assunto';
            }
            if (
                (!isset($_POST['mensagem'])) ||
                (empty($_POST['mensagem']))
            ) {
                $this->erro[] = 'Informar mensagem';
            }


            /* validar os outros */

            if (!isset($this->erro)) {
                $this->dadosEnvio = array();
                $this->dadosEnvio['name'] = $_POST['nome'];
                $this->dadosEnvio['email'] = $_POST['email'];
                $this->dadosEnvio['subject'] = $_POST['assunto'];
                $this->dadosEnvio['message'] = $_POST['mensagem'];


                $this->dadosEnvio['name'] = $this->parserString($this->dadosEnvio['name'], $_POST['nome']);
                $this->dadosEnvio['email'] = $this->parserString($this->dadosEnvio['email'], $_POST['email']);
                $this->dadosEnvio['subject'] = $this->parserString($this->dadosEnvio['subject'], $_POST['assunto']);
                $this->dadosEnvio['message'] = $this->parserString($this->dadosEnvio['message'], $_POST['mensagem']);
            }
        };
    }
    protected function envioSmtp()
    {
        $this->mail->CharSet = 'UTF-8';
        $this->mail->isSMTP(true);
        $this->mail->SMTPAuth = true;
        $this->mail->SMTPSecure = 'tls'; // Criptografia do envio SSL também é aceito
        $this->mail->Username = MAIL_USER; // Autenticação do Email
        $this->mail->Password = MAIL_PASS;
        $this->mail->Port = MAIL_PORT;
        $this->mail->Host = MAIL_HOST;

        //Define o Remetente
        $this->mail->setFrom('goyagoba@gmail.com', 'Ola');


        //Define email para resposta
        $this->mail->addReplyTo('goyagoba@gmail.com');


        //Define o assunto do email
        $this->mail->Subject = ($this->dadosEnvio['subject']);


        //Define o email em cópia
        $this->mail->addBCC('ybarbosa1608@gmail.com', 'Cópia ' . ($this->dadosEnvio['subject']));


        // Define o destinatário
        $this->mail->AddAddress($this->dadosEnvio['email'], $this->dadosEnvio['name']);


        // Seta o formato do e-mail para aceitar conteúdo HTML
        $this->mail->isHTML(true);
        $conteudo =  "
        <style type='text/css'>
            body {
                min-width: 450px;
                max-width: 550px;
                margin: 0px;
                font-family: Verdane;
                font-size: 12px;
                color: #0c020b;
            }
        </style>
        <html>

        <body style='padding: 10px; font-family: Arial, Helvetica, sans-serif;'>
            <div style='border: 0.1px solid black; padding: 30px; text-align:center; background:#750505;'>
                <h1 style='font-size: 40px;'>Shaolin Contatos</h1>
            </div>
            <div style='border: 1px solid; text-align: center; padding: 15px 85px; background-color: rgb(240, 241, 241);'>
                <div style='padding: 30px 0 40px 10px; font-size: 20px;'>Olá, você recebeu um aviso de <br>
                    {$this->dadosEnvio['name']}</div>
                <div
                    style='width:350px; color:rgb(20, 15, 15); font-size:18px; padding: 20px 10px; border:2px solid #c7c6c9; background-color: #c7c6c9; border-radius: 10px; text-align: center; '>
                    {$this->dadosEnvio['message']}</div>
            </div>
        </body>

        </html>
        ";
        $this->mail->msgHTML($conteudo);


        if (!$this->mail->send()) {
            echo 'Não foi possível enviar a mensagem.<br>';
        } else {
        echo "";
           
        }
    }
}
