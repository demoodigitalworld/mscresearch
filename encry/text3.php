<html lang="en">
<head>
    <meta http-equiv="Content-Language" content="ar-sa">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
// $text = 'الحمد لله';
// $letters2 = ['ا','ب','ت','ث','ج','ح','خ','د','ذ','ر','ز','س','ش','ص','ض','ط','ظ','ع','غ','ف','ق','ك','ل','م','ن','و','ه','ي'];
// $letters3 = ['ص','ض','ط','ظ','ع','غ','ف','ق','ك','ل','م','ن','و','ه','ي','ا','ب','ت','ث','ج','ح','خ','د','ذ','ر','ز','س','ش'];
// $map = array_combine($letters2, $letters3);

// for ($i = 0; $i < strlen($text); $i++) {
//     $text[$i] = array_search($text[$i], $map);

// }
// echo $text;
// $map = array_combine($letters3, $letters2);
// for ($i = 0; $i < strlen($text); $i++) {
//     $text2[$i] = array_search($text[$i], $map);
// }
// echo '<br/>'.$text2;

// $str="";
function str_to_array($str) {
    return preg_split('//u', $str, -1, PREG_SPLIT_NO_EMPTY);
}
$text = "الحمد لله";
$text = str_to_array($text);
$alphabet = str_to_array(" ا ب ت ث ج ح خ د ذ ر ز س ش ص ض ط ظ ع غ ف ق ك ل م ن و ه ي ");
$map = array_combine($alphabet, array_reverse($alphabet));

for ($i = 0; $i < sizeof($text); $i++) {
    $char = array_search($text[$i], $map);
    if ($char) {
        $text[$i] = $char;
    }
}
$text = implode($text);
echo $text;


// function encode($plain)
// {
//     $encoder = array(
//         ',' => '',
//         ' ' => '',
//         '.' => '',
//         '0' => '0',
//         '1' => '1', 
//         '2' => '2', 
//         '3' => '3',
//         '4' => '4', 
//         '5' => '5', 
//         '6' => '6',
//         '7' => '7', 
//         '8' => '8', 
//         '9' => '9',
//     );
    
//     for ($i = 0; $i < 26; $i++) {
//         $encoder[chr(122 - $i)] = chr(97 + $i);
//     }
//     $letters = str_split(strtolower($plain));
//     $results = '';
//     $final = ''; 
//     $count = 0;
//     foreach ($letters as $letter) {
//         $results .= $encoder[$letter];
//     }
//     for ($i = 0; $i < strlen($results); $i++) {
//         if ($i > 0 && $i % 5 == 0) {
//             $final .= " ";
//         }
//         $final .= $results[$i];
//     }
//     return trim($final);
// }
// function decode($cypher)
// {

// }
?>




</body>
  </html>