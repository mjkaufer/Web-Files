<?php 

    $maxLength = $_GET["maxLength"];
    $firstLetter = $_GET["firstLetter"];

    $remainingLength = intval($maxLength) - 1;
    
    // echo $remainingLength . "\n";

    $file = file_get_contents("dict.txt"); 

    
    $pattern = '/\b' . $firstLetter . '\w{0,'. $remainingLength . '}\s/'; 
    // echo $maxLength . "|" . $firstLetter . "|" . $remainingLength . "|" . $pattern;
    preg_match_all($pattern, $file, $matches ); 

	foreach($matches[0] as $word) {
		echo $word . "\r\n";
	}
?>