<?php 

    $maxLength = $_GET["maxLength"];
    $firstLetter = $_GET["firstLetter"];

    $remainingLength = intval($maxLength) - 1;
    
    echo $remainingLength . "\n";

    $file = file_get_contents("dict.txt"); 

    
    $pattern = '/' . $firstLetter . '\w{0,'. $remainingLength . '}/'; 
    echo $maxLength . "|" . $firstLetter . "|" . $remainingLength . "|" . $pattern;
    preg_match_all($pattern, $file, $matches ); 
    print_r($matches); 
?>