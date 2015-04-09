// Differentiate between collabtube tabs and youtube tabs because content scripts matches both

if(document.URL.indexOf("ct-kingshu2.rhcloud.com/room") != -1) {
  chrome.runtime.onMessage.addListener(
    function(request, sender, sendResponse) {
    	var postinp = $("#postinput");

      // Add a space if there is no space after a non-zero length post
      if ( postinp.val().length != 0 && postinp.val().slice(-1) != " " ) {
      	postinp.val( postinp.val()+" " );
      }

      postinp.val( postinp.val() + request.ytURL.substring(23) + " " );
      roomNum = $('#roomID').val();
      sendResponse({
  			uid: roomNum+request.ytURL.substring(31), 
  			  alert: "The video titled \""+request.ytTitle+"\" has been added to your CollabTube post in Room "+roomNum
  			});
    }
  );
}

if(document.URL.indexOf("www.youtube.com/watch?v") != -1) { 
	$('#watch-headline-title').append("<button id='addToCT' style='float:right' class='yt-uix-button-default yt-uix-button'>Add to CollabTube</button>");
	$('#addToCT').click( function() {
		chrome.runtime.sendMessage( {video_title: $('#eow-title').attr('title') });
    this.setAttribute("disabled", true);
	});
}
