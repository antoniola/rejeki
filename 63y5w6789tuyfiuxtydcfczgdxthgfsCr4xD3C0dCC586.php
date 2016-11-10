<body><div id="form-container"><div align="center" class="style2"><table width="100%" border="0"><tr><td align="center" style="width:50%;background-color:#;border:2px inset white;">>-|I|-> HsH Crack CC <-|I|-<</td></tr></table></div><table width="100%" border="0"><tr><td align="center" style="width:50%;background-color:#000;border:2px inset grey;background-image:url(#);"><html><br><br><form name="croot" method="POST" action="" /><textarea name="datamucok" rows="5" placeholder="Masukan Code CC nya COK" style="margin: 0px; width: 419px; height: 119px;" required></textarea><br><br><input type="submit" name="submit" value="Submit"> | <input type="button" value="refresh" onClick="window.location.href=window.location.href"><br><br></td></tr></table><table width="100%" border="0"><tr><td align="center" style="width:50%;background-color:#000;border:2px inset white;"><br><?php function decryptIt($data, $key) { $key = md5($key); $data = base64_decode($data); $decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $data, MCRYPT_MODE_CBC, md5($key)); $decrypted = rtrim($decrypted, "\0"); return $decrypted; } function encryptIt($data, $key) { $key = md5($key); $encrypted = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $data, MCRYPT_MODE_CBC, md5($key)); $encrypted = base64_encode($encrypted); return $encrypted; } if(isset($_POST['submit'])){ $data = 'testing'; $key = '81944cff7d8046e1d2ad4a188270fd47'; $encrypted = encryptIt($data, $key);
// Masukan Data mu Cok
@$encrypted = $_POST['datamucok']; $nganu = explode("\n", $encrypted); echo 'Hasilnya : <br><br>'; echo '<textarea name="datamucok" rows="5" style="margin: 0px; width: 462px; height: 117px;" required="">'; for($x = 0; $x < count($nganu); $x++) { $decrypted = decryptIt($nganu[$x], $key); echo $decrypted, PHP_EOL; } echo ' </textarea><br><br>'; echo ' Total Check : '.count($nganu); }
?></td></tr></table><table width="100%" border="0"><tr><td align="center" style="width:50%;background-color:# ;border:1px solid #fff;">
<center><script language="JavaScript1.2"> 
var message=" ..::[+ © Copyright 2016 | Hacker Sakit Hati  +]::..  "// jangan pakai enter 
var neonbasecolor=" white" 
var neontextcolor=" aqua" 
var neontextcolor2="purple"  // kode warna kedua 
var flashspeed=1	// kecepatan flash neon, semakin kecil semakin cepat 
var flashingletters=10	// jumlah huruf yang tersorot oleh flash 
var flashingletters2=10	// jumlah warna di ekor flash 
var flashpause=1					 
///edit by http://googel-indonesia.blogspot.com/ 
var n=0 
if (document.all||document.getElementById){ 
document.write('<font color="'+neonbasecolor+'">') 
for (m=0;m<message.length;m++) 
document.write('<span id="neonlight'+m+'">'+message.charAt(m)+'</span>') 
document.write('</font>') 
} 
else 
document.write(message) 
function crossref(number){ 
var crossobj=document.all? eval("document.all.neonlight"+number) : document.getElementById("neonlight"+number) 
return crossobj 
} 
function neon(){ 
//Change all letters to base color 
if (n==0){ 
for (m=0;m<message.length;m++) 
crossref(m).style.color=neonbasecolor 
} 
//cycle through and change individual letters to neon color 
crossref(n).style.color=neontextcolor 
 
if (n>flashingletters-1) crossref(n-flashingletters).style.color=neontextcolor2  
if (n>(flashingletters+flashingletters2)-1) crossref(n-flashingletters-flashingletters2).style.color=neonbasecolor 
if (n<message.length-1) 
n++ 
else{ 
n=0 
clearInterval(flashing) 
setTimeout("beginneon()",flashpause) 
return 
} 
} 
function beginneon(){ 
if (document.all||document.getElementById) 
flashing=setInterval("neon()",flashspeed) 
} 
beginneon() 
</script></b><center></center></center></a></center></tr></table></center></body></html></center></td></tr></table></td></ol></tr><tr></tr></table></center></body></html>
</body></html>

