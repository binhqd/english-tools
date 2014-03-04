var allPhotoContainer = $('#allPhotoContainer');
var load = true;
var masonry = null;
var page = null;
var globalToken = null;
var objPhoto = {
	element : null,
	href : null
};
var objCountFile = {
	article : {
		addFile : 0,
		doneFile : 0
	},
	photo : {
		addFile : 0,
		doneFile : 0
	}
};

var optionMasonry = {
	gutter : 32,
	columnWidth : 1,
	isFitWidth : true,
	isOriginLeft : true,
	isAnimated : true,
	animationOptions : {
		duration : 750,
		easing : 'linear',
		queue : false
	},
	cornerStampSelector : ".corner-stamp",
	isResizeBound : true,
	itemSelector : '.image-item'
};


function photoDeleted() {
	$('.mfp-close').trigger('click');
	
	var _lnk = zone.photo.tmpObject;
	
	allPhotoContainer.masonry('remove', _lnk.parent(), true);
	allPhotoContainer.masonry(optionMasonry);
	
}
function initMasonry() {


}


function removeBtnDiabledPhoto() {
	if (objCountFile.photo.addFile == 0) {
		$("#doneUpload,#doneUploadAlbum").attr("class", "");
		$("#doneUpload,#doneUploadAlbum").addClass("wd-bt-cancel");
		$("#doneUpload,#doneUploadAlbum").hide();
	}
}
function cancelPhotos() {
	$("#pushImages" + globalToken).html('');
	objCountFile.photo.addFile = 0;
	objCountFile.photo.doneFile = 0;
	$('.wd-pageletphoto-upload-completed').remove();
	if(page == null) $(".wd-pagelet-composer-mainform").hide();
	$("#doneUpload,#doneUploadAlbum").hide();
}
function addPhotos() {
	triggerAddFileViewAllPhoto(globalToken);
}
function triggerAddFileViewAllPhoto(token) {
	var gallery = $(".gallery" + token);
	gallery.find('form .fileupload-buttonbar .span7 input:file').trigger(
			'click');
}

