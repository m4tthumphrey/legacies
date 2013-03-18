<?php
##########################################
# paBox v1.6
# Lead Programmer: Matt Humphrey (PHPAlien) >> matt@phparena.net <<
# Version 1.6
# 18 May 2002
# Copyright 2002 PHP Arena. All rights reserved.
#
# Help Module
# Module Written by Matt Humphrey
# Module Date: 27-02-2002
# Module Version: 1.0
##########################################

ob_start("ob_gzhandler"); // Start GZIP compression

include("conf.php");
include("connect.lib.php");
include("lang-$langpack.lib.php");
include("swearfilter.lib.php");
include("smilies.lib.php");

?>
<html>
<head>
<title><?=$sitename?> powered by paBox <?=$version?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="thebox.css" type="text/css">
<script language='javascript'>

function MM_findObj(n, d) { //v4.0
		var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
		d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
		if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
		for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
		if(!x && document.getElementById) x=document.getElementById(n); return x;
}

function MM_setTextOfTextfield(objName,x,newText) { //v3.0
		var obj = MM_findObj(objName); if (obj) obj.value = newText;
}

function add_smiley(code) {
	opener.document.addform.shout.value += ' ' + code + ' ';
}
</script>
</head>

<body bgcolor='<?=$bgcolor?>' text='#000000' leftmargin='0' topmargin='0' marginwidth='0' marginheight='0' link='#000000'>
<table width='100%' border='1' bordercolordark='#FFFFFF' bordercolorlight='#CCCCCC' align='center' cellspacing='1' cellpadding='2'>
	<tr>
		<td align='center'>
<?php

