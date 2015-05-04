<?php

	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
	    $ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
	    $ip = $_SERVER['REMOTE_ADDR'];
	}

	// echo "HELLO" . $ip . "<br>";

	$db = new SQLite3('experiment.db');
	/*
		Table stats
		
		Fields lastVisit(int), visits(int), ip (text)

		CREATE TABLE stats (ip TEXT NOT NULL UNIQUE, visits INT, lastVisit INT);
	
	*/

	$find = $db->prepare("select * from stats;");
	$result = $find->execute();
	// print_r($result->fetchArray());
	$results = array();
	print_r("<h1>Lab 8: IP Visits</h1>");
	print_r("<hr>");
	while($row = $result->fetchArray()){
		// print_r($row);
		$results[] = $row;
		print_r("<p>Address <b>" . $row["ip"] . "</b> has visited <b>" . $row["visits"] . "</b> time(s). Last visited at <b>" . date("H:m:s, m/d/y", $row["lastVisit"]) . "</b></p>");
		print_r("<br>");
	}
	print_r("<hr>");



	$query = "INSERT OR REPLACE INTO stats (lastVisit, visits, ip) VALUES (" . time() . ", COALESCE((SELECT visits FROM stats WHERE ip='" . $ip . "')+1, 1), '" . $ip . "');";

	$update = $db->prepare($query);
	$res = $update->execute();

	/*

	$db = new SQLite3('experiment.db');
	$something = $db->prepare("JayIsSilly0");
	$results = $something->execute();

	*/
	//insert or replace into stats (lastVisit, visits, $ip) values (lastVisit, coalesce((select visits from table where id=$ip)+1, 1), $ip);
	


?>