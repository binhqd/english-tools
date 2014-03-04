;(function($, scope){
	scope['CommonHtml'] = {
		init : function(){
			
		},
		Actions:{
			toggleDropMenu:function(_this){
				if(zone.CommonHtml.objHtml.objDropDownShowCurrent !=null){
					zone.CommonHtml.objHtml.objDropDownShowCurrent.hide();
				}
				if(_this.hasClass('wd-toggle-bt-active')){
					
					
					_this.removeClass('wd-toggle-bt-active');
					_this.parent().find('.wd_toggle').hide();
					
				}else{
					_this.addClass('wd-toggle-bt-active');
					_this.parent().find('.wd_toggle').show();
					zone.CommonHtml.objHtml.objDropDownShowCurrent = _this.parent().find('.wd_toggle');
				}
			},
			clickDropMenu:function(){
				zone.CommonHtml.objHtml.wdToggleBt = $(".wd_toggle_bt");
				$('body').on('click', '.wd_toggle_bt', function(e){
					
					zone.CommonHtml.objHtml.objClickCurrent = $(this);
					zone.CommonHtml.Actions.toggleDropMenu($(this));
					e.stopPropagation();
				});
			}
		},
		data:{
			
		},
		objHtml:{
			objDropDownShowCurrent:null,
			objClickCurrent:null,
			wdToggleBt:null,
			dataCarouFredSel:{
				auto: false,
				responsive: true,
				width: '100%',    
				scroll: 3,
				prev: '#wd-prev',
				next: '#wd-next',
				pagination: false,
				mousewheel: true,
				items: {
				height: 'auto',
				visible: {
				min: 3,
				max: 10
				}
				},
				swipe: {
					onMouse: true,
					onTouch: true
				}
			}
		}
	}
})(jQuery, zone);

$(document).ready(function(){
	
	/* toggle */
	zone.CommonHtml.Actions.clickDropMenu();
	
	
	$(document).click(function(e){
		$('.wd_toggle').hide();
		if(zone.CommonHtml.objHtml.objClickCurrent != null){
			zone.CommonHtml.objHtml.objClickCurrent.removeClass('wd-toggle-bt-active');
			
		}
		if($(".wd-notif-bt").hasClass('wd-toggle-bt-active')){
			
			$(".wd-notif-bt").removeClass('wd-toggle-bt-active');
		}
		
		$("body").removeClass("noscroll");
	});

	//external
    $('a[rel="external"]').attr('target', '_blank');
	
	var widthScreen =$(window).width();
	/* placeholder */
	$('input, textarea').placeholder();
	if (($('.wd-connec-list').children("li").length >8)&&(widthScreen > 1024)){
		$('.wd-connec-list').carouFredSel(zone.CommonHtml.objHtml.dataCarouFredSel);
	}else{
		if(($('.wd-connec-list').children("li").length >= 5)&&(widthScreen <= 1024)){
			$('.wd-connec-list').carouFredSel(zone.CommonHtml.objHtml.dataCarouFredSel);
		}
	}
	//Caroufredsel .end
	
	
	
	
	//Caroufredsel .end
	//fix scroll
	var Wscreen = $(window).width();
	var lengthConnect = $('.wd-connec-list li');
	var searchItem = lengthConnect.parent().parent().find('.control-div').css('display','none');
	//alert(Wscreen);
	//alert(lengthConnect.length);
	if(Wscreen >=1600){
		if(lengthConnect.length <= 10){
			searchItem;
		}
	}
	else if(Wscreen >= 1440){
		if(lengthConnect.length <= 9){
			searchItem;
		}	
	}
	else if(Wscreen >= 1280){
		if(lengthConnect.length <= 8){
			searchItem;
		}	
	}
	else if(Wscreen >= 1024){
		if(lengthConnect.length <= 6){
			searchItem;
		}	
	}
	//input search form
	var _thisInputSearchStyle = $(".wd-input-search");
	var _thisInputSearchStyleinput = _thisInputSearchStyle.find(".wd-text-search");
	_thisInputSearchStyleinput.focus(function() {  
		$(this).parent().addClass("wd-input-search-focus");
	}).blur(function() {
		$(this).parent().removeClass("wd-input-search-focus");
	});  
	//setting toggle
	var _thisSettingHeader = $(".wd-setting-header");
	var _thisSettingHeader_bt = _thisSettingHeader.find(".wd-settingicon-top");
	_thisSettingHeader_bt.click(function(e){
		e.stopPropagation();
		$(this).toggleClass("wd-settingicon-top-active");
		$(this).parent().toggleClass("wd-setting-header-active");
		$(this).parent().find(".wd-setting-content").toggle().addClass("wd_toggle_open");
	});

	/* check action notification*/
	var _thisJewelItem = $(".wd-jewelItemList .wd-jewelItem");
	_thisJewelItem.click(function(){
		var _thisJewelItem_act = $(this).find(".wd-x-act");
		_thisJewelItem_act.toggleClass("wd-x-act-checked");
		$(this).toggleClass("wd-jewelItemSelected");
	});
	/* textarea */
	$.fn.expandingTextarea.initialSelector = "textarea";

	/*tooltip */
	$('.wd-tooltip-hover').tipsy({gravity: 's'});
	$('.wd-tooltip-hover-html').tipsy({html: true,gravity: 's',fade: true});

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

	/* Scroll for left and right content */
	$('.wd-auto-fixed').each(function(index, block){
		var offset_top = $(block).offset().top;
		var padding_bottom = parseInt($(block).css('padding-bottom').replace('px', ''));
		$(window).scroll(function(){
			var main_height = $(block).parent().height();
			$(block).prevAll().each(function(index, element){
				main_height -= $(element).outerHeight();
			});
			if ($(block).height() < $(this).height() - $('#wd-header').outerHeight()) {
				var top = $('#wd-header').outerHeight();
				if (($(this).scrollTop() > -top + offset_top) && ($(this).width() >= 1024)) {
					if (($(this).scrollTop() + $(this).height() - ($(this).height() - $(block).height() - $('#wd-header').outerHeight()) < main_height + offset_top) && ($(this).width() >= 1024)) {
						$(block).css({
							'position': 'fixed',
							'margin-top': '0px',
							'top': top
						});
					} else {
						$(block).css({
							'position': 'static',
							'margin-top': main_height - $(block).height() - padding_bottom,
							'top': top
						});
					}
				} else {
					$(block).css({
						'position': 'static',
						'margin-top': 0,
						'top': 0
					});
				}
			} else {
				var top = - $(block).height() + $(this).height() - padding_bottom;
				if (($(this).scrollTop() > -top + offset_top) && ($(this).width() >= 1024)) {
					if ($(this).scrollTop() + $(this).height() <= main_height + offset_top) {
						$(block).css({
							'position': 'fixed',
							'margin-top': '0px',
							'top': top
						});
					} else {
						$(block).css({
							'position': 'static',
							'margin-top': main_height - $(block).height() - padding_bottom,
							'top': top
						});
					}
				} else {
					$(block).css({
						'position': 'static',
						'margin-top': 0,
						'top': 0
					});
				}
			}
		});
	});
	$(window).trigger('scroll');

});
	$(document).on('click' , '.wd_toggle' , function(e){
		e.stopPropagation();
	});

function loadScroll(_this){
	try{
		_this.jScrollPane({
			horizontalGutter:5,
			verticalGutter:5,
			mouseWheelSpeed:50,
			autoReinitialise: true,
			'showArrows': false
		});
	}catch(e){
	
	}
}