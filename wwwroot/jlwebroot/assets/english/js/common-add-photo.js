$(document).ready(function(){
	/* sort */
	var _wookMarkG = $('ul.wd-view-all-photo li');
	var _appName = navigator.appName;
	if(_appName == "Microsoft Internet Explorer"){
		_wookMarkG.wookmark({
			itemWidth: 210, // Optional min width of a grid item
			autoResize: true, // This will auto-update the layout when the browser window is resized.
			container: $('.wd-pagelet-images-wiew'), // Optional, used for some extra CSS styling
			offset: 45 // Optional, the distance between grid items
		});
	} else{
		$('ul.wd-view-all-photo li img').imagesLoaded(function(){
			_wookMarkG.wookmark({
				itemWidth: 210, // Optional min width of a grid item
				autoResize: true, // This will auto-update the layout when the browser window is resized.
				container: $('.wd-pagelet-images-wiew'), // Optional, used for some extra CSS styling
				offset: 45 // Optional, the distance between grid items
			});
			if($(window).width()<1030){
				_wookMarkG.wookmark({
					itemWidth: 210, // Optional min width of a grid item
					autoResize: true, // This will auto-update the layout when the browser window is resized.
					container: $('.wd-pagelet-images-wiew'), // Optional, used for some extra CSS styling
					offset: 30 // Optional, the distance between grid items
				});
			}
		});
	};
	$('.wd-pagelet-images-wiew').delay(500).animate({
		opacity: '1'
	});
	/* scroll top for button edit file profile user*/
	var widthScreen =$(window).width();	
	$(window).scroll(function(){
		if ($(this).scrollTop() > 200) {
			if(widthScreen > 1024){
				$('.wd-headline-submit .wd-headline-main').css({"margin-right":"248px"});
			}
			$('.wd-headline-submit').css({"position":"fixed","top":"89px"});
		} else {
			$('.wd-headline-submit .wd-headline-main').css({"margin-right":"0"});
			$('.wd-headline-submit').css({"position":"static","top":"auto"}); 
		}
	});
});