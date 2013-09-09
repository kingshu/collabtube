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
          videoId: 'a1Y73sPHKxw',
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
      //    The function indicates that when playing a video (state=1),
      //    the player should play for six seconds and then stop.
      //var done = false;
      function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.ENDED) {
          player.loadVideoById(window.playlist[window.nowPlaying++], 0, "large");
      //    done = true;
        }
      }
      
      function stopVideo() {
        player.stopVideo();
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
						var urlP = /watch\?v=(\w{11})/g ;
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
			
			window.nowPlaying = 0;
			
			$('#submitted').hide();
			
			loop();			
		
			$('#theForm').ajaxForm(function() { 
				$('#submitted').show();
				$('#submitted').fadeOut(3000);
				$('#postinput').val('');
			});         
		
			  $('#prev').click(function() {
				  console.log(player);
				  window.nowPlaying -= 2;
				  if (window.nowPlaying < 0) 
					  alert ('There are no more videos before this'); 
				  else
					  player.loadVideoById(window.playlist[window.nowPlaying++], 0, "large");
			  });
			
			  $('#next').click(function() {
				  if (window.nowPlaying >= window.playlist.length)
					  alert ('There are no more videos after this');
				  else
					  player.loadVideoById(window.playlist[window.nowPlaying++], 0, "large");
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
		.formTd {width:500px;}
		.feedTd {width:700px;}
	</style>
</head>
<body>
	
	<div class="navbar navbar-default">
	<h1>&emsp;&emsp;<a href='localhost/collabtube'>COLLABTUBE</a></h1> <br>
	</div>
	<?php
		session_start();
		$_SESSION['ids'] = array();
	?>
	
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
