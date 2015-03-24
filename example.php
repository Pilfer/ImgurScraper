<?php

require_once("imgur.php");

//grab 3 pages of /r/funny/ SFW images from imgur and download to /imgz/
$x = scrape("funny",false,1);
foreach($x as $y){
	echo " Title: " . $y[0];
	echo " Hash: " . $y[1];
	echo " Picture: i.imgur.com/" . $y[2];
	echo " Width: " . $y[3];
	echo " Height: " . $y[4] . "<br/>\n";
	
	$f = fopen("imgz/".$y[2],"w");
	fputs($f,file_get_contents("http://i.imgur.com/".$y[2]));
	fclose($f);
	
}


