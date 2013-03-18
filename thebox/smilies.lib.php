<?php
##########################################
# paBox v1.6
# Lead Programmer: Matt Humphrey (PHPAlien) >> matt@phparena.net <<
# Version 1.6
# 18 May 2002
# Copyright 2002 PHP Arena. All rights reserved.
#
# Emoticon Module
# Module Written by Matt Humphrey
# Module Date: 27-02-2002
# Module Version: 1.0
##########################################

function dosmileys($text, $smileytheme) { // This parses the text into emoticons

    $emoticon = array(
	   ":EEK:" => "<img src='smileys/".$smileytheme."/".$smileytheme."bigeek.gif' alt='' align='absmiddle'>",
	   ":ROLLEYES:" => "<img src='smileys/".$smileytheme."/".$smileytheme."rolleyes.gif' alt='' align='absmiddle'>",
	   ":MAD:" => "<img src='smileys/".$smileytheme."/".$smileytheme."mad.gif' alt='' align='absmiddle'>",
	   ":CONFUSED:" => "<img src='smileys/".$smileytheme."/".$smileytheme."confused.gif' alt='' align='absmiddle'>",
	   ":SIGH:" => "<img src='smileys/".$smileytheme."/".$smileytheme."sigh.gif' alt='' align='absmiddle'>",
	   ":YES:" => "<img src='smileys/".$smileytheme."/".$smileytheme."yes.gif' alt='' align='absmiddle'>",
	   ":NO:" => "<img src='smileys/".$smileytheme."/".$smileytheme."no.gif' alt='' align='absmiddle'>",
	   ":SLEEP:" => "<img src='smileys/".$smileytheme."/".$smileytheme."sleep.gif' alt='' align='absmiddle'>",
	   ":UPSET:" => "<img src='smileys/".$smileytheme."/".$smileytheme."upset.gif' alt='' align='absmiddle'>",
	   ":SHY:" => "<img src='smileys/".$smileytheme."/".$smileytheme."shy.gif' alt='' align='absmiddle'>",
	   ":NONE:" => "<img src='smileys/".$smileytheme."/".$smileytheme."none.gif' alt='' align='absmiddle'>",
	   ":LAUGH:" => "<img src='smileys/".$smileytheme."/".$smileytheme."laugh.gif' alt='' align='absmiddle'>",
	   ":DEAD:" => "<img src='smileys/".$smileytheme."/".$smileytheme."dead.gif' alt='' align='absmiddle'>",
	   ":CRY:" => "<img src='smileys/".$smileytheme."/".$smileytheme."cry.gif' alt='' align='absmiddle'>",
	   ":eek:" => "<img src='smileys/".$smileytheme."/".$smileytheme."bigeek.gif' alt='' align='absmiddle'>",
	   ":rolleyes:" => "<img src='smileys/".$smileytheme."/".$smileytheme."rolleyes.gif' alt='' align='absmiddle'>",
	   ":mad:" => "<img src='smileys/".$smileytheme."/".$smileytheme."mad.gif' alt='' align='absmiddle'>",
	   ":confused:" => "<img src='smileys/".$smileytheme."/".$smileytheme."confused.gif' alt='' align='absmiddle'>",
	   ":sigh:" => "<img src='smileys/".$smileytheme."/".$smileytheme."sigh.gif' alt='' align='absmiddle'>",
	   ":yes:" => "<img src='smileys/".$smileytheme."/".$smileytheme."yes.gif' alt='' align='absmiddle'>",
	   ":no:" => "<img src='smileys/".$smileytheme."/".$smileytheme."no.gif' alt='' align='absmiddle'>",
	   ":sleep:" => "<img src='smileys/".$smileytheme."/".$smileytheme."sleep.gif' alt='' align='absmiddle'>",
	   ":upset:" => "<img src='smileys/".$smileytheme."/".$smileytheme."upset.gif' alt='' align='absmiddle'>",
	   ":shy:" => "<img src='smileys/".$smileytheme."/".$smileytheme."shy.gif' alt='' align='absmiddle'>",
	   ":laugh:" => "<img src='smileys/".$smileytheme."/".$smileytheme."laugh.gif' alt='' align='absmiddle'>",
	   ":dead:" => "<img src='smileys/".$smileytheme."/".$smileytheme."dead.gif' alt='' align='absmiddle'>",
	   ":cry:" => "<img src='smileys/".$smileytheme."/".$smileytheme."cry.gif' alt='' align='absmiddle'>",
	   ":)" => "<img src='smileys/".$smileytheme."/".$smileytheme."smile.gif' alt='' align='absmiddle'>",
	   ":(" => "<img src='smileys/".$smileytheme."/".$smileytheme."sad.gif' alt='' align='absmiddle'>",
	   ";)" => "<img src='smileys/".$smileytheme."/".$smileytheme."smilewinkgrin.gif' alt='' align='absmiddle'>",
	   ":|" => "<img src='smileys/".$smileytheme."/".$smileytheme."none.gif' alt='' align='absmiddle'>",
	   ":-)" => "<img src='smileys/".$smileytheme."/".$smileytheme."smile.gif' alt='' align='absmiddle'>",
	   ":-(" => "<img src='smileys/".$smileytheme."/".$smileytheme."sad.gif' alt='' align='absmiddle'>",
	   ";-)" => "<img src='smileys/".$smileytheme."/".$smileytheme."smilewinkgrin.gif' alt='' align='absmiddle'>",
	   ":-|" => "<img src='smileys/".$smileytheme."/".$smileytheme."none.gif' alt='' align='absmiddle'>",
	   ":0" => "<img src='smileys/".$smileytheme."/".$smileytheme."bigeek.gif' alt='' align='absmiddle'>",
	   "B)" => "<img src='smileys/".$smileytheme."/".$smileytheme."cool.gif' alt='' align='absmiddle'>",
	   ":D" => "<img src='smileys/".$smileytheme."/".$smileytheme."biggrin.gif' alt='' align='absmiddle'>",
	   ":P" => "<img src='smileys/".$smileytheme."/".$smileytheme."bigrazz.gif' alt='' align='absmiddle'>",
	   ":B" => "<img src='smileys/".$smileytheme."/".$smileytheme."bigrazz.gif' alt='' align='absmiddle'>",
	   "B-)" => "<img src='smileys/".$smileytheme."/".$smileytheme."cool.gif' alt='' align='absmiddle'>",
	   ":-D" => "<img src='smileys/".$smileytheme."/".$smileytheme."biggrin.gif' alt='' align='absmiddle'>",
	   ":-P" => "<img src='smileys/".$smileytheme."/".$smileytheme."bigrazz.gif' alt='' align='absmiddle'>",
	   ":O" => "<img src='smileys/".$smileytheme."/".$smileytheme."bigeek.gif' alt='' align='absmiddle'>",
	   "b)" => "<img src='smileys/".$smileytheme."/".$smileytheme."cool.gif' alt='' align='absmiddle'>",
	   ":d" => "<img src='smileys/".$smileytheme."/".$smileytheme."biggrin.gif' alt='' align='absmiddle'>",
	   ":p" => "<img src='smileys/".$smileytheme."/".$smileytheme."bigrazz.gif' alt='' align='absmiddle'>",
	   ":b" => "<img src='smileys/".$smileytheme."/".$smileytheme."bigrazz.gif' alt='' align='absmiddle'>",
	   "b-)" => "<img src='smileys/".$smileytheme."/".$smileytheme."cool.gif' alt='' align='absmiddle'>",
	   ":-d" => "<img src='smileys/".$smileytheme."/".$smileytheme."biggrin.gif' alt='' align='absmiddle'>",
	   ":-p" => "<img src='smileys/".$smileytheme."/".$smileytheme."bigrazz.gif' alt='' align='absmiddle'>",
	   ":-b" => "<img src='smileys/".$smileytheme."/".$smileytheme."bigrazz.gif' alt='' align='absmiddle'>",
	   ":o" => "<img src='smileys/".$smileytheme."/".$smileytheme."bigeek.gif' alt='' align='absmiddle'>",
	   "o_O" => "<img src='smileys/".$smileytheme."/".$smileytheme."bigeek.gif' alt='' align='absmiddle'>",
	   "O_o" => "<img src='smileys/".$smileytheme."/".$smileytheme."bigeek.gif' alt='' align='absmiddle'>",
	   "o_o" => "<img src='smileys/".$smileytheme."/".$smileytheme."bigeek.gif' alt='' align='absmiddle'>",
	   "O_O" => "<img src='smileys/".$smileytheme."/".$smileytheme."bigeek.gif' alt='' align='absmiddle'>",
		":cool:" => "<img src='smileys/".$smileytheme."/".$smileytheme."cool.gif' alt='' align='absmiddle'>",
	);

    foreach ($emoticon as $code => $image) {
	    $text = str_replace($code, $image, $text);
    }
    return $text;
}

