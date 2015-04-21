<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/style.css"></link>
		<title>Scrabble Helper</title>
	</head>
	<body>
	<?php 

		$alphabet = "abcdefghijklmnopqrstuvwxyz";

		function underline($word, $letters){
			$retWord = $word;
			foreach($letters as $letter){
				$retWord = preg_replace('/' . $letter . '/', '<u>' . $letter . '</u>', $retWord, 1);
			}

			return $retWord;
		}

		echo "<h1>Scrabble Word Finder Results</h1>";

		$letters = array();

		//(?=.*$letter{num,})

		foreach($_GET as $i => $letter){
			if(strrpos($alphabet, $letter) !== false && strlen($letter) == 1){//if the submitted letter _is_ a letter
				$letters[] = $letter;
			}
		}

		if(count($letters) == 0){//user didn't search for anything...
			header("Location: ./Lab6.html");
			exit();
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
				echo "<h2>" . $len . " Letters Long</h2>";

				foreach($matches[0] as $word) {
					echo underline($word, $letters) . "\r\n";
				}

				echo "<hr>";
			}

		}
	?>
	</body>
</html>