<link rel="stylesheet" type="text/css" href="css/global.css">
<?php
	$db = new PDO('mysql:dbname=collabtube;host=localhost','root','k9is1337!');
	
	$sql = "SELECT * FROM rooms WHERE roomID = '".$_REQUEST['roomID']."' LIMIT 1" ; // Auto increment   
	$statement = $db->prepare($sql);    
    $statement->execute();
    $result = $statement->fetchAll();
     
    if ( empty($result) ) {
		echo "<a href='localhost/collabtube'><h1>COLLABTUBE</h1></a><br>";
		
		echo "<h2>This room does not exist! You can: </h2>";
		
			echo "<h3>Create New Room</h3>";
			echo "<form action='create.php' method='POST' enctype='multipart/form-data'> ";
				echo "<input id='createButton' type='submit' value='Create Room'/>	";
			echo "</form>";
				
			echo "	<h2>OR</h2><br>";
				
			echo "	<h3>Try to another existing Room</h3> ";
			echo "	<form action='join.php' method='POST' enctype='multipart/form-data'> ";
			echo "		<input type='text' name='roomID' placeholder='Room ID' />	";
		    echo "		<input id='joinButton' type='submit' value='Join'/>	";
			echo "	</form>";
	}
	else
		header ('Location: room.php?id='.$result[0][0]);
?>
