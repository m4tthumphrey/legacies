<?php
##########################################
# paBox v1.6
# Lead Programmer: Matt Humphrey (PHPAlien) >> matt@phparena.net <<
# Version 1.6
# 18 May 2002
# Copyright 2002 PHP Arena. All rights reserved.
#
# BoxCode Module
# Module Written by Matt Humphrey
# Module Date: 27-02-2002
# Module Version: 1.0
##########################################

function doBoxCode($text) {

	$text = htmlspecialchars($text);

    $html = array();
    $html[] = array("[b]", "<b>");
	$html[] = array("[/b]", "</b>");
	$html[] = array("[i]", "<i>");
	$html[] = array("[/i]", "</i>");
	$html[] = array("[u]", "<u>");
	$html[] = array("[/u]", "</u>");
	$html[] = array("[move]", "<marquee>");
	$html[] = array("[/move]", "</marquee>");
	$html[] = array("[nl]", "<br>");

    foreach ($html as $html) {
	    $text = str_replace($html[0],$html[1],$text);
    }

	$text = eregi_replace("\\[email\\]([^\\[]*)\\[/email\\]", "<a href=\"mailto:\\1\">\\1</a>", $text); 
	$text = eregi_replace("\\[email=([^\\[]*)\\]([^\\[]*)\\[/email\\]", "<a target='_blank' href=\"mailto:\\1\">\\2</a>", $text); 
	$text = eregi_replace("\\[url\\]([^\\[]*)\\[/url\\]", "<a target='_blank' href=\"\\1\">\\1</a>", $text); 
	$text = eregi_replace("\\[url=([^\\[]*)\\]([^\\[]*)\\[/url\\]", "<a target='_blank' href=\"\\1\">\\2</a>", $text); 

	return $text;
}
?>