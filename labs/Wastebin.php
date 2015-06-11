<!DOCTYPE html>
<html>
	<head>
		<title>Wastebin</title>
	</head>
	<body>
		<h1>Wastebin</h1>
		<h3>Volatile Pastebin</h3>

		<?php

			if ($_GET["id"]){

				$db = new SQLite3('wastebin.db');
				/*
				CREATE TABLE data (id TEXT NOT NULL UNIQUE, content TEXT);
				*/

				$find = $db->prepare("select * from data where id=:id;");
				$find->bindValue(':id', $_GET["id"], SQLITE3_TEXT);

				$result = $find->execute();
				$info = $result->fetchArray();

				if(!$info){
					echo "<p style='color:red;'>Invalid id. Perhaps someone has already looked at your file?</p>";
				}
				else{
					echo "<pre>" . $info["content"] . "</pre>";
				}

				$del = $db->prepare("delete from data where id=:id;");
				$del->bindValue(':id', $_GET["id"], SQLITE3_TEXT);

				$result = $del->execute();

				//render the contents & delete the pastebin
			} else if ($_POST["content"]){

				$_POST["content"] = $_POST["content"];

				$db = new SQLite3('wastebin.db');

				echo "<p>Your content:</p><pre>" . $_POST["content"] . "</pre>";

				$id = hash("sha256", $_POST["content"] . "slartibartfast" . time());
				echo "<p>Can be found <a href='?id=" . $id . "'>here</a></p>";
				echo "<p>Warning: Accessing this information will remove it - you can only view the file once!</p>";

				$ins = $db->prepare("insert into data (id, content) values (:id, :content);");
				$ins->bindValue(':id', $id, SQLITE3_TEXT);
				$ins->bindValue(':content', $_POST["content"], SQLITE3_TEXT);

				$result = $ins->execute();

			}else {
				?>
					
					<form action="Wastebin.php" method="POST" id="form">
						<p>Your Content</p>
						<textarea id="content" name="content"></textarea>
						<br>
						<button type="submit">Submit!</button>
					</form>
				<?
			}

		?>
	</body>
</html>