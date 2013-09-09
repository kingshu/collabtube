<link rel="stylesheet" type="text/css" href="css/global.css">

<?php
	session_start();
	if (!isset($_SESSION['ids'])) 
		$_SESSION['ids'] = array();

	$idsCSV = implode("','",$_SESSION['ids']);
	
	$db = new PDO('mysql:dbname=collabtube;host=localhost','root','k9is1337!');
	$sql = "SELECT * FROM posts WHERE roomID = ".$_REQUEST['id']." AND id NOT IN ('".$idsCSV."') ORDER BY time DESC"; 
	$statement = $db->prepare($sql);    
    $statement->execute();
	$result = $statement->fetchAll();
	
	foreach ($result as $post) {
		if (!in_array($post, $_SESSION['ids'])) {
			array_push($_SESSION['ids'], $post['id']);
			echo "<div id='".$post['id']."' class='post well well-lg'><p>";
			echo 	$post['post'];
			echo 	"</p><h6><p class='text-muted'> - ".$post['user'];
			echo 	"&emsp;&emsp;&emsp;".$post['time'];
			echo "</p></h6></div>";	
		}	
	}
?>
		
