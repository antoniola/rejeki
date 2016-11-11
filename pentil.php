 echo "<center></center><div id=result>";
echo "<center><br><form><input type='text' size='60' value='bawok.com' name='pentil' /><input type='hidden' name='action' value='pentil'> &nbsp;<input type='submit' value='search'></form></center>";
if($_GET['do'] == 'pentil')
{
$site = $_GET['pentil'];
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
