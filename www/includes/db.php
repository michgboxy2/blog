<?php #test.php sandbox

define('DBNAME', 'blog');
define('DBUSER', 'root');
define('DBPASS', 'root');

try{ 
		#prepare a PDO INSTNCE

$conn = new PDO('mysql:host=localhost;dbname='.DBNAME, DBUSER, DBPASS);

	# SET verbose error modes
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);

} catch(PDOException $e) {

		echo $e->getMessage();
}





?>