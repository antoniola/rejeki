 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Pemisah Email</title>
<link rel="SHORTCUT ICON" href="http://i48.servimg.com/u/f48/16/08/07/74/indone10.gif">
<font class="hk2" style="text-shadow: 1px -1px 8px;"> 
<font class="hk2" style="text-shadow: 1px -1px 8px;">

    <center><table style="background:#" border="1"><tr>
<th style="background:blink;"> 
<style type="text/css" media="screen">
body,table{background:  ; font-family:Verdana,tahoma; color: Darkviolet ; font-size:10px }
A:link {text-decoration: none;color: aqua;}
A:active {text-decoration: none;color: aqua;}
A:visited {text-decoration: none;color: lime;}
A:hover {text-decoration: underline; color: Fuchsia;}
#new,input,table,td,tr,#gg{border-style:solid;text-decoration:bold ;}
input:hover,tr:hover,td:hover{background-color:  ; color: aqua;}
body {
	background:#;
	}

body,td,th,ul,p {
	font: normal normal normal 8pt/1em # ;
	color: #violet;
	}

textarea,input,select {
	font: normal normal normal 8pt/1em # ;
	color: #;
	background:#;
	}

a:link, a:visited {
	text-decoration: none;
	color: #;
	}

a:active, a:hover {
	text-decoration: underline;
	color: #;
	}

fieldset {
	padding-left: 10px; 
	padding-bottom: 10px; 
	border:1px solid #;
	}

legend {
	font: normal normal bold 9pt Arial;
	color: #;
	}

.bordercolor {
	background:#;
	}

.maincolor {
	background:#; 
	border:1px solid #;
	}

.button {
	background:#;
	}

.titlebarcolor {
	background:#;
	}

.titlefont {
	font: normal normal bold 9pt/1em Arial;
	color: #;
	text-decoration:none;
	}

.copyrightfont, .copyrightfont a {
	font: normal normal bold 9pt/1em Arial;
	color: #;
	text-decoration:none;
	}

</style>
<style type="text/css"><!-- a:link{color:#ffffff;text-decoration:none}--></style> <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"><script language="JavaScript">function tb5_makeArray(n){ this.length = n; return this.length;



}



tb5_messages = new tb5_makeArray(2);



tb5_messages[0] = "Antonio";



tb5_messages[1] = "HsH";



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



}</script>
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
<div align="center">
<div id="form-container">
<form method="POST">
<p align="center">
<font face="Times New Roman" size="6"color = 'grey'>Email Domain Filter<br>------------------------------------</font></p>
<p><textarea class="Eml" rows="10" name="emails" cols="45"></textarea></p>
<p><input class="submit-button" type="submit" value="@" name="B1"></p>
</form>
</div>
<?php

$emails = $_POST['emails'];
$ex = explode("\n",$emails);
$count = count($ex);
if(isset($emails)&&$count>=1){
echo "<center><font color = 'red'><b>($count) </font>Jumlah Email  </b></center><br />";
}else{
echo "<center>  
Masukan Email </center>";
exit;}

