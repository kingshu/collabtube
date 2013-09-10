<?php
	$db = new PDO('mysql:dbname=collabtube;host=localhost','root','k9is1337!');
	
	$sql = "SELECT * FROM rooms WHERE roomID = '".$_REQUEST['roomID']."' LIMIT 1" ; // Auto increment   
	$statement = $db->prepare($sql);    
    $statement->execute();
    $result = $statement->fetchAll();
     
    if ( empty($result) ) {
		echo "	 	<style>";
		echo "			.container {width:70%;}";
		echo "			.roomID {width:150px;}";
		echo "			.floatleft {float:left;}";
		echo "			.floatright {float:right;}";
		echo "			.center {text-align:center;}";
		echo "		</style>";
				
		echo "		<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js'></script> ";
		echo "		<link rel='stylesheet' type='text/css' href='css/global.css'>	";			
		echo "		<script>";
		echo "			$(document).ready(function() {";
		echo "				$('.close').click(function() {";
		echo "					$('#failMessage').fadeOut('slow');";
		echo "				});";
		echo "			});";
		echo "		</script>";
				
		echo "		<div class='navbar navbar-default'>";
		echo "		<h1>&emsp;&emsp;<a href='localhost/collabtube'>COLLABTUBE</a></h1> <br>";
		echo "		</div>";
				
		echo "		<table class='centered container' border=0 cellpadding=25>";
					
		echo "			<tr><td colspan=3>";
		echo "				<div class='alert alert-dismissable alert-warning' id='failMessage'>";
		echo "					<button type='button' class='close' data-dismiss='alert'>&times;</button>";
		echo "					<h4><br>&emsp;&emsp;Room ".$_REQUEST['roomID']." does not exist.<br><br></h4>";
		echo "				</div>";
		echo "			</td></tr>";
					
		echo "			<tr><td>";
						
		echo "				<h3  class='floatright'>Create New Room</h3>";
		echo "				<form action='create.php' method='POST' enctype='multipart/form-data'> ";
		echo "					<input id='createButton' type='submit' value='Create Room' class='btn btn-primary btn-lg floatright'/>	";
		echo "				</form>";
					
		echo "			</td><td class='center'>";	
					
		echo "				<h2>|<br><br>OR<br><br>|</h2><br>";
					
		echo "			</td><td>	";
					
		echo "				<h3 class='floatleft'>Join Existing Room</h3> ";
		echo "				<form action='join.php' method='POST' enctype='multipart/form-data'> ";
		echo "				<table border=0 cellpadding=5 class='floatleft'>";
		echo "					<tr><td>";
		echo "						<input type='text' name='roomID' placeholder='Room ID' class='form-control input-lg roomID'/>	";
		echo "					</td><td>	";
		echo "						<input id='joinButton' type='submit' value='Join' class='btn btn-primary btn-lg'/>";
		echo "					</td></tr>	";
		echo "				</table>";
		echo "				</form>";
					
		echo "			</td></tr>";
		echo "		</table>";
	}
	else
		header ('Location: room.php?id='.$result[0][0]);
?>
