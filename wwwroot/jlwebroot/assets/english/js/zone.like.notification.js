;(function($, scope){
	scope['likeNotification'] = {
		init : function(){
			zone.likeNotification.objHtml.item = $('.item-notification');
			$('body').on('click', '.item-notification', function(e){
				var _this = $(this);
				if($(this).find('a').hasClass('like-status')){
					var _this = $(this).find('a.like-status');
					window.location.href = homeURL + "/status/view?id="+_this.attr('status_id');
				}
				if($(this).find('a').hasClass('like-article-notification')){
					var _this = $(this).find('a.like-article-notification');
					window.location.href = _this.attr('href');
				}
				// if($(this).find('a').hasClass('lnkViewPhotoDetail')){
					// var _this = $(this).find('a.lnkViewPhotoDetail');
					// _this.trigger('click');
					// return false;
				// }
			});
		},
		data:{

		},
		objHtml:{
			item:null
		}
	}
})(jQuery, zone);
;(function($, scope){
	scope['commentNotification'] = {
		init : function(){
			zone.likeNotification.objHtml.item = $('.item-notification');
			$('body').on('click', '.item-notification', function(e){
				var _this = $(this);
				if($(this).find('a').hasClass('comment-status')){
					var _this = $(this).find('a.comment-status');
					window.location.href = homeURL + "/status/view?id="+_this.attr('status_id')+"&anchor="+_this.attr('comment_id');
				}
			});
			
		},
		scrollTop:function(anchorTarget){
			zone.likeNotification.objHtml.commentBox = $('.wd-comment-box');
			$.each(zone.likeNotification.objHtml.commentBox.find('.item-box'),function(x,y){
				if($(this).attr('anchor') == anchorTarget){
					$(this).css({backgroundColor:'#FFFFC2'});
					zone.commentNotification.data.idItem = Libs.makeid(50);
					$(this).attr('id',zone.commentNotification.data.idItem);
					$("html, body").animate({ scrollTop:($(this).offset().top-150)+"px" });
					setTimeout(function(){
						$("#"+zone.commentNotification.data.idItem).css({backgroundColor:'transparent'});
					},2000);
					return false;
				}
			});
		},
		data:{
			idItem:null
		},
		objHtml:{
			item:null,
			commentBox:null
		}
	}
})(jQuery, zone);
$().ready(function(e){
	zone.likeNotification.init();
	zone.commentNotification.init();
	
	
	$('.js-notifications-request-friend').click(function(){
		$("body").addClass("noscroll");
		zone.CommonHtml.Actions.toggleDropMenu($(this));
		if ((typeof jlbd != 'undefined') && (typeof jlbd.notification != 'undefined'))
			jlbd.notification.Action.loadNotificationsRequestFriend();
		
		$("body").addClass("noscroll");
		try{
			$('.timeago').timeago([]);
		}catch(e){
			console.log(e.message());
		}
		loadScroll($(this).parent().find('.notification-friend'));
		return false;
	});

	$('.js-notifications').click(function(){
		zone.CommonHtml.Actions.toggleDropMenu($(this));
		if ((typeof jlbd != 'undefined') && (typeof jlbd.notification != 'undefined'))
			jlbd.notification.Action.loadNotifications();
		
		
		$("body").addClass("noscroll");
		
		try{
			$('.timeago').timeago([]);
		}catch(e){
			console.log(e.message());
		}
		
		loadScroll($(this).parent().find('.notification-other'));
		
		return false;
	});
	$('#pane-friend').bind(
		'jsp-scroll-y',
		function(event, scrollPositionY, isAtTop, isAtBottom)
		{
			if(isAtBottom){
				
				return false;
			}
			
		}
	);
	$('#pane-other').bind(
		'jsp-scroll-y',
		function(event, scrollPositionY, isAtTop, isAtBottom)
		{
			if(isAtBottom){
				// $("#load-more-notification-tab-other").show();
				
				return false;
			}
		}
	);
	
	$('body').on('click', '#see-all-notifi-friend,#see-all-notifi-other', function(e){
		var _this = $(this);
		$(this).find('img').show();
		$.ajax({
			url : homeURL + '/pull/?id=' + Math.random()+"&p="+jlbd.notification.pagination.notification.page,
			success : function(res) {
				if (res.length > 0) {
					for (var i = 0; i < res.length; i++) {
						var item = new jlbd.notification.Libs.JLNotificationItem(res[i]);
						item.find('.timeago').timeago();
						jlbd.notification.instances.notificationContainer.append(item);
					}
					jlbd.notification.pagination.notification.page++;
					
				} else {
					
				}
				_this.find('img').hide();

			}
		});
	})

	
});