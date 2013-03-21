<?php
##########################################
# paBox v1.6
# Lead Programmer: Matt Humphrey (PHPAlien) >> matt@phparena.net <<
# Version 1.6
# 18 May 2002
# Copyright 2002 PHP Arena. All rights reserved.
#
# Admin Module
# Module Written by Matt Humphrey
# Module Date: 27-02-2002
# Module Version: 1.0
##########################################

ob_start("ob_gzhandler"); // Start GZIP compression

if (is_file("installer.php")) {
	echo "<b>Fatal Error:</b><br>\n";
	echo "paBox cannot continue untill installer.php is removed.\n";
	exit();
}

function error($msg, $url) {
	echo "<html>\n";
	echo "<head>\n";
	echo "<title>paBox Admin Panel</title>\n";
	echo "<link rel='stylesheet' href='thebox.css' type='text/css'>\n";
	echo "</head>\n";
	echo "<body bgcolor='#FFFFFF'>\n";
	echo "<br><br><br><br>\n";
	echo "<center>$msg<br>\n";
	echo "<br>Taking you to back...<br><br>\n";
	echo "<a href='$url'>( Click here if you are not automatically redirected....)</a>";
	echo "<meta http-equiv='refresh' content='3; url=$url'>\n";
	echo "</center>\n\n";
	echo "</body>\n";
	echo "</html>";
}

