chrome.runtime.onMessage.addListener(
  function(request, sender, sendResponse) {
	chrome.tabs.query({url:"http://ct-kingshu2.rhcloud.com/room*"}, function(tabs) {
		if (tabs.length==0)
			alert ("You aren't in any CollabTube room at the moment");
		for (var i=0; i<tabs.length; i++)	
			chrome.tabs.sendMessage(tabs[i].id, { ytURL:sender.url }, function(response) {
				var opt = {
				  type: "basic",
				  title: "CollabTube Information",
				  message: response.alert,
				  iconUrl: "notif_icon.png"
				};
				chrome.notifications.create(response.uid, opt, function(c){});
			});
	}); 
  }
);