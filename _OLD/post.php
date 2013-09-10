<?php
	if ($_REQUEST['post'] != "") {
		
		$username = ($_REQUEST['user']=='')?"Anonymous":$_REQUEST['user'];
		
		$db = new PDO('mysql:dbname=collabtube;host=localhost','root','k9is1337!');
		$sql = "INSERT INTO posts SET user = :user, post = :post, time = NOW(), roomID = :room"; 
		$statement = $db->prepare($sql);    
		$statement->execute( array(			
									'user' => $username,
									'post' => $_REQUEST['post'],
									'room' => $_REQUEST['roomID']
								  )
						   );
	}
?>
