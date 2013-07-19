<html>
 <head>
  <title>Converter</title>
 </head>
 <body>
 <?php
 $xml = file_get_contents("http://localhost/comtamcalihrm/convert_to_unescaped_string.txt");
 /*
preg_match("^*$", $xml, $lines, PREG_OFFSET_CAPTURE, 0);
echo "before convert: \r\n";
foreach ($lines as &$value) {
    $value = json_encode($value);
}
unset($value);

echo "\r\nAfter convert: \r\n";

print_r($lines);
*/
echo json_encode($xml);
 ?>
 </body>
</html>