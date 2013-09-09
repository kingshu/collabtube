<html>
<head>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
	<link rel="stylesheet" type="text/css" href="css/global.css">
	<style>
		.container {width:70%;}
		.roomID {width:150px;}
		.floatleft {float:left;}
		.floatright {float:right;}
		.center {text-align:center;}
	</style>
</head>

<body>
	<div class="navbar navbar-default">
	<h1>&emsp;&emsp;<a href='localhost/collabtube'>COLLABTUBE</a></h1> <br>
	</div>
	
	<table class='centered container' border=0 cellpadding=25>
		
		<tr><td>
			
			<h3  class='floatright'>Create New Room</h3>
			<form action="create.php" method="POST" enctype="multipart/form-data"> 
				<input id='createButton' type="submit" value="Create Room" class="btn btn-primary btn-lg floatright"/>	
			</form>
		
		</td><td class='center'>	
		
			<h2>|<br><br>OR<br><br>|</h2><br>
		
		</td><td>	
		
			<h3 class='floatleft'>Join Existing Room</h3> 
			<form action="join.php" method="POST" enctype="multipart/form-data"> 
			<table border=0 cellpadding=5 class='floatleft'>
				<tr><td>
					<input type="text" name="roomID" placeholder="Room ID" class="form-control input-lg roomID"/>	
				</td><td>	
					<input id='joinButton' type="submit" value="Join" class="btn btn-primary btn-lg"/>
				</td></tr>	
			</table>
			</form>
		
		</td></tr>
	</table>
</body>	
</html>
