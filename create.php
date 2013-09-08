<?php
	$db = new PDO('mysql:dbname=collabtube;host=localhost','root','k9is1337!');
	
	$sql = "INSERT INTO rooms VALUES ()" ; // Auto increment   
	$statement = $db->prepare($sql);    
    $statement->execute();
    
    
    header ('Location: room.php?id='.$db->lastInsertId() );
?>
