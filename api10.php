<?php
set_time_limit(0);
error_reporting(0);
date_default_timezone_set('Asia/Jakarta');

/* randomised useragent (minimalis) */
function chooseRandomBrowserAndOS(){$frequencies = array(34 => array(89 => array('chrome', 'win'),9 => array('chrome', 'mac'),2 => array('chrome', 'lin')),32 => array(100 => array('iexplorer', 'win')),25 => array(83 => array('firefox', 'win'),16 => array('firefox', 'mac'),1 => array('firefox', 'lin')),7 => array(95 => array('safari', 'mac'),4 => array('safari', 'win'),1 => array('safari', 'lin')),2 => array(91 => array('opera', 'win'),6 => array('opera', 'lin'),3 => array('opera', 'mac')));$rand = rand(1, 100);$sum = 0;foreach($frequencies as $freq => $osFreqs){$sum += $freq;if ($rand <= $sum){$rand = rand(1, 100);$sum = 0;foreach($osFreqs as $freq => $choice){$sum += $freq;if ($rand <= $sum){return $choice;}}}}throw new Exception("Frequencies don't sum to 100.");}function array_random(array $array){return $array[array_rand($array, 1)];}function nt_version(){return rand(5, 6) . '.' . rand(0, 1);}function ie_version(){return rand(7, 9) . '.0';}function trident_version(){return rand(3, 5) . '.' . rand(0, 1);}function osx_version(){return "10_" . rand(5, 7) . '_' . rand(0, 9);}function chrome_version(){return rand(13, 15) . '.0.' . rand(800, 899) . '.0';}function presto_version(){return '2.9.' . rand(160, 190);}function presto_version2(){return rand(10, 12) . '.00';}function firefox($arch){$ver = array_random(array('Gecko/' . date('Ymd', rand(strtotime('2011-1-1'), time())) . ' Firefox/' . rand(5, 7) . '.0','Gecko/' . date('Ymd', rand(strtotime('2011-1-1'), time())) . ' Firefox/' . rand(5, 7) . '.0.1','Gecko/' . date('Ymd', rand(strtotime('2010-1-1'), time())) . ' Firefox/3.6.' . rand(1, 20),'Gecko/' . date('Ymd', rand(strtotime('2010-1-1'), time())) . ' Firefox/3.8'));switch ($arch){case 'lin':return "(X11; Linux {proc}; rv:" . rand(5, 7) . ".0) $ver";case 'mac':$osx = osx_version();return "(Macintosh; {proc} Mac OS X $osx rv:" . rand(2, 6) . ".0) $ver";case 'win':default:$nt = nt_version();return "(Windows NT $nt; {lang}; rv:1.9." . rand(0, 2) . ".20) $ver";}}function safari($arch){$saf = rand(531, 535) . '.' . rand(1, 50) . '.' . rand(1, 7);if (rand(0, 1) == 0){$ver = rand(4, 5) . '.' . rand(0, 1);}else{$ver = rand(4, 5) . '.0.' . rand(1, 5);}switch ($arch){case 'mac':$osx = osx_version();return "(Macintosh; U; {proc} Mac OS X $osx rv:" . rand(2, 6) . ".0; {lang}) AppleWebKit/$saf (KHTML, like Gecko) Version/$ver Safari/$saf";case 'win':default:$nt = nt_version();return "(Windows; U; Windows NT $nt) AppleWebKit/$saf (KHTML, like Gecko) Version/$ver Safari/$saf";}}function iexplorer($arch){$ie_extra = array('','; .NET CLR 1.1.' . rand(4320, 4325) . '','; WOW64');$nt = nt_version();$ie = ie_version();$trident = trident_version();return "(compatible; MSIE $ie; Windows NT $nt; Trident/$trident)";}function opera($arch){$op_extra = array('','; .NET CLR 1.1.' . rand(4320, 4325) . '','; WOW64');$presto = presto_version();$version = presto_version2();switch ($arch){case 'lin':return "(X11; Linux {proc}; U; {lang}) Presto/$presto Version/$version";case 'win':default:$nt = nt_version();return "(Windows NT $nt; U; {lang}) Presto/$presto Version/$version";}}function chrome($arch){$saf = rand(531, 536) . rand(0, 2);$chrome = chrome_version();switch ($arch){case 'lin':return "(X11; Linux {proc}) AppleWebKit/$saf (KHTML, like Gecko) Chrome/$chrome Safari/$saf";case 'mac':$osx = osx_version();return "(Macintosh; U; {proc} Mac OS X $osx) AppleWebKit/$saf (KHTML, like Gecko) Chrome/$chrome Safari/$saf";case 'win':default:$nt = nt_version();return "(Windows NT $nt) AppleWebKit/$saf (KHTML, like Gecko) Chrome/$chrome Safari/$saf";}}function random_uagent(array $lang=array('en-US')){list($browser, $os) = chooseRandomBrowserAndOs();$proc = array('lin' => array('i686', 'x86_64'),'mac' => array('Intel', 'PPC', 'U; Intel', 'U; PPC'),'win' => array('foo')); switch ($browser){case 'firefox':$ua = "Mozilla/5.0 " . firefox($os);break;case 'safari':$ua = "Mozilla/5.0 " . safari($os);break;case 'iexplorer':$ua = "Mozilla/5.0 " . iexplorer($os);break;case 'opera':$ua = "Opera/" . rand(8, 9) . '.' . rand(10, 99) . ' ' . opera($os);break;case 'chrome':$ua = 'Mozilla/5.0 ' . chrome($os);break;}$ua = str_replace('{proc}', array_random($proc[$os]), $ua);$ua = str_replace('{lang}', array_random($lang), $ua);return $ua;}
/* ---------------------------------------------------------------- useragent function end ---------------------------------------------------------------- */

