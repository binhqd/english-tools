
<?php
	GNAssetHelper::init(array(
		'image'		=> 'img',
		'css'		=> 'css',
		'script'	=> 'js',
	));
	Yii::app()->clientScript->registerCoreScript('jquery');
	
	GNAssetHelper::setBase('myzone_v1');
	GNAssetHelper::cssFile('popup-content');
	GNAssetHelper::cssFile('uniform.default');
	GNAssetHelper::cssFile('uniform-default-custom');
	
	GNAssetHelper::cssFile('main-form');
	GNAssetHelper::scriptFile('zone', CClientScript::POS_HEAD);
	
	


?>
<script>
$().ready(function(e){
	$("html").niceScroll({styler:"fb",cursorcolor:"#000"});
	
});
</script>


	
	<div id="wd-signin-popup" class="wd-container-popup" style="margin:100px auto;border:none">
		
		<div class="wd-top-mess w-msg-625" style="margin-top:30px;display:none">
			<div class="wd-top-mess-content ">
				<span class="content-message">
					<span class="wd-intro"></span>
				</span>
				<a class="wd-close-topmess" target="wd-top-mess-content"></a>
			</div>
		</div>
		<div class="wd-popup-content"  id="content-forgot" style="display:block">
			<h2 class="wd_tt_n3">Forgot your password?</h2>
			<div class="wd-form-content">
				
				<?php /** @var BootActiveForm $form */
					// GNAssetHelper::registerScript('Login', "jlbd.users_login.Libs.initForm($('#userLoginForm'));", CClientScript::POS_READY);
					$formForgot = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
					'id' => 'userForgotForm',
					'enableClientValidation' => true,
					'enableAjaxValidation' => true,
					'action'=>GNRouter::createUrl('/users/forgot'),
					'clientOptions'=> array(
						'validateOnSubmit'=>true,
						'validateOnChange'=>false,
						// 'beforeValidate'=>'js:beforefpw',
						'afterValidate'=>'js:forgotpw'
					),
					'htmlOptions'=>array('class' => 'well'),
					'focus'=>array($model,'email'),
				));
				?>
				
					
					<fieldset class="wd-main-form wd-main-form-2" style="padding:0px;">
					
						<p class="wd-dis" style="font-size:14px;"><span>Don’t worry!</span> Just fill in your email and we’ll help you reset your password</p>
						<div class="wd-input hide-label">
							<?php echo $formForgot->textFieldRow($model, 'email', array('class'=>'span3','placeholder'=>'Enter your email address','style'=>'width:90%')); ?>
						</div>
						
						<div class="wd-submit pb30" id="buttonForgot">
						
						
							
							
						
							<?php 
							$this->widget('bootstrap.widgets.TbButton', array(
								'buttonType' => 'submit',
								'label' => 'Send email',
								'type' => '',
								'htmlOptions'=>array(
									'class'=>'btn btn-continue'
								)
							));
							?>
							<span class="wd-or">Or</span>
							<a href="<?php echo ZoneRouter::createUrl('/users/login');?>" class="wd-link">Back to sign in</a>
							
						</div>
					</fieldset>
				<?php $this->endWidget(); ?>
			</div>
		</div>
		

		
	</div>

<script>


function forgotpw(frm,res){
	if(typeof res.error == "undefined"){
		$("#buttonForgot button").removeAttr('disabled');
		return false;
	}else{
		$("#ZoneForgotPasswordForm_email").val('');
		if(res.error){
			$(".wd-top-mess-content").addClass('wd-top-mess-content-error');
		}else{
			$(".wd-top-mess-content").addClass('wd-top-mess-content-success');
		}
		$("#buttonForgot button").removeAttr('disabled');
		$(".content-message .wd-intro").html(res.message);
		$(".wd-top-mess").css({opacity:0,display:"block"});
		$(".wd-top-mess").animate({opacity:1},1000);
	}
	
}
$(document).ajaxSend(function() {
  $( "#buttonForgot .btn" ).attr('disabled','disabled');
  
});
$(document).ajaxSuccess(function() {
	$( "#buttonForgot .btn" ).removeAttr('disabled');
});
$(document).ajaxError(function() {
	
  $( "#buttonForgot .btn" ).removeAttr('disabled');
});
</script>
