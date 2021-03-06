<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/global.css">
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
	<script src="http://malsup.github.com/jquery.form.js"></script>
	
	 <script>
      // 2. This code loads the IFrame Player API code asynchronously.
      var tag = document.createElement('script');

      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      // 3. This function creates an <iframe> (and YouTube player)
      //    after the API code downloads.
      var player;
      function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
          height: '390',
          width: '640',
          videoId: 'ikWwR5Y4LmA',
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
        });
      }

      // 4. The API will call this function when the video player is ready.
      function onPlayerReady(event) {
        event.target.playVideo();
      }

      // 5. The API calls this function when the player's state changes.
      function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.ENDED) {
			window.nowPlaying++ ;
			if (window.nowPlaying < window.playlist.length) {
				player.loadVideoById(window.playlist[window.nowPlaying], 0, "large");
			}
			else {
				waitForNewPost();
			}
        }
      }
      
      function stopVideo() {
        player.stopVideo();
      }
      
      var waitForNewPost = function () {
		  setTimeout( function () {
			  if (window.nowPlaying >= window.playlist.length)
				waitForNewPost();
			  else
				player.loadVideoById(window.playlist[++window.nowPlaying], 0, "large");
		  }, 5000);
	  }
      
    </script>
	
	
	<script>
		
		window.playlist = window.playlist || new Array() ;
		
		var loop = function() {
			setTimeout( function() {
				var id = +new Date;
				$('#allposts').prepend('<div id='+id+'></div>');
				$('#'+id).load('loader.php?id='+$('#roomID').val(), function() {
					window.tempList = new Array();
					if ( $('#'+id).html().length == 3 ) // Empty
						$('#'+id).remove();
					else {
						var urlP = /watch\?v=([\w\-]{11})/g ;
						var match;
						while ( (match = urlP.exec ($('#'+id).html())) != null )
							window.tempList.push(match[1]);
					}
					while (window.tempList.length > 0) 
						window.playlist.push(window.tempList.pop());
				});
				loop();
			}, 5000);
		}
		
		$(document).ready(function() {
			
			window.nowPlaying = -1;
			
			$('#submitted').hide();
			
			loop();			
		
			$('#theForm').ajaxForm(function() { 
				$('#submitted').show();
				$('#submitted').fadeOut(3000);
				$('#postinput').val('');
			});         
		
			  $('#prev').click(function() {
				  window.nowPlaying --;
				  if (window.nowPlaying < 0) {
					  alert ('There are no more videos before this'); 
					  window.nowPlaying++ ;
				  }
				  else
					  player.loadVideoById(window.playlist[window.nowPlaying], 0, "large");
			  });
			
			  $('#next').click(function() {
				  window.nowPlaying++ ;
				  if (window.nowPlaying >= window.playlist.length) {
					  alert ('There are no more videos after this');
					  window.nowPlaying--;
				  }
				  else
					  player.loadVideoById(window.playlist[window.nowPlaying], 0, "large");
			  });
			  
			  $('.close').click(function() {
				  $('#roomIDdiv').fadeOut('slow');
				  $('#roomIDNav').fadeIn('slow');
			  });
			  
		  });
				
		
		
		
	</script>
	<style>
		table {table-layout:fixed;}
		.postTd {width:30px;}
		.nameTd {width:250px;}
		.confirmTd {width:150px;}
		tr {width:430px;}
		td {break-word:word-wrap;}
		.pushtop {vertical-align:top;}
		.container {width:90%;}
		.roomIDdiv {width:75%;margin-left:auto;margin-right:auto;}
		.formTd {width:500px;}
		.feedTd {width:700px;}
		.rAlign {text-align:right;vertical-align:bottom;}
	</style>
</head>
<body>
	
	<?php
		session_start();
		$_SESSION['ids'] = array();
	?>
	
	<div class="navbar navbar-default">
		<table border=0 width=75% class='centered'><tr><td>
			<a class="navbar-brand" href='http://ct-kingshu2.rhcloud.com/'><h1>COLLABTUBE</h1></a> 
		</td><td class='rAlign'>
			<button type="button" class="btn btn-warning disabled" id="roomIDNav" style="display:none"> Room <?php echo $_REQUEST['id']; ?> </button>
		</td></tr></table>
		<br>
	</div>
	
	
	<div class='alert alert-dismissable alert-warning roomIDdiv' id='roomIDdiv'>
		<button type='button' class='close' data-dismiss='alert'>&times;</button>
		<h4><br>&emsp;&emsp;Hello, this is Room number: <?php echo $_REQUEST['id']; ?>. Give this number to your friends and ask them to join!<br><br></h4>
	</div>
	
	<table border=0 class='centered' cellpadding=20><tr>
	
    <td> <button id='prev' class="btn btn-primary"> &lt; Prev </button> </td>
    <td> <div id="player"></div> </td>	
	<td> <button id='next' class="btn btn-primary"> Next &gt; </button> </td>
	
	
	</tr></table>
	
	<br>
	<table border=0 class='centered container' cellpadding=20><tr><td class='pushtop'>
		
		<table border=0 class='centered' cellpadding=10>
				<form id='theForm' method='POST' action='post.php'>
					<tr>
						<td colspan=3 style='vertical-align:top'>Post:<textarea name='post' id='postinput' class="form-control" rows=4 cols=50></textarea></td>
					</tr>
					<tr>
						<td class='nameTd'>Name: <input type='text' name='user' class="form-control" placeholder='Your name here' size=5></td>
						<input type='hidden' value='<?php echo $_REQUEST['id']; ?>' name='roomID' id='roomID'>
						<td class='postTd'><input type='submit' value='Post' class="btn btn-info"></td>
						<td class='confirmTd'>
							<div id='submitted' class="btn btn-success disabled">Submitted!</div>
						</td>
					</tr>
				</form>
			
		</table>
	
	</td><td>
	
		<div id='allposts'>
		</div>
	
	</td></tr>
	</table>
</body>
</html>
