$(document).ready(function(){
	/* sort */
var data = [];
	var optionMasonry = {
		gutter: 30,
		columnWidth:1,
		isOriginLeft:true,
		stamp: ".stamp",
		isResizeBound:true,
		itemSelector: '.wd-streamstory-viewall-action-composer'
	};
	$().ready(function(e){
		calMasonry();	
		$(window).resize(function() {
			//logWidthHeitght();
			initMasonry();
		});
	});
	function initMasonry(){
		$('.wd-view-all-list-celebrities').masonry(optionMasonry);
	}
	function calMasonry(){
		
		initMasonry();
	}
	$('.wd-view-all-list-celebrities').delay(500).animate({
		opacity: '1'
	});
});