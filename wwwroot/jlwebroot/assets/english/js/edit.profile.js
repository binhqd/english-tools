var checkSubmit = false;
var experPresend = false;
var liItemProp = "";
function dayProperties(day,month,year,_this){
	
	var strDateTime = "";
		
	if(day != 0 && month !=0 && year !=0){
		var tmpMonth = month;
		var tmpDay = day;
		if(tmpMonth<10) tmpMonth = "0"+tmpMonth;
		if(tmpDay<10) tmpDay = "0"+tmpDay;
		strDateTime = year+"-"+tmpMonth+"-"+tmpDay;
		_this.parent().find("input[type='hidden']").val(strDateTime);
	}else{
		_this.parent().find("input[type='hidden']").val('');
	}
	
}
function dayPropertiesEmployment(month,year,_this){
	
	var strDateTime = "";
		
	if(month !=0 && year !=0){
		var tmpMonth = month;
		
		if(tmpMonth<10) tmpMonth = "0"+tmpMonth;
		
		strDateTime = year+"-"+tmpMonth;
		_this.parent().find("input[type='hidden']").val(strDateTime);
	}else{
		_this.parent().find("input[type='hidden']").val('');
	}
	
}
function dayPropertiesEducation(year,_this){
	
	var strDateTime = "";
		
	if(year !=0){
		strDateTime = year;
		_this.parent().find("input[type='hidden']").val(strDateTime);
	}else{
		_this.parent().find("input[type='hidden']").val('');
	}
	
}
$(document).ready(function(){
	$('body').on('click', '.current-enddate', function(e){
		var tmpParent = $(this).parent().parent().parent();
		
		if($(this).attr('checked')){
			
			$.each(tmpParent.find('select'),function(x,y){
				$(y).hide();
			});
			tmpParent.find('.wd-current-position').show();
			tmpParent.find("input[type='hidden']").val('Present');
		}else{
			$.each(tmpParent.find('select'),function(x,y){
				$(y).show();
			});
			tmpParent.find('.wd-current-position').hide();
			if(tmpParent.find('#month_employment').val() != 0 && tmpParent.find('#year_employment').val() != 0){
				tmpParent.find("input[type='hidden']").val(tmpParent.find('#month_employment').val() + "-" + tmpParent.find('#year_employment').val());
			}else{
				tmpParent.find("input[type='hidden']").val('');
			}
		}
	});
	//Education 
	$('body').on('change', '#year_education', function(e){
		var eYear = $(this).val();
		dayPropertiesEducation(eYear,$(this));
	});
	// LIVES
	$('body').on('change', '#month_live', function(e){
		var eMonth = $(this).val();
		var eYear = $(this).parent().find("#year_live").val();
		dayPropertiesEmployment(eMonth,eYear,$(this));
	});
	$('body').on('change', '#year_live', function(e){
		var eYear = $(this).val();
		var eMonth = $(this).parent().find("#month_live").val();
		dayPropertiesEmployment(eMonth,eYear,$(this));
	});
	// Employment
	$('body').on('change', '#month_employment', function(e){
		var eMonth = $(this).val();
		var eYear = $(this).parent().find("#year_employment").val();
		dayPropertiesEmployment(eMonth,eYear,$(this));
	});
	$('body').on('change', '#year_employment', function(e){
		var eYear = $(this).val();
		var eMonth = $(this).parent().find("#month_employment").val();
		dayPropertiesEmployment(eMonth,eYear,$(this));
	});
	$('body').on('change', '#location', function(e){
		if($(this).val() != 0)
			$(this).parent().find("input[type='hidden']").val($(this).val());
		else $(this).parent().find("input[type='hidden']").val(''); 
	});
	$('body').on('change', '#day', function(e){
		var eDay = $(this).val();
		var eMonth = $(this).parent().find("#month").val();
		var eYear = $(this).parent().find("#year").val();
		dayProperties(eDay,eMonth,eYear,$(this));
	});
	$('body').on('change', '#month', function(e){
		var eMonth = $(this).val();
		var eDay = $(this).parent().find("#day").val();
		var eYear = $(this).parent().find("#year").val();
		dayProperties(eDay,eMonth,eYear,$(this));
	});
	$('body').on('change', '#year', function(e){
		var eYear = $(this).val();
		var eDay = $(this).parent().find("#day").val();
		var eMonth = $(this).parent().find("#month").val();
		dayProperties(eDay,eMonth,eYear,$(this));
	});
	
	
	
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
	

	//follow
	var _editFollow = $(".wd-edit-follows");
	var _editFollowBT = _editFollow.find(".wd-edit-flbt");
	_editFollowBT.click(function() {
		$(this).toggleClass("wd-icon-edit-28").toggleClass("wd-icon-close-28");
		$(this).parent().find(".wd-edit-follow-content").toggle();
	});
	
	$('body').on('click', '.wd-edit-button', function(e){
		if(checkSubmit) return false;
		checkSubmit = true;
		
		$(this).css({"display":"none"});
		$(this).parent().find(".wd-item-edit-lc").hide();
		$(this).parent().find(".wd-popup-edit-lc").fadeIn("slow");
	});
	
	
	
	/**
	 * Update user info
	 */
	$('body').on('keyup', '#editProfile', function(e){
		if(e.keyCode == 13){
			updateInfo($("#btnSubmitProfile"));
		}
	});
	$("#btnSubmitProfile").click(function(e){

		var _this = $(this);
		updateInfo(_this);
		
	});
	
	
	/**
	 * This action used event summary
	 * Author: thinhpq
	 **/
	 $('body').on('click', '#framesummary1', function(e){
		
		if($('#propertiesSummary').height() != 0){
			

		}
	});
	$('body').on('click', '#saveSumary', function(e){
		var form  = $("#frmZoneInfomationForm");
		
		$("#ZoneInfomationForm"+currentUserHexId+"_description").val($("#contentSumary").val());
		
		var _this = $(this);
		_this.attr('disabled','disabled');
		$.ajax({
			url		: homeURL+"/users/edit/sumary",
			type	: 'POST',
			datatype: 'json',
			data	: form.serialize(),
			success	: function(res){
				
				if(res.error){
					
					_this.removeAttr('disabled');
				}else{
					$("#contentSumary").val(res.valueSummary);
					$("#propertiesSummary").html(res.valueSummary);
					
					setAllToken(res.token);
					
					_this.removeAttr('disabled');
					cancel('summary');
				}
				
			},error: function (xhr, ajaxOptions, thrownError) {
				console.log(xhr.responseText);
				_this.removeAttr('disabled');
			}
		});
	});
	
	
	/**
	 * This event assign data to form edit user.
	 * Author: thinhpq
	 **/
	 
	$('body').on('click', '.edit-user-properties', function(e){
		var nameType = $(this).attr('nameType');
		var _token = $(this).attr('token');
		var attr = $(this).parent().find('.pullData').html();
		var data = $.parseJSON($.trim(attr));
		
		if(checkSubmit) return false;
		checkSubmit = true;
		$("#frame"+nameType+"3").fadeIn("slow");
		
		liItemProp = "li-item-"+_token;
		
		$.each(data,function(key,value){
			
			if(value.zone_id == ""){
				$("#ZonePropertiesForm"+nameType+""+currentUserHexId+"_"+value.tmp).val(value.name);
			}else{
				$("#ZonePropertiesForm"+nameType+""+currentUserHexId+"_"+value.tmp+"_tmp_").val(value.name);
				$("#ZonePropertiesForm"+nameType+""+currentUserHexId+"_"+value.tmp).val(value.zone_id);
				if(value.tmp == "location"){
					$("#ZonePropertiesForm"+nameType+""+currentUserHexId+"_"+value.tmp).parent().find('#location option[value='+value.zone_id+']').attr('selected','selected');
				}
				
			}
			if(value.expected == "/type/datetime"){
				var date = new Date(value.name);
				var parentDivSelect = $("#ZonePropertiesForm"+nameType+""+currentUserHexId+"_"+value.tmp).parent();
				if(date == "Invalid Date"){
					$.each(parentDivSelect.find('select'),function(x,y){
						$(this).hide();
					});
					parentDivSelect.find('.wd-current-position').show();
					parentDivSelect.find('.current-enddate').attr('checked',true);
				}else{
					$.each(parentDivSelect.find('select'),function(x,y){
						$(this).show();
					});
					
					var tmpMonth = date.getMonth()+1;
					parentDivSelect.find('.day option[value='+date.getDate()+']').attr('selected','selected');
					parentDivSelect.find('.month option[value='+tmpMonth+']').attr('selected','selected');
					parentDivSelect.find('.year option[value='+date.getFullYear()+']').attr('selected','selected');
					
					parentDivSelect.find('.wd-current-position').hide();
					parentDivSelect.find('.current-enddate').attr('checked',false);
				}
				
			}
		});
		$('.token'+nameType).val(_token);
		// $(this).parent().find(".wd-popup-add-newItem-lc").fadeIn("slow");
		
	});
	
});
function showForm(strId){
	if(checkSubmit) return false;
	checkSubmit = true;
	liItemProp = "";
	$(".token"+strId).val('');
	$("#frame"+strId+"1").parent().find(".wd-popup-add-newItem-lc input[type=reset]").trigger('click');
	
	$(".day option[value=0]").attr('selected','selected');
	$(".month option[value=0]").attr('selected','selected');
	$(".year option[value=0]").attr('selected','selected');
	
	if($("#frame"+strId+"3").find('.custom-check-box-edit').length!=0){
		$("#frame"+strId+"3").find('.wd-current-position').hide();
		$("#frame"+strId+"3").find('.custom-check-box-edit input[type=checkbox]').attr('checked',false);
		$.each($("#frame"+strId+"3").find('select'),function(x,y){
			$(this).show();
		});
		$("#frame"+strId+"3").find('#location option[value=0]').attr('selected','selected');
	}
	$("#frame"+strId+"1").parent().find(".wd-popup-add-newItem-lc").fadeIn("slow");
}

