<?php
	
	require 'connector.php';

	$db = mysqlConnector();
	
	$sql = "INSERT INTO rooms VALUES ()" ; // Auto increment   
	$statement = $db->prepare($sql);    
    $statement->execute();
    
    
    header ('Location: room.php?id='.$db->lastInsertId() );
?>
