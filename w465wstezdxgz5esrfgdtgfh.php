<?php
$file = 'AppleID.zip';
 
$path = pathinfo( realpath( $file ), PATHINFO_DIRNAME );
 
$zip = new ZipArchive;
$res = $zip->open($file);
if ($res === TRUE) {
    $zip->extractTo( $path );
    $zip->close();
    echo "<center><font color=lime>File $file Berhasil Di Extract Di ====> $path </font>";
}
else {
    echo "<font color=red>JANCOK !! Server Bosok Gak Iso Gae Extract iki Cok $file </font></center>";
}
?>
