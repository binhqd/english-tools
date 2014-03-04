;(function($, scope){
	scope['notification']	= {
		callbacks : {},
		pagination:{
			notification:{
				page:1
			}
		},
		addCallBack : function(callback) {
			var callbackID = this.Libs.makeid(8);
			this.callbacks[callbackID] = callback;
		},
		instances : {
			notificationContent		: $('div#jl-notification-layout'),
			notificationContainer	: $('ul#listNotifications'),
			notificationRequestFriendContainer	: $('ul#listRequestFriendNotifications'),
			notificationRequestFriendPopup	: $('.js-popup-request-friend-notofications'),
			contentHeight			: $('#jl-notification-layout').outerHeight(),
			numberLink				: $('.wd-top-head-right a.jl-notifications'),
			notificationArea		: $('div#notification-content'),
			number					: $('span#jl-notification-number'),
			numberRequestFriend		: $('span#jl-notification-number-request-friend'),
			scroller				: $('.jl-notification-list-scroll')
		},
		pool : {
			unread : parseInt($('#jl-notification-number').html()),
			unreadRequestFriend : parseInt($('#jl-notification-number-request-friend').html())
		},
		Event : {
			onConnect : function(data) {
				for (var fid in scope.notification.Libs.registeredFunction) {
					scope.notification.Libs.registeredFunction[fid](data);
				}
			}
		},
		Action : {
			register : function(namespace, callback) {
				var clientID = scope.notification.Libs.makeid(8);
				if (typeof scope.notification.pool.socket == "undefined") {
					scope.notification.pool.socket = io.connect(notificationUrl);
					
					scope.notification.Libs.registeredFunction[namespace] = callback;
					
					scope.notification.pool.socket.on("connect", function(data) {
						scope.notification.pool.socket.emit("register", {
							namespace	: namespace,
							clientID	: clientID
						});
						
						scope.notification.Event.onConnect(data);
					});
				} else {
					scope.notification.pool.socket.emit("register", {
						namespace : namespace,
						clientID	: clientID
					});
					
					scope.notification.Libs.registeredFunction[namespace] = callback;
				}
			},
			
			add : function(data) {
				// Increase notification
				//jlbd.notification.instances.numberLink.show();

				scope.notification.pool.unread++;
				scope.notification.instances.number.html(scope.notification.pool.unread);
				scope.notification.instances.number.css('display', scope.notification.pool.unread == 0 ? 'none' : 'block');
				var item = new scope.notification.Libs.JLNotificationItem(data);
				item.find('.timeago').timeago();
				scope.notification.instances.notificationContainer.prepend(item);

				scope.notification.instances.notificationContainer.removeClass('js-notify-loaded');
				if (scope.notification.instances.notificationArea.css('display') != 'none') {
					jlbd.notification.Action.loadNotifications();
					scope.notification.instances.number.html(0);
					scope.notification.instances.number.css('display', 'none');
					scope.notification.pool.unread = 0;
				}
//				if (jlbd.notification.instances.numberLink.hasClass('jl-notifications-active')) {
//					scope.notification.instances.contentHeight = scope.notification.instances.notificationContent.outerHeight() + 25;
//					scope.notification.instances.notificationArea.animate({height: scope.notification.instances.contentHeight}, 200, function() {
//						
//					});
//				}
			},
			addRequestFriend : function(data) {
				scope.notification.pool.unreadRequestFriend++;
				scope.notification.instances.numberRequestFriend.html(scope.notification.pool.unreadRequestFriend);
				scope.notification.instances.numberRequestFriend.css('display', scope.notification.pool.unreadRequestFriend == 0 ? 'none' : 'block');
				// var item = new scope.notification.Libs.JLRequestFriendNotificationItem(data);
				// scope.notification.instances.notificationRequestFriendContainer.prepend(item);
				scope.notification.instances.notificationRequestFriendContainer.removeClass('js-notify-loaded');
				if (scope.notification.instances.notificationRequestFriendPopup.css('display') != 'none')
					jlbd.notification.Action.loadNotificationsRequestFriend();
			},
			login : function(user, loginInfo) {
				user.clientID = scope.notification.Libs.makeid(8);
				user.location = window.location.href;
				user.loginInfo = loginInfo;
				scope.notification.pool.socket.emit("handshake", user);
				//console.log('sending handshake:');
				//console.log(user);
			},
			loadNotifications : function() {
				if (scope.notification.instances.notificationContainer.hasClass('js-notify-loaded'))
					return false;
				scope.notification.instances.notificationContainer.addClass('js-notify-loaded');
				$.ajax({
					url : homeURL + '/pull/?id=' + Math.random()+"&p="+jlbd.notification.pagination.notification.page,
					success : function(res) {
						scope.notification.instances.notificationContainer.html("");
						if (res.length > 0) {
							for (var i = 0; i < res.length; i++) {
								var item = new scope.notification.Libs.JLNotificationItem(res[i]);
								item.find('.timeago').timeago();
								scope.notification.instances.notificationContainer.append(item);
							}
							jlbd.notification.instances.notificationContainer.removeClass('not-load');
							jlbd.notification.pagination.notification.page++;
							//scope.notification.instances.contentHeight = scope.notification.instances.notificationContent.outerHeight() + 15;
							
							//scope.notification.instances.notificationArea.animate({height: scope.notification.instances.contentHeight}, 200, function() {
								// do something after load notifications
								//jlbd.notification.instances.notificationContainer.removeClass('not-load')
							//});
						} else {
							scope.notification.instances.notificationContainer.html("<li class=\"jl-notification-iterm\" align=\"center\">There currently no notification yet</li>");
						}
						
						scope.notification.instances.number.html(0);
						scope.notification.instances.number.css('display', 'none');
						scope.notification.pool.unread = 0;
						
//						scope.notification.instances.scroller.jScrollPane({
//							showArrows: true,
//							scrollbarMargin : '0',
//							animateDuration:'0',
//							dragMaxHeight : '355'
//						});
					}
				});
			},
			loadNotificationsRequestFriend : function() {
				if (scope.notification.instances.notificationRequestFriendContainer.hasClass('js-notify-loaded'))
					return false;
				scope.notification.instances.notificationRequestFriendContainer.addClass('js-notify-loaded');
				$.ajax({
					url : homeURL + '/pull/requestFriend/?id=' + Math.random(),
					success : function(res) {
						scope.notification.instances.notificationRequestFriendContainer.html("");
						if (res.length > 0) {
							for (var i = 0; i < res.length; i++) {
								var item = new scope.notification.Libs.JLRequestFriendNotificationItem(res[i]);
								scope.notification.instances.notificationRequestFriendContainer.append(item);
							}
							$.Friends.initLinks(scope.notification.instances.notificationRequestFriendContainer.find(".js-friend-request"));
						} else {
							scope.notification.instances.notificationRequestFriendContainer.html("<li class=\"jl-notification-iterm\" align=\"center\">There currently no notification yet</li>");
						}

						scope.notification.instances.numberRequestFriend.html(0);
						scope.notification.instances.numberRequestFriend.css('display', 'none');
						scope.notification.pool.unreadRequestFriend = 0;
					}
				});
			}
		},
		Libs : {
			registeredFunction : {},
			makeid : function(length) {
				if (typeof length == "undefined") length = 5;
				var text = "";
				var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
				for( var i=0; i < length; i++ )
					text += possible.charAt(Math.floor(Math.random() * possible.length));
				return text;
			},
			JLNotificationItem : function(data) {
				var item = $.tmpl($("#tmpNotiItem"), data);
				if (data.is_clicked == 0) {
					item.addClass('unread');
				}
				if (typeof data.defaultLink != "undefined") {
					item.attr('ref', data.defaultLink);
					item.click(function() {
						// thinhpq remove code set notification readed
						// if (data.is_clicked == 0) {
							// var date = new Date();
							// date.setTime(date.getTime() + (30 * 60 * 1000));
							
							// var newOptions = {
								// domain: cookieDomain,
								// path: '/',
								// expiresAt: date
							// }
							// $.cookies.setOptions(newOptions);
							// $.cookies.set("notificationClicked", data.id);
						// }
						
						window.location = homeURL + data.defaultLink;
					});
				}

//				if (typeof data.notifier != "undefined") {
//					var uri = data.notifier.type=='bm'?'/business/details?uuid='+data.notifier.id:homeURL+"/profile?u="+data.notifier.id;
//					var imageLink = $("<a class=\"jl-thumb-avata\" href='"+uri+"'></a>");
//					var iPath = data.notifier.type=='bm'?data.filepath:(homeURL+"/upload/user-photos/fill/40-40/"+data.avatar.filename);				
//					var image = $('<img src="'+iPath+'" alt="avatar">');
//					imageLink.append(image);
//					item.append(imageLink);
//				}
//				
//				var messageContainer = $("<div class=\"jl-notification-content\"></div>");
//				var message = $("<h4>"+data.message+"</h4>");
//				
//				messageContainer.append(message);
//				item.append(messageContainer);
//				
				return item;
			},
			JLRequestFriendNotificationItem : function(data) {
				var item = $.tmpl($("#tmpNotiItemRequestFriend"), data.userInfo);
				return item;
			}
		}
	}
})(jQuery, jlbd);

