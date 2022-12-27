<?php 

include 'teste.html';
include './PHPMailer/lib/vendor/autoload.php';

class forpen{
    
    
    protected function parserString($array, $string)
    {

        foreach ($array as $key => $value) {
            $string = str_replace('[$key]', $value, $string);
        }
        return $string;
    }
}

$array = array(
    "nome" => "Yago",
    "nomeSobrenome" => "Yago Barbosa",
    "mensagem" => "Ola mundo"
);

$email = fopen('./template.html', 'r+');
$conteudo = fread($email, filesize('./template.html'));
$nome = str_replace('[nome]', $array["nome"], $conteudo);
$nomeSobre = str_replace('[nome_sobrenome]', $array["nomeSobrenome"], $nome);
$mensagem = str_replace('[mensagem]', $array["mensagem"], $nomeSobre);


echo $mensagem;
fclose($email);
