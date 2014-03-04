$(document).ready(function(){
	/**
	 * This event used save & remove your interests 
	 **/
	$('body').on('click', '#add-interests', function(e){
		var _this = $(this);
		var tid = $(this).attr('tid');
		var interestToken = $(this).attr('token');
		_this.hide();
		_this.parent().find('#remove-interests').show();
		$.post(homeURL+"/categories/api/addInterest",{type_id:tid},function(res){
			
			
			
			if(!res.error){
				
				$("#"+interestToken).addClass('wd-interest-item-following');
				var tmpTextInterests = "";
				if(res.people == 1) tmpTextInterests = " Follower";
				else tmpTextInterests = " Followers";
				_this.parent().parent().find('.wd-count').html( res.people + tmpTextInterests);
				$(".wd-count-choice-follow-interest label").html(res.count);
				if(res.count > 0){
					$("#hLimitTopic").show();
					$("#submitInterest").hide();	
				}else{
					$("#hLimitTopic").hide();
					$("#submitInterest").show();
				}
			}else{
				
			}
			
		}).fail(function() {
			
		});
	});
	$('body').on('click', '#remove-interests', function(e){
		var _this = $(this);
		var tid = $(this).attr('tid');
		var interestToken = $(this).attr('token');
		_this.hide();
		_this.parent().find('#add-interests').show();
		$.post(homeURL+"/categories/api/removeInterest",{type_id:tid},function(res){
			
			
			if(!res.error){
				
				$("#"+interestToken).removeClass('wd-interest-item-following');
				var tmpTextInterests = "";
				if(res.people == 1) tmpTextInterests = " Followers";
				else tmpTextInterests = " Followers";
				_this.parent().parent().find('.wd-count').html( res.people + tmpTextInterests);
				$(".wd-count-choice-follow-interest label").html(res.count);
				if(res.count > 0){
					$("#hLimitTopic").show();
					$("#submitInterest").hide();	
				}else{
					$("#hLimitTopic").hide();
					$("#submitInterest").show();
				}
			}else{
				
			}
		}).fail(function() {
			
		});
	});
	
	
});

