var load = true;
var masonry = null;
var objPhoto = {
	element:null,
	href:null
};
var objCountFile = {
		article:{
			addFile: 0 ,
			doneFile: 0
		},
		photo:{
			addFile: 0 ,
			doneFile: 0
		}
	};
var optionMasonry = {
	gutter: 32,
	columnWidth:1,
	isFitWidth: true,
	isOriginLeft:true,
	isAnimated: true,
	animationOptions: {
		duration: 750,
		easing: 'linear',
		queue: false
	},
	cornerStampSelector: ".corner-stamp",
	isResizeBound:true,
	itemSelector: '.image-item'
};
function deletePhoto(){
	if(objPhoto.href != null){
		$containerLi.masonry( 'remove',  objPhoto.element,true);
		$containerLi.masonry(optionMasonry);
		$.get(objPhoto.href,function(res){
			
		});
		objPhoto.href = null;
		objPhoto.element = null;
		$('.mfp-close').trigger('click');
	}
}
function initMasonry(){
	calScreen();
	$.each($('#allPhotoContainer .image-item'), function(key, value) {
		var _this = $(this);
		$(this).imagesLoaded(function() {

			_this.animate({
				opacity : 1
			}, 800);
			$('#allPhotoContainer').masonry(optionMasonry);
		});
	});
	
}

function calScreen(){
	if (($(window).width() > 1599)) {
		optionMasonry.gutter = 32;
		//console.log('a'+optionMasonry.gutter);
	}else if ($(window).width() > 1439 && $(window).width() < 1600  ){
		optionMasonry.gutter = 30;
		//console.log('b'+optionMasonry.gutter);
	}
	else if ($(window).width() > 1359 && $(window).width() < 1440  ){
		optionMasonry.gutter = 5;
		// console.log('c'+optionMasonry.gutter);
	}
	else if ($(window).width() > 1279 && $(window).width() < 1360  ){
		optionMasonry.gutter = 5;
		// console.log('d'+optionMasonry.gutter);
	}else if ($(window).width() > 1023 && $(window).width() < 1280  ){
		optionMasonry.gutter = 1;
		// console.log('e'+optionMasonry.gutter);
	}
	else if ($(window).width() > 767 && $(window).width() < 1024  ){
		optionMasonry.gutter = 178;
		// console.log('f'+optionMasonry.gutter);
	}
}

function removeBtnDiabledPhoto(){
	if(objCountFile.photo.addFile == 0){
		$("#doneUpload").attr("class","");
		$("#doneUpload").addClass("wd-bt-cancel");
		$("#doneUpload").hide();
	}
}
function cancelPhotos(){
	$("#pushImages"+globalToken).html('');
	objCountFile.photo.addFile = 0;
	objCountFile.photo.doneFile = 0;
	$("#filesContainer"+globalToken).html('');
	$(".wd-pagelet-composer-mainform").slideUp();
	$("#doneUpload").hide();
	$("#cancelUpload").hide();
}
function addPhotos(){
	triggerAddFileViewAllPhoto(globalToken);
}
function triggerAddFileViewAllPhoto(token){
	var gallery = $(".gallery"+token);
	gallery.find('form .fileupload-buttonbar .span7 input:file').trigger('click');
}

$(document).ready(function(e) {
	initMasonry();
	$('body').on('click', '.wd-icon-remove', function(e){
		
		$("#pp-confirm").magnificPopup({tClose: 'Close (Esc)',closeBtnInside:false}).trigger('click');
		
		objPhoto.element = $(this).parent();
		objPhoto.href = $(this).attr('href');
		
		
		return false;
	});
	initMasonry();
	$(document).ajaxComplete(function() {
		initPopup();
	});
	
	$("#doneUpload").click(function(e){
		var content = $('.wd-main-content textarea').val();
		
		if($(this).hasClass('wd-bt-cancel')){
			return false;
		}
		
		if($.trim(content) == ""){
			$('textarea.wd-font-11').focus();
			return false;
		}
		
		var frmUpload = $("#formPullImages");
		
		var _this = $(this);
		$("#doneUpload").attr("class","");
		$("#doneUpload").addClass("wd-bt-cancel");
		
		$.ajax({
			type:"POST",
			url:homeURL+"/photos/views/upload?nodeId="+_this.attr('nodeid'),
			data:frmUpload.serialize(),
			success:function(res){
				
				$("#doneUpload").attr("class","wd-bt-done-upload");
				$("#doneUpload").removeClass("wd-bt-cancel");
				if(res.error){
					
					console.log(res.message);
				}else{
					// $("#header-upload-done").fadeOut(1000);
					window.location.reload();
					
				}
			
			},error: function (xhr, ajaxOptions, thrownError) {
				console.log(xhr.responseText);
			}
		});
	});
	
});

$containerLi.infinitescroll({
		navSelector  : 'ul.pages-photo li.selected',    // selector for the paged navigation 
		nextSelector : 'ul.pages-photo li.selected a',  // selector for the NEXT link (to page 2)
		itemSelector : '.image-item',     // selector for all items you'll retrieve
		animate      :false,
		maxPage:maxPages,
		loading: {
			finishedMsg: 'No more pages to load.',
			img: homeURL+'/myzone_v1/img/front/ajax-loader.gif'
		}
	},
	// trigger Masonry as a callback
	function( newElements ) {
		// hide new items while they are loading
		var $newElems = $( newElements ).css({opacity:0});
		// $newElems.animate({ opacity: 1 });
		$.each($( newElements ),function(key,value){
			// ensure that images load before adding to masonry layout
			$(value).imagesLoaded(function(){
				// show elems now they're ready
				// $(value).animate({ opacity: 1 },700);
				$containerLi.masonry( 'appended', $(value), true ); 
			});
		});
	}
);