$(document).ready(function() {
	if (typeof io != "undefined") {
		//jlbd.notification.Action.connect(notificationUrl, 'global');
		jlbd.notification.Action.register('notification', function(data) {
			if (typeof jlbd.user != "undefined" && typeof jlbd.user.collection.current.user != "undefined") {
				var loginInfo = {
					namespace : 'global'
				};
				
				jlbd.notification.Action.login(jlbd.user.collection.current.user, loginInfo);
				
				jlbd.notification.pool.socket.on("notification", function(data) {
					if (data.type == 'requestFriend') {
						jlbd.notification.Action.addRequestFriend(data);
						return;
					}
					// Add notification on top
					jlbd.notification.Action.add(data);

					if (data.type == 'postArticle' || data.type == 'postAlbum' || data.type == 'followNode') {
						if (typeof page != "undefined") {
							if ((page.type == 'NodeDetail' && page.id == data.otherInfo.node.id)
								|| (page.type == "ProfileHome")	
							) {
								var activities = [data.activity];
								// console.log(activities);
								loadArticles(activities);
							} else {
								
							}
						}
					}
					// Run callbacks
					/*for (var callbackID in jlbd.notification.callbacks) {
						jlbd.notification.callbacks[callbackID]("notification", data);
					}*/
					
					/*// Show tray notification
					var notifyOptions = {
						title : "MyZone Notification",
						text : data.message,
						sticky: false
					};
					
					if (typeof data.avatar.filename != "undefined") {
						notifyOptions.image = homeURL+"/upload/user-photos/fill/40-40/"+data.avatar.filename;
					} else if (typeof data.avatar.filepath != "undefined") {
						notifyOptions.image = homeURL+"/"+data.avatar.filepath;
					}
					
					jlbd.dialog.showTrayNotify(notifyOptions, function(elem, gritter) {
						if (typeof data.defaultLink != "undefined") {
							gritter.find('.gritter-with-image').click(function() {
								if (data.is_clicked == 0) {
									var date = new Date();
									date.setTime(date.getTime() + (30 * 60 * 1000));
									
									var newOptions = {
										domain: cookieDomain,
										path: '/',
										expiresAt: date
									}
									$.cookies.setOptions(newOptions);
									$.cookies.set("notificationClicked", data.id);
								}
								
								window.location = homeURL + data.defaultLink;
							});
						}
					});*/
				});
			}
		});
		
		jlbd.notification.Action.register('command', function(data) {
			jlbd.notification.pool.socket.on("command", function(data) {
				if (data.command == "reset") {
					jlbd.notification.instances.number.html(0);
					jlbd.notification.instances.number.css('display', 'none');
					jlbd.notification.pool.unread = 0;
					//jlbd.notification.instances.notificationContainer.find('li').removeClass('unread');
				}
				for (var callbackID in jlbd.notification.callbacks) {
					jlbd.notification.callbacks[callbackID]("command", data);
				}
			});
		});
		
		// added by dongnd, to hide notification when a click event occurring outside of notification area.
		/*$(document).click(function(event){
			var ni = jlbd.notification.instances;
			if(ni.numberLink.hasClass('jl-notifications-active')) {
				ni.notificationArea.animate({height: 0}, 200, function() {
					ni.numberLink.removeClass('jl-notifications-active');
				});
			}
		});*/		
	}
	
	/*var item = $('#notification-page li.noti-item');
	item.each(function() {
		var _item = $(this);
		_item.find('a.wd-remove').click(function() {
			var ref = $(this).attr('ref');
			$.ajax({
				url : homeURL + '/notifications/remove?id=' + ref,
				success : function(response) {
					if (!response.error) {
						_item.remove();
					}
					
					var notifyOptions = {
						message	: response.message,
						autoHide : true,
						timeOut : 2
					}
					jlbd.dialog.notify(notifyOptions);
				}
			});
			return false;
		});
		
		_item.click(function() {
			var defaultLink = _item.attr('defaultLink');
			var ref = _item.attr('ref');
			if (defaultLink != "") {
				if (_item.hasClass('unread')) {
					var date = new Date();
					date.setTime(date.getTime() + (30 * 60 * 1000));
					
					var newOptions = {
						domain: cookieDomain,
						path: '/',
						expiresAt: date
					}
					$.cookies.setOptions(newOptions);
					$.cookies.set("notificationClicked", ref);
				}
				window.location = homeURL + defaultLink;
			}
		});
		
	});*/
	
	// process common task when having new notification
	/*jlbd.notification.addCallBack(function(eventName, data) {
		if (typeof data.type != "undefined" && data.type == "acceptFriend" || (eventName == "command" || data.command == "unFriend")) {
			var now = parseInt(new Date().getTime() / 1000);
			
			var newOptions = {
				domain: cookieDomain,
				path: '/'
			}
			$.cookies.setOptions(newOptions);
			$.cookies.set("userInfoCache-" + user.id, now - 190*86400);
		}
	});*/
});