/* email bounce */
if (isset($_REQUEST['debug'])) {
    define('AEVS_DEBUG', true);
}
if (!defined('STDIN')) {
	define('ISWEB', true);
} else {
	define('ISWEB', false);
}
define('EOL',"\r\n");
global $CACHEPLACES;
$CACHEPLACES = array(
	'/dev/shm',
	getcwd(),
	'/tmp'
);
function fcrdns_check($msg){
    $aRec = @dns_get_record($_SERVER['SERVER_NAME'], DNS_A, $authns, $add);
    $ip = !empty($aRec) ? $aRec[0]['ip'] : $_SERVER['SERVER_ADDR'];
    $rev = preg_replace('/^(\\d+)\.(\\d+)\.(\\d+)\.(\\d+)$/', '$4.$3.$2.$1', $ip);
    $authns = array();
    $add    = array();
	$ptrs = @dns_get_record("{$rev}.IN-ADDR.ARPA.", DNS_PTR, $authns, $add);
	if (true == empty($ptrs)) {
    	$msg = 'PTR record not found';
        return -1;
    }
    $retIp = '';
    foreach ($ptrs as $x) {
        if ( isset($x['target']) ) {
            $target = $x['target'];
            $a      = @dns_get_record($target, DNS_A, $authns, $add);
            if (true == is_array($a)) {
                foreach ($a as $y) {
                    if ( isset($y['ip']) ) {
                    	$retIp = $y['ip'];
                        if ($ip == $y['ip']) {
                            return 0;
                        }
                    }
                }
            }
        }
    }
    $msg = $ip.' resolved as '.$target."\n ".$target.' resolved as '.$retIp."\nrDNS is NOT forward confirmed";
    return 1;
}

class logger {
	function log($s) {
		if (!defined('AEVS_DEBUG')) return;
		if (!is_string($s) ) {
			if (!defined('STDIN')) echo '<pre>';
			print_r($s);
			if (!defined('STDIN')) echo '</pre>';
			return;
		}
		if ($s == '<hr />' && defined('STDIN')) {
			echo "------------------------------------------------------------\n";
			return;
		}
		if (defined('STDIN')) {
			echo $s."\n";
		} else {
			echo htmlspecialchars($s)."<br />";
		}		
	}
}

class smtp extends logger {
	var $socket;
	var $last_code = 0;
	var $last_msg = '';
	var $host = '';
	var $error = false;
	var $error_msg = '';
	var $selfhost = '';
	var $mailfrom = '';
	var $mx_chache = array();
	var $cachePlace = '';
	var $cacheloaded = false;
	var $command_results = array();
	var $last_mx = array();
	function smtp($selfhost = null) {
		if ( $selfhost ) {
			$this->selfhost = $selfhost;
		} else {
			$this->selfhost = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : 'localhost';
		}
	}
	function cr($command) {
		if ( isset($this->command_results[$command] ) ) {
			$r = $this->command_results[$command];
			return is_array($r) ? $r['msg'] : $r;
		} else {
			return null;
		}
	}
	function ensureMXCache() {
		global $CACHEPLACES;
		if ( !$this->cacheloaded ) {

			foreach ( $CACHEPLACES as $dir ) {
				if ( $this->tryLoadCache($dir) ) {
					break;
				}
			}
		}
	}
	function tryLoadCache($dir) {
		$cache = @file_get_contents($dir."/aevs_mx_cache");
		if ( $cache ) {
			$this->mx_cache = json_decode($cache, true);
			$this->cacheloaded = true;
			$this->cachePlace = $dir;
			$this->log('MX Cache loaded from '.$dir);
			return true;
		}			
	}
	function trySaveCache($dir) {
		$content = json_encode($this->mx_cache);
		$done = @file_put_contents($dir."/aevs_mx_cache", $content);
		if ( $done ) {
			$this->cachePlace = $dir;
			$this->log('MX Cache saved to '.$dir);
			return true;
		}
	}
	function saveMXCache() {
		global $CACHEPLACES;
		foreach ( $CACHEPLACES as $dir ) {
			if ( $this->trySaveCache($dir) ) {	
				break;
			}
		}
	}
	function getMXIndex($domain) {
		$idx = 0;
		if ( isset($this->last_mx) ) {
			if ( isset($this->last_mx[$domain]) ) {
				$this->last_mx[$domain]++;
				$idx = $this->last_mx[$domain];
			} else {
				$this->last_mx[$domain] = $idx;
			}
		} else {
			$this->last_mx = array( $domain => $idx);
		}
		return $idx;	
	}
	function getMX($domain) {
		$idx = $this->getMXIndex($domain);
		$this->ensureMXCache();
		if ( isset($this->mx_cache[$domain]) ) {
			return isset($this->mx_cache[$domain][$idx]) ? $this->mx_cache[$domain][$idx] : false;
		} else {
			if ( getmxrr($domain, $mx_hosts, $mx_weights) ) {
				for ( $i=0; $i < count($mx_hosts); $i++ ) {
					$mxs[$mx_hosts[$i]] = $mx_weights[$i];
				}
				asort($mxs);
				$records = array_keys($mxs);
				$this->mx_cache[$domain] = $records;
				$this->saveMXCache();
				return isset($records[$idx]) ? $records[$idx] : false;
			} else {
				return false;
			}		
		}
	}
	function connect($emaildomain) {
		$this->error = false;
		do {
			$this->host = $this->getMX($emaildomain);
			if ( !$this->host ) {
				$this->error = true;
				$this->error_msg = 'Working MX record for domain '.$emaildomain.' is not found.';
				$this->command_results['connect'] = $this->error_msg;
				return false;
			}
			$this->log("Connecting to ".$this->host."...");
			$this->socket = @fsockopen($this->host, 25);
			if ( $this->socket ) {
				$this->log("Connected.");
				$this->read_response();				
				if ( $this->last_code != 220 ) {
					$this->error = true;
					$this->command_results['connect'] = $this->last_resp;
					return $this->last_resp;
				}
				$this->command_results['connect'] = 'OK';
				$this->send_command('HELO '.$this->selfhost);
				if ( $this->last_code != 250 ) {
					$this->error = true;
					$this->command_results['hello'] = $this->last_resp;
					return $this->last_resp;
				}
				$this->command_results['hello'] = 'OK';
				$mf = $this->mailfrom ? $this->mailfrom : 'support@'.$this->selfhost; 
				$this->send_command('MAIL FROM: <'.$mf.'>');
				if ( $this->last_code != 250 ) {
					$this->error = true;
					$this->command_results['mailfrom'] = $this->last_resp;
					return $this->last_resp;
				}
				$this->command_results['mailfrom'] = 'OK';
				return true;
			} else {
				$this->command_results['connect'] = 'Cannot connect to '.$this->host;
			}
		} while(!$this->socket);
		return false;
	}
	function verifyEmail($email) {
		if ( $this->error ) {
			return $this->last_resp;
		}
		return $this->send_command('RCPT TO: <'.$email.'>');
	}
	function isFatalError($msg) {
		$result = false;
		$rxs = array(
			'550 5.7.1.*((Sender Blocked)|(cannot find your hostname)|(authentication required)|(IP name lookup failed)|(Invalid Host)|(Rejected by user)|(Prohibited or invalid sender)|(Your message was rejected)|(your IP has been)|(IP banned))',
			'(spamhaus\.org)|(Helo command rejected)|(HELO\/EHLO was syntactically invalid)|(Your IP Address)|(Sender address rejected)|(helo has been denied)|(DNS PTR)|(Sender rejected)|(cannot find your hostname)',
			'501.*((invalid host name)|(sender domain must exist)|(system is not configured to relay mail from)|(IP address is on an RBL))',
			'504.*helo command rejected',
			'554.*((spam-relay detected)|(refused)|(listed)|(blocked)|(Spamhaus Blacklist)|(www\.us\.sorbs\.net)|(unauthenticated connections)|(Helo command rejected)|(spamhaus))',
			'553.*((spamcop)|(openproxy)|(open proxy)|(mail-abuse.org)|(rejected)|(blocked)|(mail from.* not allowed)|(block list)|(validating sender)(http\:\/\/dsbl\.org)|(badmailfrom list)|(relaying denied from your location)|(does not accept mail from)|(Wrong helo)|(www\.sorbs\.net)|(dynamic_ip\.html)|(Dynamic pool)|(reverse dns record)|(Attack detected)|(sender has been denied)|(reverse DNS)|(invalid HELO)|(reverse\-DNS)|(DNS blacklists))',
			'550.*((blacklist)|(Sender address rejected)|(open proxy)|(openproxy)|(spamcop)|(mail-abuse\.com)|(spamhaus)|(sender verify failed)|(requires valid sender)|(sender address .* does not exist)|(return address not allowed)|(could not verify sender)|(invalid sender address)|(ip helo.* not allowed)(dsbl\.org)|(FROM address from sending host is invalid)|(Invalid HELO)|(from sending mail from)|(SORBS DNSBL database)|(Bad HELO)|(EHLO\/HEL0)|(spamming not allowed)|(SpamHaus)|(Reverse DNS)|(HELO is syntactically invalid)|(HELO string is incorrect)|(detected in HELO)|(you must be spam)|(HELO\/EHLO)|(HELO domain)|(IP name lookup)|(HELO name)|(bogus HELO)|(SPF NONE)|(problem with sender)|(Relaying is not permitted from IP)|(invalid sender))',
			'511.*(www\.sorbs\.net)',
			'^554 5.7.1',
			'^4(21|50|51|52).*((re|)try|grey)'
		);
		foreach( $rxs as $rx ) {
			if ( preg_match("#".$rx."#i", $msg)) {
				$result = true;
				break;
			}
		}
		return $result;
	}
	function verifyEmails($emails) {
		$results = array();
		foreach ( $emails as $email ) {
			$email = trim($email);
			if ( $email == '' ) continue;
			$r = $this->verifyEmail($email);
			$msg = $r['code'] == 250 ? 'OK' : $r['msg'];
			if ( $this->isFatalError($r['msg']) ) {
				return $r['msg'];				
			}
			$results[$email] = $msg;
		}		
		return $results;
	}
	function quit() {
		$this->send_command('QUIT', 'no response');
		fclose($this->socket);
		return $this->last_resp;
	}
	function read_response($timeout = 5) {
		$data = "";
		while($str = @fgets($this->socket, 515)) {
			$data .= $str;
			$this->log('<'.$str);
			if(substr($str,3,1) == " ") { break; }
		}
	    $xarr = preg_split("#\n#", $data, -1, PREG_SPLIT_NO_EMPTY);
		$msg = '';
		$code = '';
		$xcode = '';
		foreach ( $xarr as $line ) {
			if ( preg_match('#(\d+)(?:[\s\-]+(\d\.\d\.\d)|)[\s\-]+?(.*)#i', $line, $res) ) {
				if ( isset($res[1]) ) $code = $res[1];
				if ( isset($res[2]) ) $xcode = $res[2];
				$msg .= ' '.trim($res[3]);		
			}
		}
			$msg = $code.' '.$xcode.' '.$msg;
			$this->last_code = $code;
			$this->last_msg = $msg;
			$this->last_resp = array(
				'code' => $code,
				'msg' => $msg
			);
		return $this->last_resp;
	}
	function send_command($command, $read_response = '') {
		$this->log('>'.$command);
		fputs($this->socket, $command.EOL);
		if ( $read_response != 'no response' ) {
			return $this->read_response();	
 		}
	}
}

