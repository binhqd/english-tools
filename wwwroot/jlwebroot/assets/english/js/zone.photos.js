;(function($, scope){
	scope['photo']	= {
		btnNext : null,
		btnPrev : null,
		navNext : null,
		navPrev : null,
		_preloadImages : {},
		_preloadImagesContainer : null,
		_caches : {},
		photoCurrent:null,
		beforePopupOpen : function() {},
		afterPopupOpened : function() {},
		afterPopupClosed : function() {},
		cache : function(photoID, photoData) {
			this._caches[photoID] = photoData;
		},
		retrieve : function(photoID) {
			if (typeof this._caches[photoID] != "undefined") {
				return this._caches[photoID];
			} else {
				return null;
			}
		},
		setPrev : function(photoID, prevPhotoID) {
			if (typeof this._caches[photoID].prev != "object" || typeof this._caches[photoID].prev.id == "undefined")
			this._caches[photoID].prev = {
				status : 'Done',
				id : prevPhotoID
			};
		},
		
		setNext : function(photoID, nextPhotoID) {
			if (typeof this._caches[photoID].next != "object" || typeof this._caches[photoID].next.id == "undefined")
			this._caches[photoID].next = {
				status : 'Done',
				id : nextPhotoID
			};
		},
		
		cachePhotos : function(photos) {
			var prev = null;
			for (var i in photos) {
//				console.log(photos[i].photo.id);
				// save cache
				this.cache(photos[i].photo.id, photos[i]);
				// set prev
				if (prev != null) {
					this.setPrev(photos[i].photo.id, prev.photo.id);
//					console.log('prev: ' + prev.photo.id);
				}
				
				// Set prev for next use
				prev = photos[i];
				
				// set next
				var nextIndex = parseInt(i) + 1;
				var next = photos[nextIndex];
				if (typeof next != "undefined") {
					this.setNext(photos[i].photo.id, next.photo.id);
//					console.log('Next: ' + next.photo.id);
				}
				
//				console.log('---------------------')
			}
		},
		renderPhotoInfo:function(photos){
			if(photos.photo.poster.id == jlbd.user.collection.current.user.id){
				if(photos.photo.description != null && photos.photo.description != ''){
					$(".wd-desc-photo").html(photos.photo.description);
					$(".wd-add-desc-ppphoto-bt").html("Update a description");
					$(".frmAddDesPhotoForm").find('textarea').val(photos.photo.description);
				}else{
					$(".wd-desc-photo").html("");
					$(".wd-add-desc-ppphoto-bt").html("Add a description");
					$(".frmAddDesPhotoForm").find('textarea').val('');
				}
				$(".wd-add-desc-ppphoto-bt").show();
				$(".wd-add-desc-ppphoto-content").hide();
				$(".frmAddDesPhotoForm").find('.hiddenPhotoID').val(photos.photo.id);
			}else{
				$(".wd-add-desc-ppphoto-bt").hide();
				$(".wd-add-desc-ppphoto-content").hide();
				$(".wd-desc-photo").html("");
			}
		
			
			
			
			
		},
		/**
		 * This method is used to render a set of photos
		 */
		render : function(photos) {
			photos.like.style = {
				floatLeft : false
			}
			
			zone.photo.renderPhotoInfo(photos);
			
			
			_photoPoster = $.tmpl($('#tmpPosterInfo'), photos);
			_photoPoster.find('.timeago').timeago();
			_posterContainer.html(_photoPoster);
			
			
			_photoLike = $.tmpl($('#tmplLike'), photos.like);
			_likeContainer.html(_photoLike);
			
			_photoReceiver = $.tmpl($('#tmpPhotoReceiver'), photos);
			_photoReceiver.find('.timeago').timeago();
			_receiverContainer.html(_photoReceiver);
			
			_photoComments = $.tmpl($('#tmpPhotoCommentItem'), photos.comments);
			_photoComments.find('.timeago').timeago();
			
			if (commentScroller == null) {
				// _photoCommentContainer.prepend(_photoComments);
			} else {
				
				// commentScroller.getContentPane().html('').prepend(_photoComments);
			}
			try{
				commentScroller.getContentPane().html('');
			}catch(error){
				console.log(error.message);
			}
			
			_photoContent = $.tmpl($('#areaPhoto'), photos);
			photoArea.html(_photoContent);
			
			_photoCommentContainer.data('photo', photos);
			
			var photo = _photoContent.find('img');
			_lnkViewMoreComments.find('span.wd-text').html('<img src="'+homeURL+'/myzone_v1/img/front/ajax-loader.gif" alt="loading" style="width:16px;">');
			photo.imagesLoaded(function(){
				photo.animate({ opacity: 1 }, 800,function(e){
					/**
					 * show image success (thinhpq add code)
					 * 20/08/2013
					 **/
					_photoCommentContainer.height(photo.height() - 152);
					if (commentScroller == null) {
						commentScroller = _photoCommentContainer.jScrollPane({
							horizontalGutter:5,
							verticalGutter:5,
							mouseWheelSpeed:50,
							//autoReinitialise: true,
							'showArrows': false
						}).data('jsp');
					} else {
						commentScroller.reinitialise();
					}
					
					// if (photos.photo.totalComments > (photos.comments.length + photos.photo.commentOffset)) {
					if (photos.photo.totalComments !=0) {
						var strTotalComment = ' comment';
						if(photos.photo.totalComments > 1)
							strTotalComment = ' comments';
							
						_lnkViewMoreComments.find('span.wd-text').html('View all <label id="numberComment">' + photos.photo.totalComments + '</label>'+ strTotalComment);
						_viewAllCommentsContainer.show();
						
						// set attributes
						_lnkViewMoreComments.attr('limit', photos.photo.totalComments);
						_lnkViewMoreComments.attr('objectId', photos.photo.id);
						_lnkViewMoreComments.attr('offset', photos.comments.length);
						_lnkViewMoreComments.attr('token', photos.token);
						_lnkViewMoreComments.attr('loaddata', 0);
					}else{
						_lnkViewMoreComments.find('span.wd-text').html('0 comments');
						_viewAllCommentsContainer.show();
					}
					
					var txtCommentWrapper = $('#txtCommentFormWrapper');
					txtCommentWrapper.html('');
					
					var commentFormData = {
						action : homeURL + '/photos/default/addComment',
						token : photos.token,
						object_id : photos.photo.id,
						htmlOptions : [
							{key: 'rows', value: '2'},
							{key: 'cols', value: '97'},
							{key: 'class', value: 'wd-font-11 photo-form-input'},
							{key: 'style', value: 'overflow: hidden; word-wrap: break-word; resize: none; height: 37px;'}
						]
					}
					var txtCommentForm = $.tmpl($('#tmplAddCommentForm'), commentFormData);
					txtCommentWrapper.append(txtCommentForm);
					
					
				});

				
			});

			
		},
		
		/**
		 * This method return an jQuery object of preload image container
		 */
		preloadImageContainer : function() {
			if (this._preloadImagesContainer == null) {
				this._preloadImagesContainer = $('<div id="preloadImages" style="display:none"/>');
				$('body').append(this._preloadImagesContainer);
			}
			
			return this._preloadImagesContainer;
		},
		
		/**
		 * This method is used to perform a preload of an image given by an url
		 */
		preloadImage : function(url) {
			if (typeof this._preloadImages[url] == "undefined") {
				var _img = $("<img src='"+url+"'/>");
				this.preloadImageContainer().append(_img);
				this._preloadImages[url] = true;
			}
		},
		
		/**
		 * This method is used to get information of next photo
		 */
		getNextPhoto : function(photo_id, album_id, photoType) {
			if (typeof this._caches[photo_id].next == "undefined") {
				this._caches[photo_id].next = {
					status : 'Loading'
				}
				// build URL
				// build URL
				var url = "";
				if (zone.photo.navNext.length > 0) {
					var path = zone.photo.navNext.attr('path');
					var query = zone.photo.navNext.attr('query');
					url = path + query + photo_id
				} else {
					url = homeURL + '/photos/detail?photo_id=' + photo_id + '&album_id=' + album_id + '&comments=5&next=true&type='+photoType;
				}
				
				$.ajax({
					url : url,
					success : function(res) {
						
						if (typeof res.error == "undefined" || !res.error) {
							
							zone.photo.preloadImage(res.photo.url);
							// If user is call for rendering, then render photo after complete
							if (zone.photo._caches[photo_id].next.status == 'Rendering') {
								zone.photo.render(res);
							}
							
							zone.photo.setNext(photo_id, res.photo.id);
							if (typeof zone.photo._caches[res.photo.id] == "undefined") {
								zone.photo._caches[res.photo.id] = res;
							}
							zone.photo.setPrev(res.photo.id, photo_id);
						} else {
							// TODO: alert something here
						}
					}
				});
			}
		},
		
		/**
		 * This method is used to get information of previous photo
		 */
		getPrevPhoto : function(photo_id, album_id, photoType) {
			if (typeof this._caches[photo_id].prev == "undefined") {
				this._caches[photo_id].prev = {
					status : 'Loading'
				}
				
				// build URL
				var url = "";
				if (zone.photo.navPrev.length > 0) {
					var path = zone.photo.navPrev.attr('path');
					var query = zone.photo.navPrev.attr('query');
					url = path + query + photo_id
				} else {
					url = homeURL + '/photos/detail?photo_id=' + photo_id + '&album_id=' + album_id + '&comments=5&prev=true&type='+photoType;
				}
				
				//console.log(url);return;
				$.ajax({
					url : url,
					success : function(res) {
						if (typeof res.error == "undefined" || !res.error) {
							
							// If user is call for rendering, then render photo after complete
							if (zone.photo._caches[photo_id].prev.status == 'Rendering') {
								zone.photo.render(res);
							}
							
							// set prev for current photo
							zone.photo.setPrev(photo_id, res.photo.id);
							if (typeof zone.photo._caches[res.photo.id] == "undefined") {
								// save get photo to cache
								zone.photo._caches[res.photo.id] = res;
							}
							zone.photo.setNext(res.photo.id, photo_id);
						} else {
							// TODO: alert something here
						}
					}
				});
			}
		},
		
		/**
		 * This method is used to load an individual photo
		 */
		loadPhoto : function(photo_id, album_id, image, photoType) {
			
			if (_photoContent != null) _photoContent.remove();
			if (_photoPoster != null) _photoPoster.remove();
			//_photoCommentContainer.html('');
			
			// _viewAllCommentsContainer.hide();
			
			if (typeof this._caches[photo_id] != "undefined" && (typeof this._caches[photo_id].invalidate == "undefined" || this._caches[photo_id].invalidate == false)) {
				var res = this._caches[photo_id];
				this.render(res);
				this.getNextPhoto(res.photo.id, res.photo.album_id, photoType);
				this.getPrevPhoto(res.photo.id, res.photo.album_id, photoType);
			} else {
				$.ajax({
					url : homeURL + '/photos/detail?photo_id=' + photo_id + '&album_id=' + album_id + '&comments=5&type=' + photoType,
					success : function(res) {
						if (typeof res.error == "undefined" || !res.error) {
							zone.photo.render(res);
							
							// get next-prev photo
							zone.photo._caches[res.photo.id] = res;
							
							zone.photo.getNextPhoto(res.photo.id, res.photo.album_id, photoType);
							zone.photo.getPrevPhoto(res.photo.id, res.photo.album_id, photoType);
						} else {
							// TODO: alert something here
						}
					}
				});
			}
		},
		
		deletePhoto : function (callback) {
			var _lnk = zone.photo.tmpObject;
			var _url = _lnk.attr('href');
			
			$.ajax({
				url : _url,
				success : function(res) {
					if (res.error) {
						// TODO: Need to use alert popup of MyZone here
						alert(res.message);
					} else {
						if (typeof callback == "function") {
							callback(res);
						}
					}
				}
			});
		},
		calMiddleImage:function(){
			var heightPopupContainer = $(window).height() - 80 - 62;
			$("#photoPopupContainer").css({height:heightPopupContainer+"px"});			
			$(".wd-img-content").attr('style','line-height:'+Math.round((heightPopupContainer) - 62) + "px");
			$("#containerPhotoComments").css({height:Math.round((heightPopupContainer) - 62 -169) + "px" });
			try{
				commentScroller.reinitialise();
			}catch(e){
				console.log(e.message);
			}
		},
		showDialog : function(modal){
			this.beforePopupOpen();
			
			$("#wd-overlay").show();
			$("#wd-popup_statistics").fadeIn(300);
			_popupScrollTop = $(window).scrollTop();
			
			// thinhpq add code 23/08/2013
			$("body").addClass("noscrollpopup");
			zone.photo.calMiddleImage();
			// xu ly scroll
			// #photoPopupContainer
			var _viewer = $('#photoPopupContainer');
			var _height = _viewer.outerHeight() + 50;
			
			
			_pageWrapper.height(_height + _popupScrollTop);
			_pageWrapper.css('margin-top', -_popupScrollTop);
			_pageWrapper.css('overflow', 'hidden');
			$(document).scrollTop(0);
			
			if (modal){
				$("#wd-overlay").unbind("click");
			} else {
				$("#wd-overlay").click(function (e){
					zone.photo.hideDialog();
				});
			}
			
			this.afterPopupOpened();
		},
		
		hideDialog : function(callback) {
			$("#wd-overlay").hide();
			$("#wd-popup_statistics").fadeOut(300);
			
			_pageWrapper.css('overflow', '');
			_pageWrapper.css('height', '');
			_pageWrapper.css('margin-top', '');

			$("body").removeClass("noscrollpopup");
			window.scrollTo(0,_popupScrollTop);
			
			if (typeof callback == "function") callback();
			this.afterPopupClosed();
		},
		
		init : function(options) {
			this.btnNext = $('#btnNextPhoto, .lnkNextPhoto');
			this.btnPrev = $('#btnPrevPhoto');
			this.navNext = $('#navNextPhoto');
			this.navPrev = $('#navPrevPhoto');
			
			
			if (typeof options.beforePopupOpen == "function") {
				this.beforePopupOpen = options.beforePopupOpen;
			}
			if (typeof options.afterPopupClosed == "function") {
				this.afterPopupClosed = options.afterPopupClosed;
			}
			if (typeof options.afterPopupOpened == "function") {
				this.afterPopupOpened = options.afterPopupOpened;
			}
			
			
			// init events
			$('body').on('click', '#btnNextPhoto, .lnkNextPhoto', function(e){
				var _currentPhoto = _photoCommentContainer.data('photo');
				var _photo_id = _currentPhoto.photo.id;
				var _album_id = _currentPhoto.photo.album_id;
				
				zone.photo.getNextPhoto(_photo_id, _album_id, photoType);
				if (typeof zone.photo._caches[_photo_id].next == 'string') {
					zone.photo._caches[_photo_id].next.status = "Rendering";
				} else if (typeof zone.photo._caches[_photo_id].next == 'object') {
					var _next_photo = zone.photo._caches[zone.photo._caches[_photo_id].next.id];
					if (typeof _next_photo != "undefined") {
						zone.photo.loadPhoto(_next_photo.photo.id, _next_photo.photo.album_id, _next_photo.photo.image, photoType);
					} else {
						//zone.photo._caches[_photo_id].next.status = "Rendering";
						zone.photo.getNextPhoto(_photo_id, _album_id, photoType);
						console.log("Loading next photo of " + _photo_id);
					}
				} else {
					console.log("Can't load photo");
				}
			});
			
			this.btnPrev.click(function() {
				var _currentPhoto = _photoCommentContainer.data('photo');
				var _photo_id = _currentPhoto.photo.id;
				var _album_id = _currentPhoto.photo.album_id;
				
				zone.photo.getPrevPhoto(_photo_id, _album_id, photoType);
				if (typeof zone.photo._caches[_photo_id].prev == 'string') {
					zone.photo._caches[_photo_id].prev.status = "Rendering";
				} else if (typeof zone.photo._caches[_photo_id].prev == 'object') {
					var _prev_photo = zone.photo._caches[zone.photo._caches[_photo_id].prev.id];
					
					if (typeof _prev_photo != "undefined") {
						zone.photo.loadPhoto(_prev_photo.photo.id, _prev_photo.photo.album_id, _prev_photo.photo.image, photoType);
					} else {
						//zone.photo._caches[_photo_id].next.status = "Rendering";
						zone.photo.getPrevPhoto(_photo_id, _album_id, photoType);
						console.log("Loading prev photo of " + _photo_id);
					}
				} else {
					console.log("Can't load photo");
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

				zone.photo.loadPhoto(photo_id, album_id, image, photoType);
				e.preventDefault();
			});

			// set event
			$("#wd-btnClose").click(function (e){
				zone.photo.hideDialog();
				//e.preventDefault();
			});
		}
	};
	
	/**
	 * Object for handling album
	 */
	scope['album']	= {
		
	};
})(jQuery, zone);

var _popupScrollTop = 0;
var _body = null;
var _pageWrapper = $('#pageWrapper');
$(document).ready(function () {
	_pageWrapper = $('#pageWrapper');

	// append comment
	$('body').on('keydown', '.frmAddCommentForm .photo-form-input', function(e){
		if (event.keyCode == 13){
			var _this = $(this);
			var objForm = _this.parents('form');
			var action = objForm.attr('action');
			//var objViewMore = $("#viewMore"+token);
			
			_this.attr("disabled", "disabled");
			if($.trim(_this.val())==""){
				_this.removeAttr("disabled");
				return;
			}
			
			$.ajax({
				url			: action,
				data		: objForm.serialize()+"&content="+encodeURIComponent(_this.val()),
				type		:'POST',
				success		: function (res) {
					_this.removeAttr("disabled");
					_this.val('');
					_this.css({
						height:'auto'
					});
					
					if(res.error){
					
					} else {
						_photoComment = $.tmpl($('#tmpPhotoCommentItem'), res.content);
						_photoComment.find('.timeago').timeago();
						
						commentScroller.getContentPane().prepend(_photoComment);
						commentScroller.reinitialise();
						
						var photoID = objForm.find('.hiddenObjectID').val();
						zone.photo._caches[photoID].invalidate = true;
						if(res.totalComment == 1)
							_this.parents('div.wd-comment-box').find('span.wd-text').empty().html('View all <label id="numberComment">' + res.totalComment + '</label>'+ ' comment');
						else
							_this.parents('div.wd-comment-box').find('span.wd-text').empty().html('View all <label id="numberComment">' + res.totalComment + '</label>'+ ' comments');
							
						zone.photo.calMiddleImage();
					}
					
					
				}, error: function (xhr, ajaxOptions, thrownError) {
					console.log(xhr.responseText);
					_this.removeAttr("disabled");
				}
			});
		}
	});
	
	$('body').on('click', '.btnLikePopupPhoto', function(e){
		var token = $(this).attr('token');
		initLike(token, function(res) {
			zone.photo._caches[res.photo_id].invalidate = true;
		});
		return false;
	}); 
	
	$('body').on('click', '.wd-add-desc-ppphoto .wd-add-desc-ppphoto-bt', function(e){
		$(this).hide();
		$(this).parent().find(".wd-add-desc-ppphoto-content").animate({opacity: "show"}, 1500);
		$(".wd-desc-photo").html('');
	});
	$(window).resize(function() {
		zone.photo.calMiddleImage();
	});
	$('body').on('keyup', '.frmAddDesPhotoForm', function(e){
		var _this = $(this);
		
		if(e.keyCode == 13){
			$.ajax({
			url			: _this.attr('action')+"?fileid="+_this.find('.hiddenPhotoID').val(),
			data		: _this.serialize(),
			type		:'POST',
			success		: function (res) {
				_this[0].reset();
				if(res.error){
				
				}else{
					
					$(".wd-desc-photo").html(res.photo.description);
					if($.trim(res.photo.description)!="" && $.trim(res.photo.description)!=null){
						$(".wd-add-desc-ppphoto-bt").html("Update a description");
						$(".wd-desc-photo").show();
					}else{
						$(".wd-add-desc-ppphoto-bt").html("Add a description");
						$(".wd-desc-photo").hide();
					}
					$(".frmAddDesPhotoForm").find('textarea').val(res.photo.description);
					$(".wd-add-desc-ppphoto-content").hide();
					$(".wd-add-desc-ppphoto-bt").show();
					$(".frmAddDesPhotoForm").find('.hiddenPhotoID').val(res.photo.id);
					
					if(typeof profilePhotos != "undefined"){
						$.each(profilePhotos,function(x,y){
							if(y.photo.id ==  res.photo.id){
								profilePhotos[x].photo.description = res.photo.description;
							}
						});
					}else{
						if(typeof zone.photo._caches != "undefined"){
							$.each(zone.photo._caches,function(x,y){
								if(y.photo.id ==  res.photo.id){
									zone.photo._caches[x].photo.description = res.photo.description;
								}
							});
						}
					}
				}
				
				
			},error: function (xhr, ajaxOptions, thrownError) {
				console.log(xhr.responseText);
				
			}
		});
		}
	});
	
});


