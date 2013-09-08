<html>
<head>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
</head>

<body>
	<h1>COLLABTUBE</h1>	
	
	<h3>Create New Room</h3>
	<form action="create.php" method="POST" enctype="multipart/form-data"> 
		<input id='createButton' type="submit" value="Create Room"/>	
	</form>
	
	<h2>OR</h2><br>
	
	<h3>Join Existing Room</h3> 
	<form action="join.php" method="POST" enctype="multipart/form-data"> 
		<input type="text" name="roomID" placeholder="Room ID" />	
		<input id='joinButton' type="submit" value="Join"/>	
	</form>

</body>	
</html>
