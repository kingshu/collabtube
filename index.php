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
		<table border=0 width=75% class='centered'><tr><td>
			<a class="navbar-brand" href='http://ct-kingshu2.rhcloud.com/'><h1>COLLABTUBE</h1></a> 
		</td></tr></table>
		<br>
	</div>
	
	<table class='centered container' border=0 cellpadding=25>
		
		<tr><td>
			
			<table border=0 cellpadding=5 class='floatright'>
				<tr><td>
					<h3  class='floatright'>Create New Room</h3>
				</td></tr>
				<tr><td>
					<form action="create.php" method="POST" enctype="multipart/form-data" class='floatright'> 
						<input id='createButton' type="submit" value="Create Room" class="btn btn-primary btn-lg floatright"/>	
					</form>
				</td></tr>
			</table>
			
		</td><td class='center'>	
		
			<h2>|<br><br>OR<br><br>|</h2><br>
		
		</td><td>	
			
			<table border=0 cellpadding=5>
				<tr><td>
					<h3 class='floatleft'>Join Existing Room</h3> 
				</td></tr>
				<tr><td>
					<form action="join.php" method="POST" enctype="multipart/form-data" class='floatleft'> 
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
			
		</td></tr>
	</table>
</body>	
</html>
