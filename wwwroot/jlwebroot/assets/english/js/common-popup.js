$(document).ready(function(){
	var _optionShow = $('.wd-option-show');
	var _iconOpActv = 'wd-icon-option-active';
	var _sharePopup = $('#wd-share-popup');
	var _contentPopup = $('.wd-content-popup');
	$('.wd-pagelet-images-wiew ul li a.wd-popup-images').magnificPopup({
		tClose: 'Close',
		closeBtnInside:true,
		callbacks: {
		    open: function() {
		     	/* jscroll */
				$('.wd-list-comments').jScrollPane({
					horizontalGutter:5,
					verticalGutter:5,
					'showArrows': false
				});
				$('.jspDrag').hide();
				$('.jspScrollable').mouseenter(function(){
					$(this).find('.jspDrag').stop(true, true).fadeIn('slow');
				});
				$('.jspScrollable').mouseleave(function(){
					$(this).find('.jspDrag').stop(true, true).fadeOut('slow');
				});
				$('a.wd-icon-close-popup').click(function(){
					$.magnificPopup.close();
					return false;
				});
				$('.wd-option-main a.wd-icon-option').toggle(function(){
					$(_optionShow).show(0);
					$(this).addClass(_iconOpActv);
				}, function(){
					$(_optionShow).hide(0);
					$(this).removeClass(_iconOpActv);
				});
				$('a.wd-share-popup').click(function(){
					var _sharePopup = $('#wd-share-popup');
					var _contentPopup = $('.wd-content-popup');
					var _height = $(window).height();
					var _width = $(window).width();
					_sharePopup.width(_width);
					_sharePopup.height(_height);
					_contentPopup.css({
						'top':_height/2-_contentPopup.height()/2+'px',
						'left':_width/2-_contentPopup.width()/2+'px'
					});
					_sharePopup.show();
					$('a.wd-share-popup-close').click(function(){
						_sharePopup.hide();
					});
				});
		    },
		    close: function() {
		      	$(_optionShow).hide(0);
		      	_sharePopup.hide();
				$('.wd-option-main a.wd-icon-option').removeClass(_iconOpActv);
		    }
	    }
	});
});