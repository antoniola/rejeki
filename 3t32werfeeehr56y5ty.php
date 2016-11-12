<?php
 $file = $_GET['file'];
 
    if (isset($file))
    {
       echo "Unzip " . $file . "<br>";
       system('unzip -o ' . $file);
       exit;
    }
 
    // create a handler to read the directory contents
    $handler = opendir(".");
 
    echo "<font color=lime>Silakan Pilih File Zip Yang Mau di Extract: " . "<br>";
 
    // A blank action field posts the form to itself
    echo '<FORM action="" method="get">';
 
    $found = FALSE; // Used to see if there were any valid files
 
    // keep going until all files in directory have been read
    while ($file = readdir($handler))
    {
        if (preg_match ("/.zip$/i", $file))
        {
            echo '<input type="radio" name="file" value=' . $file . '> ' . $file . '<br>';
            $found = true;
        }
    }
 
    closedir($handler);
 
    if ($found == FALSE)
        echo "Tidak Ada File Berekstensi Zip Yang Ditemukan<br></font>";
    else
        echo '<p class=blink><font color=red>Peringatan: File Yang Ada Akan Ditimpa </p></font><br><INPUT type="submit" value="Extact Zip">';
 
    echo "</FORM>";
?>
