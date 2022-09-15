<?php
 
$str = "الحمد";
$key = "VIGENERECIPHER";
 
printf("Text: %s\n", $str);
printf("key:  %s\n", $key);
 
$cod = encipher($str, $key, true); printf("Code: %s\n", $cod);
$dec = encipher($cod, $key, false); printf("Back: %s\n", $dec);
 
function encipher($src, $key, $is_encode)
{
    $key = strtoupper($key);
    $src = strtoupper($src);
    $dest = '';
 
    /* strip out non-letters */
    // for($i = 0; $i <= strlen($src); $i++) {
    //     $char = substr($src, $i, 1);
    //     if(ctype_upper($char)) {
    //         $dest .= $char;
    //     }
    // }
 
    for($i = 0; $i <= strlen($dest); $i++) {
        $char = substr($dest, $i, 1);
        if(!ctype_upper($char)) {
            continue;
        }
        $dest = substr_replace($dest,
            chr (
                ord('ا') +
                ($is_encode
                   ? ord($char) - ord('ا') + ord($key[$i % strlen($key)]) - ord('ا')
                   : ord($char) - ord($key[$i % strlen($key)]) + 39
                ) % 39
            )
        , $i, 1);
    }
 
    return $dest;
}
 
?>




