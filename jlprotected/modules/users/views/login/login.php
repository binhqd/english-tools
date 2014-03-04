<?php
	GNAssetHelper::init(array(
		'image'		=> 'img',
		'css'		=> 'css',
		'script'	=> 'js',
	));
	Yii::app()->clientScript->registerCoreScript('jquery');
	
	GNAssetHelper::setBase('myzone_v1');
	GNAssetHelper::cssFile('topmenu-right');
	GNAssetHelper::cssFile('banner-yl');
	GNAssetHelper::cssFile('main-form');
	
?>
<script>
$().ready(function(e){
	$("html").niceScroll({styler:"fb",cursorcolor:"#000"});
});
</script>
<div class="wd-main-content-wr2 wd-main-content-bggray">
			<div class="wd-center">
				<div class="wd-left-content-hp">
					<h2 class="wd_tt_4">Connect with people and the world around you on YouLook</h2>
					<div class="wd-login-img">
						<img src="<?php echo baseUrl();?>/img/front/login-img-1.png" alt="Connect with people and the world around you on YouLook" height="244" width="558">
					</div>
					<ul class="wd-intro-yl">
						<li>
							<span class="wd-icon-yli wd-icon-yli-share-new"></span>
							<div class="wd-intro-yl-rightct">
								<h4><a >Share what's new</a></h4>
								<p>in your life on your profile.</p><p>
							</p></div>
						</li>
						<li>
							<span class="wd-icon-yli wd-icon-yli-see-pt"></span>
							<div class="wd-intro-yl-rightct">
								<h4><a >See photos and updates</a></h4>
								<p>from friends on YouLook.</p><p>
							</p></div>
						</li>
					</ul>
				</div>
				<div class="wd-right-content-hp">
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
					<fieldset class="wd-main-form wd-main-form-2 bbor-solid-2">
						<h2 class="wd_tt_n3">Sign in to your account</h2>
						<div class="wd-input hide-label">
							<?php echo $form->textFieldRow($model, 'email', array('class'=>'span3','placeholder'=>'Enter your email address'));?>
						</div>
						<div class="wd-input hide-label">
							<?php echo $form->passwordFieldRow($model, 'password', array('class'=>'span3','placeholder'=>'Enter your password')); ?>
						</div>
						<div class="wd-remember">
							<?php echo $form->checkboxRow($model, 'rememberMe'); ?>
						</div>
						<div class="wd-submit">
							
							<?php $this->widget('bootstrap.widgets.TbButton', array(
								'buttonType' => 'submit',
								'label' => 'Sign in',
								'type' => '',
								'htmlOptions'=>array(
									'class'=>'btn btn-continue'
								)
							));?>
							<span class="wd-or">Or</span>
							<?php
								echo CHtml::link('Sign up for YouLook',ZoneRouter::createUrl('/users/registration'),array(
									'class'=>'wd-link'
								));
								echo CHtml::link('Forgot your password?',ZoneRouter::createUrl('/users/forgot'),array(
									'class'=>'wd-forgot-pass-link'
								));
							?>
							
							
						</div>
					</fieldset>
					
				<?php $this->endWidget(); ?>
				<div class="wd-login-more custom-wd-login-more">
					<?php
						echo CHtml::link('SIGN IN WITH FACEBOOK ',ZoneRouter::createUrl('/facebook'),array(
							'class'=>'wd-sigin-facebook'
						));
					?>
				
				</div>
						
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
<div id="wd-push">&nbsp;</div>

<style>
.hide-label label{display:none!important}
</style>