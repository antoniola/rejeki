<?php
echo "<head>\n"; 
echo "<style>input[type=submit]{ padding: 3px; color: #;\n"; 
echo "font-weight: bold;\n"; 
echo "text-align: center;\n"; 
echo "text-shadow: 0 1px rgba(255, 255, 255, 0.3);\n"; 
echo "background: #;\n"; 
echo "background-clip: padding-box;\n"; 
echo "border: 1px solid #;\n"; 
echo "border-bottom-color: #;\n"; 
echo "border-radius: 4px;\n"; 
echo "cursor: pointer;\n"; 
echo "background-image:-webkit-linear-gradient(top, #, #);\n"; 
echo "background-image: -moz-linear-gradient(top, #, #);\n"; 
echo "background-image: -o-linear-gradient(top, #, #);\n"; 
echo "background-image: linear-gradient(to bottom, #, #);\n"; 
echo "-webkit-box-shadow: inset 0 1px rgba(255, 255, 255, 0.5), inset 0 0 7px rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.15); box-shadow: inset 0 1px rgba(255, 255, 255, 0.5), inset 0 0 7px rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.15); } input[type=text]{ padding: 3px; color: #; text-shadow: # 0px 0px 3px; border: 1px solid #; background: transparent; box-shadow: 0px 0px 4px #; padding: 3px; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px; -webkit-box-shadow: rgb(85,85,85) 0px 0px 4px; -moz-box-shadow: # 0px 0px 4px;}\n"; 
echo "</style>\n"; 
echo "</head>\n";
echo "<center>Reverse IP Domain Check</center>\n";
echo "<center></center><div id=result>";
echo "<center><br><form><input type='text' size='60' value='bawok.com' name='pentil' />&nbsp;<input type='submit' value='search'></form></center>";
if(isset($_GET["pentil"]))
{
$site = $_GET["pentil"];
$nn = "http://domains.yougetsignal.com/domains.php";

//Curl Function
$ch = curl_init($nn);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt($ch, CURLOPT_POSTFIELDS, "remoteAddress=$site&ket=");
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
$resp = curl_exec($ch);
$resp = str_replace("[","", str_replace("]","", str_replace("\"\"","", str_replace(", ,",",", str_replace("{","", str_replace("{","", str_replace("}","", str_replace(", ",",", str_replace(", ",",", str_replace("'","", str_replace("'","", str_replace(":",",", str_replace('"','', $resp ) ) ) ) ) ) ) ) ) ))));
$array = explode(",,", $resp);
unset($array[0]);
echo "<table style='margin: 0 auto'>";
foreach($array as $lnk)
{
print "<tr><td><a style=\"color:#0076B1;\" href='$lnk' target=_blank>$lnk</a></td></tr>";
}
echo "</table>";
curl_close($ch);
}

?>
