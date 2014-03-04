<?php if(Yii::app()->user->hasFlash('contact')): ?>
 

	
	<div class="notify-container success-container success" id="notify-container" style="height:auto!important">
		<div class="jlbd-ico-title" style="top: -1px;">
			<div class="jlbd-ico-thumb success-ico-thumb"></div>
			<h2 class="jlbd-title-mess">Message</h2>
		</div>
		<p class="notify-message">
			 <?php echo Yii::app()->user->getFlash('contact'); ?>
		</p>
		
	</div>
	
	
	<script>
		var wcontainerNotify = $("#notify-container").width();
		var ww = $(window).width();
		var widthMod2 = ww- wcontainerNotify;
		$("#notify-container").css({
			top:"40px",
			left:widthMod2/2 + "px"
		});
		
		setTimeout(function(){
			// do something
			$("#notify-container").hide();
		},10000);
		$(".notify-close").click(function(e){
			$("#notify-container").hide();
		});
		var jsonEmail = $.parseJSON($("#jsonEmail").html());

	</script>
<?php endif; ?>
<div class="wd-st-pp">
	<div id="wd-signup-popup" class="wd-container-popup">
		<div class="wd-popup-content">
			<h2 class="wd-tt-pp-1 ">Sign up new account</h2>
			<div class="wd-form-content">
				
				<?php
				$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
					'id'=>'userRegistrationForm',
					'enableClientValidation' => true,
					'enableAjaxValidation' => true,
					'action'=>GNRouter::createUrl('/users/registration/register'),
					'clientOptions'=> array(
						'validateOnSubmit'=>true,
						'validateOnChange'=>false
					),
					'htmlOptions'=>array('class' => 'well'),
				)); ?>
					<fieldset class="wd-main-form wd-signup-form">
						<div class="wd-input hide-label">
							
							<?php echo $form->textFieldRow($model,'firstname', array('class'=>'span3','placeholder'=>'First Name'));?>
						</div>
						<div class="wd-input hide-label">
							<?php echo $form->textFieldRow($model,'lastname', array('class'=>'span3','placeholder'=>'Last Name'));?>
						</div>
						<div class="wd-input hide-label">
							<?php echo $form->textFieldRow($model,'email', array('class'=>'span3','placeholder'=>'Email'));?>
						</div>
						<div class="wd-input hide-label">
							<?php echo $form->passwordFieldRow($model, 'password', array('class'=>'span3','placeholder'=>'New password')); ?>
						</div>
						<div class="wd-input hide-label">
							<?php echo $form->passwordFieldRow($model, 'confirmPassword', array('class'=>'span3','placeholder'=>'Re-enter password')); ?>
						</div>
						<div class="wd-input">
							<?php
							echo $form->dropDownListRow($model, 'monthbirth',$model->getMonths(),
								array(
									'style'=>'width:110px; '
							)); 
							echo $form->dropDownListRow($model, 'daybirth',$model->getDays(),
								array(
									'style'=>'width:80px;margin-left:5px'
							)); 
							echo $form->dropDownListRow($model, 'yearbirth',$model->getYears(),
								array(
									'style'=>'width:90px; margin-left:5px'
							)); 
							echo CHtml::link('Why do I need to provide my birthday?',array('javascript:void(0)'),array(
								'style'=>'margin-left:5px; line-height:40px;'
							));
							
							?>
							
						</div>
						<div class="wd-input">
							<?php echo $form->dropDownListRow($model, 'location', $model->getLocations(),array(
									'style'=>'width:100%'
							)); 
							?>
						</div>
						<div class="wd-input wd-input-radio-cus pt20">

							<input type="radio" name="ZoneRegisterForm[gender]" value="<?php echo ZoneUserTmpProfile::TYPE_GENDER_FEMALE;?>" class="wd-radio-cus" checked="checked"/>
							<label class="mr25">Female</label>
							<input type="radio" name="ZoneRegisterForm[gender]" value="<?php echo ZoneUserTmpProfile::TYPE_GENDER_MALE;?>" class="wd-radio-cus"/>
							<label>Male</label>
						</div>
						<p class="wd-note-form">By creating an account, I accept YouLook's <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>.</p>
						<div class="wd-submit alignC">
							
							<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Sign up now',
								'htmlOptions'=>array(
									'class'=>'btn btn-signup'
								)
							)); ?>
							<span class="wd-or">Or</span>
							<a href="<?php echo GNRouter::createUrl('/facebook'); ?>" class="wd-forgot-pass">Sign in with Facebook</a>
	
						</div>
					</fieldset>
				<?php $this->endWidget(); ?>
			</div>
		</div>
	</div>
</div>
