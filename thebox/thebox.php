<?php
##########################################
# paBox v1.6
# Lead Programmer: Matt Humphrey (PHPAlien) >> matt@phparena.net <<
# Version 1.6
# 18 May 2002
# Copyright 2002 PHP Arena. All rights reserved.
#
# Main Index Module
# Module Written by Matt Humphrey
# Module Date: 27-02-2002
# Module Version: 1.0
##########################################

ob_start("ob_gzhandler"); // Start GZIP compression

if (is_file("installer.php")) { // Check if installer.php is present
	echo "<b>Fatal Error:</b><br>\n";
	echo "paBox cannot continue untill installer.php is removed.\n";
	exit();
}

require "conf.php"; // Contains all of your box's attributes
require "connect.lib.php"; // Contains your mySQL functions
require "lang-$langpack.lib.php"; // Includes the language pack specified in conf.php
require "swearfilter.lib.php"; // Loads the swearfilter
require "smilies.lib.php"; // Loads the smilies module
require "boxcode.lib.php"; // Loads the BoxCode module

if (empty($status)) {
	$status = "ON";
} 

if ($status == "OFF") {
?>
<html>
<head>
<title><?=$sitename?> powered by paBox <?=$version?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="keywords" content="TheBox PHP Script">
<link rel="stylesheet" href="thebox.css" type="text/css">
</head>

<body bgcolor='<?=$bgcolor?>' text='#000000' leftmargin='3' topmargin='3' marginwidth='0' marginheight='0' link='#000000'>
<table width='100%' border='0' bgcolor='#000000' align='center' cellspacing='1' cellpadding='2' id='maintable'>
<tr>
	<td width='100%' align='center' id='poster'><?=$lang['offline']?></td>
</tr>
</table>
</body>
</html>
<?php
} else {

$connection = mysql_connect ($dbhost, $dbuser, $dbpass);
if ($connection == false){
  echo mysql_errno().": ".mysql_error()."<BR>";
  exit;
}

$db = mysql_select_db($dbname);

if (empty($act)) {
?>
<html>
<head>
<title><?=$sitename?> powered by paBox<?=$version?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="keywords" content="TheBox PHP Script">
<link rel="stylesheet" href="thebox.css" type="text/css">
<script language='javascript'>
function pop_up(url,width,height,size,scroll) {
	newWin = window.open(url, "pop", "width="+ width +",height="+ height +",toolbar=no,menubar=no,location=no,scrollbars="+ scroll +",resizable="+ size +"");
	newWin.focus();
}

function resetform() {
	document.addform.name.value = "";
	document.addform.site.value = "";
	document.addform.shout.value = "";
}

function checkform() {
	if (document.addform.shout.value.length > <?=$shoutlength?>) {
		alert("<?=$lang['error_shoutlength_big']?>")
		return false;
	} else if (document.addform.shout.value.length < 5) {
		alert("<?=$lang['error_shoutlength_small']?>")
		return false;
	} else {
		return true;
	}
}
</script>
</head>

<body bgcolor='<?=$bgcolor?>' text='#000000' leftmargin='3' topmargin='3' marginwidth='0' marginheight='0' link='#000000'>
<table width='100%' border='0' bgcolor='#000000' align='center' cellspacing='1' cellpadding='2' id='maintable'>
<?php

	$get = mysql_query("SELECT * FROM $tablename");
	$num = mysql_num_rows($get);
	$total = $num-$amount;

	# Which direction is the new shout going?

	if ($direction == "0") {
		if ($num  < $amount) {
			$direction = "DESC";
			$limit = "";
		} else {
			$direction = "DESC";
			$limit = "limit 0,$amount";
		}
	} elseif ($direction == "1") {
		if ($num  < $amount) {
			$direction = "";
			$limit = "";
		} else {
			$direction = "";
			$limit = "limit $total,$amount";
		}
	}
	
	# Do we want to show all?
	
	if (empty($showall)) {
		$query = "SELECT * FROM $tablename ORDER BY id $direction $limit"; // No
	} elseif ($showall == "1") {
		$query = "SELECT * FROM $tablename ORDER BY id DESC";	 // Yes
	}

	$result = mysql_query($query);

		 $numOfRows = mysql_num_rows ($result);
		  for ($i = 0; $i < $numOfRows; $i++) {
			$shout = mysql_result ($result, $i, "shout");
			$name = mysql_result ($result, $i, "name");
			$date = mysql_result ($result, $i, "date");   
			$id = mysql_result ($result, $i, "id");
			$site = mysql_result ($result, $i, "site");
			$time = mysql_result ($result, $i, "time");
			$posticon = mysql_result ($result, $i, "posticon");

			$shout = stripslashes($shout); // Removes backslahes (\) from the shout
			$shout = wordwrap($shout, 22, "\n", 1); // Stops the table stetching
			$posticon = stripslashes($posticon); // Removes backslahes (\) from the posticon HTML
			
			# Is there a site to grab?
			
			if ($site != "") {
				$details = "$posticon <a href='$site' target='_blank'>$name</a>";
			} else {
				$details = "$posticon $name";
			}

			echo "<!-- Start shout $id ($name) -->\n";
			echo "<a name='$id'>\n";
			echo "<tr>\n\t";
			echo "<td align='left' id='poster'>$details</td>\n";
			echo "</tr>\n";
			echo "<tr>\n\t";
			echo "<td align='left' id='shout'>$shout</td>\n";
			echo "</tr>\n";
			echo "<tr>\n\t";
			echo "<td align='left' id='date'>$date $lang[seperator] $time</td>\n";
			echo "</tr>\n";
			echo "</a>\n";
			echo "<!-- End shout $id ($name) -->\n\n";
		 }

	  		# This function parses the given date format (1 or 0) into text that the user can understand. Either US or GMT.
			
			if ($dateformat == "1") { // GMT time zone	
				$datefor = gmdate($date_format);		
				$timefor = gmdate($time_format);				 
				$format = "GMT";							 
			} elseif ($dateformat == "0") { // US time zone
				$datefor = date($date_format);
				$timefor = date($time_format);
				$format = "US";
			}

			# Is the swear filter enabled?
			
			if ($swearmode == "TRUE") {
				$check = $lang['on'];
			} else {
				$check = $lang['off'];
			}

			# Are smilies enabled?
			
			if ($smileys == "TRUE") {
				$emot = $lang['on'];
			} else {
				$emot = $lang['off'];
			}

			# Is BoxCode enabled?
			
			if ($boxcode == "TRUE") {
				$code = $lang['on'];
			} else {
				$code = $lang['off'];
			}

			# Do we want to show option status? (These are stuff like 'Smilies are on' etc)

			if ($optionstatus == "on") {

			echo "<tr>\n\t";
			echo "<td align='left' id='miscbgcolor1'>".$lang['times']." <span id='highlight'>$format</a></td>\n";
			echo "</tr>\n";
			echo "<tr>\n\t";
			echo "<td align='left' id='miscbgcolor2'>".$lang['swear_state']." <span id='highlight'>$check</span></a></td>\n";
			echo "</tr>\n";
			echo "<tr>\n\t";
			echo "<td align='left' id='miscbgcolor1'><a href=\"javascript:pop_up('help.php?act=smilies','220','112','no','no')\">".$lang['smilies_state']."</a> <span id='highlight'>$emot</span></td>\n";
			echo "</tr>\n\t";
			echo "<tr>\n";
			echo "<td align='left' id='miscbgcolor2'><a href=\"javascript:pop_up('help.php?act=boxcode','396','156','yes','yes')\">".$lang['boxcode_state']."</a> <span id='highlight'>$code</span></td>\n";
			echo "</tr>\n";
			
			}

			echo "<tr>\n\t";
			echo "<td align='left' id='miscbgcolor1'><a href=\"javascript:pop_up('thebox.php?showall=1','210','400','no','yes')\">".$lang['showall']."</a> ".$lang['seperator']." <a href=\"javascript:pop_up('help.php','210','400','yes','yes')\">".$lang['help']."</a></td>\n";
			echo "</tr>\n";

			# Check of the user has been here before
			
			if (empty($cname)) {
				$cname = $lang['default_name']; // Define default name if this is users first post
			}

			if (empty($csite)) {
				$csite = $lang['default_site']; // Define default website if this is users first post
			}
?>	 

<script language='javascript'>
	function addsmiley(theSmilie) {
		document.addform.shout.value += ' ' + theSmilie + ' ';
		document.addform.shout.focus();
	}
</script>

<form action='thebox.php?act=add' method='post' name='addform' onsubmit='return checkform()'>
<input type='hidden' name='date' value='<?=$datefor?>'>
<input type='hidden' name='time' value='<?=$timefor?>'>
<tr><td align='center' id='form'><?php if (!empty($message)) { echo "$message<br>"; }?><?php if ($posticonsmode == "TRUE") { doposticons($smileytheme); } ?><?=$lang['your_name']?><input type='text' name='name' value='<?=$cname?>' class='forminput'><br><?=$lang['your_site']?><input type='text' name='site' value='<?=$csite?>' class='forminput'><br><?=$lang['your_shout']?><input type='text' name='shout' value="<?=$lang['default_shout']?>" class='forminput'><br><input type="submit" value='<?=$lang['submit']?>' class='forminput'>&nbsp;<input type="button" value='<?=$lang['reset']?>' onclick='resetform()' class='forminput'>
<?php
if ($smileys == "TRUE" and $clickablesmilies == "TRUE") { // If clickable smilies are enabled, we can show clickable smilies
echo "<br>\n";
addsmiley($smileytheme);
}
echo "</td></tr>\n";
echo "</form>\n";
echo "</table>\n";
echo "</body>\n";
echo "</html>";
	
} elseif ($act == "add") {

	# Is flood control enabled?

	if ($floodcontrol == "TRUE") {			
		if (time() > $floodtime && time() < $floodtime+$timetoflood) {
			echo "<center><font face='verdana' size='2'>".$lang['flood']."</center>";
			exit();
		}
	}

	# Is the swear filter on?
	
	if ($swearmode == "TRUE") {
		$shout = stopswearing($shout);
		$check = "on";
	}
	
	# Is BoxCode enabled?
	
	if ($boxcode == "TRUE") {
		$shout = doBoxCode($shout);
		$code = "on";
	}

	# Are smilies enabled?
	
	if ($smileys == "TRUE") {
		$shout = dosmileys($shout, $smileytheme);
		$emot = "on";
	}

	# Was a name entered?

	if ($name == "") {
		$name = "$lang[no_name]";
		$message = "$lang[invalid_name]";
	}

	# Is the site format is correct? If the site does not contain a http:// the website will return invalid and site will become blank

	if (!eregi("http:\/\/", $site)) {
		$site = "";
		$message = "$lang[invalid_site]";
	}

	# Is the shouter banned?

	if ($banmode == "on") {	
		if ($banned == "yes") {
			echo "<center><font face='verdana' size='2'>$lang[banned]</center>";
			exit();
		}

		$file = file("bannedusers.php");
		foreach ($file as $ip) {
			$check = explode("|", $ip);
		}

		for ($i=0; $i<count($check); $i++) {
			if ($check[$i] == $REMOTE_ADDR) {
				setcookie("banned", "yes", time()+3600*100000);
				echo "<center><font face='verdana' size='2'>$lang[banned]</center>";
				exit();
			}
		}
	}

	$name = strip_tags($name); // Will prevent the poster posting HTML as his name
	$site = strip_tags($site); // Will prevent the poster posting HTML as his website address
	$posticon = parseposticons($posticon, $smileytheme); // Parses the post icon
	$shout = addslashes($shout); // Will escape any php characters, such as ' and $
	$ip = gethostbyname($REMOTE_ADDR); // Gets the shouters IP address
	$timestamp = time(); // Grab current UNIX time (used for flood control)
	
	$query = "INSERT INTO $tablename VALUES ('$id', '$name', '$shout', '$posticon', '$date', '$time', '$site', '$ip')";
	$result = mysql_query($query);

	# If the above query executed, we can set the cookies so if that poster posts again his/her website and name wil be remembered
	
	if ($result) {
		setcookie("floodtime", "$timestamp", time()+3600);
		setcookie("cname", "$name", time()+3600*1000);
		setcookie("csite", "$site", time()+3600*1000);
		if ($message == "") {
			header("Location:thebox.php");
		} else {
			header("Location:thebox.php?message=$message");
		}
		mysql_close();
	} else {
		echo mysql_errno().": ".mysql_error()."<BR>";
	}
} else {
	print $lang['no_act']; // If we get an un recognized action we wil get the no action specifed message
}
}

?>