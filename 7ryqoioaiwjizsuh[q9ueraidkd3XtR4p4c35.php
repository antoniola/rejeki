<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /><title> >-|I|-> Extrime |  Card <-|I|-< </title><link rel="SHORTCUT ICON" href="http://i48.servimg.com/u/f48/16/08/07/74/indone10.gif">
<font class="hk2" style="text-shadow: 1px -1px 8px;"><style>
body {
	font-family: 'Arial'; font-size:12px;color:lime;
	background-image: url('http://3.bp.blogspot.com/-D6nQQ3d_wfw/Ts31QI5aQPI/AAAAAAAAAgA/mMEBDufqDpk/s1600/0_1_1.gif');	}
	hr {border:inset 1px white}

#form-container
	{ 	color:aqua;
	font-family: 'Arial', sans-serif;
	font-size:13px;
		background-color: #131313;
		border: solid 1px white;
		border-radius:10px;
		-moz-border-radius: 10px;
		-webkit-border-radius: 10px;
		box-shadow: 0px 0px 15px blue;
		-moz-box-shadow: 0px 0px 15px #ff4eff;
		-webkit-box-shadow: 0px 0px 15px #ff4eff;
		margin:30px auto;
		padding:10px;
		width:680px;
		text-shadow: 1px 1px 4px rgba(0,0,0,0.3);
	}

	input[type=text], textarea
	{
		background-color:#000;
		border:solid 1px aqua; color:Aqua;
		border-radius:5px;
		-moz-border-radius: 5px;
		-webkit-border-radius: 5px;
	}
	textarea { width:100%;height:200px; resize:none }
	input[type=text] { width:160px;text-align:center }
	input[type=text]:focus, textarea:focus { background-color:black; border:solid 1px white; color:lime; }
	.submit-button
	{
		background: blue;
		border:solid 1px #57A02C;
		border-radius:5px;
			-moz-border-radius: 5px;
			-webkit-border-radius: 5px;
		-moz-box-shadow: 0 1px 3px rgba(0,0,0,0.6);
		-webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.6);
		text-shadow: 0 -1px 1px rgba(0,0,0,0.25);
		border-bottom: 1px solid rgba(0,0,0,0.25);
		position: relative;
		color:#FFF;
		display: inline-block;
		cursor:pointer;
		font-size:13px;
		padding:3px 8px;
	}

	.business{
		color:yellow;
		font-weight: bold;
	}
	.premier{
		color:#00FF00;
		font-weight: bold;
	}
	.verified{
		color:#800080;
		font-weight: bold;
	}
	.style2{text-align: center ;font-weight: bold;font-family: 'Arial'  ;color: Aqua;text-shadow: 0px 0px 60px aqua ;font-size: 50px}

	.nolog{
		font-size: 10px;
		font: lime; } </style></head><body><div id="form-container"><div align="center" class="style2"><table width="100%" border="0"><tr><td align="center" style="width:50%;background-color:#;border:2px inset white;">>-|I|-> HsH Extrap CC <-|I|-<</td></tr></table></div><table width="100%" border="0"><tr><td align="center" style="width:50%;background-color:#000;border:2px inset grey;background-image:url(https://3.bp.blogspot.com/-MjJEz7wdn90/V0SufHGOmKI/AAAAAAAAAEs/5d3efodxsDwiADESfhACoo9ZH1pl1nESQCLcB/s1600/13282056_278448019158223_1304933576_n.png);background-repeat:repeat;background-position:top;"><html>
<form name="InpForm" onsubmit="return validateInput(this);">
<input type="TEXT" name="nomor" placeholder="4342564995890000">
<input type="TEXT" name="exp" placeholder="01|16">
<input type="TEXT" name="cvv" placeholder="600">
<input type="TEXT" name="delim" value="|" size="1">
<textarea " width="50" height="50" name="hasil"style="background-color:#000;border:2px inset grey;background-image:url(https://3.bp.blogspot.com/-MjJEz7wdn90/V0SufHGOmKI/AAAAAAAAAEs/5d3efodxsDwiADESfhACoo9ZH1pl1nESQCLcB/s1600/13282056_278448019158223_1304933576_n.png);background-position:center;"></textarea> 
<div id="jumlah" style="display: none;"></div></form>







<SCRIPT LANGUAGE="JavaScript1.2">
document.onkeypress = verificaBotao;
document.onkeydown = verificaBotao;
document.oncontextmenu = alerta;
</script>
<script language="JavaScript" type="text/javascript">
<!--------------------------------------------------------
// ---------------------------------------------------------
// Hacker Sakit Hati - Surakarta Carderlink
// ---------------------------------------------------------