function addsmiley($smileytheme) { // This is generated for the clickable smilies
	$_emoticons = array(
		":eek:" => "<img src='smileys/".$smileytheme."/".$smileytheme."bigeek.gif' alt='' border='0' align='absmiddle'>",
		":rolleyes:" => "<img src='smileys/".$smileytheme."/".$smileytheme."rolleyes.gif' alt='' border='0' align='absmiddle'>",
		":mad:" => "<img src='smileys/".$smileytheme."/".$smileytheme."mad.gif' alt='' border='0' align='absmiddle'>",
		":yes:" => "<img src='smileys/".$smileytheme."/".$smileytheme."yes.gif' alt='' border='0' align='absmiddle'>",
		":no:" => "<img src='smileys/".$smileytheme."/".$smileytheme."no.gif' alt='' border='0' align='absmiddle'>",
		":shy:" => "<img src='smileys/".$smileytheme."/".$smileytheme."shy.gif' alt='' border='0' align='absmiddle'>",
		":laugh:" => "<img src='smileys/".$smileytheme."/".$smileytheme."laugh.gif' alt='' border='0' align='absmiddle'>",
		":dead:" => "<img src='smileys/".$smileytheme."/".$smileytheme."dead.gif' alt='' border='0' align='absmiddle'>",
		":cry:" => "<img src='smileys/".$smileytheme."/".$smileytheme."cry.gif' alt='' border='0' align='absmiddle'>",
		":)" => "<img src='smileys/".$smileytheme."/".$smileytheme."smile.gif' alt='' border='0' align='absmiddle'>",
		":(" => "<img src='smileys/".$smileytheme."/".$smileytheme."sad.gif' alt='' border='0' align='absmiddle'>",
		";)" => "<img src='smileys/".$smileytheme."/".$smileytheme."smilewinkgrin.gif' alt='' border='0' align='absmiddle'>",
		":|" => "<img src='smileys/".$smileytheme."/".$smileytheme."none.gif' alt='' border='0' align='absmiddle'>",
		":D" => "<img src='smileys/".$smileytheme."/".$smileytheme."biggrin.gif' alt='' border='0' align='absmiddle'>",
		":P" => "<img src='smileys/".$smileytheme."/".$smileytheme."bigrazz.gif' alt='' border='0' align='absmiddle'>",
		":cool:" => "<img src='smileys/".$smileytheme."/".$smileytheme."cool.gif' alt='' border='0' align='absmiddle'>",
	);

	echo "<br>\n";
	foreach ($_emoticons as $code => $image) {
		$_emoticon_ = "<a href=\"javascript:addsmiley('$code')\">$image</a>";
		echo "$_emoticon_ ";
	}
}

