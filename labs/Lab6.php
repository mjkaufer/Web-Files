<?php 

	echo "<h1>Scrabble Word Finder Results</h1>";

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

	// foreach ($map as $key => $value){
	// 	$regex += "(?=.*" . $key . "{" . $value . "})";
	// }

	foreach ($map as $letter => $freq){
		$regex .= "(?=(.*" . $letter . "){" . $freq . "})";
	}


	

	//todo - right now, it finds only words with the letters specified
	//make it better

    $pattern = '/\b' . $regex . '\s/'; 

    $file = file_get_contents("dict.txt"); 
    

	for ($len = 2; $len <= 12; $len++) {

		$newRegex = $regex . "\w{" . $len . "}";
		$pattern = '/\b' . $newRegex . '\s/'; 

		preg_match_all($pattern, $file, $matches ); 

		if(count($matches[0]) > 0){
			echo "<h2>" . $len . " Letters Long</h2><br>";

			foreach($matches[0] as $word) {
				echo $word . "\r\n";
			}

			echo "<br>";
		}

	}
?>