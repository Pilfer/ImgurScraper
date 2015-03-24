<?php
/*
	imgur scraper
	
	Usage:
		$x = scrape("funny",false,3);		
		subreddit, nsfw pics (false for no porn), page count
	
	Returns Array:
		foreach($x as $y){
			echo " Title: " . $y[0];
			echo " Hash: " . $y[1];
			echo " Picture: i.imgur.com/" . $y[2];
			echo " Width: " . $y[3];
			echo " Height: " . $y[4] . "<br/>\n";
		}
*/
function scrape($subreddit,$nsfw,$pages){
	$result = array();
	for($i = 1;$i<=$pages;$i++){
		$feed = json_decode(file_get_contents("http://imgur.com/r/".$subreddit."/top/week/page/".$i.".json"));
		foreach($feed->gallery as $item){
			if($nsfw == false){
				if($item->nsfw == false){
					$title = preg_replace("/[^A-Za-z0-9_ ]/","", $item->title);
					if(($title == " ") || ($title == "")){
						//bad times, man.
					}else{				
						$hash = $item->hash;
						$pic = $hash.$item->ext;
						$width = $item->width;
						$height = $item->height;
						$result[] = array($title,$hash,$pic,$width,$height);
					}	
				}
			}else{
				$title = preg_replace("/[^A-Za-z0-9_ ]/","", $item->title);
				if(($title == " ") || ($title == "")){
					//bad times, man.
				}else{
					$hash = $item->hash;
					$pic = $hash.$item->ext;
					$width = $item->width;
					$height = $item->height;
					$result[] = array($hash,$pic,$width,$height);
				}			
			}
		}
	}
	return $result;
}