function doposticons($smileytheme) { // Function for the post icons

	$picons = array(
		":eek:" => "<img src='smileys/".$smileytheme."/".$smileytheme."bigeek.gif' alt='' border='0' align='absmiddle'>",
		":rolleyes:" => "<img src='smileys/".$smileytheme."/".$smileytheme."rolleyes.gif' alt='' border='0' align='absmiddle'>",
		":mad:" => "<img src='smileys/".$smileytheme."/".$smileytheme."mad.gif' alt='' border='0' align='absmiddle'>",
		":yes:" => "<img src='smileys/".$smileytheme."/".$smileytheme."yes.gif' alt='' border='0' align='absmiddle'>",
		":no:" => "<img src='smileys/".$smileytheme."/".$smileytheme."no.gif' alt='' border='0' align='absmiddle'>",
		":shy:" => "<img src='smileys/".$smileytheme."/".$smileytheme."shy.gif' alt='' border='0' align='absmiddle'>",
		":laugh:" => "<img src='smileys/".$smileytheme."/".$smileytheme."laugh.gif' alt='' border='0' align='absmiddle'>",
		":dead:" => "<img src='smileys/".$smileytheme."/".$smileytheme."dead.gif' alt='' border='0' align='absmiddle'>",
		":cry:" => "<img src='smileys/".$smileytheme."/".$smileytheme."cry.gif' alt='' border='0' align='absmiddle'>",
		":)" => "<img src='smileys/".$smileytheme."/".$smileytheme."smile.gif' alt='' border='0' align='absmiddle'>",
		":(" => "<img src='smileys/".$smileytheme."/".$smileytheme."sad.gif' alt='' border='0' align='absmiddle'>",
		";)" => "<img src='smileys/".$smileytheme."/".$smileytheme."smilewinkgrin.gif' alt='' border='0' align='absmiddle'>",
		":|" => "<img src='smileys/".$smileytheme."/".$smileytheme."none.gif' alt='' border='0' align='absmiddle'>",
		":D" => "<img src='smileys/".$smileytheme."/".$smileytheme."biggrin.gif' alt='' border='0' align='absmiddle'>",
		":P" => "<img src='smileys/".$smileytheme."/".$smileytheme."bigrazz.gif' alt='' border='0' align='absmiddle'>",
		":cool:" => "<img src='smileys/".$smileytheme."/".$smileytheme."cool.gif' alt='' border='0' align='absmiddle'>",
		"" => "None",
	);

	foreach ($picons as $code => $image) {
		$posticon = "<input type='radio' value='$code' name='posticon' checked>$image";
		echo "$posticon ";
	}
	echo "<br>\n";
}