function is_writableEx($path) {
//will work in despite of Windows ACLs bug
//NOTE: use a trailing slash for folders!!!
//see http://bugs.php.net/bug.php?id=27609
//see http://bugs.php.net/bug.php?id=30931
    if ($path{strlen($path)-1}=='/') // recursively return a temporary file path
        return is_writableEx($path.uniqid(mt_rand()).'.tmp');
    else if (is_dir($path))
        return is_writableEx($path.'/'.uniqid(mt_rand()).'.tmp');
    // check tmp file for read/write capabilities
    $rm = file_exists($path);
    $f = @fopen($path, 'a');
    if ($f===false)
        return false;
    fclose($f);
    if (!$rm)
        unlink($path);
    return true;
}

function compatibility_check($v = 0) {
	global $CACHEPLACES;
	$results = array();
	$has_writable_dir = false;
	foreach ( $CACHEPLACES as $dir ) {
		if ( is_writableEx($dir."/") ) {
			$has_writable_dir = true;
			if ( $v == 2 ) {
				$results[] = array( 'code' => 'OK', 'msg' => "Directory $dir is writable" );	
			}			
		} else {
			if ( $v >= 1 ) {
				//$results[] = array( 'code' => 'WARNING', 'msg' => "Directory $dir is not writable");		
			}			
		}
	}
	if ( !$has_writable_dir ) {
		$results[] = array( 
			'code' => 'WARNING', 
			'msg' => 'There is no writable dir for MX cache. This will decrease script performance.'
		);
	}
	$functions_to_check = array(
		'fsockopen',
		'getmxrr',
		'json_encode',
		'dns_get_record'
	);
	foreach ( $functions_to_check as $fn ) {
		if ( function_exists($fn) ) {
			if ($v == 2)
			$results[] = array(
				'code' => 'OK',
				'msg' => "Function $fn exists"
			);
		} else {
			$results[] = array(
				'code' => 'ERROR',
				'msg' => "Function $fn does not exist."
			);
		}
	}
	$d_functions = ini_get('disable_functions');
	if ( $d_functions ) {
		$df_list = explode(' ', $d_functions);
		foreach ( $functions_to_check as $fn ) {
			if ( in_array($fn, $df_list) ) {
				$results[] = array(		
					"code" => 'ERROR',
					"msg" => "function $fn is disabled by administrator. It's needed for the work of the script."
				);
			} else {
				if ( $v == 2 ) {
					$results[] = array( 'code' => 'OK', "msg" =>  "function $fn allowed.");	
				}				
			}			
		}
	}
	$con = new smtp();
	$mxhost = $con->getMX('gmail.com');
	$sock = @fsockopen($mxhost, 25);
		if ( $sock ) {
			if ( $v == 2 ) {
				$results[] = array(
					'code' => 'OK',
					'msg' => '25 port is allowed'
				);				
			}
			fclose($sock);
		} else {
			$results[] = array(
				'code' => 'ERROR',
				'msg' => '25 port seems to be forbidden by firewall rules'
			);			
		}
	$rdns_err = '';
	$rdns = fcrdns_check($rdns_err);
	if ( $rdns == 0 ) {
		if ( $v == 2 ) {
			$results[] = array(
				'code' => 'OK',
				'msg' => 'Forward Confirmed reverse DNS check passed.'
			);				
		}
	} else {
		$s = "Forward Confirmed reverse DNS check failed. \n".$rdns_err;
		$note = "<br /><div style=\"width: 45em; font-size: 14px; color: #555;\">Note: This means that you cannot use the script to verify email addresses from the @yahoo.co*, @live.com, @hotmail.com, and @aol.com domains because these ISP use FCrDNS lookup to authenticate the IP address the connection is coming from. If the FCrDNS lookup fails, the incoming IP address goes to a blacklist. See the Advanced Email Verifier Help for more information.</div><br />";
		$s = ISWEB ? nl2br("\n".$s) : $s;
		$results[] = array(
			'code' => 'WARNING',
			'msg' => $s,
			'note' => $note
		);					
	}
	$pass = true;
	foreach ( $results as $msg ) {
		if ( $msg['code'] == 'ERROR' ) {
			$pass = false;
		}
	}
	if ( $pass ) {
		$results[] = array(
			'code' => 'SUCCESS',
			'msg' => 'All tests passed. Script is ready to work.'
		);
	} else {
		$results[] = array(
			'code' => 'FAILURE',
			'msg' => 'Some tests failed. Please show this page to your server administrator and ask to fix these issue(s).'
		);		
	}
	return $results;
}

