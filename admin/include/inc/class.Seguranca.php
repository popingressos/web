<?
# Classe de encriptação de dados com chave
# Estas funções impossibilitam o acesso aos texto sem a chave
if(!class_exists('Seguranca')) {
class Seguranca
{
        function __construct() {}
        ##
        # Codificação simples
        ##
        function encriptar($texto, $chave)
        {
                $texto = str_split($texto, 1);
                $final = NULL;
                
                foreach($texto as $char)
                {
                        $final .= sprintf("%03x", ord($char) + $chave);
                }
                
                return $final;
        }
        
        ##
        # Decodificação simples
        ##
        function decriptar($texto, $chave)
        {
                $final = NULL;
                $texto = str_split($texto, 3);
                foreach($texto as $char)
                {
                        $final .= chr(hexdec($char) - $chave);
                }
                
                return $final;
        }
        
        ##
        # Encontrar uma chave de acordo com um texto
        ##
        function chave($texto)
        {
                $texto = str_split(md5($texto), 1);
                $sinal = 0;
                $soma = 0;
                foreach($texto as $char)
                {
                        if($sinal)
                        {
                                $soma -= ord($char);
                                $sinal = 0;
                        }
                        else
                        {
                                $soma += ord($char);
                                $sinal = 1;
                        }
                }
                if($soma < 0)
                        $soma *= -1;
                
                return $soma;
        }
}
}
?>