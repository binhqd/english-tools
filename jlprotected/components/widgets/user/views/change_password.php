<?php 
GNAssetHelper::init(array(
	'image'		=> 'img',
	'css'		=> 'css',
	'script'	=> 'js'
));

GNAssetHelper::setBase('application.modules.users.assets', 'user');
GNAssetHelper::scriptFile('jlbd.users.changepass', CClientScript::POS_END);


?>
<div class="<?php echo ($isPopup) ? "wd-st-pp": "";?> custom-form-changepass">
	<div id="wd-changepass-popup" class="wd-container-popup" style="<?php echo ($isPopup) ? "": "margin:100px auto;border:none";?>">
		<?php if(!$isPopup):?>
		<div class="wd-top-mess w-msg-625" style="margin-top:30px;display:none">
			<div class="wd-top-mess-content ">
				<span class="content-message">
					<span class="wd-intro"></span>
				</span>
				<a class="wd-close-topmess" target="wd-top-mess-content"></a>
			</div>
		</div>
		<?php endif;?>
		<div class="wd-popup-content" id="content-login" style="display:block">
			<?php if ($hasCreatedPassword) : ?>
				<h2 class="<?php echo ($isPopup) ? "wd-tt-pp-1": "wd_tt_n3";?>">Change password</h2>
			<?php else : ?>
				<h2 class="<?php echo ($isPopup) ? "wd-tt-pp-1": "wd_tt_n3";?>">Create password</h2>
			<?php endif; ?>
			<div class="wd-form-content">
				<?php 
				if ($hasCreatedPassword)
					GNAssetHelper::registerScript('ChangePassword', "jlbd.users_changepass.Libs.initFormChangePasswordFull($('#userProfileChangepassForm'));", CClientScript::POS_READY);
				else
					GNAssetHelper::registerScript('ChangePassword', "jlbd.users_changepass.Libs.initFormChange($('#userProfileChangepassForm'));", CClientScript::POS_READY);
					
				$validateForm = array(
					'id' => 'userProfileChangepassForm',
					'enableClientValidation' => false,
					'htmlOptions'=>array('class' => 'well'),
					'action'=>GNRouter::createUrl('/profile/change_password'),
					'focus'=>array($model,'password'),
				);
				if(!$isPopup){
					$validateForm = array(
						'id' => 'userProfileChangepassForm',
						'enableClientValidation' => true,
						'enableAjaxValidation' => true,
						'htmlOptions'=>array('class' => 'well'),
						'action'=>GNRouter::createUrl('/profile/change_password'),
						'clientOptions'=> array(
							'validateOnSubmit'=>true,
							'validateOnChange'=>false,
							'afterValidate'=>'js:jlbd.users_changepass.Libs.validateFormFullScreen'
						),
						'focus'=>array($model,'password'),
					);
				}
				$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', $validateForm); ?>
				
					<fieldset class="<?php echo ($isPopup) ? "wd-main-form": "wd-main-form wd-main-form-2";?> wd-signin-form" style="<?php echo ($isPopup) ? "": "padding:0px";?>">
						<?php if(!$isPopup):?>
							<p class="wd-dis" style="font-size:14px;">Enter the new password to complete process to change your password.</p>
						<?php endif;?>
						<div class="wd-input hide-label" id="js-change-password-current-password-element" <?php if (!$hasCreatedPassword) echo 'style="display:none"' ?>>
							<?php echo $form->passwordFieldRow($model, 'currentPassword', array('class'=>'span3','placeholder'=>'Enter your current password'));?>
						</div>
						<div class="wd-input hide-label">
							<?php echo $form->passwordFieldRow($model, 'password', array('class'=>'span3','placeholder'=>'New password'));?>
						</div>
						<div class="wd-input hide-label">
							<?php echo $form->passwordFieldRow($model, 'confirmPassword', array('class'=>'span3','placeholder'=>'Confirm new password')); ?>
						</div>
						<div class="wd-submit <?php echo ($isPopup) ? "pb30": "";?>">
							<?php $this->widget('bootstrap.widgets.TbButton', array(
								'buttonType' => 'submit',
								'label' => $hasCreatedPassword ? 'Save & continue' : 'Create',
								'type' => $isPopup ? 'primary' : "",
								'htmlOptions'=>array(
									'class'=>$isPopup ? '' : "btn btn-continue", 
								)
							));
							if(!$isPopup):
							?>
							<span class="wd-or">Or</span>
							<a href="<?php echo ZoneRouter::createUrl('/profile');?>" class="wd-link">Cancel</a>
							<?php endif;?>
						</div>
					</fieldset>
				<?php $this->endWidget(); ?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(window).ready(function(){
	//popup
	$('.wd-open-popup').magnificPopup({
		tClose: 'Close (Esc)',closeBtnInside:false
	});
});
</script>