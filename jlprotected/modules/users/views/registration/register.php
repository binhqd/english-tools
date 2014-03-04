
<?php
	GNAssetHelper::init(array(
		'image'		=> 'img',
		'css'		=> 'css',
		'script'	=> 'js',
	));
	Yii::app()->clientScript->registerCoreScript('jquery');
	
	GNAssetHelper::setBase('myzone_v1');
	GNAssetHelper::cssFile('uniform.default');
	GNAssetHelper::cssFile('uniform-default-custom');
	
	GNAssetHelper::cssFile('main-form');
	
	


?>
<script>
$().ready(function(e){
	$("html").niceScroll({styler:"fb",cursorcolor:"#000"});
});
</script>
<?php
if(Yii::app()->user->hasFlash('error')):?>
	<div class="wd-top-mess w-msg-625" style="margin-top: 20px;margin-bottom: -40px;">
		<div class="wd-top-mess-content wd-top-mess-content-error">
			<span class="content-message">
				<?php echo Yii::app()->user->getFlash('error'); ?>
				<span class="wd-intro"></span>
			</span>
			<a class="wd-close-topmess" target="wd-top-mess" onclick="$('.wd-top-mess').fadeOut(500);"></a>
		</div>
	</div>
<?php endif; ?>
<div class="wd-main-content-wr2 wd-main-content-bggray">
	<div class="wd-center">
		<div class="wd-left-content-hp">
			<h2 class="wd_tt_4">Connect with people and the world around you on YouLook</h2>
			<ul class="wd-intro-register-yl">
				<li>
					<span class="wd-icon-yli wd-icon-yli-social-graph"></span>
					<div class="wd-intro-yl-rightct">
						<h4><a href="#">Social graph</a></h4>
						<p>The social graph is a graph that depicts personal relations.</p><p>
					</p></div>
				</li>
				<li>
					<span class="wd-icon-yli wd-icon-yli-knowledge-graph"></span>
					<div class="wd-intro-yl-rightct">
						<h4><a href="#">Knowledge graph</a></h4>
						<p>The Knowledge Graph is a knowledge base used by YouLook.</p><p>
					</p></div>
				</li>
				<li>
					<span class="wd-icon-yli wd-icon-yli-find-more"></span>
					<div class="wd-intro-yl-rightct">
						<h4><a href="#">Find more </a></h4>
						<p>Find and share with the people in your life.</p><p>
					</p></div>
				</li>
			</ul>
		</div>
		<div class="wd-right-content-hp">
			<div class="wd-form-content">
				<?php
				$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
					'id'=>'userRegistrationForm',
					'enableClientValidation' => true,
					'enableAjaxValidation' => true,
					'action'=>GNRouter::createUrl('/users/registration'),
					'clientOptions'=> array(
						'validateOnSubmit'=>true,
						'validateOnChange'=>false
					),
					'htmlOptions'=>array('class' => 'well'),
				)); ?>
					<fieldset class="wd-main-form wd-main-form-2">
						<h2 class="wd_tt_n3">Sign up new account</h2>
						<p class="wd-dis-tt">It’s free and always will be</p>
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
						<div class="wd-input wd-input-time hide-label">
							
							<?php
							echo '<div class="wd-input-child wd-input-w1">';
							echo $form->dropDownListRow($model, 'monthbirth',$model->getMonths(),
								array(
									'class'=>'wd-custome-select'
							)); 
							echo '</div>';
							echo '<div class="wd-input-child wd-input-w2">';
							echo $form->dropDownListRow($model, 'daybirth',$model->getDays(),
								array(
									'class'=>'wd-custome-select'
							)); 
							echo '</div>';
							echo '<div class="wd-input-child wd-input-w3">';
							echo $form->dropDownListRow($model, 'yearbirth',$model->getYears(),
								array(
									'class'=>'wd-custome-select'
							)); 
							echo '</div>';
							
							?>
							
						</div>
						<div class="wd-input wd-select-country hide-label">
							<?php echo $form->dropDownListRow($model, 'location', $model->getLocations(),array(
									'class'=>'wd-custome-select'
							)); 
							?>
						</div>
						<div class="wd-input wd-input-radio-cus pt20">
							<input type="radio" name="ZoneRegisterForm[gender]" value="<?php echo ZoneUserTmpProfile::TYPE_GENDER_MALE;?>" class="wd-radio-cus"/>
							<label class="mr25">Male</label>
							<input type="radio" name="ZoneRegisterForm[gender]" value="<?php echo ZoneUserTmpProfile::TYPE_GENDER_FEMALE;?>" class="wd-radio-cus" checked="checked"/>
							<label >Female</label>
							
						</div>
						<p class="wd-note-form">By creating an account, I accept YouLook's <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>.</p>
						<div class="wd-submit">
							
							<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'', 'label'=>'Sign up ',
								'htmlOptions'=>array(
									'class'=>'btn-signup'
								)
							)); ?>
							<span class="wd-or">Or</span>
							<a href="<?php echo GNRouter::createUrl('/facebook'); ?>" class="wd-link">Sign in with Facebook</a>
	
						</div>
						
					</fieldset>
				<?php $this->endWidget(); ?>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div id="wd-push">&nbsp;</div>
<style>
.hide-label label{display:none!important}
</style>