if(isset($emails)){
   

for($i=0;$i<=$count;$i++){
$d = strtolower($ex[$i]);

if(strstr($d,"hotmail")   || strstr($d,"live") || strstr($d,"msn") || strstr($d,"outlook")){
$hotmail.=$d;
$nh = $nh + 1;
}else{
if(strstr($d,"yahoo")   || strstr($d,"ymail")){
$yahoo.=$d;
$ny = $ny + 1;
}else{
if(strstr($d,"gmail")  || strstr($d,"googlemail")   ){
$gmail.=$d;
$ng = $ng + 1;
}else{
if(strstr($d,"aol")   ){
$aol.=$d;
$na = $na + 1;
}else{
if(strstr($d,"icloud")   || strstr($d,"me") || strstr($d,"sky") || strstr($d,"mac")){
$icloud .=$d;
$nr = $nr + 1;
}else{
if(strstr($d,"wanadoo")   ){
$wanadoo .=$d;
$nw = $nw + 1;
}else{
if(strstr($d,"walla")   ){
$walla .=$d;
$nt = $nt + 1;
}else{
if(strstr($d,"gmx")   ){
$gmx .=$d;
$ngm = $ngm + 1;
}else{
if(strstr($d,"@web.")   ){
$web .=$d;
$nw2 = $nw2 + 1;
}else{

$ather .=$d;
$nn=$nn + 1;
}

}

}


}

}
}
}
}

}
}
}				
?>
<p><table border="0" width="100%" style="width: 30%">
<tbody>
<tr>
<td><p align="center"><font color = 'grey'><font face="Times New Roman" size="4">Gmail</font><b>(<font color="<?php if(count($ng)>=1){echo "#00FF00";}else{echo "#FF0000";} ?>"><b><?php if(count($ng)>=1){ echo $ng;}else{echo "0";} ?></b></font>)</b></p></td>
<td><p align="center"><font color = 'grey'><font face="Times New Roman" size="4">Hotmail</font><b>(<font color="<?php if(count($nh)>=1){echo "#00FF00";}else{echo "#FF0000";} ?>"><?php if(count($nh)>=1){ echo $nh;}else{echo "0";} ?></font>)</b></p></td>
<td><p align="center"><font color = 'grey'><font face="Times New Roman" size="4">Yahoo</font><b>(<font color="<?php if(count($ny)>=1){echo "#00FF00";}else{echo "#FF0000";} ?>"><?php if(count($ny)>=1){ echo $ny;}else{echo "0";} ?></font>)</b></p></td>
<td><p align="center"><font color = 'grey'><font face="Times New Roman" size="4">Icloud</font><b>(<font color="<?php if(count($nr)>=1){echo "#00FF00";}else{echo "#FF0000";} ?>"><?php if(count($nr)>=1){ echo $nr;}else{echo "0";} ?></font>)</b></p></td>
<td><p align="center"><font color = 'grey'><font face="Times New Roman" size="4">Aol</font><b>(<font color="<?php if(count($na)>=1){echo "#00FF00";}else{echo "#FF0000";} ?>"><?php if(count($na)>=1){ echo $na;}else{echo "0";} ?></font>)</b></p></td>
</tr>

<tr>
<td><div id="form-container1"><font color = 'grey'><textarea rows="10" name="S1" cols="30"><?php echo $gmail;?></textarea></div></td>
<td><div id="form-container1"><font color = 'grey'><textarea rows="10" name="S2" cols="30"><?php echo $hotmail;?></textarea></div></td>
<td><div id="form-container1"><font color = 'grey'><textarea rows="10" name="S3" cols="30"><?php echo $yahoo;?></textarea></div></td>
<td><div id="form-container1"><font color = 'grey'><textarea rows="10" name="S4" cols="30"><?php echo $icloud;?></textarea></div></td>
<td><div id="form-container1"><font color = 'grey'><textarea rows="10" name="S5" cols="30"><?php echo $aol;?></textarea></div></td>
</tr>

</tbody>
<tbody>
<tr>
<td><p align="center"><font color = 'grey'><font face="Times New Roman" size="4">Wanadoo</font><b>(<font color="<?php if(count($nw)>=1){echo "#00FF00";}else{echo "#FF0000";} ?>"><b><?php if(count($nw)>=1){ echo $nw;}else{echo "0";} ?></b></font>)</b></p></td>
<td><p align="center"><font color = 'grey'><font face="Times New Roman" size="4">Walla</font><b>(<font color="<?php if(count($nt)>=1){echo "#00FF00";}else{echo "#FF0000";} ?>"><?php if(count($nt)>=1){ echo $nt;}else{echo "0";} ?></font>)</b></p></td>
<td><p align="center"><font color = 'grey'><font face="Times New Roman" size="4">Gmx</font><b>(<font color="<?php if(count($ngm)>=1){echo "#00FF00";}else{echo "#FF0000";} ?>"><?php if(count($ngm)>=1){ echo $ngm;}else{echo "0";} ?></font>)</b></p></td>
<td><p align="center"><font color = 'grey'><font face="Times New Roman" size="4">Web</font><b>(<font color="<?php if(count($nw2)>=1){echo "#00FF00";}else{echo "#FF0000";} ?>"><?php if(count($nw2)>=1){ echo $nw2;}else{echo "0";} ?></font>)</b></p></td>
<td><p align="center"><font color = 'grey'><font face="Times New Roman" size="4">Other</font><b>(<font color="<?php if(count($nn)>=1){echo "#00FF00";}else{echo "#FF0000";} ?>">
<?php if(count($nn)>=1){ echo $nn-1;}else{echo "0";} ?></font>)</b></p></td>
</tr>

<tr>
<td><div id="form-container1"><font color = 'grey'><textarea rows="10" name="S6" cols="30"><?php echo $wanadoo;?></textarea></div></td>
<td><div id="form-container1"><font color = 'grey'><textarea rows="10" name="S7" cols="30"><?php echo $walla;?></textarea></div></td>
<td><div id="form-container1"><font color = 'grey'><textarea rows="10" name="S8" cols="30"><?php echo $gmx;?></textarea></div></td>
<td><div id="form-container1"><font color = 'grey'><textarea rows="10" name="S9" cols="30"><?php echo $web;?></textarea></div></td>
<td><div id="form-container1"><font color = 'grey'><textarea rows="10" name="S10" cols="30"><?php echo $ather;?></textarea></div></td>
</tr>

</tbody>
</table>
</p>
<p>Copyright ©&nbsp; 2016
<br><font color="lime" size="4">..:| CROOD  <span class="auto-style8">CODER |:..</span></font></p>
</body>
</html>
 
