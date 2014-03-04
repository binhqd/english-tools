;if(window.jQuery) (function($){
	window['zone'] = {
		redirect: function(strUrl) {
			window.location = strUrl;
		}
	};
	window['Libs'] = {
		makeid : function(strLength) {
			if (typeof strLength == "undefined") strLength = 5;
			var text = "";
			var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
			for( var i=0; i < strLength; i++ )
				text += possible.charAt(Math.floor(Math.random() * possible.length));
			return text;
		}
	}
})(jQuery);
;(function($, scope){
	scope['Common'] = {
		init : function(){

		},
		obj:{
			niceScroll:{
				touchbehavior:false,
				cursorcolor:"#282828",
				cursoropacitymax:2.7,
				cursorwidth:5,
				spacebarenabled:false,
				cursorborder:"1px solid #333333",
				cursorborderradius:"8px",
				background:"#ccc",
				autohidemode:"scroll"
			}
		}
	}
})(jQuery, zone);
;(function($, scope){
	scope['EventHelper'] = {
		init : function(){
		

		},
		Actions : {
			urlValid:function(url){
				var myVariable = url;
				if(/^([a-z]([a-z]|\d|\+|-|\.)*):(\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?((\[(|(v[\da-f]{1,}\.(([a-z]|\d|-|\.|_|~)|[!\$&'\(\)\*\+,;=]|:)+))\])|((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=])*)(:\d*)?)(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*|(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)|((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)|((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)){0})(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(myVariable)) {
					return true;
				} else {
					return false;
				}
			}
		},
		objHtml:{

		}
	}
})(jQuery, zone);

;(function($, scope){
	scope['MessageBar'] = {
		init : function(){
		

		},
		resendEmail : function(){
			zone.MessageBar.objHtml.resendEmail = $(".resend-email");
			$('body').on('click', '.resend-email', function(e){
				$.get($(this).attr('href'),function(res){
					$(".content-message").html("<span class='wd-intro'>"+res.message+"</span>");
					if(res.error){
						$(".wd-top-mess-content").addClass('wd-top-mess-content-error');
					}else{
						$(".wd-top-mess-content").addClass('wd-top-mess-content-success');
					}
				});
				return false;
				
			});
		},
		closeMessage:function(){
			zone.MessageBar.objHtml.closeMessage = $(".wd-close-topmess");
			$('body').on('click', '.wd-close-topmess', function(e){
				$("."+$(this).attr('target')).fadeOut(500);
				return false;
				
			});
		},
		data:{

		},
		objHtml:{
			resendEmail:null,
			closeMessage:null
		}
	}
})(jQuery, zone);

$(document).ready(function(){

	
	
	zone.MessageBar.resendEmail();
	zone.MessageBar.closeMessage();
	
	// toggle box comment
	$('body').on('click', '.wd-pp-comment-info-bt', function(e){
		$(this).toggleClass("wd-pp-comment-info-btac");
		$(this).find(".wd-comment-bt").toggleClass("wd-commented-bt");
		$(this).parent().parent().find('.wd-comment-box').slideToggle("slow");
	});


	
	/**
	 * This event used save session categories for myzone
	 **/
	$('body').on('click', '#saveCategoryNav', function(e){
	
		var _this = $(this);
		$.get(homeURL+"/categories/api/changeCat",{cat:_this.attr('typeId'),keyword:_this.attr('key_search')},function(res){
			window.location.href = homeURL+"/landingpage?interest="+_this.attr('key_search');
		});
	});
	
});




function addReview(token){
	var _this = $("#textareaReview"+token);
	var objForm = $("#frmAddReview"+token);
	var action = objForm.attr('action');
	var objViewMore = $("#viewMore"+token);
	
	_this.attr("disabled", "disabled");
	if($.trim(_this.val())==""){
		_this.removeAttr("disabled");
		return;
	}
	$.ajax({
		url			: action,
		data		: objForm.serialize()+"&contentComment="+_this.val(),
		type		:'POST',
		success		: function (res) {
			_this.removeAttr("disabled");
			_this.val('');
			_this.css({
				height:'40px'
			});
			if(res.error){
			
			}else{
				$("#contentComments"+token).prepend(res);
				$('.hide-row-comment').fadeIn(1000);
				$("#box-comment-"+token).removeClass("bdbno");
				var startPage = parseInt(objViewMore.attr('totalrecord'));
				if($.isNumeric(startPage)){
					startPage = parseInt(startPage) + 1;
				}
				if($("#numberComment").length != 0){
					var numberComment = parseInt($("#numberComment").html()) + 1;
					$("#numberComment").html(numberComment);
					if(numberComment == 1){
						$("#textNumberComment").html("comment");
					}else $("#textNumberComment").html("comments");
				}
				objViewMore.attr('totalrecord',startPage);
				
				try{
					 jQuery(" .timeago").timeago([]);
					 
				}catch(etime){
					console.log(etime.message);
				}
			}
			
			
		},error: function (xhr, ajaxOptions, thrownError) {
			console.log(xhr.responseText);
			_this.removeAttr("disabled");
		}
	});
}
function submitReview(token,event){
	if (event.keyCode == 13){
		addReview(token);
		
	}
}