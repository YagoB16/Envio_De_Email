<?php



require_once './lib/vendor/autoload.php';

class teste{

    public function parserString($array, $string)
    {
        foreach ($array as $key => $value) {
            $string = str_replace( $value,  '[ . $key . ]', $string);
        }
        return $string;
    }
}



$arra =[
    '[nome]' => 'Yago',
    '[nome_sobrenome]' => 'Yago Barbosa',
    '[mensagem]' => 'esta mensagem é um teste'
    
];

#$mensagem = new teste();

$email = fopen('./template.html', 'r+');

$conteudo = fread($email, filesize('./template.html'));


foreach ($arra as $key => $value) {

    $conteudo = str_replace([$key], $value , $conteudo);
    
}

var_dump($conteudo) ;


fclose($email);