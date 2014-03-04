$(document).ready(function(){
	$('.wd-call-pp-load-popup').magnificPopup({tClose: 'Close',showCloseBtn:false}).trigger('click');
	$('.wd-call-pp-load-popup').magnificPopup({tClose: 'Close',closeBtnInside:true,showCloseBtn:false});

	$('.wd-add-new-colleague').click(function(){
		$('.wd-input-add-new-colleague').show();
	});
	$('.wd-add-info-you-know .wd-search-activities-toggle ul a').not('.wd-add-new-colleague').click(function(){
		$('.wd-input-add-new-colleague').hide();
	});
	$('.wd-choose-colleague').click(function(){
		$('.wd-pagelet-stream-form').show();
	});
	$('.wd-radio-cus').not('.wd-choose-colleague').click(function(){
		$('.wd-pagelet-stream-form').hide();
	});
	if($('.wd-choose-colleague').attr('checked')=='checked'){
		$('.wd-pagelet-stream-form').show();
	}
});