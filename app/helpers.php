<?php
function genRandomString()
{
    $length = 6;
    $Caracteres = 'ABCDEFGHIJKLMOPQRSTUVXWYZ0123456789';
    $QuantidadeCaracteres = strlen($Caracteres);
    $QuantidadeCaracteres--;
    $Hash=NULL;
    for($x=1;$x<=$length;$x++){
        $Posicao = rand(0,$QuantidadeCaracteres);
        $Hash .= substr($Caracteres,$Posicao,1);
    }

    return $Hash;
}
 function properSlug($string)
    {

        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
        return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.


    }
    function shortText($x)
    {
        $k=strip_tags($x);
        if(strlen($k)>50)
        {
              return substr($k,0,50)."...";
        }else{
            return $k;
        }
    }
?>