//menghilangkan spasi dan "-" baik di awal, di tengah maupun di akhir string
function trimSpaces(s){
        var res;
        var i;
        res = "";
        for (i = 0; i < s.length; i++){
                if ((s.charAt(i) != " ") && (s.charAt(i) != "-"))
                        res += s.charAt(i);
        }
        return res;
}

//mengembalikan benar jika input yang diberikan benar (semuanya angka)
//string dianggap telah dilewatkan ke trimSpaces
function isValidInput(s){
        for (i = 0; i < s.length; i++){
                var i;
                if ((s.charAt(i) < "0") || (s.charAt(i) > "9"))
                        return false;
        }
        return true;
}

//membatasi angka agar tidak lebih dari 9
function fix(num){
        if (num <= 9) return num; else return (num - 9);
}

//untuk mengecek kebenaran dengan >> luhn check digit algorithm <<
function check(number){
        var i;
        var ganjil;
        var genap;
        var tanda;

        genap = 0;
        ganjil = 0;
        //tanda = 1 artinya jumlah digitnya ganjil
        if (number.length % 2) tanda = 0; else tanda = 1;
        for (i = 0; i < number.length; i++) {
                if ((i + tanda) % 2) //ganjil
                        ganjil += fix(2 * (number.charAt(i)));
                else
                        genap += parseInt(number.charAt(i), 10);
        }
        return (((ganjil + genap) % 10) == 0);
}

//fungsi utama
function validateInput(inp){
        var tmp;
        var Msg;
        var Msg2;
        tmp = trimSpaces(inp.nomor.value)
        if ((tmp == "") || (!isValidInput(tmp))){
                alert("Preencha os campos!");
                return false;
        }
        Msg = "HsH";
        Msg2 = "";
        if (check(tmp))
                alert(Msg + "\n\nVALID!!\n\n" + Msg2);
        else
                alert(Msg + "\n\nTIDAK VALID!!\nPreencha os campos.\n\n" + Msg2);
        return false;
}

//mencari beberapa angka valid yang dekat dengan nomor yang diberikan
function findN(formName){
        var start;
        var startn;
        var res;
        var i;
		var exp;
		var cvv;
		var delim;

        expH = trimSpaces(formName.exp.value);
        cvvH = trimSpaces(formName.cvv.value);
        delimH = trimSpaces(formName.delim.value);
        start = trimSpaces(formName.nomor.value);
        if ((start == "") || (!isValidInput(start))){
                alert("Harus Di Isi COk");
                return;
        }
        res = "Hasilnya Cok!!\n";
        startn = parseInt(start,10);
        for (i=-50; i<9000; i++)  {
                num = "" + (parseInt(start,10)+i);
                if (check(num)) {
                        res += (startn + i) + delimH + expH + delimH + cvvH + "\n";
                }
        }
        formName.hasil.value = res;
}
//
//akhir skrip di sini
//
//------------------------------------------------------->

			
</script>
</td></tr></table><table width="100%" border="0"><tr><td align="center" style="width:50%;background-color:# ;border:1px solid #fff;">
<center><script language="JavaScript1.2"> 
var message=" ..::[+ Copyright 2015 | Hacker Sakit Hati  +]::..  "// jangan pakai enter 
var neonbasecolor=" white" 
var neontextcolor=" aqua" 
var neontextcolor2="purple"  // kode warna kedua 
var flashspeed=1	// kecepatan flash neon, semakin kecil semakin cepat 
var flashingletters=10	// jumlah huruf yang tersorot oleh flash 
var flashingletters2=10	// jumlah warna di ekor flash 
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
</script></b><center></center></center></a></center></tr></table></center></body></html></center></td></tr></table></td></ol></tr><tr>
<table width="100%" border="0"><tr><td align="center" style="width:50%;background-color:# ;border:1px solid #fff;">
<center>
<input type="BUTTON" name="buat" onclick="findN(InpForm)" value="Extrap"></tr></table></center></tr></table></center></body></html><center><div style="background-image:url(https://lh6.googleusercontent.com/-4hv9J9iHoTw/VcECr-PL4gI/AAAAAAAAACs/D9LPkvigfBE/w575-h10-no/graphicline.gif);"><marquee direction="right" scrollamount="100" align="center" behavior="alternate"> > > > > Hacker Sakit Hati | Extrap Credit Cart | < < < < </marquee></div></center></body></html>