if (empty($act)) {
?>
<html>
<head>
<title>paBox Admin Panel</title>
<link rel="stylesheet" href="thebox.css" type="text/css">
</head>
<body bgcolor='#FFFFFF'>
<table valign='middle' align='center' cellspacing='1' cellpadding='1' border='0' width='60%' height='50%'>
	<form action='admin.php?act=login' method='post'>
		<tr>
			<td valign='middle'>
				<table align='center' cellspacing='1' cellpadding='2' border='0' bgcolor='#000000' width='100%'>
					<tr>
						<td colspan='2' bgcolor='#ffffff'>Welcome to paBox Admin Panel.<br>Please login....</td>
					</tr>
					<tr bgcolor='#ffffff'>
						<td width='50%'>Username:</td>
						<td width='50%'><input type='text' name='username' class='forminput'></td>
					</tr>
					<tr bgcolor='#ffffff'>
						<td width='50%'>Password:</td>
						<td width='50%'><input type='password' name='password' class='forminput'></td>
					</tr>
					<tr>
						<td colspan='2' align='center' bgcolor='#ffffff'><input type='submit' value='Log in..' class='forminput'></td>
					</tr>
				</table>
			</td>
		</tr>
	</form>
</table>
</body>
</html>

<?php
} elseif ($act == "login") {
	include("conf.php");
	if ($username == "$aduser" && $password == "$adpass") {
		setcookie("cookie[user]", $username, time()+3600);
		setcookie("cookie[pass]", $password, time()+3600);
		echo "<html>\n";
		echo "<head>\n";
		echo "<title>paBox Admin Panel</title>\n";
		echo "<link rel='stylesheet' href='thebox.css' type='text/css'>\n";
		echo "</head>\n";
		echo "<body bgcolor='#FFFFFF'>\n";
		echo "<br><br><br><br>\n";
		echo "<center>Thanks for loggin in, $username!<br>\n";
		echo "<br>Now taking you to your admin panel...<br><br>\n";
		echo "<a href='admin.php?act=main'>( Click here if you are not automatically redirected....</a>";
		echo "<meta http-equiv='refresh' content='3; url=admin.php?act=main'>\n";
		echo "</center>\n\n";
		echo "</body>\n";
		echo "</html>";
	} else {
		error("Your login details were incorrect", "admin.php");
	}
} elseif ($act == "main") {
	include("conf.php");
	if ($cookie['user'] == "$aduser" && $cookie['pass'] == "$adpass") {

?>
<html>
<head>
<title>paBox Admin Panel</title>
<link rel="stylesheet" href="thebox.css" type="text/css">
<script language='javascript'>
function pop_up(url,width,height,size,scroll) {
	newWin = window.open(url, "pop", "width="+ width +",height="+ height +",toolbar=no,menubar=no,location=no,scrollbars="+ scroll +",resizable="+ size +"");
	newWin.focus();
}
</script>
</head>
<body bgcolor='#FFFFFF'>
<table valign='middle' align='center' cellspacing='1' cellpadding='1' border='0' width='60%' height='50%'>
	<form action='admin.php?act=write' method='post'>
		<tr>
			<td valign='middle'>
				<table align='center' cellspacing='1' cellpadding='2' border='0' bgcolor='#000000' width='100%'>
					<tr>
						<td colspan='2' bgcolor='#ffffff'>Welcome to paBox Admin Panel.<br>This is where you can edit the way paBox works and looks.</td>
					</tr>
					<tr bgcolor='#ffffff'>
						<td colspan='2'><b>Settings...</b></td>
					</tr>
					<tr bgcolor='#ffffff'>
						<td width='50%'>Box Status:<br><span id='small'>Is the box enabled?</span></td>
						<td width='50%'><select name='status' class='forminput'>
						<?php
						$array['status'] = array('ON' => 'On', 'OFF' => 'Off');
						while(list($key, $selname)=each($array['status'])) {
						   echo"<option value='$key'";
						   if($status == $key) {
							   echo" selected";
						   }
						   echo">$selname</option>\r\n";
						}

						?>
						</select></td>
					</tr>
					<tr bgcolor='#ffffff'>
						<td width='50%'>Shouts shown:<br><span id='small'>This is the amount of shouts shown in the iframe!</span></td>
						<td width='50%'><input type='text' name='amount' value='<?=$amount?>' size='4' maxlength='4' class='forminput'></td>
					</tr>
					<tr bgcolor='#ffffff'>
						<td width='50%'>Flood Control:<br><span id='small'>Do you want floodcontrol on? Yes is recommended.</span></td>
						<td width='50%'><select name='floodcontrol' class='forminput'>
						<?php
						$array['floodcontrol'] = array('TRUE' => 'Yes', 'FALSE' => 'No');
						while(list($key, $selname)=each($array['floodcontrol'])) {
						   echo"<option value='$key'";
						   if($floodcontrol == $key) {
							   echo" selected";
						   }
						   echo">$selname</option>\r\n";
						}

						?>
						</select></td>
					</tr>
					<tr bgcolor='#ffffff'>
						<td width='50%'>Time to Flood:<br><span id='small'>How many seconds to you want to have between each post? Will only work if floodcontrol is enabled.</span></td>
						<td width='50%'><input type='text' name='timetoflood' value='<?=$timetoflood?>' size='4' maxlength='4' class='forminput'></td>
					</tr>
					<tr bgcolor='#ffffff'>
						<td width='50%'>Swearmode:<br><span id='small'>Do you want the swearfilter on?</span></td>
						<td width='50%'><select name='swearmode' class='forminput'>
						<?php
						$array['swearmode'] = array('TRUE' => 'Yes', 'FALSE' => 'No');
						while(list($key, $selname)=each($array['swearmode'])) {
						   echo"<option value='$key'";
						   if($swearmode == $key) {
							   echo" selected";
						   }
						   echo">$selname</option>\r\n";
						}

						?>
						</select></td>
					</tr>
					<tr bgcolor='#ffffff'>
						<td width='50%'>Posticons:<br><span id='small'>Do you want the posticons enabled?</span></td>
						<td width='50%'><select name='posticonsmode' class='forminput'>
						<?php
						$array['posticons'] = array('TRUE' => 'Yes', 'FALSE' => 'No');
						while(list($key, $selname)=each($array['posticons'])) {
						   echo"<option value='$key'";
						   if($posticonsmode == $key) {
							   echo" selected";
						   }
						   echo">$selname</option>\r\n";
						}

						?>
						</select></td>
					</tr>
					<tr bgcolor='#ffffff'>
						<td width='50%'>Smiley Mode:<br><span id='small'>Do you want the smilies enabled?</span></td>
						<td width='50%'><select name='smileys' class='forminput'>
						<?php
						$array['smilies'] = array('TRUE' => 'Yes', 'FALSE' => 'No');
						while(list($key, $selname)=each($array['smilies'])) {
						   echo"<option value='$key'";
						   if($smileys == $key) {
							   echo" selected";
						   }
						   echo">$selname</option>\r\n";
						}

						?>
						</select></td>
					</tr>
					<tr bgcolor='#ffffff'>
						<td width='50%'>Clickable Smilies:<br><span id='small'>Do you want the clickable smilies enabled? Smiley mode must be on.</span></td>
						<td width='50%'><select name='clickablesmilies' class='forminput'>
						<?php
						$array['clickablesmilies'] = array('TRUE' => 'Yes', 'FALSE' => 'No');
						while(list($key, $selname)=each($array['clickablesmilies'])) {
						   echo"<option value='$key'";
						   if($clickablesmilies == $key) {
							   echo" selected";
						   }
						   echo">$selname</option>\r\n";
						}

						?>
						</select></td>
					</tr>
					<tr bgcolor='#ffffff'>
						<td width='50%'>BoxCode:<br><span id='small'>Do you want BoxCode enabled? BoxCode consists of certain HTML tags, which can be used, using tages such as [i] and [/i] will return itallic text.</span></td>
						<td width='50%'><select name='boxcode' class='forminput'>
						<?php
						$array['boxcode'] = array('TRUE' => 'Yes', 'FALSE' => 'No');
						while(list($key, $selname)=each($array['boxcode'])) {
						   echo"<option value='$key'";
						   if($boxcode == $key) {
							   echo" selected";
						   }
						   echo">$selname</option>\r\n";
						}

						?>
						</select></td>
					</tr>
					<tr bgcolor='#ffffff'>
						<td width='50%'>Option Status Display:<br><span id='small'>Do you want the options states displayed? Such as smiles are on etc.</span></td>
						<td width='50%'><select name='optionstatus' class='forminput'>
						<?php
						$array['optionstatus'] = array('on' => 'Yes', 'off' => 'No');
						while(list($key, $selname)=each($array['optionstatus'])) {
						   echo"<option value='$key'";
						   if($optionstatus == $key) {
							   echo" selected";
						   }
						   echo">$selname</option>\r\n";
						}

						?>
						</select></td>
					</tr>
					<tr bgcolor='#ffffff'>
						<td width='50%'>Time Zone:<br><span id='small'>Which time format are you in?</span></td>
						<td width='50%'><select name='dateformat' class='forminput'>
						<?php
						$array['datezone'] = array('1' => 'UK', '0' => 'US');
						while(list($key, $selname)=each($array['datezone'])) {
						   echo"<option value='$key'";
						   if($dateformat == $key) {
							   echo" selected";
						   }
						   echo">$selname</option>\r\n";
						}

						?>
						</select></td>
					</tr>
					<tr bgcolor='#ffffff'>
						<td width='50%'>Date Format:<br><span id='small'>You will need to use <a href="javascript:pop_up('help.php?act=date','480','600')">this key</a> to choose the format you want to use.</span></td>
						<td width='50%'><input type='text' name='date_format' value='<?=$date_format?>' size='10' maxlength='10' class='forminput'></td>
					</tr>
					<tr bgcolor='#ffffff'>
						<td width='50%'>Time Format:<br><span id='small'>You will need to use <a href="javascript:pop_up('help.php?act=date','480','600')">this key</a> to choose the format you want to use.</span></td>
						<td width='50%'><input type='text' name='time_format' value='<?=$time_format?>' size='10' maxlength='10' class='forminput'></td>
					</tr>
					<tr bgcolor='#ffffff'>
						<td width='50%'>Shout Length:<br><span id='small'>What is the maximum allowed characters in a shout?</span></td>
						<td width='50%'><input type='text' name='shoutlength' value='<?=$shoutlength?>' size='4' maxlength='10' class='forminput'></td>
					</tr>
					<tr bgcolor='#ffffff'>
						<td width='50%'>Ban Mode:<br><span id='small'>Do you want to be able to ban certain users from using your Box?</span></td>
						<td width='50%'><select name='banmode' class='forminput'>
						<?php
						$array['banmode'] = array('on' => 'Yes', 'off' => 'No');
						while(list($key, $selname)=each($array['banmode'])) {
						   echo"<option value='$key'";
						   if($banmode == $key) {
							   echo" selected";
						   }
						   echo">$selname</option>\r\n";
						}

						?>
						</select></td>
					</tr>
					<?php
							if ($banmode == "on") {
						?>
					<tr bgcolor='#ffffff'>
						<td width='50%'>Edit banned IP's:<br><span id='small'>One per line. If this box is empty, IP banning must be set to off.</span></td>
						<td width='50%'><?php
							$file = file("bannedusers.php");
		foreach ($file as $ip) {
			$check = explode("|", $ip);
		}
		echo "<textarea class='forminput' cols='50' rows='5' name='bannedusers'>\n";
		for ($i=0; $i<count($check); $i++) {
			echo "$check[$i]\n";
		}
		echo "</textarea>\n";
		?></td>
					</tr>
					<?php
						}
					?>
					<tr bgcolor='#ffffff'>
						<td width='50%'>Direction of Posts:<br><span id='small'>How do u want the shouts to be added? Top is recommended.</span></td>
						<td width='50%'><select name='direction' class='forminput'>
						<?php
						$array['direction'] = array('1' => 'Bottom', '0' => 'Top');
						while(list($key, $selname)=each($array['direction'])) {
						   echo"<option value='$key'";
						   if($direction == $key) {
							   echo" selected";
						   }
						   echo">$selname</option>\r\n";
						}

						?>
						</select></td>
					</tr>
					<tr bgcolor='#ffffff'>
						<td width='50%'>Language Pack:<br><span id='small'>The language pack used in your Box. The pack MUST be named lang-&lt;packname&gt;.lib.php and should already be uploaded.</span></td>
						<td width='50%'><select name='langpack' class='forminput'>
						<?php			
						$dir = opendir(".");
						$size = count($dir);
						while ($file = readdir($dir)) { 
							if (preg_match("/lang-\w+\.lib\.php/", $file)) {
								$filename = preg_replace("/lang-(\w+)\.lib\.php/", "$1", $file);
								if ($langpack == $filename) {
									$filename1 = ucfirst($filename);
									echo "<option value='$filename' selected>$filename1</option>\n\t";
								} else {
									$filename1 = ucfirst($filename);
									echo "<option value='$filename'>$filename1</option>\n\t";
								}
							}
						}
						closedir($dir);
						echo "</select>\n\t";
						?></td>
					</tr>
					<tr bgcolor='#ffffff'>
						<td width='50%'>Edit Language Attributes:</td>
						<td width='50%'><input type='button' value='Click here' onclick="window.location='admin.php?act=lang'" class='forminput'></td>
					</tr>
					<tr bgcolor='#ffffff'>
						<td width='50%'>View log:<br><span id='small'>This will show all of the shouts in your database with the poster's ip addresses. You can delete and edit shouts using this log.</span></td>
						<td width='50%'><input type='button' value='Click here' onclick="window.location='admin.php?act=log'" class='forminput'></td>
					</tr>
					<tr bgcolor='#ffffff'>
						<td colspan='2'><b>Styles and your site...</b></td>
					</tr>
					<tr bgcolor='#ffffff'>
						<td width='50%'>Sitename:<br><span id='small'>Your site name...</span></td>
						<td width='50%'><input type='text' name='sitename' value='<?=$sitename?>' class='forminput'></td>
					</tr>
					<tr bgcolor='#ffffff'>
						<td width='50%'>Background Color:<br><span id='small'>The backgorund color used around your site. Please DO NOT use a #</span></td>
						<td width='50%'><input type='text' name='bgcolor' value='<?=$bgcolor?>' class='forminput'></td>
					</tr>
					<tr bgcolor='#ffffff'>
						<td width='50%'>Domain Cookie:<br><span id='small'>If your domain was http://www.yourdomain.com, your domain cookie would be .yourdomain.com</span></td>
						<td width='50%'><input type='text' name='domain_cookie' value='<?=$domain_cookie?>' class='forminput'></td>
					</tr>
					<tr bgcolor='#ffffff'>
						<td width='50%'>Smiliey theme:<br><span id='small'>The color of the smilies used in your Box</span></td>
						<td width='50%'><select name='smileytheme' class='forminput'>
						<?php
						$smileydir = opendir("smileys/");
						while ($theme = readdir($smileydir)) { 
							if ($theme != "." && $theme != ".." && !eregi(".gif", $theme)) {
								if ($smileytheme == $theme) {
									echo "<option value='$theme' selected>$theme</option>\n\t";
								} else {
									echo "<option value='$theme'>$theme</option>\n\t";
								}
							}
						}
						closedir($smileydir);
						echo "</select>\n\t";
						?></td>
					</tr>
					<tr bgcolor='#ffffff'>
						<td width='50%'>Edit CSS File:<br><span id='small'>This is where you can edit your CSS stylesheet.</span></td>
						<td width='50%'><input type='button' value='Click here' onclick="window.location='admin.php?act=css'" class='forminput'></td>
					</tr>
					<tr bgcolor='#ffffff'>
						<td colspan='2'><b>Admin Details...</b></td>
					</tr>
					<tr bgcolor='#ffffff'>
						<td width='50%'>Admin Username:<br><span id='small'>The username you use to gain access to this admin panel.</span></td>
						<td width='50%'><input type='text' name='aduser' value='<?=$aduser?>' class='forminput'></td>
					</tr>
					<tr bgcolor='#ffffff'>
						<td width='50%'>Admin Password:<br><span id='small'>The password you use to gain access to this admin panel.</span></td>
						<td width='50%'><input type='password' name='adpass' value='<?=$adpass?>' class='forminput'></td>
					</tr>
					<tr>
						<td colspan='2' align='center' bgcolor='#ffffff'><input type='submit' value='Apply...' class='forminput'></td>
					</tr>
				</table>
			</td>
		</tr>
	</form>
</table>
</body>
</html>

<?php
	} else {
		error("Your cookies have expired or the login details were incorrect", "admin.php");
	}

} elseif ($act == "write") {
	echo "<html>\n";
	echo "<head>\n";
	echo "<title>paBox Admin Panel</title>\n";
	echo "<link rel='stylesheet' href='thebox.css' type='text/css'>\n";
	echo "</head>\n";
	echo "<body bgcolor='#FFFFFF'>\n";
	echo "<br><br><br><br>\n";
	$fp = fopen("conf.php", "w");
	$data = "<?php\n\n";
	$data .= "\$version = \"1.6\";\n";
	$data .= "\$canget = \"You can get paBox $version from <a href='http://www.http://www.acuitynetwork/index.php?p=downloads'>ACN</a> :)\";\n";
	$data .= "\$status = \"$status\";\n";
	$data .= "\$amount = \"$amount\";\n";
	$data .= "\$swearmode = \"$swearmode\";\n";
	$data .= "\$smileys = \"$smileys\";\n";
	$data .= "\$posticonsmode = \"$posticonsmode\";\n";
	$data .= "\$clickablesmilies = \"$clickablesmilies\";\n";
	$data .= "\$boxcode = \"$boxcode\";\n";
	$data .= "\$floodcontrol = \"$floodcontrol\";\n";
	$data .= "\$timetoflood = \"$timetoflood\";\n";
	$data .= "\$optionstatus = \"$optionstatus\";\n";
	$data .= "\$langpack = \"$langpack\";\n";
	$data .= "\$dateformat = \"$dateformat\";\n";
	$data .= "\$date_format = \"$date_format\";\n";
	$data .= "\$time_format = \"$time_format\";\n";
	$data .= "\$shoutlength = \"$shoutlength\";\n";
	$data .= "\$sitename = \"$sitename\";\n";
	$data .= "\$bgcolor = \"$bgcolor\";\n";
	$data .= "\$domain_cookie = \"$domain_cookie\";\n";
	$data .= "\$smileytheme = \"$smileytheme\";\n";
	$data .= "\$direction = \"$direction\";\n";
	$data .= "\$banmode = \"$banmode\";\n";
	$data .= "\$aduser = \"$aduser\";\n";
	$data .= "\$adpass = \"$adpass\";\n\n";
	$data .= "?>";
	fwrite($fp, $data);
	fclose($fp);
	include("conf.php");
	if ($banmode == "on") {
		if ($bannedusers != "") {
			$busers = fopen("bannedusers.php", "w");
			$bannedusers = str_replace("\r\n", "|", $bannedusers);
			fwrite($busers, $bannedusers);
			fclose($busers);
		}
	}
	echo "<meta http-equiv='refresh' content='2; url=admin.php?act=main'>\n";
	echo "<center>Your details have been updated!<br><br>Taking you back...<br><br><a href='admin.php?act=main'>( Click here if you are not automatically redirected....)</a>\n"; 
	echo "</center>\n\n";
	echo "</body>\n";
	echo "</html>";

} elseif ($act == "lang") {
	include("conf.php");
	if ($cookie['user'] == "$aduser" && $cookie['pass'] == "$adpass") {
?>
<html>
<head>
<title>paBox Admin Panel</title>
<link rel="stylesheet" href="thebox.css" type="text/css">
</head>
<body bgcolor='#FFFFFF'>
<table valign='middle' align='center' cellspacing='1' cellpadding='1' border='0' width='60%' height='50%'>
	<tr>
		<td valign='middle'>
			<table align='center' cellspacing='1' cellpadding='2' border='0' bgcolor='#000000' width='100%'>
				<form action='admin.php?act=lang&do=write' method='post' name='langform'>
					<tr>
						<td colspan='2' bgcolor='#ffffff'>Welcome to paBox Admin Panel<br><a href='admin.php?act=main'>Main</a> | Language Attributes</td>
					</tr>
				<?php
if (empty($do)) {
	include_once("lang-$langpack.lib.php");
}

	foreach ($lang as $one => $two) {
		echo "<tr bgcolor='#FFFFFF'>\n\t<td width='50%'>$one</td>\n\t<td width='50%'><input type='text' name='lang[$one]' value='$two' size='75' class='forminput'></td>\n</tr>\n";
	}

?>
					<tr>
						<td colspan='2' bgcolor='#ffffff' align='center'><input type='submit' value='Apply...' class='forminput'></td>
					</tr>
				</form>
			</table>
		</td>
	</tr>
</table>
</body>
</html>
<?php
	if (empty($do)) {
	} else if ($do == "write") {
		$fp = fopen("lang-$langpack.lib.php", "w");
		$data = "<?php\n\n";
		$data .= "\$lang = array(\n\t";
		foreach($lang as $abc => $lang[$one]) {
			$data .= "\"$abc\" => \"$lang[$one]\",\n\t";
		}
		$data .= ");";
		$data .= "\n";
		$data .= "?>";
		fwrite($fp, $data);
		fclose($fp);
	}

	} else {
		error("Your cookies have expired or the login details were incorrect", "admin.php");
	}
} elseif ($act == "log") {
	include("conf.php");
	if ($cookie['user'] == "$aduser" && $cookie['pass'] == "$adpass") {
		include("connect.lib.php");
		$connection = mysql_connect ($dbhost, $dbuser, $dbpass);
		if ($connection == false){
		  echo mysql_errno().": ".mysql_error()."<BR>";
		  exit;
		}

		$db = mysql_select_db($dbname);
		$numresults=mysql_query("SELECT * FROM $tablename");
		$numrows=mysql_num_rows($numresults);
?>
<html>
<head>
<title>paBox Admin Panel</title>
<link rel="stylesheet" href="thebox.css" type="text/css">
<script language='javascript'>
    function del_shout(url) {
       if (confirm("Are you sure you want to delete this shout?")) {
          window.location.href=url;
       }
	}
</script>
</head>
<body bgcolor='#FFFFFF'>
<table valign='middle' align='center' cellspacing='1' cellpadding='1' border='0' width='60%' height='50%'>
	<tr>
		<td valign='middle'>
			<table align='center' cellspacing='1' cellpadding='2' border='0' bgcolor='#000000' width='100%'>
				<tr>
					<td colspan='4' bgcolor='#ffffff'>Welcome to paBox Admin Panel<br><a href='admin.php?act=main'>Main</a> | Log</td>
				</tr>
				<tr>
					<td colspan='4' bgcolor='#ffffff'>This log shows all the posts with the posters IP address. This can be used for IP banning and deleting posts. To view a post, simply click the shouters name.<br>You have <?=$numrows?> shouts in the database.</td>
				</tr>
				<tr bgcolor='#ffffff'>
					<td align='center' width='30%'><b>Name</b></td>
					<td align='center' width='20%'><b>IP</b></td>
					<td align='center' width='20%'><b>Edit?</b></td>
					<td align='center' width='30%'><b>Delete?</b></td>
				</tr>
<?php

		if (empty($do)) {
		} elseif ($do == "del") {
			$query = mysql_query("DELETE FROM $tablename WHERE id='$id'");
			if ($query) {
				echo "<tr bgcolor='#ffffff'><td colspan='4' align='center'>Shout number $id was deleted successfully</td></tr>\n";
			} else {
				echo "<tr bgcolor='#ffffff'><td colspan='4' align='center'>".mysql_errno().": ".mysql_error()."</td></tr>\n";
			}
		} elseif ($do == "shout") {
			$query = mysql_query("SELECT * FROM $tablename WHERE id='$id'");
			while ($row = mysql_fetch_array($query)) {
				$row['shout'] = stripslashes($row['shout']);
				echo "<tr bgcolor='#ffffff'><td colspan='4' align='center'>Shout for ".$row["id"]."<br><table border='0' cellpadding='1' cellspacing='1' width='95%' bgcolor='#000000'><tr bgcolor='#FFFFFF'><td align='center'>".$row["shout"]."</td></tr></table><br></td></tr>\n";
			}
		} elseif ($do == "edit") {
			if (empty($write)) {
				$query = mysql_query("SELECT * FROM $tablename WHERE id='$id'");
				echo "<form action='admin.php?act=log&offset=$offset&do=edit&write=1' method='post'>\n";
				while ($row = mysql_fetch_array($query)) {
					$row['shout'] = stripslashes($row['shout']);
					echo "<input type='hidden' name='id' value='".$row["id"]."'>\n";
					echo "<tr bgcolor='#ffffff'><td colspan='4' align='center' valign='middle'>Shout for ".$row["id"]."<br><table border='0' cellpadding='1' cellspacing='1' width='95%' bgcolor='#000000'><tr bgcolor='#FFFFFF'><td align='center'>".$row["shout"]."</td></tr></table><br><textarea name='shout' rows='3' class='forminput' style='width:95%;'>".$row["shout"]."</textarea><br><input type='submit' value='Edit this Shout' class='forminput'></td></tr>\n";
				}
				echo "</form>\n";
			} elseif ($write == 1) {
				$shout = addslashes($shout);
				$query = mysql_query("UPDATE $tablename SET shout='$shout' WHERE id='$id'");
				if ($query) {
					echo "<tr bgcolor='#ffffff'><td colspan='4' align='center'>Shout number $id has been edited successfully</td></tr>\n";
				} else {
					echo "<tr bgcolor='#ffffff'><td colspan='4' align='center'>".mysql_errno().": ".mysql_error()."</td></tr>\n";
				}
			}
		}

		if (empty($offset)) {
			$offset = "0";
		}
		
		$limit = 30;
		$query = mysql_query("SELECT * FROM $tablename ORDER BY id DESC LIMIT $offset,$limit");
		$num = mysql_num_rows($query);
		
		echo "<tr bgcolor='#ffffff'><td colspan='4' align='center'>";
		if ($numrows < $limit) {
			echo "Single page";
		} else {
			echo "Pages: ";
		
			if ($offset!=0) {
				$prevoffset=$offset-$limit;
				print "<a href=\"$PHP_SELF?act=log&offset=$prevoffset\"> &laquo; Prev</a>&nbsp;\n";
			}
			$pages=intval($numrows/$limit);

			if ($numrows%$limit) {
				$pages++;
			}

			for ($i=1;$i<=$pages;$i++) {
				$newoffset=$limit*($i-1);
				print "<a href=\"$PHP_SELF?act=log&offset=$newoffset\">$i</a>&nbsp;\n";
			}

			if ((($offset/$limit)!=$pages) && $pages!=1) {
				$newoffset=$offset+$limit;
				print "<a href=\"$PHP_SELF?act=log&offset=$newoffset\">Next &raquo;</a>\n";
			}		
		}
		echo "</td></tr>\n";
		while ($row = mysql_fetch_array($query)) {
		echo "<tr bgcolor='#ffffff'><td align='center'><a href='admin.php?act=log&offset=$offset&do=shout&id=".$row["id"]."'>".$row["name"]."</a></td><td align='center'>".$row["ip"]."</td><td align='center'><a href='admin.php?act=log&offset=$offset&do=edit&id=".$row["id"]."'>Edit Shout</a></td><td align='center'><a href=\"javascript:del_shout('admin.php?act=log&offset=$offset&do=del&id=".$row["id"]."')\">Delete Shout</a></td></tr>\n";
		}
		mysql_free_result($query);
		mysql_close();
		echo "</table>\n";
		echo "</td>\n";
		echo "</tr>\n";
		echo "</table>\n";
		echo "</body>\n";
		echo "</html>\n";
	} else {
		error("Your cookies have expired or the login details were incorrect", "admin.php");
	}
} elseif ($act == "css") {
	include("conf.php");
	if ($cookie['user'] == "$aduser" && $cookie['pass'] == "$adpass") {
		$fp = fopen("thebox.css", "r");
		$css = fread($fp, filesize("thebox.css"));
		$css = stripslashes($css);
		fclose($fp);
?>
<html>
<head>
<title>paBox Admin Panel</title>
<link rel="stylesheet" href="thebox.css" type="text/css">
</head>
<body bgcolor='#FFFFFF'>
<table valign='middle' align='center' cellspacing='1' cellpadding='1' border='0' width='60%' height='50%'>
	<tr>
		<td valign='middle'>
			<table align='center' cellspacing='1' cellpadding='2' border='0' bgcolor='#000000' width='100%'>
				<form action='admin.php?act=css&do=write' method='post' name='langform'>
					<tr>
						<td colspan='2' bgcolor='#ffffff'>Welcome to paBox Admin Panel<br><a href='admin.php?act=main'>Main</a> | CSS Editor</td>
					</tr>
					<tr>
						<td colspan='2' bgcolor='#ffffff'>This is where you can edit your css online.</td>
					</tr>
<?php
					if (empty($do)) {
						$do = "";
					} elseif ($do == "write") {
						$fp1 = fopen("thebox.css", "w");
						$newcss = stripslashes($newcss);
						$newcss = str_replace("\r\n", "\n", $newcss);
						$update = fwrite($fp1, $newcss);
						if ($update) {
							echo "<tr>	<td colspan='2' bgcolor='#ffffff' align='center'>Your CSS file updated successfully!</td></tr>\n";
						} else {
							echo "<tr>	<td colspan='2' bgcolor='#ffffff' align='center'>Your CSS file could NOT be updated..</td></tr>\n";
						}
						fclose($fp1);
					}
?>
					<tr>
						<td colspan='2' bgcolor='#ffffff' align='center'><textarea name='newcss' rows='20' style='width:95%' class='forminput'><?=$css?></textarea></td>
					</tr>
					<tr>
						<td colspan='2' bgcolor='#ffffff' align='center'><input type='submit' value='Apply...' class='forminput'></td>
					</tr>
				</form>
			</table>
		</td>
	</tr>
</table>
</body>
</html>
<?php
	} else {
		error("Your cookies have expired or the login details were incorrect", "admin.php");
	}
} else {
	include("conf.php");
	include("lang-$langpack.lib.php");
	echo "$lang[no_act]"; // If we get an un recognized action we wil get the no action specifed message
}

?>