class verifier extends logger {
	var $mailfrom;
	function verifier($mailfrom = '') {
		$this->mailfrom = $mailfrom;
		
	}
	function getdomain($email) {
		$xEmail = explode('@', $email);
		return $xEmail[1];		
	}
	function checkemails($emails, $l = 0){
		$tree = array();
		$res = array();
		if ($l) {
			$emails = array_slice($emails, 0, $l);
		}
		foreach ( $emails as $email ) {
			$email = trim($email);
			$domain = $this->getdomain($email);
			$this->log('domain >'.$domain);
			if ( !isset($tree[$domain]) ) $tree[$domain] = array();
			$tree[$domain][] = $email;
		}
		foreach ( $tree as $domain => $emails ) {
			if (trim($domain) == '') continue;
			$c = new smtp();
			$c->mailfrom = $this->mailfrom;
			if ( $c->connect($domain) ) {
				$res[$domain] = array(
					'connect' => $c->cr('connect'),
					'hello' => $c->cr('hello'),
					'mailfrom' => $c->cr('mailfrom'),
					'emails' => null
				);
				if ( !$c->error ) {
					$res[$domain]['emails'] = $c->verifyEmails($emails);
				}
				$c->quit();				
			} else {
				$res[$domain] = array(
					'connect' => $c->cr('connect')
				);				
			}
		}
		return $res;
	}
}
/* ---------------------------------------------------------------- email bounce function end ---------------------------------------------------------------- */

