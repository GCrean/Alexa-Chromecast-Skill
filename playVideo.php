<?php
	$db = new mysqli('','','','');

	$searchString   = $_GET['searchString'];
    $correctString  = str_replace(" ","+",urldecode($searchString));
    $youtubeUrl = "https://www.youtube.com/results?search_query=". $correctString;
    $getHTML        = file_get_contents($youtubeUrl);
    $pattern        = '/<a href="\/watch\?v=(.*?)"/i';

    if(preg_match($pattern, $getHTML, $match)){
            $videoID    = $match[1];
    } else {
            echo "Something went wrong!";
            exit;
    }

    $query = "INSERT INTO  `commands` (`command` ,`video`) VALUES ('play',  '$videoID')";
    $run = mysqli_query($db, $query);

    if($run) {
        echo "Video was added Successfully";
    } else {
        echo "The video could not be added.";
    }
?>