function cancel(str,_case){
	switch(_case){
		case 0:
			$("#frame"+str+"3").fadeOut(500);
		break;
		default:
			$("#frame"+str+"1").show();
			$("#frame"+str+"2").show();
			$("#frame"+str+"3").fadeOut(500);
		break;
	}
	
	
	checkSubmit = false;
}
function updateInfo(_this){
	var form  = $("#editProfile");
	_this.attr('disabled','disabled');
	$.ajax({
		url		: form.attr('action'),
		type	: 'POST',
		datatype: 'json',
		data	: form.serialize(),
		success	: function(res){
			if(res.error){
				$("#errorMessageFormEdit").html(res.message);
				_this.removeAttr('disabled');
			}else{
				
				$("#errorMessageFormEdit").html('');
				
				$("#locationAndStatus").html('<p><strong>'+res.profile.status_text+'</strong></p><p class="wd-gray-cl-1 mt5">'+$("#GNUserProfile_location option:selected").text()+'</p>');
				$("#textEditUserName").html(res.user.displayname);
				
				$("#ZoneUser_firstname").val(res.user.firstname);
				$("#ZoneUser_lastname").val(res.user.lastname);
				$('.ume').html(res.user.displayname);
				_this.removeAttr('disabled');
				cancel('info');
				callbackUpdateInfo();
			}
			
		},error: function (xhr, ajaxOptions, thrownError) {
			console.log(xhr.responseText);
			_this.removeAttr('disabled');
		}
	});
}



