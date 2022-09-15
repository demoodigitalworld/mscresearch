<?php
error_reporting(0);
    mb_internal_encoding('UTF-8');
    header('Content-Type: text/html; charset=UTF-8');
?><html lang="en">
<head>
    <meta http-equiv="Content-Language" content="ar-sa">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

$text = 'welcome to dignity technology';
$letters2 = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
$letters3 = ['z','y','x','w','v','u','t','s','r','q','p','o','n','m','l','k','j','i','h','g','f','e','d','c','b','a'];
$map = array_combine($letters2, $letters3);

for ($i = 0; $i < strlen($text); $i++) {
    $text[$i] = array_search($text[$i], $map);
}
echo $text;

// $map1 = array_combine($letters3, $letters2);
// for ($i = 0; $i < strlen($text); $i++) {
//     $text[$i] = array_search($text[$i], $map1);
// }
// echo '<br/>'.$text;

?>



<?php
function encode(string $str): string
{
  $alphabet = 'abcdefghijklmnopqrstuvwxyz';
  $result = 'welcome';
  preg_match_all('/[a-z0-9]/', strtolower($str), $matches);
  foreach($matches[0] as $char) {
    $idx = strpos($alphabet, $char);
    if ($idx === false) $result .= $char;
    else $result .= $alphabet[25 - $idx];
  }
  return trim(preg_replace('/(.{5})/', '$1 ', $result));
}
?>
<?php



?>


</body>
</html>