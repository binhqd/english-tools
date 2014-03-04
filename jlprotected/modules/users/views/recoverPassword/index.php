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
<style>
form .wd-input label {
display: block;
}
.wd-container-popup{
	margin:40px auto;
}
</style>

<div id="wd-signin-popup" class="wd-container-popup" style="margin:100px auto;border:none">

	<div class="wd-popup-content" id="content-login" style="display:block">
		<h2 class="wd_tt_n3">Choose a new password</h2>
		
		<div class="wd-form-content">
			<?php /** @var BootActiveForm $form */
			
			$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
				'id'=>'userChangepassForm',
				'enableClientValidation' => true,
				'enableAjaxValidation' => true,
				'clientOptions'=> array(
					'validateOnSubmit'=>true,
					'validateOnChange'=>false
				),
				'htmlOptions'=>array(
					'class' => 'well'
					),
				)); 
			?>
				<fieldset class="wd-main-form wd-main-form-2 wd-signin-form" style="padding:0px;">
					<p class="wd-dis" style="font-size:14px;">A strong password is a combination of letters and punctuation marks. It must be at least 6 characters long.</p>
					
					<div class="wd-input  hide-label">
						<?php echo $form->passwordFieldRow($model, 'password', array('class'=>'span3','placeholder'=>'New Password ')); ?>
					</div>
					<div class="wd-input  hide-label">
						<?php echo $form->passwordFieldRow($model, 'confirmPassword', array('class'=>'span3','placeholder'=>'Confirm New Password ')); ?>
					</div>
					<div class="wd-submit pb30">
						
						<?php $this->widget('bootstrap.widgets.TbButton', array(
							'buttonType' => 'submit',
							'label' => 'Continue',
							'type' => '',
							'htmlOptions'=>array(
								'class'=>'btn btn-continue'
							)
						));?>
						
					</div>
				</fieldset>
			<?php $this->endWidget(); ?>
		</div>
	</div>
</div>