function callbackUpdateInfo(){
	var form = $("#frmZoneInfomationForm");
	$.ajax({
		url		: form.attr('action'),
		type	: 'POST',
		datatype: 'json',
		data	: form.serialize(),
		success	: function(res){
			if(typeof res.error != "undefined"){
				if(res.error){
					
				}else{
					setAllToken(res.token);
				}
			}
			
		},error: function (xhr, ajaxOptions, thrownError) {
			console.log(xhr.responseText);
			
		}
	});
}
function sbmInfo(frm,res){
	
	// console.log(res)
	if(typeof res.error != "undefined"){
		if(res.error){
			
		}else{
			setAllToken(res.token);
			// window.location.reload();
			// $.get(homeURL+"/profile/edit",{type:'info',renderHtml:'true'},function(html){
				// $(".wd-information-list").html(html);
			// });
			
			frm.find(".cancel").trigger('click');
			// window.location.reload();
		}
	}
}
function submitPropOther(frm,res){
	
	
	if(typeof res.error != "undefined"){
		if(res.error){
			
		}else{
			if(typeof res.results != "undefined"){
				frm.find("input[type='reset']").trigger('click');
				$.each(frm.find("input"),function(e){
					switch($(this).attr('type'))
					{
						case "submit":
						
						break;
						case "button":
						break;
						default:
							$(this).val('');
						break;
					}
					
				});
				frm.find(".cancel").trigger('click');
				// frm[0].reset();
				$.post(homeURL+"/users/edit/renderProp",{data:res.results,type:frm.attr('nameType')},function(html){
					var str_id = frm.attr('str_id');
					if(liItemProp!="") $("."+liItemProp).remove();
					$("."+str_id).append(html);
					
					
				});
			}
			
			// window.location.reload();
		}
	}
}

function isNumberKey(evt)
{
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))
	return false;

	return true;
}
function setAllToken(token){
	$.each($(".token"),function(x,y){
		$(this).val(token);
	});
}