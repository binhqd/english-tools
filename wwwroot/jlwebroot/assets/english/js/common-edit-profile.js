$(document).ready(function(){
	
	//Uniform customize for check box, radio box in edit profile user
	jQuery("input[type=checkbox].wd-check-cus,input[type=radio].wd-radio-cus").uniform();
	var _thisCheckboxBox = $(".wd-customiz-form .wd-input-child");
	var _thisCheckbox = _thisCheckboxBox.find("div.checker span");
	var _inputParent = $(".wd-input-parent");
	
	_thisCheckboxBox.each(function(){
		_thisCheckbox.click(function(){
			if($(this).hasClass("checked")){
				$(this).parent().parent().parent().parent(".wd-input-parent").find("div.checker span").addClass("checked");
			}
		});
	});
	_inputParent.each(function(){
		var _inputParentCheck = $(this).find("div.checker").eq(0);
		_inputParentCheck.click(function(){
			if(!$(this).find("span").hasClass("checked")) {
				$(this).parent().find(".wd-input-child div.checker span").removeClass("checked");
			}
		});
	});
	/* select who show profile*/
	var _thisParentPublicProfile = $(".wd-make-public-pro");
	var _a = $(".wd-make-public-pro .wd-input-radio-cus .radio span").eq(0);
	var _b=  $(".wd-make-privacy-pro .wd-input-radio-cus .radio span").eq(0);
	if(_a.hasClass("checked")){
		_thisParentPublicProfile.find(".wd-everyone-detail-content").css({'display':'block'});
	}
	_a.click(function(){
		if($(this).hasClass("checked")){
			$(this).parent().parent().parent().find(".wd-everyone-detail-content").css({'display':'block'});
		}
	});
	_b.click(function(){
		if($(this).hasClass("checked")){
			_thisParentPublicProfile.find(".wd-everyone-detail-content").css({'display':'none'});
		}
	});
	/* select who show profile .end*/

	/* popup form edit */
	var toogle_disContent = $(".wd-popup-edit-lc .wd-dis-form-toogle");
	toogle_disContent.each(function(){
		$(this).find(".wd_tt_toogle").click(function(){
			if($(this).hasClass("wd-former-name")){
				$(this).find(".wd-arrow").toggleClass("wd-arrow-activi");
			}
			$(this).parent().find(".wd-dis-form-toogle-ct").toggle();
		});
	});

	var toogle_block_edit = $(".wd-edit-block");	
	toogle_block_edit.each(function(){
		var toogle_disContent = $(this).find(".wd-popup-edit-lc");
		var toogle_itemEdit = $(this).find(".wd-item-edit-lc");
		var toogle_close_bt = $(this).find(".wd-close-edit");
		var toogle_editBt = $(this).find(".wd-edit-button");
		var timePeriod_enddate = $(this).find(".wd-timeperiod-enddate");
		/* add new */
		var toogle_addnewEntries = $(this).find(".wd-popup-add-newItem-lc");
		var toogle_addnewEntries_bt = $(this).find(".wd-show-entire-section");
		toogle_addnewEntries_bt.click(function(){
			$(this).addClass("wd-show-entire-section-adding");
			$(this).parent().find(".wd-popup-add-newItem-lc").show();
		});
		/* edit*/
		toogle_editBt.click(function(){			
			$(this).css({"display":"none"});
			$(this).parent().find(".wd-item-edit-lc").hide();
			$(this).parent().find(".wd-popup-edit-lc").fadeIn("slow");
		});
		toogle_close_bt.click(function(){
			toogle_block_edit.find(".wd-edit-button").css({"display":"block"});
			toogle_itemEdit.fadeIn();
			toogle_disContent.hide();
			toogle_addnewEntries.hide();
			toogle_addnewEntries_bt.removeClass("wd-show-entire-section-adding");
		});
		/* edit*/
		timePeriod_enddate.each(function(){
			var timePeriod_bt = $(this).find(".still-here");
			var timePeriod_endposition = $(this).find(".wd-ended-position");
			var timePeriod_currenttime = $(this).find(".wd-current-position");
			timePeriod_bt.click(function(){
				$(this).find('.wd-still-here-checkbox').change(function () {
					if(this.checked) 
					{
						timePeriod_endposition.hide();
						timePeriod_currenttime.show();
						return;
					}else{
						timePeriod_currenttime.hide();
						timePeriod_endposition.show();
					}
				});
			});
		});
	});
	//follow
	var _editFollow = $(".wd-edit-follows");
	var _editFollowBT = _editFollow.find(".wd-edit-flbt");
	_editFollowBT.click(function() {
		$(this).toggleClass("wd-icon-edit-28").toggleClass("wd-icon-close-28");
		$(this).parent().find(".wd-edit-follow-content").toggle();
	});
});
