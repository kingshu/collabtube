<link rel="stylesheet" type="text/css" href="css/global.css">

<?php
	require 'connector.php';
	session_start();
	if (!isset($_SESSION['ids'])) 
		$_SESSION['ids'] = array();

	$idsCSV = implode("','",$_SESSION['ids']);
	
	
	$db = mysqlConnector();
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
			echo 	"&emsp;&emsp;&emsp;".date( 'M j, g:ia', strtotime( $post['time'] ) );
			if ( preg_match('/watch\?v=[\w\-]{11}/', $post['post']) == 1 ) { 
				echo "&emsp;&emsp;<span class='badge' id='badge".$post['id']."'>&#10003;</span>";
			}
			echo "</p></h6></div>";	
			echo "<script> $('#badge".$post['id']."').hover( function() { $('#badge".$post['id']."').append(' This post contains a video'); } , function() { $('#badge".$post['id']."').html('&#10003;'); }); </script>";	
		}	
	}
?>
