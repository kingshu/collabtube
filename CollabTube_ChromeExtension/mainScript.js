chrome.runtime.onMessage.addListener(
  function(request, sender, sendResponse) {
  	var postinp = $("#postinput");
  	if ( postinp.val().slice(-1) != " " )
    	postinp.val( postinp.val()+" " );
    postinp.val( request.ytURL.substring(23) + " " );
    roomNum = $('#roomID').val();
    sendResponse({
    				uid: roomNum+request.ytURL.substring(31), 
    			  	alert: "The video has been added to your CollabTube post in Room "+roomNum
    			});
  });

if(document.URL.indexOf("www.youtube.com/watch?v") != -1) {
	$('#watch-headline-title').append("<button id='addToCT' style='float:right' class='yt-uix-button-default yt-uix-button'>Add to CollabTube</button>");
	$('#addToCT').click( function() {
		chrome.runtime.sendMessage( {addButton:"clicked"}, function(response) {
		  console.log(response);
		});
	})
}
