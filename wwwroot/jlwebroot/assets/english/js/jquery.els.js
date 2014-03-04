;if(window.jQuery) (function($){
	window['els'] = {
		redirect: function(strUrl) {
			window.location = strUrl;
		}
	};
})(jQuery);

;(function($, scope){
	scope['Init'] = {
		init : function(){
		

		},
		Events:{
			Inline:function(obj,data,objResult){
				var _elsHtml = obj.html();
				$.each(data,function(k,v){
					_elsHtml  = _elsHtml.replace("{"+k+"}",v);
				});
				objResult.html(_elsHtml);
			},
			For:function(obj,data,objResult){
				if(data.length!=0){
					$.each(data,function(x,y){
						var _elsHtml = obj.html();
						$.each(y,function(k,v){
							_elsHtml  = _elsHtml.replace("{"+k+"}",v);
						});
						objResult.append(_elsHtml);
						

					});
				}
				
			},
		},

		data:{

		},
		defaults:{
		}
	}
})(jQuery, els);

