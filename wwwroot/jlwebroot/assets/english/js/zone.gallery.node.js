var pullNodeGallery = [];
var autoRun = true;

;(function($, scope){
	scope['GalleryLandingPage'] = {
		init : function(){
			
			$.each(zone.GalleryLandingPage.obj.gallery,function(x,y){
				try{
					zone.CommonHtml.objHtml.dataCarouFredSel.prev  ='#wd-prev-'+x;
					zone.CommonHtml.objHtml.dataCarouFredSel.next  = '#wd-next-'+x;
					$('.gallery-landingpage-'+x).carouFredSel(zone.CommonHtml.objHtml.dataCarouFredSel);
				}catch(e){
				
				}
			});

		},
		Actions : {

		},
		obj:{
			gallery:null
		}
	}
})(jQuery, zone);

function sliderTabNode(){
	if(!autoRun) return;
	$.each($('.wd-connection ul'),function(x,y){
			var _this = $(this);
			if(_this.hasClass('un-gallery-active')){
				$.each($('ul.wd-nav li'),function(a,b){
					if($(this).hasClass('wd-active')){
						$(this).removeClass('wd-active');
						if($(this).next().hasClass('wd-loop')){
							$("ul.wd-nav li:first").addClass('wd-active');
							loadGalleryNode($("ul.wd-nav li:first a").attr('key_search'));
						}else{
							$(this).next().addClass('wd-active');
							loadGalleryNode($(this).next().find('a').attr('key_search'));
						}
						return false;
					}
				});
			}
	});
}
function loadGalleryNode(strNode){
	strNode = $.trim(strNode);
	
	$("#wd-connection-landingpage").attr('class','wd-connection wd-subject-node-conection  responsive wd-bg-scroll-'+strNode);
	
	$("#ul-gallery-first").parent().animate({opacity:0},800, function() {
		
		$.each($('.wd-connection ul'),function(x,y){
			
			if($(this).attr('key_search') == strNode){
				$("#ul-gallery-first").html($(this).html());
			}
		});
		
		
		
		
		$("#ul-gallery-first").parent().animate({
			opacity:1
		},1500,function(){
			// zone.CommonHtml.objHtml.dataCarouFredSel.prev = '#wd-prev-1';
			// zone.CommonHtml.objHtml.dataCarouFredSel.next = '#wd-next-1';
			// zone.CommonHtml.objHtml.dataCarouFredSel.min = 1;
			// zone.CommonHtml.objHtml.dataCarouFredSel.max = 8;
			// $('.wd-connec-list-2').carouFredSel(zone.CommonHtml.objHtml.dataCarouFredSel);
		});
	});
	
	// console.log($("#ul-gallery-first").css('display'))
	
	// $("#ul-gallery-first").animate({
		// 'display':'block'
	// },1000);
}

$().ready(function(e){
	
	setInterval(function(){
		sliderTabNode();
	},10000);
	$('body').on('mouseover', 'div.caroufredsel_wrapper', function(e){
		autoRun = false;
	});
	$('body').on('mouseout', 'div.caroufredsel_wrapper', function(e){
		autoRun = true;
	});
	
});