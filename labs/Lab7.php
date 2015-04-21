<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/style.css"></link>
		<title>Page Stats</title>
	</head>
	<body>
	<h1>Page Stats</h1>
	<?php

		$DB = "./Lab7.db";

		/*DB Schema

		lastAccessed: int time(),
		visits: int n

		*/
		$contents = file_get_contents($DB);
		$stats = null;

		if($contents == false){//no info in DB
			$stats = array(
				"lastAccessed" => time(),
				"visits" => 0
			);
		} else {
			$stats = json_decode($contents, true);	
		}

		$time = $stats["lastAccessed"];
		$visits = $stats["visits"] + 1;

		echo "<h2>Page views: " . $visits . "</h2>";
		echo "<h2>Last visited: " . date("H:m:s, m/d/y", $time) . "</h2>";

		$stats["visits"] += 1;
		$stats["lastAccessed"] = time();

		file_put_contents($DB, json_encode($stats));
	?>
	</body>
</html>