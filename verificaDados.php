<?php 

namespace verificaDados\ValidaDados;

require_once './lib/vendor/autoload.php';



class validaDados{


    public function __construct()
    {
        $this->validaInfo();
    }
    
    
    protected function validaInfo()
    {
        
        // Validar nome, email, subject e mensagem
        if (isset($_POST['submit'])) {
            $erro = array();
            
            $nomeSobrenome =  (explode(" ", trim($_POST['nome'])));

            
            //Validar nome
            if (
                (!isset($_POST['nome'])) ||
                (empty($_POST['nome'])) ||
                (strlen($nomeSobrenome[0]) < 3)||
                (strlen(trim($_POST['nome'])) > 55) || 
                (!preg_match("/^[a-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑA-Z-' ]*$/",$nomeSobrenome[0]))
            ) {
                $this->erro[] = 'Insira um nome válido';
            }


            //Validar sobrenome
            if (
                (count($nomeSobrenome) <= 1)||
                (strlen($nomeSobrenome[1]) < 3)||
                (!preg_match("/^[a-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑA-Z-' ]*$/",$nomeSobrenome[1]))
            ) {
                $this->erro[] = 'Insira um sobrenome válido';
                
            }


            //Validar caracteres após sobrenome
            if(
                (count($nomeSobrenome)>5)||
                (!preg_match("/^[a-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑA-Z-' ]*$/", $_POST['nome']))
            ){
                $this->erro[]= 'Caracteres digitados inválidos';
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

            /*if (!isset($this->erro)) {
                $dadosEnvio = array();

                $this->dadosEnvio['name'] = $_POST['nome'];
                $this->dadosEnvio['email'] = $_POST['email'];
                $this->dadosEnvio['subject'] = $_POST['assunto'];
                $this->dadosEnvio['message'] = $_POST['mensagem'];


                $this->dadosEnvio['name'] = $this->parserString($this->dadosEnvio['name'], $_POST['nome']);
                $this->dadosEnvio['email'] = $this->parserString($this->dadosEnvio['email'], $_POST['email']);
                $this->dadosEnvio['subject'] = $this->parserString($this->dadosEnvio['subject'], $_POST['assunto']);
                $this->dadosEnvio['message'] = $this->parserString($this->dadosEnvio['message'], $_POST['mensagem']); 
                
            }*/
        };
    }


    //Validação de Email
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


    protected function parserString($array, $string)
    {

        foreach ($array as $key => $value) {
            $string = str_replace('[' . $key . ']', $value, $string);
        }
        return $string;
    }
}