class GlobalValidator {
	public $useragent = NULL;
	public $timeServer = NULL;
	public $email = NULL;
	public $type = NULL;
	public $status = NULL;
	public $country = NULL;
	public $country_code = NULL;
	public $msg = NULL;
	public $error_code = NULL;
	public $client_ip = NULL;
	function __construct() {
		if (isset($_GET['email'])) $this->email = $_GET['email'];
		if (isset($_GET['type'])) $this->type = $_GET['type'];
		$this->client_ip = $_SERVER['REMOTE_ADDR'];
	}
	public function curl($url, $post = null, $usecookie = null, $sock = null, $timeout = null) {
		$ch = curl_init();
		if($post != null) {
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
		}
		if($timeout != null){
			curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
		}
		if($sock != null){
				curl_setopt($ch, CURLOPT_PROXY, $sock);
				curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
		}
		curl_setopt($ch, CURLOPT_URL, $url); 
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (iPhone; CPU iPhone OS 9_2 like Mac OS X) AppleWebKit/601.1 (KHTML, like Gecko) CriOS/47.0.2526.70 Mobile/13C71 Safari/601.1.46"); 
		if ($usecookie != null) { 
			curl_setopt($ch, CURLOPT_COOKIEJAR, $usecookie); 
			curl_setopt($ch, CURLOPT_COOKIEFILE, $usecookie);    
		}
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		$result=curl_exec ($ch); 
		curl_close ($ch); 
		return $result; 
	}
	public function listCountry($coco){$co = array("AF"=>"Afghanistan","AX"=>"\xc3\x85land Islands","AL"=>"Albania","DZ"=>"Algeria","AS"=>"American Samoa","AD"=>"Andorra","AO"=>"Angola","AI"=>"Anguilla","AQ"=>"Antarctica","AG"=>"Antigua and Barbuda","AR"=>"Argentina","AM"=>"Armenia","AW"=>"Aruba","AU"=>"Australia","AT"=>"Austria","AZ"=>"Azerbaijan","BS"=>"Bahamas","BH"=>"Bahrain","BD"=>"Bangladesh","BB"=>"Barbados","BY"=>"Belarus","BE"=>"Belgium","BZ"=>"Belize","BJ"=>"Benin","BM"=>"Bermuda","BT"=>"Bhutan","BO"=>"Bolivia, Plurinational State of","BQ"=>"Bonaire, Sint Eustatius and Saba","BA"=>"Bosnia and Herzegovina","BW"=>"Botswana","BV"=>"Bouvet Island","BR"=>"Brazil","IO"=>"British Indian Ocean Territory","BN"=>"Brunei Darussalam","BG"=>"Bulgaria","BF"=>"Burkina Faso","BI"=>"Burundi","KH"=>"Cambodia","CM"=>"Cameroon","CA"=>"Canada","CV"=>"Cape Verde","KY"=>"Cayman Islands","CF"=>"Central African Republic","TD"=>"Chad","CL"=>"Chile","CN"=>"China Domestic","C2"=>"China International","CX"=>"Christmas Island","CC"=>"Cocos (Keeling) Islands","CO"=>"Colombia","KM"=>"Comoros","CG"=>"Congo","CD"=>"Congo, The Democratic Republic of the","CK"=>"Cook Islands","CR"=>"Costa Rica","CI"=>"C\xc3\xb4te d'Ivoire","HR"=>"Croatia","CU"=>"Cuba","CW"=>"Cura\xc3\xa7ao","CY"=>"Cyprus","CZ"=>"Czech Republic","DK"=>"Denmark","DJ"=>"Djibouti","DM"=>"Dominica","DO"=>"Dominican Republic","EC"=>"Ecuador","EG"=>"Egypt","SV"=>"El Salvador","GQ"=>"Equatorial Guinea","ER"=>"Eritrea","EE"=>"Estonia","ET"=>"Ethiopia","FK"=>"Falkland Islands (Malvinas)","FO"=>"Faroe Islands","FJ"=>"Fiji","FI"=>"Finland","FR"=>"France","GF"=>"French Guiana","PF"=>"French Polynesia","TF"=>"French Southern Territories","GA"=>"Gabon","GM"=>"Gambia","GE"=>"Georgia","DE"=>"Germany","GH"=>"Ghana","GI"=>"Gibraltar","GR"=>"Greece","GL"=>"Greenland","GD"=>"Grenada","GP"=>"Guadeloupe","GU"=>"Guam","GT"=>"Guatemala","GG"=>"Guernsey","GN"=>"Guinea","GW"=>"Guinea-Bissau","GY"=>"Guyana","HT"=>"Haiti","HM"=>"Heard Island and McDonald Islands","VA"=>"Holy See (Vatican City State)","HN"=>"Honduras","HK"=>"Hong Kong","HU"=>"Hungary","IS"=>"Iceland","IN"=>"India","ID"=>"Indonesia","IR"=>"Iran, Islamic Republic of","IQ"=>"Iraq","IE"=>"Ireland","IM"=>"Isle of Man","IL"=>"Israel","IT"=>"Italy","JM"=>"Jamaica","JP"=>"Japan","JE"=>"Jersey","JO"=>"Jordan","KZ"=>"Kazakhstan","KE"=>"Kenya","KI"=>"Kiribati","KP"=>"Korea, Democratic People's Republic of","KR"=>"Korea, Republic of","KW"=>"Kuwait","KG"=>"Kyrgyzstan","LA"=>"Lao People's Democratic Republic","LV"=>"Latvia","LB"=>"Lebanon","LS"=>"Lesotho","LR"=>"Liberia","LY"=>"Libya","LI"=>"Liechtenstein","LT"=>"Lithuania","LU"=>"Luxembourg","MO"=>"Macao","MK"=>"Macedonia, The Former Yugoslav Republic of","MG"=>"Madagascar","MW"=>"Malawi","MY"=>"Malaysia","MV"=>"Maldives","ML"=>"Mali","MT"=>"Malta","MH"=>"Marshall Islands","MQ"=>"Martinique","MR"=>"Mauritania","MU"=>"Mauritius","YT"=>"Mayotte","MX"=>"Mexico","FM"=>"Micronesia, Federated States of","MD"=>"Moldova, Republic of","MC"=>"Monaco","MN"=>"Mongolia","ME"=>"Montenegro","MS"=>"Montserrat","MA"=>"Morocco","MZ"=>"Mozambique","MM"=>"Myanmar","NA"=>"Namibia","NR"=>"Nauru","NP"=>"Nepal","NL"=>"Netherlands","NC"=>"New Caledonia","NZ"=>"New Zealand","NI"=>"Nicaragua","NE"=>"Niger","NG"=>"Nigeria","NU"=>"Niue","NF"=>"Norfolk Island","MP"=>"Northern Mariana Islands","NO"=>"Norway","OM"=>"Oman","PK"=>"Pakistan","PW"=>"Palau","PS"=>"Palestine, State of","PA"=>"Panama","PG"=>"Papua New Guinea","PY"=>"Paraguay","PE"=>"Peru","PH"=>"Philippines","PN"=>"Pitcairn","PL"=>"Poland","PT"=>"Portugal","PR"=>"Puerto Rico","QA"=>"Qatar","RE"=>"R\xc3\xa9union","RO"=>"Romania","RU"=>"Russian Federation","RW"=>"Rwanda","BL"=>"Saint Barth\xc3\xa9lemy","SH"=>"Saint Helena, Ascension and Tristan Da Cunha","KN"=>"Saint Kitts and Nevis","LC"=>"Saint Lucia","MF"=>"Saint Martin (French part)","PM"=>"Saint Pierre and Miquelon","VC"=>"Saint Vincent and the Grenadines","WS"=>"Samoa","SM"=>"San Marino","ST"=>"Sao Tome and Principe","SA"=>"Saudi Arabia","SN"=>"Senegal","RS"=>"Serbia","SC"=>"Seychelles","SL"=>"Sierra Leone","SG"=>"Singapore","SX"=>"Sint Maarten (Dutch part)","SK"=>"Slovakia","SI"=>"Slovenia","SB"=>"Solomon Islands","SO"=>"Somalia","ZA"=>"South Africa","GS"=>"South Georgia and the South Sandwich Islands","SS"=>"South Sudan","ES"=>"Spain","LK"=>"Sri Lanka","SD"=>"Sudan","SR"=>"Suriname","SJ"=>"Svalbard and Jan Mayen","SZ"=>"Swaziland","SE"=>"Sweden","CH"=>"Switzerland","SY"=>"Syrian Arab Republic","TW"=>"Taiwan, Province of China","TJ"=>"Tajikistan","TZ"=>"Tanzania, United Republic of","TH"=>"Thailand","TL"=>"Timor-Leste","TG"=>"Togo","TK"=>"Tokelau","TO"=>"Tonga","TT"=>"Trinidad and Tobago","TN"=>"Tunisia","TR"=>"Turkey","TM"=>"Turkmenistan","TC"=>"Turks and Caicos Islands","TV"=>"Tuvalu","UG"=>"Uganda","UA"=>"Ukraine","AE"=>"United Arab Emirates","GB"=>"United Kingdom","US"=>"United States","UM"=>"United States Minor Outlying Islands","UY"=>"Uruguay","UZ"=>"Uzbekistan","VU"=>"Vanuatu","VE"=>"Venezuela, Bolivarian Republic of","VN"=>"Viet Nam","VG"=>"Virgin Islands, British","VI"=>"Virgin Islands, U.S.","WF"=>"Wallis and Futuna","EH"=>"Western Sahara","YE"=>"Yemen","ZM"=>"Zambia","ZW"=>"Zimbabwe","XX"=>"UnKnown");return $co[$coco];}
	public function getCountry() {
		$this->useragent = random_uagent();
		$linkerz = $this->type;
		$t = date("j_M_D_G:i:s-Y");
		$cook = $this->email.'-'.$t.'.txt';

		//USE THIS IF YOU WANT TO STORE ALL THE CHECKED COOKIES
		//$cook = "cookie/"$this->email.'-'.$t.'.txt';

		$ch = curl_init();
		if ($linkerz=='0'){
			curl_setopt($ch, CURLOPT_URL, "https://www.paypal.com/cgi-bin/webscr?cmd=_cart&add=1&business=".$this->email);
		} elseif ($linkerz=='1'){
			curl_setopt($ch, CURLOPT_URL, "https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=".$this->email);
		} elseif ($linkerz=='2'){
			curl_setopt($ch, CURLOPT_URL, "https://www.paypal.com/cart/display=1&bn=tm_gl_2.0&business=".$this->email."&item_name=Shopping+Cart+Button&item_number=123456&amount=0.00&shipping=0.00&shipping2=0.00&handling=0.00&return=http://www.paypal.com&cancel_return=http://www.paypal.com");
		}
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($ch, CURLOPT_ENCODING ,"");
		
		// curl_setopt($ch, CURLOPT_FAILONERROR, 1);
		// curl_setopt($ch, CURLOPT_TIMEOUT, 10);

		curl_setopt($ch, CURLOPT_POST, 0);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

		curl_setopt($ch, CURLOPT_COOKIESESSION, 1);
		curl_setopt($ch, CURLOPT_COOKIEJAR, $cook);
		curl_setopt($ch, CURLOPT_COOKIEFILE, $cook);

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		//curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/x-www-form-urlencoded"));
		
		// $headers = array();
		// $headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8';
		// $headers[] = 'Accept-Encoding: gzip, deflate';
		// $headers[] = 'Accept-Language: en-US,en;q=0.8,id;q=0.6';
		// $headers[] = 'Connection: keep-alive';
		// $headers[] = 'Host: www.paypal.com';
		// $headers[] = 'Upgrade-Insecure-Requests: 1';
		// //$headers[] = 'User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.65 Safari/537.36';
		// curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		curl_setopt($ch, CURLOPT_USERAGENT, $this->useragent);
		$kirim = curl_exec($ch) or die(curl_error($ch));
		curl_close($ch); 
		@unlink($cook);

		if (preg_match("/\bs.eVar36\b/i", $kirim, $match)) {
			$arr = explode('s.eVar36=', $kirim);
			$val = $arr[1];
			$val = substr($val, 0, strpos($val, 's.eVar50'));
			$val = substr($val, 1);
			$val = substr($val, 0, 2);

			if (preg_match("/\bYour purchase couldn\b/i", $kirim, $match)) {
				$idf = array('stat' => 'success' , 'msg' => 'the PayPal account is limited' , 'coco' => $val , 'limited' => 'yes' );
			}elseif (preg_match("/\bPembelian Anda tidak dapat diselesaikan\b/i", $kirim, $match)) {
				$idf = array('stat' => 'success' , 'msg' => 'the PayPal account is limited' , 'coco' => $val , 'limited' => 'yes' );
			}else{
				$idf = array('stat' => 'success' , 'msg' => 'the email address is valid PayPal account' , 'coco' => $val , 'limited' => 'no');
			}
			return $idf;
		}

		if (preg_match("/\bSecurity Challenge\b/i", $kirim, $match)) {
			$idf = array('stat' => 'captcha' , 'msg' => 'process blocked by security challenge');
			return $idf;
		}

		if (preg_match("/\bAccess Denied\b/i", $kirim, $match)) {
			$idf = array('stat' => 'blocked' , 'msg' => 'the IP address temporarily blocked');
			return $idf;
		}

		$idf = array('stat' => 'invalid' , 'msg' => 'the email address not registered');
		return $idf;
	}
	public function chkCountry($email){
		if(strstr($email,".co.uk") || strstr($email,".uk")){
			$code = "GB";
		} elseif(strstr($email,".au") || strstr($email,"bigpond")){
			$code = "AU";
		} elseif(strstr($email,".sg") || strstr($email,".co.sg")){
			$code = "SG";
		} elseif(strstr($email,"co.at") || strstr($email,".at")){
			$code = "AT";
		} elseif(strstr($email,".ie") || strstr($email,".com.ie") || strstr($email,".co.ie")){
			$code = "IE";
		} elseif(strstr($email,".it") || strstr($email,".co.it")){
			$code = "IT";
		} elseif(strstr($email,".co.de") || strstr($email,".de")){
			$code = "DE";
		} elseif(strstr($email,".hk") || strstr($email,".com.hk")){
			$code = "HK";
		} elseif(strstr($email,".ca")){
			$code = "CA";
		} elseif(strstr($email,"ne.jp") || strstr($email,".jp") || strstr($email,"co.jp")){
			$code = "JP";
		} elseif(strstr($email,"co.id") || strstr($email,".id") || strstr($email,"or.id")){
			$code = "ID";
		} elseif(strstr($email,".nl")){
			$code = "NL";
		} elseif(strstr($email,".fr")){
			$code = "FR";
		} elseif(strstr($email,".cl")){
			$code = "CL";
		} elseif(strstr($email,".ge")){
			$code = "GE";
		} else {
			$code = "XX";
		}
		return $code;
	}
	public function EmailFilter($mailserver){
		$xy = array("|","\\","/","-",";"); 
		$sepe = $xy[0]; 
		foreach($xy as $v){ 
			if (substr_count($mailserver,$sepe) < substr_count($mailserver,$v)) $sepe = $v; 
		} 
		$x = explode($sepe,$mailserver); 
		foreach($xy as $y) $x = str_replace($y,"",str_replace(" ","",$x)); 
		foreach ($x as $xx){
			if (stristr($xx,"@yahoo") or stristr($xx,"@ymail") or stristr($xx,"@rocketmail")){
				return "YAHOO";
			} elseif (stristr($xx,"@hotmail") or stristr($xx,"@live.") or stristr($xx,"@msn.") or stristr($xx,"@outlook.")){ 
				return "MICROSOFT";
			} elseif (stristr($xx,"@aol.")) {
				return "AOL";
			} elseif (stristr($xx,"@gmail.") or stristr($xx,"@googlemail.")) {
				return "GOOGLE";
			} elseif (stristr($xx,"@bigpond")) {
				return "BIGPOND";
			} elseif (stristr($xx,".gov") or stristr($xx,".go") or stristr($xx,".gob")){ 
				return "GOVERNMENT";
			} elseif (stristr($xx,".edu") or stristr($xx,".sch") or stristr($xx,".ac")){ 
				return "EDUCATION";
			} elseif (stristr($xx,"@att.")){ 
				return "ATT";
			} elseif (stristr($xx,"@pya8.")){ 
				return "PY8";
			} elseif (stristr($xx,"@bellsouth.")){ 
				return "BELLSOUTH";
			} elseif (stristr($xx,"@ameritech.")){ 
				return "AMERITECH";
			} elseif (stristr($xx,"@sbcglobal.")){ 
				return "SBCGLOBAL";
			} elseif (stristr($xx,"@btinternet.")){ 
				return "BTINTERNET";
			} elseif (stristr($xx,"@juno.")){ 
				return "JUNO";
			} elseif (stristr($xx,"@mail.ru")){ 
				return "MAIL.RU";
			} elseif (stristr($xx,"@wanadoo")){ 
				return "WANADOO";
			} elseif (stristr($xx,"@ntlworld")){ 
				return "NTLWORLD";
			} elseif (stristr($xx,"@gmx")){ 
				return "GMX";
			} elseif (stristr($xx,"@web")){ 
				return "WEB";
			} else {
				return "OTHER";
			}
		}
	}
	public function chkMXX($email, $record = 'MX'){
	   list($user, $domain) = explode('@', $email);
	   return checkdnsrr($domain, $record);
	}
	public function Exec() {
		$this->timeServer = date("D M j G:i:s T Y");
		if($this->type == '0' or $this->type == '1' or $this->type == '2') {
			if ($this->email==NULL) {
				$this->error_code = -1;
				$this->msg = "Email Address not given";
				$data = array('error_code' => $this->error_code , 'msg' => $this->msg , 'time' => $this->timeServer, 'client_ip' => $this->client_ip );
				$data = json_encode($data);
				return $data;
			}else{
				if (!preg_match("/\b@\b/i", $this->email, $match)) {
					$this->error_code = -1;
					$this->msg = "Email Address format wrong";
					$data = array('error_code' => $this->error_code , 'email' => $this->email , 'msg' => $this->msg , 'time' => $this->timeServer, 'client_ip' => $this->client_ip );
					$data = json_encode($data);
					return $data;
				}else{
					$stat = $this->getCountry();
					$switcher = $stat['stat'];
					$proc_msg = $stat['msg'];
					if ($switcher == 'success') {
						$limited = $stat['limited'];
						if ($limited == 'no') {
							$this->error_code = 0;
							$this->msg = "Valid PayPal";
							$this->country = $this->listCountry($stat['coco']);
							$this->country_code = $stat['coco'];
							$this->status = "live";
							$this->domain = $this->EmailFilter($this->email);
							$data = array(
									'error_code' => $this->error_code,
									'email' => $this->email,
									'country' => $this->country,
									'country_code' => $this->country_code,
									'status' => $this->status,
									'msg' => $this->msg,
									'domain' => $this->domain,
									'time' => $this->timeServer,
									'client_ip' => $this->client_ip
									);
							$data = json_encode($data);
						}elseif ($limited == 'yes') {
							$this->error_code = 1;
							$this->msg = "Limited Valid PayPal";
							$this->country = $this->listCountry($stat['coco']);
							$this->country_code = $stat['coco'];
							$this->status = "limited";
							$this->domain = $this->EmailFilter($this->email);
							$data = array(
									'error_code' => $this->error_code,
									'email' => $this->email,
									'country' => $this->country,
									'country_code' => $this->country_code,
									'status' => $this->status,
									'msg' => $this->msg,
									'domain' => $this->domain,
									'time' => $this->timeServer,
									'client_ip' => $this->client_ip
									);
							$data = json_encode($data);
						}
						return $data;					
					}elseif ($switcher == 'captcha') {
						$this->error_code = -1;
						$this->msg = "Captcha Valid PayPal";
						$this->status = "unknown";
						$data = array(
								'error_code' => $this->error_code,
								'email' => $this->email,
								'status' => $this->status,
								'msg' => $this->msg,
								'time' => $this->timeServer,
								'client_ip' => $this->client_ip
								);
						$data = json_encode($data);
						return $data;	
					}elseif ($switcher == 'blocked') {
						$this->error_code = -1;
						$this->msg = "Blocked Valid PayPal";
						$this->status = "unknown";
						$data = array(
								'error_code' => $this->error_code,
								'email' => $this->email,
								'status' => $this->status,
								'msg' => $this->msg,
								'time' => $this->timeServer,
								'client_ip' => $this->client_ip
								);
						$data = json_encode($data);
						return $data;	
					}elseif ($switcher == 'invalid') {
						$this->error_code = 2;
						$this->msg = "Not Valid PayPal";
						$this->status = "invalid";
						$data = array(
								'error_code' => $this->error_code,
								'email' => $this->email,
								'status' => $this->status,
								'msg' => $this->msg,
								'time' => $this->timeServer,
								'client_ip' => $this->client_ip
								);
						$data = json_encode($data);
						return $data;	
					}
				}
				$this->error_code = -1;			
				$this->status = "unknown";
				$this->msg = "Unknown Valid PayPal";
				$data = array('error_code' => $this->error_code , 'email' => $this->email , 'status' => $this->status , 'msg' => $this->msg , 'time' => $this->timeServer, 'client_ip' => $this->client_ip);
				return $data;
			}
		} elseif($this->type == '3') {
			$filter = $this->EmailFilter($this->email);
			$cookies = md5($_SERVER['REMOTE_ADDR']).'.txt';
			$agent = 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_2 like Mac OS X) AppleWebKit/601.1 (KHTML, like Gecko) CriOS/47.0.2526.70 Mobile/13C71 Safari/601.1.46';
			$post = "id=" .$this->email;
			$url = 'https://iforgot.apple.com/password/verify/appleid';
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_USERAGENT, $agent);
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_COOKIESESSION, true);
			curl_setopt($curl, CURLOPT_COOKIEJAR, $cookies);
			curl_setopt($curl, CURLOPT_COOKIEFILE, $cookies);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
			curl_setopt($curl, CURLOPT_HEADER, 1);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
			$apple = curl_exec($curl);
			$ismatch1 = preg_match('/\/recovery\/options\?sstt=/', $apple);
			$ismatch2 = preg_match('/password\/authenticationmethod/', $apple);
			$ismatch3 = preg_match('/\/password\/verify\/phone\?/', $apple);
			if($ismatch1|$ismatch2|$ismatch3) {
				$result['error_code'] = 0;
				$result['status'] = "live";
				$result['email'] = $this->email;
				$result['msg'] = "Valid Apple";
				$result['domain'] = $filter;
				$result['time'] = $this->timeServer;
				$result['client_ip'] = $this->client_ip;
			} else {
				$result['error_code'] = 2;
				$result['status'] = "invalid";
				$result['email'] = $this->email;
				$result['msg'] = "Not Valid Apple";
				$result['domain'] = $filter;
				$result['time'] = $this->timeServer;
				$result['client_ip'] = $this->client_ip;
			}
			@unlink($cookies);
			return json_encode($result);
		} elseif($this->type == '4') {
			$filter = $this->EmailFilter($this->email);
			$cookies = md5($_SERVER['REMOTE_ADDR']).'.txt';
			$url = "https://ams.apple.com/pages/SignUp.jsf";
			$data = "SignUpForm=SignUpForm&SignUpForm%3AemailField=".$this->email."&SignUpForm%3AblueCenter=Continue&javax.faces.ViewState=j_id1";
			$page = $this->curl($url,"",$cookies);
			if($page) {
				$curl = $this->curl($url,$data,$cookies);
				if(preg_match('/This email address is already in use for another Apple ID account/i',$curl)) {
					$result['error_code'] = 0;
					$result['status'] = "live";
					$result['email'] = $this->email;
					$result['msg'] = "Valid Apple";
					$result['domain'] = $filter;
					$result['time'] = $this->timeServer;
					$result['client_ip'] = $this->client_ip;
				} else {
					$result['error_code'] = 2;
					$result['status'] = "invalid";
					$result['email'] = $this->email;
					$result['msg'] = "Not Valid Apple";
					$result['domain'] = $filter;
					$result['time'] = $this->timeServer;
					$result['client_ip'] = $this->client_ip;
				}
			} else {
				$result['error_code'] = -1;
				$result['status'] = "unknown";
				$result['email'] = $this->email;
				$result['msg'] = "Blocked Valid Apple";
				$result['domain'] = $filter;
				$result['time'] = $this->timeServer;
				$result['client_ip'] = $this->client_ip;
			}
			@unlink($cookies);
			return json_encode($result);
		} elseif($this->type == '5') {
			$filter = $this->EmailFilter($this->email);
			$cookies = md5($_SERVER['REMOTE_ADDR']).'.txt';
			$get = $this->curl('https://reg.ebay.com/reg/ajax?email='.urlencode($this->email).'&countryId=1&mode=5&eId=email','',$cookies);
			if(preg_match("/Your email address is already registered with eBay./i", $get)) {
				$result['error_code'] = 0;
				$result['status'] = "live";
				$result['email'] = $this->email;
				$result['msg'] = "Valid eBay";
				$result['domain'] = $filter;
				$result['time'] = $this->timeServer;
				$result['client_ip'] = $this->client_ip;
			} else {
				$result['error_code'] = 2;
				$result['status'] = "invalid";
				$result['email'] = $this->email;
				$result['msg'] = "Not Valid eBay";
				$result['domain'] = $filter;
				$result['time'] = $this->timeServer;
				$result['client_ip'] = $this->client_ip;
			}
			@unlink($cookies);
			return json_encode($result);
		} elseif($this->type == '6') {
			if (!defined('STDIN')) {
				$filter = $this->EmailFilter($this->email);
				$emails = explode("\n", $this->email);
				if (isset($_REQUEST['check']) && $_REQUEST['check'] == 'submit') {
					$a0x = base_convert(22, 4, 10);
				}
				$mf = isset($_REQUEST['mailfrom']) ? $_REQUEST['mailfrom'] : '';						
				$v = new verifier($mf);
				$checked = $v->checkemails($emails, $a0x);
				$checked_json = json_encode($checked);
				if(strpos($checked_json, '{"'.$this->email.'":"OK"') !== false) {
					$result['error_code'] = 0;
					$result['status'] = "live";
					$result['email'] = $this->email;
					$result['response'] = $checked;
					$result['msg'] = "Valid Email";
					$result['domain'] = $filter;
					$result['time'] = $this->timeServer;
					$result['client_ip'] = $this->client_ip;
				} else {
					$result['error_code'] = 2;
					$result['status'] = "invalid";
					$result['email'] = $this->email;
					$result['response'] = $checked;
					$result['msg'] = "Not Valid Email";
					$result['domain'] = $filter;
					$result['time'] = $this->timeServer;
					$result['client_ip'] = $this->client_ip;
				}
				return json_encode($result);
			} else {
				$v = new verifier();
				print_r($v->checkemails($this->email));
			}
		} else {
			$result['error_code'] = -1;
			$result['status'] = "invalid";
			$result['msg'] = "Invalid Validation Mode";
			$result['time'] = $this->timeServer;
			$result['client_ip'] = $this->client_ip;
			return json_encode($result);
		}
	}
}

$crott = new GlobalValidator;
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
if(!empty($_GET['sleep'])) {
	sleep($_GET['sleep']);
}
print_r($crott->Exec());

?>
