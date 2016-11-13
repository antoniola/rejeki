 <?php
  
if($_FILES["fileToUpload"]["name"]) {
        $file = $_FILES["fileToUpload"];
    $filename = $file["name"];
    $tmp_name = $file["tmp_name"];
    $type = $file["type"];
      
    $name = explode(".", $filename);
    $accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
  
    if(in_array($type,$accepted_types)) { //If it is Zipped/compressed File
        $okay = true;
    } 
      
    $continue = strtolower($name[1]) == 'zip' ? true : false; //Checking the file Extension
  
    if(!$continue) {
        $message = "The file you are trying to upload is not a .zip file. Please try again.";
    }
  
    
  /* here it is really happening */
        $ran = $name[0]."-".time()."-".rand(1,time());
        $targetdir = "zipped/".$ran;
        $targetzip = "zipped/".$ran.".zip";
  
    if(move_uploaded_file($tmp_name, $targetzip)) { //Uploading the Zip File
          
        /* Extracting Zip File */
  
        $zip = new ZipArchive();
        $x = $zip->open($targetzip);  // open the zip file to extract
        if ($x === true) {
            $zip->extractTo($targetdir); // place in the directory with same name  
            $zip->close();
      
            unlink($targetzip); //Deleting the Zipped file
        }
        $message = "Your <strong>{$ran}.zip</strong> file was uploaded and unpacked.";
  
    } else {    
        $message = "There was a problem with the upload. Please try again.";
    }
}
echo $message;
  
?>
