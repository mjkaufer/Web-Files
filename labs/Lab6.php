<?php 

	$letters = array();

	//(?=.*$letter{num,})

	for ($i = 1; $i <= 8; $i++) {
    	$letter = $_GET[$i . ""];
    	if($letter != "*"){//not a wild card
    		$letters[] = $letter;
    	}
	}

	$map = array_count_values($letters);
	$uniques = count($map);
	$regex = "";

	foreach (map as $letter => $freq){
		$regex += "(?=.*" . $letter . "{" . $freq . "})";
	}

	$regex += "\w{" . $uniques . ",}";

	//todo - right now, it finds only words with the letters specified
	//make it better

    $pattern = '/\b' . $regex . '\s/'; 

    $file = file_get_contents("dict.txt"); 
    
    print_r("DEBUG<br>" . PHP_EOL);

    print_r("<br>");

    print_r($regex);

    print_r("<br>");

	print_r("<br>");

    print_r($pattern);

    print_r("<br>");

    print_r("\\DEBUG<br>" . PHP_EOL);

    // echo $maxLength . "|" . $firstLetter . "|" . $remainingLength . "|" . $pattern;
    preg_match_all($pattern, $file, $matches ); 

	foreach($matches[0] as $word) {
		echo $word . "\r\n";
	}
?>