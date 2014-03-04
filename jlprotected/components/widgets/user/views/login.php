<div class="wd-st-pp">
	
	<div id="wd-signin-popup" class="wd-container-popup">
		
		<div class="wd-popup-content" id="content-login" style="display:block">
			<h2 class="wd-tt-pp-1">Sign in to your profile</h2>
			<div class="wd-form-content">
				
				<?php /** @var BootActiveForm $form */
					// GNAssetHelper::registerScript('Login', "jlbd.users_login.Libs.initForm($('#userLoginForm'));", CClientScript::POS_READY);
					$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
					'id' => 'userLoginForm',
					'enableClientValidation' => true,
					'enableAjaxValidation' => true,
					'action'=>GNRouter::createUrl('/users/login'),
					'clientOptions'=> array(
						'validateOnSubmit'=>true,
						'validateOnChange'=>false
					),
					'htmlOptions'=>array('class' => 'well'),
					'focus'=>array($model,'email'),
				)); ?>
					<fieldset class="wd-main-form wd-signin-form bbor-solid-2">
						<div class="wd-input hide-label">
							
							<?php echo $form->textFieldRow($model, 'email', array('class'=>'span3','placeholder'=>'Enter your email address'));?>
							
						</div>
						<div class="wd-input hide-label">
							<?php echo $form->passwordFieldRow($model, 'password', array('class'=>'span3','placeholder'=>'Enter your password')); ?>
						</div>
						<div class="wd-remember ">
							<?php echo $form->checkboxRow($model, 'rememberMe'); ?>
							
						</div>
						<div class="wd-submit pb30">
							
							<?php $this->widget('bootstrap.widgets.TbButton', array(
								'buttonType' => 'submit',
								'label' => 'Sign in',
								'type' => 'primary',
							));?>
							<a href="javascript:void(0)" onclick="$('#content-login').hide(); $('#content-forgot').fadeIn(500);" class="wd-forgot-pass">Forgot your password?</a>
						</div>
					</fieldset>
				<?php $this->endWidget(); ?>
				<div class="wd-login-more"><a href="<?php echo GNRouter::createUrl('/facebook'); ?>" class="wd-sigin-facebook">Sign in with Facebook</a></div>
			</div>
		</div>
		
		<div class="wd-popup-content"  id="content-forgot" style="display:none">
			<h2 class="wd-tt-pp-1">Forgot your password?</h2>
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
				
					<fieldset class="wd-main-form wd-signin-form">
						<p class="wd-dis"><span>Don’t worry!</span> Just fill in your email and we’ll help you reset your password</p>
						<div class="wd-input hide-label">
							<?php echo $formForgot->textFieldRow($modelPassForm, 'email', array('class'=>'span3','placeholder'=>'Enter your email address')); ?>
						</div>
						
						<div class="wd-submit pb30" id="buttonForgot">
						
						
							
							
						
							<?php 
							$this->widget('bootstrap.widgets.TbButton', array(
								'buttonType' => 'submit',
								'label' => 'Send email',
								'type' => 'primary',
							));
							?>
							<span class="wd-or">Or</span>
							<a href="javascript:void(0)" onclick="$('#content-login').fadeIn(500); $('#content-forgot').hide();" class="wd-link">Back to sign in</a>
							
						</div>
					</fieldset>
				<?php $this->endWidget(); ?>
			</div>
		</div>
		
		<div class="wd-popup-content" style="display:none" id="content-success-forgot">
			<h2 class="wd-tt-pp-1 ">Forgot your password?</h2>
			<div class="wd-succes-mess">
				<span class="wd-icon-check"></span>
				<p>We’ve sent an email to:</p>
				<p class="wd-mail"><a href="javascript:void(0)" id="emailSuccess">email@email.com</a></p>
				<p>with instructions to create a new password. Your existing password has been changed.</p>
				
				<div class="wd-submit">
					<button name="yt0" type="button" class="btn-signin" onclick="$('#content-login').fadeIn(500); $('#content-forgot').hide(); $('#content-success-forgot').hide();">Sign in</button>
					<span class="wd-or">Or</span>
					<a href="javascript:void(0)" onclick="$('.mfp-close').trigger('click');" class="wd-link">Back to home page</a>
				</div>
			</div>
		</div>
		
	</div>
</div>
<script>


function forgotpw(frm,res){
	if(typeof res.error == "undefined"){
		$("#buttonForgot button").removeAttr('disabled');
		return false;
	}else{
		if(res.error){
			$("#ZoneForgotPasswordForm_email_em_").html(res.message);
			$("#ZoneForgotPasswordForm_email_em_").show();
			$("#buttonForgot button").removeAttr('disabled');
		}else{
			$("#emailSuccess").html(res.email);
			$("#content-success-forgot").fadeIn(500);
			$('#content-forgot').hide();
			$("#buttonForgot button").removeAttr('disabled');
		}
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
