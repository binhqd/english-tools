function rearrangeItems($div) {
	if (typeof $div == 'undefined') $div = $(document);
	var _appName = navigator.appName;
	if(_appName == "Microsoft Internet Explorer"){
		$div.find('ul.wd-streamstory-lo2 li.wd-streamstory-lo2-item').wookmark({
			itemWidth: 305, // Optional min width of a grid item
			autoResize: true, // This will auto-update the layout when the browser window is resized.
			container: $('.wd-pagelet-stream-wiew'), // Optional, used for some extra CSS styling
			offset: 25 // Optional, the distance between grid items
		});
	} else{
		$div.find('ul.wd-view-all-photo li img').imagesLoaded(function(){
			$div.find('ul.wd-streamstory-lo2 li.wd-streamstory-lo2-item').wookmark({
				itemWidth: 305, // Optional min width of a grid item
				autoResize: true, // This will auto-update the layout when the browser window is resized.
				container: $('.wd-pagelet-stream-wiew'), // Optional, used for some extra CSS styling
				offset: 25 // Optional, the distance between grid items
			});
			if($(window).width() < 1285){
		       $div.find('ul.wd-streamstory-lo2 li.wd-streamstory-lo2-item').wookmark({
					autoResize: true, // This will auto-update the layout when the browser window is resized.
					container: $('.wd-pagelet-stream-wiew'), // Optional, used for some extra CSS styling
		        	offset: 20
		        });
			}
			if($(window).width() < 1024){
			    $div.find('ul.wd-streamstory-lo2 li.wd-streamstory-lo2-item').wookmark({
					autoResize: true, // This will auto-update the layout when the browser window is resized.
					container: $('.wd-pagelet-stream-wiew'), // Optional, used for some extra CSS styling
			    	offset: 15
			    });
			}
		});
	};
}
$(document).ready(function(){
	/* sort */
	rearrangeItems();
	$('.wd-pagelet-stream-wiew').delay(500).animate({
		opacity: '1'
	});
	
	//popup
	$('.wd-open-popup').magnificPopup({
		tClose: 'Close',closeBtnInside:true
	});
});