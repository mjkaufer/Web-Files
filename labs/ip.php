<?php
	$ch = curl_init();
	// set url
	curl_setopt($ch, CURLOPT_URL, "curlmyip.com");

	//return the transfer as a string
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	// $output contains the output string
	$output = curl_exec($ch);

	print("Your IP is " . $output);

	// close curl resource to free up system resources
	curl_close($ch);     
?>