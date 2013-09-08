<?php
	$db = new PDO('mysql:dbname=collabtube;host=localhost','root','k9is1337!');
	$sql = "INSERT INTO posts SET
				user = '".$_REQUEST['user']."',
				post = '".$_REQUEST['post']."',
				time = NOW(), 
				roomID = '".$_REQUEST['roomID']."'"; 
	$statement = $db->prepare($sql);    
    $statement->execute();
?>
