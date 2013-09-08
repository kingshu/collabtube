<html>
<head>
	<script src='js/jquery-1.9.1.js'></script>
	
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
				$('#'+id).load('loader.php', function() {
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
</head>
<body>
	<?php
		session_start();
		$_SESSION['ids'] = array();
	?>
	
	
	<!-- 1. The <iframe> (and video player) will replace this <div> tag. -->
    <div id="player"></div>

   
	<br>
	<button id='prev'> &lt; Prev </button> &emsp; <button id='next'> Next &gt; </button>
	<br>
	
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