function parseposticons($posticon, $smileytheme) { // Doh! Another function for the post icons, trust me ;)
	$_picons = array(
		":eek:" => "<img src='smileys/".$smileytheme."/".$smileytheme."bigeek.gif' alt='' border='0' align='absmiddle'>",
		":rolleyes:" => "<img src='smileys/".$smileytheme."/".$smileytheme."rolleyes.gif' alt='' border='0' align='absmiddle'>",
		":mad:" => "<img src='smileys/".$smileytheme."/".$smileytheme."mad.gif' alt='' border='0' align='absmiddle'>",
		":yes:" => "<img src='smileys/".$smileytheme."/".$smileytheme."yes.gif' alt='' border='0' align='absmiddle'>",
		":no:" => "<img src='smileys/".$smileytheme."/".$smileytheme."no.gif' alt='' border='0' align='absmiddle'>",
		":shy:" => "<img src='smileys/".$smileytheme."/".$smileytheme."shy.gif' alt='' border='0' align='absmiddle'>",
		":laugh:" => "<img src='smileys/".$smileytheme."/".$smileytheme."laugh.gif' alt='' border='0' align='absmiddle'>",
		":dead:" => "<img src='smileys/".$smileytheme."/".$smileytheme."dead.gif' alt='' border='0' align='absmiddle'>",
		":cry:" => "<img src='smileys/".$smileytheme."/".$smileytheme."cry.gif' alt='' border='0' align='absmiddle'>",
		":)" => "<img src='smileys/".$smileytheme."/".$smileytheme."smile.gif' alt='' border='0' align='absmiddle'>",
		":(" => "<img src='smileys/".$smileytheme."/".$smileytheme."sad.gif' alt='' border='0' align='absmiddle'>",
		";)" => "<img src='smileys/".$smileytheme."/".$smileytheme."smilewinkgrin.gif' alt='' border='0' align='absmiddle'>",
		":|" => "<img src='smileys/".$smileytheme."/".$smileytheme."none.gif' alt='' border='0' align='absmiddle'>",
		":D" => "<img src='smileys/".$smileytheme."/".$smileytheme."biggrin.gif' alt='' border='0' align='absmiddle'>",
		":P" => "<img src='smileys/".$smileytheme."/".$smileytheme."bigrazz.gif' alt='' border='0' align='absmiddle'>",
		":cool:" => "<img src='smileys/".$smileytheme."/".$smileytheme."cool.gif' alt='' border='0' align='absmiddle'>",
	);

	foreach ($_picons as $code => $image) {
		$posticon = str_replace($code, $image, $posticon);
	}
	$posticon = addslashes($posticon);
	return $posticon;
}

?>