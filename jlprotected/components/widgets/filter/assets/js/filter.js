
var loadFirstPageProfile = true;
$( window ).bind( "popstate", function( e ) {
	// back button in browser
	var returnLocation = history.location || document.location;
	
	

	if (returnLocation.href.indexOf('profile') == -1) {
		window.location.href = returnLocation.href;
	} else{
		if(!loadFirstPageProfile){
			loadSort(returnLocation.href,0);
		}
	};
	loadFirstPageProfile = false;

});
$().ready(function(e){	
	$('.sort-wall-text .text span').on('click',function(e){
		$("span .icon").trigger('click');
	});
	$("a.sort").on('click',function(e){
		var tmpUrl = $(this).attr('href');
		$(".sort-wall-text label.text span").html(" : "+$(this).html());
		loadSort(tmpUrl);
		return false;
	});
});
function loadSort(url,isHistory){
	
	isHistory = typeof isHistory !== 'undefined' ? isHistory : 1;
	$.get(url,function(newElements){
		$('#articleSelector').html(newElements);
		$('#articleSelector').infinitescroll({
			'loadingText':'Loading...',
			'donetext':' ',
			'itemSelector':'#article-item',
			'navSelector':'div.infinite_navigation',
			'nextSelector':'div.infinite_navigation a:first',
			'bufferPx':'300',
			'state': {
				isDuringAjax: false,
				isDestroyed: false,
				isDone: false,
				currPage: 1
			},
			'maxPage':3000,
			'path': [url + "&page="]
		});


		$('#articleSelector').infinitescroll('bind');
	});
	$(document).trigger('click');
	if(isHistory) history.pushState( null, null , url);
	
}