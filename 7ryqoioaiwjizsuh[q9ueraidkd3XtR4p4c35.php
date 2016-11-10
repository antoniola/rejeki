 </head><body><div id="form-container"><div align="center" class="style2"><table width="100%" border="0"><tr><td align="center" style="width:50%;background-color:#;border:2px inset white;">>-|I|-> HsH Extrap CC <-|I|-<</td></tr></table></div><table width="100%" border="0"><tr><td align="center" style="width:50%;background-color:#000;border:2px inset grey;background-image:url(https://3.bp.blogspot.com/-MjJEz7wdn90/V0SufHGOmKI/AAAAAAAAAEs/5d3efodxsDwiADESfhACoo9ZH1pl1nESQCLcB/s1600/13282056_278448019158223_1304933576_n.png);background-repeat:repeat;background-position:top;"><html>
<form name="InpForm" onsubmit="return validateInput(this);">
<input type="TEXT" name="nomor" placeholder="4342564995890000">
<input type="TEXT" name="exp" placeholder="01|16">
<input type="TEXT" name="cvv" placeholder="600">
<input type="TEXT" name="delim" value="|" size="1">
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
<center></center></center></a></center></tr></table></center></body></html></center></td></tr></table></td></ol></tr><tr>
<table width="100%" border="0"><tr><td align="center" style="width:50%;background-color:# ;border:1px solid #fff;">
<center>
<input type="BUTTON" name="buat" onclick="findN(InpForm)" value="Extrap"></tr></table></center></tr></table></center></body></html><center><div style="background-image:url(https://lh6.googleusercontent.com/-4hv9J9iHoTw/VcECr-PL4gI/AAAAAAAAACs/D9LPkvigfBE/w575-h10-no/graphicline.gif);"><marquee direction="right" scrollamount="100" align="center" behavior="alternate"> > > > > Hacker Sakit Hati | Extrap Credit Cart | < < < < </marquee></div></center>

<br>
<textarea " width="250" height="250" name="hasil"style="background-color:#000;border:2px inset grey;background-image:url(https://3.bp.blogspot.com/-MjJEz7wdn90/V0SufHGOmKI/AAAAAAAAAEs/5d3efodxsDwiADESfhACoo9ZH1pl1nESQCLcB/s1600/13282056_278448019158223_1304933576_n.png);background-position:center;"></textarea> 

</body></html>

