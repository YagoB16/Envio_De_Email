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

            //Validar nome
            if (
                (!isset($_POST['nome'])) ||
                (empty($_POST['nome'])) ||
                (strlen($nomeSobrenome[0]) < 3)||
                (strlen($_POST['nome']) > 25) || 
                (!preg_match("/^[a-zA-Z-' ]*$/",$nomeSobrenome[0]))
            ) {
                $this->erro[] = 'Nome inválido';
            }

            //Validar sobrenome
            if (
                (count($nomeSobrenome) <= 1)||
                (strlen($nomeSobrenome[1]) < 3)||
                (!preg_match("/^[a-zA-Z-' ]*$/",$nomeSobrenome[1]))
            ) {
                $this->erro[] = 'Insira o sobrenome';
            }


            //Validar email    
            if (
                (!isset($_POST['email'])) ||
                (empty($_POST['email'])) ||
                ($this->valida_email($_POST['email']) == false)
            ) {
                $this->erro[] = 'Email inválido';
            }


            //Validar subject
            if (
                (!isset($_POST['assunto'])) ||
                (empty($_POST['assunto']))
            ) {
                $this->erro[] = 'Informe o assunto';
            }


            //Validar mensagem
            if (
                (!isset($_POST['mensagem'])) ||
                (empty($_POST['mensagem']))
            ) {
                $this->erro[] = 'Informe a mensagem';
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
        $this->mail->setFrom('goyagoba@gmail.com', 'PHPMilho');


        //Define email para resposta
        $this->mail->addReplyTo('goyagoba@gmail.com');


        //Define o assunto do email
        $this->mail->Subject = '🚨'.($this->dadosEnvio['subject']);


        //Define o email em cópia
        $this->mail->addBCC('ybarbosa1608@gmail.com', 'Cópia de ' . ($this->dadosEnvio['subject']));


        // Define o destinatário
        $this->mail->AddAddress($this->dadosEnvio['email']);


        // Seta o formato do e-mail para aceitar conteúdo HTML
        $this->mail->isHTML(true);
        $conteudo =  "
        <div style='Margin:0px auto;max-width:600px;'>
        <table align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='width:100%;'>
            <tbody>
                <tr>
                    <td style='direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;'>
                        <div class='mj-column-per-100 outlook-group-fix' style='font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;'>
                            <table border='0' cellpadding='0' cellspacing='0' role='presentation' style='vertical-align:top;' width='100%'>
                                <tr>
                                    <td align='center' style='font-size:0px;padding:10px 25px;word-break:break-word;'>
                                        <table border='0' cellpadding='0' cellspacing='0' role='presentation' style='border-collapse:collapse;border-spacing:0px;'>
                                            <tbody>
                                                <tr>
                                                    <td style='width:550px; height: 150px; background-color: #691717;text-align: center;font-family:Helvetica, arial, sans-serif;font-size:35px;line-height:1.1;text-align:center;color:#0b0404;'>
                                                        Contato
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td align='center' style='font-size:0px;padding:10px 25px;word-break:break-word;'>
                                        <div style='font-family:Helvetica, arial, sans-serif;font-size:30px;line-height:1.1;text-align:center;color:#444444;'>
                                            Olá, {$this->dadosEnvio['name']} você recebeu um aviso
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align='justify' style='font-size:0px;padding:10px 25px;word-break:break-word;'>
                                        <div style='font-family:Helvetica, arial, sans-serif;font-size:16px;line-height:24px;text-align:justify;color:#444444;'>{$this->dadosEnvio['message']}</div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>    
        ";
        $this->mail->msgHTML($conteudo);


        if (!$this->mail->send()) {
            echo 'Não foi possível enviar a mensagem.<br>';
        } else {
            echo "";
        }
    }
}