$(document).ready(function(e) {
	
	$("img.lazy").unveil(300);
	
	$('body').on('click', '.show-more-album', function(e){
		var _this = $(this);
		var p = parseInt(_this.attr('page'))+1;
		var limit = parseInt(_this.attr('limit'));
		_this.find('img').show();
		$.ajax({
			type : "GET",
			url : _this.attr('href'),
			data:"&page="+p,
			success : function(res) {
				_this.find('img').hide();
				if (res.error) {
					
				} else {
					allPhotoContainer.append(res);
					$("img.lazy").unveil(300);
				}
			},
			error : function(xhr, ajaxOptions, thrownError) {
				_this.attr('page',p-1);
				_this.find('img').hide();
				console.log(xhr.responseText);
			}
		});
		return false;
	});

	$('body').on('click', '.show-more', function(e){
		var _this = $(this);
		var p = parseInt(_this.attr('page'))+1;
		var limit = parseInt(_this.attr('limit'));
		_this.find('img').show();
		$.ajax({
			type : "GET",
			url : _this.attr('href'),
			data:"&page="+p,
			success : function(res) {
				_this.find('img').hide();
				if (res.error) {
					
				} else {
				
					if(res.length!=0){
						
						if(res.length!=limit) _this.hide();
						
						var renderedPhotos = $.tmpl($('#tmplListPhotoItem'), res);
						allPhotoContainer.append(renderedPhotos); 
						
						$("img.lazy").unveil(300);
						
						zone.photo.cachePhotos(res);
						_this.attr('page',p);
						$(".wd-font-11").val('');
					}else{
						_this.hide();
					}
				}
			},
			error : function(xhr, ajaxOptions, thrownError) {
				_this.attr('page',p-1);
				_this.find('img').hide();
				console.log(xhr.responseText);
			}
		});
		return false;
	});
	// link remove photo
	$('body').on('click', '.lnkRemovePhoto', function(e){
		var _this = $(this);
		zone.photo.tmpObject = _this;
		
		$('#btnDeletePhoto').attr('onclick','zone.photo.deletePhoto(photoDeleted)');
		
		$("#pp-confirm").magnificPopup({
			tClose : 'Close (Esc)',
			closeBtnInside : false
		}).trigger('click');
		
		return false;
	});
	
	$('body').on('keyup', '.wd-font-11', function(e){
		if(page == null) $("#nameAlbum").val($(this).val());
		else $("#desAlbum").val($(this).val());
	});
	$("#doneUpload").click(function(e) {
		
		var content = $('.wd-main-content textarea').val();

		if ($(this).hasClass('wd-bt-cancel')) {
			return false;
		}
		if(typeof $(this).attr('validate') =="undefined"){
			if ($.trim(content) == "") {
				$('textarea.wd-font-11').focus();
				return false;
			}
		}

		var frmUpload = $("#formPullImages");

		var _this = $(this);
		//$("#doneUpload").hide();
		$("#cancelUpload").hide();
		$("#doneUpload").addClass("wd-bt-cancel");
		
		if($(".wd-empty-results-description").length != 0){
			$(".wd-empty-results-description").remove();
		}
		$.ajax({
			type : "POST",
			url : frmUpload.attr('action'),
			data : frmUpload.serialize(),
			success : function(res) {
				$("#doneUpload").attr("class", "wd-bt-done-upload");
				$("#doneUpload").removeClass("wd-bt-cancel");
				
				
				$(".urlViewAllPhotos .wd-value").html(parseInt($(".urlViewAllPhotos .wd-value").html()) + objCountFile.photo.doneFile);
				
				
				
				
				if (res.error) {
					//console.log(res);
				} else {
					var renderedPhotos = $.tmpl($('#tmplListPhotoItem'), res.photos);

					allPhotoContainer.prepend(renderedPhotos); 
					
					$("img.lazy").unveil(300);
					
					// zone.photo.cachePhotos(res.photos);
					// var test = $.merge(res.photos, photos);
					// console.log(test)
					// console.log(test.photos)
					
					zone.photo.cachePhotos(res.photos);
					$("#totalContributePhoto").html( parseInt($("#totalContributePhoto").html()) + objCountFile.photo.doneFile );
					$('.totalPhotoUser').html(parseInt($(".totalPhotoUser").html()) + objCountFile.photo.doneFile);
					
					cancelPhotos();
					$(".wd-font-11").val('');
					//console.log(res);
					//window.location.reload();
				}
			},
			error : function(xhr, ajaxOptions, thrownError) {
				console.log(xhr.responseText);
			}
		});
	});
	$("#doneUploadAlbum").click(function(e) {
		var content = $('.wd-main-content textarea').val();

		if ($(this).hasClass('wd-bt-cancel')) {
			return false;
		}

		if ($.trim(content) == "") {
			$('textarea.wd-font-11').focus();
			return false;
		}

		var frmUpload = $("#formPullImages");

		var _this = $(this);
		//$("#doneUpload").hide();
		$("#cancelUpload").hide();
		$("#doneUploadAlbum").addClass("wd-bt-cancel");
		
		if($(".wd-empty-results-description").length != 0){
			$(".wd-empty-results-description").remove();
		}
		$.ajax({
			type : "POST",
			url : frmUpload.attr('action'),
			data : frmUpload.serialize(),
			success : function(res) {
				$("#doneUploadAlbum").attr("class", "wd-bt-done-upload");
				$("#doneUploadAlbum").removeClass("wd-bt-cancel");
				
				
				$(".urlViewAllPhotos .wd-value").html(parseInt($(".urlViewAllPhotos .wd-value").html()) + objCountFile.photo.doneFile);
				
				
				
				
				if (res.error) {
					//console.log(res);
				} else {
					var html = '';
					$.each(res.photos,function(x,y){
						if(x==0){
							html+= '<li  style="display:block;opacity:1;" >'+
								'<div class="wd-round-image">'+
										'<a href="'+CDNUrl+'/resource/album?album_id='+y.photo.album_id+'">'+
											'<img class="lazy" src="'+homeURL+'/myzone_v1/img/front/grey.gif" data-src="'+CDNUrl+'/upload/gallery/fill/206-206/'+y.photo.image+'?album_id='+y.photo.album_id+'">'+
										'</a>'+
									'<div class="wd-info-image">'+
										'<a class="wd-like-bt" href="javascript:void(0)"></a>'+
										'<a href="javascript:void(0)" class="wd-like-number"><span class="wd-text-st">0</span>Likes</a>'+
									'</div>'+
								'</div>'+
							'</li>';
						}
					});
					$("#allPhotoContainer").prepend(html);
					
					$("img.lazy").unveil(300);
					
					
					zone.photo.cachePhotos(res.photos);
					$("#totalContributePhoto").html( parseInt($("#totalContributePhoto").html()) + objCountFile.photo.doneFile );
					$('.totalPhotoUser').html(parseInt($(".totalPhotoUser").html()) + objCountFile.photo.doneFile);
					
					cancelPhotos();
					$(".wd-font-11").val('');
					//console.log(res);
					//window.location.reload();
				}
				
			},
			error : function(xhr, ajaxOptions, thrownError) {
				console.log(xhr.responseText);
			}
		});
	});
	
	$('body').on('keypress', '.photoDescription textarea', function(e){
		if(e.keyCode == 13){
			var _this = $(this);
			var frmUpload = $("#formPullImages");
			$.ajax({
				type:"POST",
				url:homeURL+"/photos/views/updateAlbumInfo?nodeId="+$("#doneUpload").attr('album_id'),
				data:frmUpload.serialize(),
				success:function(res){
					if(res.error){
						console.log(res.message);
					}else{
						_this.parent().hide();
						
						if(res.attributes.description  == ""){
							$('.addDes').show();
							$('.editDes').hide();
						}else{
							$('.editDes').show();
							$('.addDes').hide();
						}
						$('.pullDes').html(_this.val());
						
					}
				},error: function (xhr, ajaxOptions, thrownError) {
					console.log(xhr.responseText);
				}
			});
			return false;
		}
	
	});
	zone.photo.init({
		beforePopupOpen : function() {
		},
		afterPopupOpened : function() {
		
		},
		afterPopupClosed : function() {
			
		}
	});
	
	$('body').on('click', '.lnkViewPhotoDetail', function(e){
		zone.photo.showDialog(false);
		
		var _this = $(this);
		
		// Loading images
		var photo_id = _this.attr('photo_id');
		var album_id = _this.attr('album_id');
		var image = _this.attr('filename');
		photoType = _this.attr('type');
		// console.log(photo_id)
		// console.log(album_id)
		// console.log(image)
		// console.log(photoType)
		zone.photo.loadPhoto(photo_id, album_id, image, photoType);
		
		e.preventDefault();
	});
	
	$('body').on('click', '.make-primary', function(e){
		var _this = $(this);
		if(!_this.hasClass("wd-icon-make-primary-avatar-act")){
			jConfirm('Are you sure you want to make primary this photo?', 'Make primary photo', function(r) {
				if(r){
					$.get(_this.attr('href'),function(res){
						if(res.error){
						
						}else{
							$.each($(".me"),function(x,y){
								var size = $(y).attr("size");
								$(y).attr("src",CDNUrl+"/upload/user-photos/"+jlbd.user.collection.current.user.id+"/fill/"+size+"/"+res.photo.image+"?album_id="+jlbd.user.collection.current.user.id);
							});
							// $("#"+_this.attr('ref')).fadeOut(500);
							
							// var renderedPhotos = $.tmpl($('#tmplListPhotoItem'), res.photo);

							// allPhotoContainer.prepend(renderedPhotos); 
					
							// $("img.lazy").unveil(300);
					
							// zone.photo.cachePhotos(res.photo);
							
		
							
						}
					});
					
					$.each($("#allPhotoContainer li .make-primary"),function(x,y){
						if($(this).hasClass("wd-icon-make-primary-avatar-act")){
							$(this).removeClass('wd-icon-make-primary-avatar-act');
							$(this).addClass('wd-icon-make-primary-avatar');
						}
					});
					
					_this.addClass('wd-icon-make-primary-avatar-act');
				}
			});
		}
		return false;
	});
	
	$('body').on('click', '.lnkRemoveProfilePhoto', function(e){
		var _this = $(this);
		zone.photo.tmpObject = _this;
		jConfirm('Are you sure you want to delete this photo?', 'Delete photo', function(r) {
			if(r){
				$.get(_this.attr('href'),function(res){
				
				});
				$("#"+_this.attr('ref')).fadeOut(500);
			}
		});
		
		
		return false;
	});


	
});


