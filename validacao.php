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
        $this->envioSmtp();
    }

    private function model()
    {

        // Validar nome, email, subject e mensagem
        if (isset($_POST['enviar-form'])) :
            $erros = array();
            if (
                (!isset($_POST['nome'])) ||
                (empty($_POST['nome'])) ||
                (strlen($_POST['nome']) < 3)
            ) {
                $this->erro[] = 'Nome inválido';
            }

            if (
                (!isset($_POST['email'])) ||
                (empty($_POST['email']))
            ) {
                $this->erro[] = 'Informar e-mail';
                
            }
            if ($this->valida_email($_POST['email']) == false) {
                $this->erro[] = 'Email inválido';
            }

            if (
                (!isset($_POST['subject'])) ||
                (empty($_POST['subject']))
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
            if (isset($this->erro)) {
                foreach($this->erro as $erro){
                    var_dump($erro);
                }
            }
        endif;
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
        if (strlen($this->dadosEnvio['subject']) > 0) {
            $this->mail->Subject = ($this->dadosEnvio['subject']);
        }

        //Define o email em cópia
        $this->mail->addCC('ybarbosa1608@gmail.com', 'Cópia ' . ($this->dadosEnvio['subject']));


        // Define o destinatário
        if (strlen($this->dadosEnvio['email']) > 0) {
            $this->mail->AddAddress($this->dadosEnvio['email'], $this->dadosEnvio['name']);
        }

        // Seta o formato do e-mail para aceitar conteúdo HTML
        $this->mail->isHTML(true);
        $conteudo = $this->dadosEnvio['message'];
        $this->mail->msgHTML($conteudo);


        if (!$this->mail->send()) {
            echo 'Não foi possível enviar a mensagem.<br>';
            echo 'Erro: ' . $this->mail->ErrorInfo;
        } else {
            echo 'Mensagem enviada.';
        }
    }
}
