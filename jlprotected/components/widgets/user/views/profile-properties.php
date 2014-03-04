<script>
	var currentUserHexId = "<?php echo currentUser()->hexID;?>";
	var optionsGender = null;
</script>
<style>
form#frmZoneInfomationForm .wd-input label,form#frmZoneExperienceForm .wd-input label,form#frmZoneEducationForm .wd-input label{display:block}
form#frmZoneInfomationForm .wd-input span.required,form#frmZoneExperienceForm .wd-input span.required,form#frmZoneEducationForm .wd-input span.required{float:none; width:auto; color:red;}
form#frmZoneInfomationForm .wd-input span.error,form#frmZoneExperienceForm .wd-input span.error,form#frmZoneEducationForm .wd-input span.error{font-weight:normal; color:red;}
form#frmZoneInfomationForm .special input.wd-input-1,form#frmZoneExperienceForm .special input.wd-input-1,form#frmZoneExperienceForm .special label,form#frmZoneEducationForm .special input.wd-input-1,form#frmZoneEducationForm .special label{display:none}
form#frmZoneInfomationForm .wd-textarea span.error,form#frmZoneEducationForm .wd-textarea span.error{margin-top:20px; margin-left:-10px}

.bgop30{opacity:1}
</style>
<?php
GNAssetHelper::init(array(
'image'		=> 'img',
'css'		=> 'css',
'script'	=> 'js'
));

GNAssetHelper::setBase('myzone_v1');
// GNAssetHelper::cssFile('headline-submit');
// GNAssetHelper::cssFile('profile-user-view-layout');
GNAssetHelper::cssFile('customize-public-profile');
GNAssetHelper::cssFile('popup-edit-lc');
// GNAssetHelper::cssFile('uniform.default');
// GNAssetHelper::cssFile('uniform-default-custom');
// GNAssetHelper::cssFile('sync-your-photo');

// GNAssetHelper::scriptFile('jquery.uniform.min', CClientScript::POS_END);
GNAssetHelper::scriptFile('edit.profile', CClientScript::POS_END);

echo Yii::app()->controller->renderPartial('widgets.user.views.profile.edit-info',array(
	'sumary'=>$sumary,
	'token'=>$token,
	'months'=>$months,
	'days'=>$days,
	'years'=>$years,
	'propertiesInfomation'=>$propertiesInfomation,
	'constructsBasic'=>$constructsBasic,
	'user'=>currentUser(),
	'acceptEdit'=>( !empty($acceptEdit) && $acceptEdit ) ? true : false,
	'page'=>'profile'
));


echo Yii::app()->controller->renderPartial('widgets.user.views.profile.other-properties',array(
	'constructsOther'=>$constructsOther,
	'token'=>$token,
	'months'=>$months,
	'days'=>$days,
	'years'=>$years,
	'locations'=>$locations,
	'results'=>$results,
	'acceptEdit'=>( !empty($acceptEdit) && $acceptEdit ) ? true : false,
	'page'=>'profile'
));

?>