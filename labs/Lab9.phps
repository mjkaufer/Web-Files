<!DOCTYPE html>
<html>
	<head>
		<title>latex generator</title>
	</head>
	<body>
		<h1>Lab 9 - latex generator</h1>

		<?php

			if ($_GET["id"]){

				if (!ctype_xdigit($_GET["id"])){
					echo "Invalid id!";
				} else {

					$db = new SQLite3('lg.db');

					/*
					CREATE TABLE data (id TEXT NOT NULL UNIQUE, latex TEXT);
					setup: subdirectory called pdfs
					*/
					$dirName = "pdfs";
					$dir = $dirName . "/";

					$textFile = $dir . $_GET["id"] . ".txt";

					$shellCommand = "sqlite3 lg.db 'select latex from data where id=\"" . $_GET["id"] . "\";' > " . $textFile;

					shell_exec($shellCommand);

					$del = $db->prepare("delete from data where id=:id;");
					$del->bindValue(':id', $_GET["id"], SQLITE3_TEXT);

					$result = $del->execute();					
					
					$convert = "pdflatex -output-directory=$dirName -aux-directory=$dirName " . $textFile;

					shell_exec($convert);

					

					$file = $dir . $_GET["id"];
					$file_name = $file . ".pdf";

					echo "<h1>$file_name</h1>";

					if(file_exists($file_name)){
						
					    header('Content-Description: File Transfer');
					    header('Content-Type: application/pdf');
					    header('Content-Disposition: attachment; filename='.basename($file_name));
					    header('Content-Transfer-Encoding: binary');
					    header('Expires: 0');
					    header('Cache-Control: must-revalidate');
					    header('Pragma: public');
					    header('Content-Length: ' . filesize($file_name));
					    ob_clean();
					    flush();
					    readfile($file_name);
					    // exit;

						// header("X-Sendfile: $file_name");
						// header("Content-type: application/octet-stream");
						// header('Content-Disposition: attachment; filename="' . basename($file_name) . '"');
						// header("Location: http://google.com");
						// header
						// exit;



						// shell_exec("rm " . $file_name);
						shell_exec("rm " . $file . ".*");//removes all the pdflatex files created with it
						exit;
						// shell_exec("rm " . $file_name);
						// shell_exec("rm " . $file_name);
					} else {
						echo "<p style='color:red;'>Invalid id. Perhaps someone has already looked at your file?</p>";
					}

					// $find = $db->prepare("select * from data where id=:id;");
					// $find->bindValue(':id', $_GET["id"], SQLITE3_TEXT);

					// $result = $find->execute();
					// $info = $result->fetchArray();

					// if(!$info){
					// 	echo "<p style='color:red;'>Invalid id. Perhaps someone has already looked at your file?</p>";
					// }
					// else{
					// 	echo "<hr>";
					// 	echo "<pre>" . $info["latex"] . "</pre>";
					// 	echo "<hr>";
					// }

					// $del = $db->prepare("delete from data where id=:id;");
					// $del->bindValue(':id', $_GET["id"], SQLITE3_TEXT);

					// $result = $del->execute();


				}
				//render the latexs & delete the pastebin
			} else if ($_POST["latex"]){

				$db = new SQLite3('lg.db');

				echo "<p>Your latex:</p><pre>" . $_POST["latex"] . "</pre>";

				$id = hash("sha256", $_POST["latex"] . "slartibartfast" . time());
				echo "<p>Can be found <a href='?id=" . $id . "'>here</a></p>";
				echo "<p>Warning: Accessing this information will remove it - you can only view the file once!</p>";

				$ins = $db->prepare("insert into data (id, latex) values (:id, :latex);");
				$ins->bindValue(':id', $id, SQLITE3_TEXT);
				$ins->bindValue(':latex', $_POST["latex"], SQLITE3_TEXT);

				$result = $ins->execute();

			}else {
				?>
					
					<form action="Lab9.php" method="POST" id="form">
						<p>Your latex</p>
						<textarea id="latex" name="latex" style="width:50vw; height:50vh;">
\documentclass{article}

\begin{document}

	$$ Your Math Latex Here $$

\end{document}
						</textarea>
						<br>
						<button type="submit">Submit!</button>
					</form>
				<?
			}

		?>
	</body>
</html>