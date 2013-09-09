<?php
	$db = new PDO('mysql:dbname=collabtube;host=localhost','root','k9is1337!');
	
	$sql = "SELECT * FROM rooms WHERE roomID = '".$_REQUEST['roomID']."' LIMIT 1" ; // Auto increment   
	$statement = $db->prepare($sql);    
    $statement->execute();
    $result = $statement->fetchAll();
     
    if ( empty($result) ) {
		echo "<style>
					.container {width:70%;}
					.roomID {width:150px;}
					.floatleft {float:left;}
					.floatright {float:right;}
					.center {text-align:center;}
				</style>
				
				<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js'></script> 
				<link rel='stylesheet' type='text/css' href='css/global.css'>				
				<script>
					$(document).ready(function() {
						$('.close').click(function() {
							$('#failMessage').fadeOut('slow');
						});
					});
				</script>
				
				<div class='navbar navbar-default'>
				<h1>&emsp;&emsp;<a href='localhost/collabtube'>COLLABTUBE</a></h1> <br>
				</div>
				
				<table class='centered container' border=0 cellpadding=25>
					
					<tr><td colspan=3>
						<div class='alert alert-dismissable alert-warning' id='failMessage'>
							<button type='button' class='close' data-dismiss='alert'>&times;</button>
							<h4><br>&emsp;&emsp;Room ".$_REQUEST['roomID']." does not exist.<br><br></h4>
						</div>
					</td></tr>
					
					<tr><td>
						
						<h3  class='floatright'>Create New Room</h3>
						<form action='create.php' method='POST' enctype='multipart/form-data'> 
							<input id='createButton' type='submit' value='Create Room' class='btn btn-primary btn-lg floatright'/>	
						</form>
					
					</td><td class='center'>	
					
						<h2>|<br><br>OR<br><br>|</h2><br>
					
					</td><td>	
					
						<h3 class='floatleft'>Join Existing Room</h3> 
						<form action='join.php' method='POST' enctype='multipart/form-data'> 
						<table border=0 cellpadding=5 class='floatleft'>
							<tr><td>
								<input type='text' name='roomID' placeholder='Room ID' class='form-control input-lg roomID'/>	
							</td><td>	
								<input id='joinButton' type='submit' value='Join' class='btn btn-primary btn-lg'/>
							</td></tr>	
						</table>
						</form>
					
					</td></tr>
				</table>";
	}
	else
		header ('Location: room.php?id='.$result[0][0]);
?>