if ($act == "smilies") {
?>
			<table width="100%" border="0" cellspacing="0" cellpadding="2">
				<tr>
					<td valign='middle' colspan='8'><?=$lang['smilies_help']?></td>
				</tr>
				<tr align="center" valign="bottom"> 
					<td width="12%"><a href="javascript:add_smiley(':)')" onMouseOver="MM_setTextOfTextfield('tip','',':)')"><img src='smileys/<?=$smileytheme?>/<?=$smileytheme?>smile.gif' alt=':)' border="0"></a></td>
					<td width="12%"><a href="javascript:add_smiley(':(')" onMouseOver="MM_setTextOfTextfield('tip','',':(')"><img src='smileys/<?=$smileytheme?>/<?=$smileytheme?>sad.gif' alt=':(' border="0"></a></td>
					<td width="12%"><a href="javascript:add_smiley(';)')" onMouseOver="MM_setTextOfTextfield('tip','',';)')"><img src='smileys/<?=$smileytheme?>/<?=$smileytheme?>smilewinkgrin.gif' alt=';)' border="0"></a></td>
					<td width="12%"><a href="javascript:add_smiley('B)')" onMouseOver="MM_setTextOfTextfield('tip','','B)')"><img src='smileys/<?=$smileytheme?>/<?=$smileytheme?>cool.gif' alt='B)' border="0"></a></td>
					<td width="12%"><a href="javascript:add_smiley(':D')" onMouseOver="MM_setTextOfTextfield('tip','',':D')"><img src='smileys/<?=$smileytheme?>/<?=$smileytheme?>biggrin.gif' alt=':D' border="0"></a></td>
					<td width="12%"><a href="javascript:add_smiley(':P')" onMouseOver="MM_setTextOfTextfield('tip','',':P')"><img src='smileys/<?=$smileytheme?>/<?=$smileytheme?>bigrazz.gif' alt=':P' border="0"></a></td>
					<td width="12%"><a href="javascript:add_smiley(':cry:')" onMouseOver="MM_setTextOfTextfield('tip','',':cry:')"><img src='smileys/<?=$smileytheme?>/<?=$smileytheme?>cry.gif' alt=':cry:' border="0"></a></td>
					<td width="12%"><a href="javascript:add_smiley(':dead:')" onMouseOver="MM_setTextOfTextfield('tip','',':dead:')"><img src='smileys/<?=$smileytheme?>/<?=$smileytheme?>dead.gif' alt=':dead:' border="0"></a></td>
				</tr>
				<tr align="center" valign="bottom"> 
					<td width="12%"><a href="javascript:add_smiley(':laugh:')" onMouseOver="MM_setTextOfTextfield('tip','',':laugh:')"><img src='smileys/<?=$smileytheme?>/<?=$smileytheme?>laugh.gif' alt=':laugh:' border="0"></a></td>
					<td width="12%"><a href="javascript:add_smiley(':eek:')" onMouseOver="MM_setTextOfTextfield('tip','',':eek:')"><img src='smileys/<?=$smileytheme?>/<?=$smileytheme?>bigeek.gif' alt=':eek:' border="0"></a></td>
					<td width="12%"><a href="javascript:add_smiley(':rolleyes:')" onMouseOver="MM_setTextOfTextfield('tip','',':rolleyes:')"><img src='smileys/<?=$smileytheme?>/<?=$smileytheme?>rolleyes.gif' alt=':rolleyes:' border="0"></a></td>
					<td width="12%"><a href="javascript:add_smiley(':mad:')" onMouseOver="MM_setTextOfTextfield('tip','',':mad:')"><img src='smileys/<?=$smileytheme?>/<?=$smileytheme?>mad.gif' alt=':mad:' border="0"></a></td>
					<td width="12%"><a href="javascript:add_smiley(':confused:')" onMouseOver="MM_setTextOfTextfield('tip','',':confused:')"><img src='smileys/<?=$smileytheme?>/<?=$smileytheme?>confused.gif' alt=':confused:' border="0"></a></td>
					<td width="12%"><a href="javascript:add_smiley(':sigh:')" onMouseOver="MM_setTextOfTextfield('tip','',':sigh:')"><img src='smileys/<?=$smileytheme?>/<?=$smileytheme?>sigh.gif' alt=':sigh:' border="0"></a></td>
					<td width="12%"><a href="javascript:add_smiley(':yes:')" onMouseOver="MM_setTextOfTextfield('tip','',':yes:')"><img src='smileys/<?=$smileytheme?>/<?=$smileytheme?>yes.gif' alt=':yes:' border="0"></a></td>
					<td width="12%"><a href="javascript:add_smiley(':no:')" onMouseOver="MM_setTextOfTextfield('tip','',':no:')"><img src='smileys/<?=$smileytheme?>/<?=$smileytheme?>no.gif' alt=':no:' border="0"></a></td>
				</tr>
				<tr align="center" valign="bottom"> 
					<td width="12%"><a href="javascript:add_smiley(':sleep:')" onMouseOver="MM_setTextOfTextfield('tip','',':sleep:')"><img src='smileys/<?=$smileytheme?>/<?=$smileytheme?>sleep.gif' alt=':sleep:' border="0"></a></td>
					<td width="12%"><a href="javascript:add_smiley(':upset:')" onMouseOver="MM_setTextOfTextfield('tip','',':upset:')"><img src='smileys/<?=$smileytheme?>/<?=$smileytheme?>upset.gif' alt=':upset:' border="0"></a></td>
					<td width="12%"><a href="javascript:add_smiley(':shy:')" onMouseOver="MM_setTextOfTextfield('tip','',':shy:')"><img src='smileys/<?=$smileytheme?>/<?=$smileytheme?>shy.gif' alt=':shy:' border="0"></a></td>
					<td width="12%"><a href="javascript:add_smiley(':|')" onMouseOver="MM_setTextOfTextfield('tip','',':|')"><img src='smileys/<?=$smileytheme?>/<?=$smileytheme?>none.gif' alt=':|' border="0"></a></td>
					<td colspan="4" align="center">
					<input type="text" readonly name="tip" size="15" value="<?=$lang['choose_smilie']?>" class='forminput'>
					</td>
				</tr>
			</table>
<?php
} elseif ($act == "") {
?>
			<table width="100%" border="0" cellspacing="0" cellpadding="2">
				<tr align="center" valign="bottom">
					<td width='100%'><?=$lang['help_heading']?></td>
				</tr>
				<tr align="center" valign="bottom">
					<td align='left'><a href='help.php?act=smilies'>Smilies</a> - <?=$lang['help_smilies_desc']?></td>
				</tr>
				<tr align="center" valign="bottom">
					<td align='left'><a href='help.php?act=boxcode'>BoxCode</a> - <?=$lang['help_boxcode_desc']?></td>
				</tr>
				<tr align="center" valign="bottom">
					<td></td>
				</tr>
				<tr align="center" valign="bottom">
					<td><b>Can I get my own copy of paBox?</b></td>
				</tr>
				<tr align="center" valign="bottom">
					<td><?=$canget?></td>
				</tr>
				<tr align="center" valign="bottom">
					<td>Powered by <a href='http://www.phparena.net/pabox' target='_blank'>paBox <?=$version?></a><br>Copyright 2002 - <a href='http://www.phparena.net' target='_blank'>PHPArena</a></td>
				</tr>
			</table>
<?php
} elseif ($act == "boxcode") {
?>
			<table width="100%" border="0" cellspacing="0" cellpadding="2">
				<tr align="center" valign="bottom">
					<td width='100%' colspan='2'><?=$lang['boxcode_help']?></td>
				</tr>
				<tr align='center'>
					<td><b>BoxCode</b></td>
					<td><b>Converted to</b></td>
				</tr>
				<tr align="center" valign="bottom">
					<td align='left'>[url=http://www.yoursite.com]My Site[/url]</td>
					<td align='left'><a href='http://www.yoursite.com' target='_blank'>My Site</a></td>
				</tr>
				<tr align="center" valign="bottom">
					<td align='left'>[email=you@yourdomain.com]Email Me[/email]</td>
					<td align='left'><a href='mailto:you@yourdomain.com'>Email Me</a></td>
				</tr>
				<tr align="center" valign="bottom">
					<td align='left'>[b]Bold Text[/b]</td>
					<td align='left'><b>Bold Text</b></td>
				</tr>
				<tr align="center" valign="bottom">
					<td align='left'>[i]Italic Text[/i]</td>
					<td align='left'><i>Italic Text</i></td>
				</tr>
				<tr align="center" valign="bottom">
					<td align='left'>[u]Underlined Text[/u]</td>
					<td align='left'><u>Underlined Text</u></td>
				</tr>
				<tr align="center" valign="bottom">
					<td align='left'>[nl]</td>
					<td align='left'>Page break</td>
				</tr>
				<tr align="center" valign="bottom">
					<td align='left'>[move]Moving Text[/move]</td>
					<td align='left'><marquee>Moving Text</marquee></td>
				</tr>
			</table>
<?php
} elseif ($act == "date") {
?>	
			<table width="100%" border="0" cellspacing="0" cellpadding="2">
				<tr align="center" valign="bottom">
					<td width='100%' colspan='2'>You can use any of the following keys for your date format.</td>
				</tr>
				<tr align='center'>
					<td><b>Key</b></td>
					<td><b>Meaning</b></td>
				</tr>
				<tr align="center" valign="middle">
					<td align='left'>a</td>
					<td align='left'>"am" or "pm"</td>
				</tr>
				<tr align="center" valign="middle">
					<td align='left'>A</td>
					<td align='left'>"AM" or "PM"</td>
				</tr>
				<tr align="center" valign="middle">
					<td align='left'>B</td>
					<td align='left'>Swatch Internet time</td>
				</tr>
				<tr align="center" valign="middle">
					<td align='left'>d</td>
					<td align='left'>Day of the month, 2 digits with leading zeros; i.e. "01" to "31"</td>
				</tr>
				<tr align="center" valign="middle">
					<td align='left'>D</td>
					<td align='left'>Day of the week, textual, 3 letters; i.e. "Fri"</td>
				</tr>
				<tr align="center" valign="middle">
					<td align='left'>F</td>
					<td align='left'>Month, textual, long; i.e. "January"</td>
				</tr>
				<tr align="center" valign="middle">
					<td align='left'>g</td>
					<td align='left'>Hour, 12-hour format without leading zeros; i.e. "1" to "12"</td>
				</tr>
				<tr align="center" valign="middle">
					<td align='left'>G</td>
					<td align='left'>Hour, 24-hour format without leading zeros; i.e. "0" to "23"</td>
				</tr>
				<tr align="center" valign="middle">
					<td align='left'>h</td>
					<td align='left'>Hour, 12-hour format; i.e. "01" to "12"</td>
				</tr>
				<tr align="center" valign="middle">
					<td align='left'>H</td>
					<td align='left'>hour, 24-hour format; i.e. "00" to "23"</td>
				</tr>
				<tr align="center" valign="middle">
					<td align='left'>i</td>
					<td align='left'>Minutes; i.e. "00" to "59"</td>
				</tr>
				<tr align="center" valign="middle">
					<td align='left'>I</td>
					<td align='left'>"1" if Daylight Savings Time, "0" otherwise</td>
				</tr>
				<tr align="center" valign="middle">
					<td align='left'>j</td>
					<td align='left'>Day of the month without leading zeros; i.e. "1" to "31"</td>
				</tr>
				<tr align="center" valign="middle">
					<td align='left'>L</td>
					<td align='left'>Boolean for whether it is a leap year; i.e. "0" or "1</td>
				</tr>
				<tr align="center" valign="middle">
					<td align='left'>m</td>
					<td align='left'>Month; i.e. "01" to "12"</td>
				</tr>
				<tr align="center" valign="middle">
					<td align='left'>M</td>
					<td align='left'>Month, textual, 3 letters; i.e. "Jan"</td>
				</tr>
				<tr align="center" valign="middle">
					<td align='left'>n</td>
					<td align='left'>Month without leading zeros; i.e. "1" to "12"</td>
				</tr>
				<tr align="center" valign="middle">
					<td align='left'>O</td>
					<td align='left'>Difference to Greenwich time in hours; i.e. "+0200"</td>
				</tr>
				<tr align="center" valign="middle">
					<td align='left'>r</td>
					<td align='left'>RFC 822 formatted date; i.e. "Thu, 21 Dec 2000 16:01:07 +0200"</td>
				</tr>
				<tr align="center" valign="middle">
					<td align='left'>s</td>
					<td align='left'>Seconds; i.e. "00" to "59"</td>
				</tr>
				<tr align="center" valign="middle">
					<td align='left'>S</td>
					<td align='left'>English ordinal suffix for the day of the month, 2 characters; i.e. "th", "nd"</td>
				</tr>
				<tr align="center" valign="middle">
					<td align='left'>t</td>
					<td align='left'>Number of days in the given month; i.e. "28" to "31"</td>
				</tr>
				<tr align="center" valign="middle">
					<td align='left'>T</td>
					<td align='left'>Timezone setting of this machine; i.e. "MDT"</td>
				</tr>
				<tr align="center" valign="middle">
					<td align='left'>U</td>
					<td align='left'>Seconds since the epoch</td>
				</tr>
				<tr align="center" valign="middle">
					<td align='left'>w</td>
					<td align='left'>Day of the week, numeric, i.e. "0" (Sunday) to "6" (Saturday)</td>
				</tr>
				<tr align="center" valign="middle">
					<td align='left'>W</td>
					<td align='left'>ISO-8601 week number of year, weeks starting on monday (added in PHP 4.1.0) (Saturday)</td>
				</tr>
				<tr align="center" valign="middle">
					<td align='left'>Y</td>
					<td align='left'>Year, 4 digits; i.e. "1999"</td>
				</tr>
				<tr align="center" valign="middle">
					<td align='left'>y</td>
					<td align='left'>Year, 2 digits; i.e. "99"</td>
				</tr>
				<tr align="center" valign="middle">
					<td align='left'>z</td>
					<td align='left'>Day of the year; i.e. "0" to "365"</td>
				</tr>
				<tr align="center" valign="middle">
					<td align='left'>Z</td>
					<td align='left'>timezone offset in seconds (i.e. "-43200" to "43200"). The offset for timezones west of UTC is always negative, and for those east of UTC is always positive</td>
				</tr>
			</table>
<?php
}
?>
		</td>
	</tr>
</table>
</body>
</html>