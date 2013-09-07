<html>
<head>
	<script src='js/jquery-1.9.1.js'></script>
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
	<script src="http://malsup.github.com/jquery.form.js"></script>
	
	<script>
		
		var loop = function() {
			setTimeout( function() {
				var id = +new Date;
				$('#allposts').prepend('<div id='+id+'></div>');
				$('#'+id).load('loader.php', function() {
					if ( $('#'+id).html().length == 3 )
						$('#'+id).remove();
				});
				loop();
			}, 5000);
		}
		
		$(document).ready(function() {
			
			$('#submitted').hide();
			
			loop();			
		
			$('#theForm').ajaxForm(function() { 
				$('#submitted').show();
				$('#submitted').fadeOut(3000);
				$('#postinput').val('');
			});         
		
		});
		
		
		
		
	</script>
</head>
<body>
	<?php
		session_start();
		$_SESSION['ids'] = array();
	?>
	
	<table border=0>
		<tr><td>
			<form id='theForm' method='POST' action='post.php'>
				user: <input type='text' name='user'>
				post: <input type='text' name='post' id='postinput'>
				<input type='hidden' value='3' name='roomID'>
				<input type='submit' value='Post'>
			</form>
		</td><td>
			<div id='submitted' style='display:inline'>Submitted!</div>
		</td></tr>
	</table>
	
	<br>
	<div id='allposts'>
	</div>
</body>
</html>
