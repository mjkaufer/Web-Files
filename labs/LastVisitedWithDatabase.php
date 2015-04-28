<?php

	$db = new SQLite3('experiment.db');
	/*
		Table stats
		//Fields fname (text), lname (text), age (int), coolness (int)
		Fields lastVisit(int), visits(int)
	
	*/
	$find = $db->prepare('select * from stats');
	$result = $find->execute();
	print_r($result->fetchArray());

	$update = $db->prepare('update stats set visits = visits + 1, lastVisit = ' . time() . ';');
	$res = $update->execute();


?>