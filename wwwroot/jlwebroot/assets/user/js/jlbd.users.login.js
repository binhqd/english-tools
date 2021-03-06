;(function($, scope) {
	scope['users_login'] = {
		Libs: {
			t: function(str) {
				if (typeof Yii!="undefined" && typeof Yii.t!="undefined")
					return Yii.t('UsersModule', str);
				return str;
			},
			requiredValidate: function($object, message) {
				if ($.trim($object.val()) == '') {
					var options = {
						message	: jlbd.users_login.Libs.t(message),
						autoHide : true,
						timeOut : 3,
						type : 'info'
					};
					jlbd.dialog.notify(options);
					$object.focus();
					return false;
				}
				return true;
			},
			sendFormLogin: function (objForm)
			{
				$.ajax({
					dataType : "json",
					type : "POST",
					url : objForm.attr('action'),
					data : objForm.serialize(),
					beforeSend: function() {
						objForm.find('.js-img-loading').show();
					},
					complete: function() {
						objForm.find('.js-img-loading').hide();
					},
					success : function(data){
						if(data['error'] == true){
							var options = {
								message	: data['message'],
								autoHide : true,
								timeOut : 3,
								type : 'error'
							};
							jlbd.dialog.notify(options);
						} else {
							var options = {
								message	: data['message'],
								autoHide : true,
								timeOut : 2,
								type : 'success',
								callback : function() {
									if (data['url']!=="") {
										window.location.href = data['url'];
									} else {
										var sub_1 = window.location.href;
										var sub_2 = '#';
										var result = sub_1.search(sub_2);
										if (result==-1) {
											window.location.href = window.location.href ? window.location.href : (homeURL+"/users/profile/view");
										} else {
											window.location.href = homeURL+"/profile";
										}
									}
								}
							};
							jlbd.dialog.notify(options);
						}
					}
				});
			},
			initForm: function($objForm) {
				$objForm.submit(function() {
					if (!jlbd.users_login.Libs.requiredValidate($objForm.find('#GNLoginForm_email'), 'Email cannot be blank.'))
						return false;
					if (!jlbd.users_login.Libs.requiredValidate($objForm.find('#GNLoginForm_password'), 'Password cannot be blank.'))
						return false;
					jlbd.users_login.Libs.sendFormLogin($objForm);
					return false;
				});
			}
		}
	};
})(jQuery, jlbd);