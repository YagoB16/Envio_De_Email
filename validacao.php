<?php

namespace EnviarEmail;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class EnviarEmail
{
    protected function __construct() {
        // date_default_timezone_set('America/Sao_Paulo');
        $this->config = new \stdClass;
        $this->config->typeSend = 'smtp'; // nativo, smtp
        $this->config->Username = 'teste@teste.com'; // login
        $this->config->Password = 'qawsedrf@#'; // senha
        $this->config->Port = 587;
        $this->config->Host = 'smtp.gmail.com';
        // Mensagem que vai ser enviada ao cliente
        $this->config->subjectCliente = 'Obrigado por falar conosco';
        $this->config->mensagemCliente = '
    
        ';
      // Mensagem que vai ser enviada para o dono do site
    $this->config->mensagemEmpresa = '
        <html>
            <body>
                Mensagem: $mensagem<br>
                Nome: $nome<br>
                Email: $email<br>
                Mensagem: $dataEnvio<br>
                Mensagem: $horaEnvio<br>
            </body>
        </html>
    ';
    }

    public function model()
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
            if ($this->valida_email($_POST['email']) === false) {
                $this->erro[] = 'Email inválido';
            }

            /** validar os outros */

            if (!isset($this->erro)) {
                $this->dadosEnvio = array();
                $this->dadosEnvio['name'] = $_POST['nome'];
                $this->dadosEnvio['email'] = $_POST['email'];
                $this->dadosEnvio['subject'] = $_POST['assunto'];
                $this->dadosEnvio['message'] = $_POST['mensagem'];
                // Faça o envio de acordo com o envio escolhido

            }
        endif;
    }


    public function parserString($array, $string)
    {

        foreach ($array as $key => $value) {
            $string = str_replace('[' . $key . ']', $value, $string);
        }
        return $string;
    }

    public function valida_email($email)
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
    public function envioSmtp()
    {
        $mail = new PHPMailer(true);
        $mail->isSMTP(true);
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls'; // Criptografia do envio SSL também é aceito
        $mail->Username = 'goyagoba@gmail.com'; // Autenticação do Email
        $mail->Password = 'alqezukuhvoahupl';
        $mail->Port = 587;
        $mail->Host = 'smtp.gmail.com';
        $mail->setFrom('goyagoba@gmail.com', 'Olá'); //Define o Remetente
        $mail->addAddress('ybarbosa1608@gmail.com', 'yago'); // Define o destinatário
        $mail->isHTML(true); // Seta o formato do e-mail para aceitar conteúdo HTML
        $mail->Body= $this->config->mensagemCliente;

        if (!isset($this->erro)) { //Se não  houver nenhum erro na validação  de dados ele fará uma nova verificação 
        try {
            $mail->send();

            echo "<script>alert('Mensagem enviada com sucesso!');</script>";
            echo " <h2>Olá, seu aviso foi enviado para o e-mail digitado no formulário.</h2>";
            //echo "<meta http-equiv='refresh' content='5;URL=index.php'>";
        } catch (Exception $e) {
            echo "Mensagem não foi enviada. Mailer error: {$mail->ErrorInfo}";
        }
    }
}
}
