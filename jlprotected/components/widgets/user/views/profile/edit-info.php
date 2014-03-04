<?php $className = "";?>
<div class="wd-left-block">
	<div class="wd-edit-block">
		<?php
		$content = "";
		if(!empty($sumary)) 	$content = $sumary;
		// dump($content);
		
		if( !empty($acceptEdit) && $acceptEdit ) : 
		
			if(!empty($page)):
				echo CHtml::link('<span class="wd-icon-16 wd-icon-update-info"></span><span class="wd-text">Update summary</span>','javascript:void(0)',array(
					'class'=>'wd-edit-button wd-update-infor-link',
					'id'=>'framesummary1',
				));
			else:
				echo '<span class="wd-edit-button wd-icon-edit-28" id="framesummary1"></span>';
			endif;
			
		
		?>
		
		<div class="wd-popup-edit-lc wd-summary-edit-content" id="framesummary3">
			<span class="wd-icon-edit-2"></span>
			
			<form id="frmSumary">
				<input type="hidden" id="name-article" name="data[name]" value="<?php echo $user->displayname;?>" class="text" />
				<input type="hidden" id="name-type" name="data[type_id]" value="/people/user" />
				<input type="hidden" name="data[zone_id]" value="<?php echo IDHelper::uuidFromBinary($user->id,true);?>" />

			<fieldset class="wd-edit-form-lc">
				<div class="wd-input">
					<label for="name">Summary</label>
					
					<div class="wd-textarea">
						<textarea class="wd-w1 wd-textarea-resize expanding" id="contentSumary" cols="30" rows="2" name="content" role="textbox" placeholder="Write something" aria-haspopup="true" style="overflow: hidden; word-wrap: break-word; resize: none; height: 70px;"><?php echo $content;?></textarea>
					</div>
				</div>
				<script>
				$().ready(function(e){
					$('body').on('keyup', '#contentSumary', function(e){
						$("#ZoneInfomationForm<?php echo currentUser()->hexID;?>_description").val($(this).val());
					});
				});
				</script>
				<input type="hidden" name="token" value="<?php echo $token;?>" class="token">
				<div class="wd-submit">
					<input type="button" value="Save" class="wd-form-bt-1 wd-save-button wd-close-edit mz-submit" id="saveSumary">
					<input type="reset"  style="display:none">
					<input type="button" onclick="cancel('summary');" value="Cancel" class="wd-form-bt-1 wd-cancel-button wd-close-edit">
				</div>
			</fieldset>
			</form>
		</div>
		<?php endif;?>
		<div class="" id="framesummary2">
			<h2 class="wd_tt_2">Summary</h2>
			<p id="propertiesSummary"><?php echo $content;?></p>
		</div>
	</div>
</div>



<div class="wd-left-block">
	<div class="wd-edit-block">
		<?php if( !empty($acceptEdit) && $acceptEdit ) : ?>
		<div class="wd-popup-edit-lc wd-infor-edit-content" id="framelives3">
			<span class="wd-icon-edit-2"></span>
			<?php
			
			if(!empty($constructsBasic)):
				$className = "ZoneInfomationForm".currentUser()->hexID;
				$modelZoneInfomationForm = new $className;
				
				$formModelZoneInfomationForm = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
					'id'=>'frmZoneInfomationForm',
					'action'=>GNRouter::createUrl('/users/edit/infomation'),
					'enableClientValidation' => true,
					'enableAjaxValidation' => false,
					'clientOptions'=> array(
						'validateOnSubmit'=>true,
						'validateOnChange'=>false,
						// 'beforeValidate'=>'js:beforefpw',
						// 'afterValidate'=>'js:sbmInfo'
					),
					'htmlOptions'=>array('class'=>'well', 'enctype' => 'multipart/form-data'),
				));
			?>
			<fieldset class="wd-edit-form-lc">
				<?php
					
					// dump($constructsBasic,false);
					foreach($constructsBasic as $key=>$value){
						//Description
						$value = (object) $value;
						
						$tmpLabel = strtolower($value->label);
						$tmpLabel = str_replace(" ","",$tmpLabel);
						$tmpLabel = str_replace(",","",$tmpLabel);
						$tmpLabel = str_replace("-","",$tmpLabel);

						if(!empty($propertiesInfomation)){
							// applied data to constructs
							foreach($propertiesInfomation as $k=>$propInfo){
								
								$tmpData = implode(",",(array)$propInfo['value']);
								
								if($propInfo['label'] == $value->label){

									$modelZoneInfomationForm->$tmpLabel = $tmpData;

								
								}
							}
						}
						echo '<div class="wd-input">';
						
						// Create ID HTML string for form.
						$strIdInputForm = strtolower($value->label);
						$strIdInputFormFirst = str_replace(" ","",$strIdInputForm);
						$strIdInputForm = "#{$className}_".$strIdInputFormFirst;
						$strIdInputFormTmp = "{$className}_".$strIdInputFormFirst."_tmp_";
						
						switch($value->type){
							case "text":
								if(strtolower($value->label) != "description"){
									$modelZoneInfomationForm->description = $content;
									if($value->suggest){
										
										$pos = strpos($value->expected, 'location');
										if ($pos === false) {
											// Input suggest values.
											echo "<label for='ZoneInfomationForm51c1810f8b1842a5b14f15eccbdd56cb_religion'>{$value->label}</label>";
											echo "<input type='text' class='wd-input-1' id='{$strIdInputFormTmp}' value='{$modelZoneInfomationForm->$tmpLabel}'>";
											if($modelZoneInfomationForm->$tmpLabel != null){
												$valueHidden = ZoneInstanceRender::search($modelZoneInfomationForm->$tmpLabel,1,0);
												if(!empty($valueHidden[0]['zone_id'])) $modelZoneInfomationForm->$tmpLabel = $valueHidden[0]['zone_id'];
											}
											// echo $formModelZoneInfomationForm->textFieldRow($modelZoneInfomationForm,$tmpLabel , array('class'=>'wd-input-1','placeholder'=>$value->label));
											echo $formModelZoneInfomationForm->hiddenField($modelZoneInfomationForm,$tmpLabel , array('class'=>'wd-input-1'));
											Yii::import('ext.jqautocomplete.jqAutocomplete');
		
											$json_options = array(
												'script'=> GNRouter::createUrl('users/profile/suggestNodes?expected='.$value->expected."&"),
												'varName'=>'term',
												'showMoreResults'=>true,
												'valueSep' => null,
												'maxresults'=>16,
												'callback' =>'js:function(obj){ 
													$("'.$strIdInputForm.'").val(obj.id);
													
												}'
											);
											echo '<script>';
											echo '$().ready(function(e){
												$(\'body\').on(\'keyup\', \'#'.$strIdInputFormTmp.'\', function(e){
													$("'.$strIdInputForm.'").val($(this).val());
												});
											});
											';
											echo '</script>';
											jqAutocomplete::addAutocomplete("#".$strIdInputFormTmp,$json_options);
										} else {
											echo $formModelZoneInfomationForm->hiddenField($modelZoneInfomationForm,$tmpLabel , array('class'=>'wd-input-1'));
										}
										
									}else{
										if(!empty($value->expected) && $value->expected == "/type/datetime") {
											echo $formModelZoneInfomationForm->labelEx($modelZoneInfomationForm,$tmpLabel);
											// $this->widget('zii.widgets.jui.CJuiDatePicker',array(
												// 'model'=>$modelZoneInfomationForm,
												// 'attribute'=>$tmpLabel,
												
												// 'options'=>array(
													// 'showAnim'=>'fold',
													// 'dateFormat'=>'yy-mm-dd',
													// 'changeMonth'=> true,
													// 'changeYear'=> true,
													// 'showOtherMonths' => true,      // show dates in other months
													// 'selectOtherMonths' => true,
													// 'showButtonPanel' => true,
												// ),
												// 'htmlOptions'=>array(
													// 'class'=>'wd-input-1',
													
													
												// ),
											// ));
											echo $formModelZoneInfomationForm->hiddenField($modelZoneInfomationForm,$tmpLabel , array('class'=>'wd-input-1'));
											$m = (int) date("m",strtotime($modelZoneInfomationForm->$tmpLabel));
											$d = (int) date("d",strtotime($modelZoneInfomationForm->$tmpLabel));
											$y = (int) date("Y",strtotime($modelZoneInfomationForm->$tmpLabel));
											 echo CHtml::dropDownList('month', $tmpLabel, $months,array(
												'style'=>'width:31%;margin-right:10px;',
												'options' => array($m=>array('selected'=>true))
											 ));
											 echo CHtml::dropDownList('day', $tmpLabel, $days,array(
												'style'=>'width:30%; margin-right:10px;',
												'options' => array($d=>array('selected'=>true))
											 ));
											 echo CHtml::dropDownList('year', $tmpLabel, $years,array(
												'style'=>'width:30%; margin-right:10px;',
												'options' => array($y=>array('selected'=>true))
											 ));
											echo $formModelZoneInfomationForm->error($modelZoneInfomationForm,$tmpLabel);
										}else{
											switch($tmpLabel){
												case "username":
													echo $formModelZoneInfomationForm->hiddenField($modelZoneInfomationForm,$tmpLabel , array('class'=>'wd-input-1'));
												break;
												case "weight":
													echo $formModelZoneInfomationForm->textFieldRow($modelZoneInfomationForm,$tmpLabel , array('class'=>'wd-input-1',
													'style'=>'width:25%;display: inline-block;'));
													echo '<label style="width: 100px;line-height:30px; margin-left:5px;display: inline-block;font-weight:normal;">kilogram</label>';
												break;
												case "height":
													echo $formModelZoneInfomationForm->textFieldRow($modelZoneInfomationForm,$tmpLabel , array('class'=>'wd-input-1',
													'style'=>'width:25%;display: inline-block;'));
													echo '<label style="width: 100px;line-height:30px; margin-left:5px;display: inline-block;font-weight:normal;">meter</label>';
												break;
												default:
													echo $formModelZoneInfomationForm->textFieldRow($modelZoneInfomationForm,$tmpLabel , array('class'=>'wd-input-1'));
												break;
											}
											
												
											
										}
									
									}
									
									
								}else{
									
									echo $formModelZoneInfomationForm->hiddenField($modelZoneInfomationForm,$tmpLabel , array('class'=>'wd-input-1'));
									
								}
								
								
							break;
							case "select":
								$selectedId = array_search($modelZoneInfomationForm->$tmpLabel,$value->options);
								echo $formModelZoneInfomationForm->dropDownListRow($modelZoneInfomationForm,$tmpLabel, $value->options, array('class'=>'wd-input-1','prompt'=>'---',
									'options' => array($selectedId=>array('selected'=>true))
								));
				?>
								<script>
									optionsGender = <?php echo @CJSON::encode($value->options);?>
								</script>
				<?php
								
							break;
						}
						
						echo '</div>';
						
					}
					
				
				?>
				
				
				<input type="hidden" name="token" value="<?php echo $token;?>" class="token">
				<div class="wd-submit">
					<input type="submit" value="Save" class="wd-form-bt-1 wd-save-button wd-close-edit mz-submit">
					<input type="reset"  style="display:none">
					<input type="button" onclick="cancel('lives');" value="Cancel" class="wd-form-bt-1 cancel wd-cancel-button wd-close-edit">
				</div>
			</fieldset>
			<?php
			$this->endWidget();
			endif;
			?>
		</div>
		
		<?php
		
		
		
			if(!empty($page)):
				echo CHtml::link('<span class="wd-icon-16 wd-icon-update-info"></span><span class="wd-text">Update infomation</span>','javascript:void(0)',array(
					'class'=>'wd-edit-button wd-update-infor-link',
					'id'=>'framelives2',
				));
			else:
				echo '<span class="wd-edit-button wd-icon-edit-28" id="framelives2"></span>';
			endif;
			
		endif;
		?>
		<div class="" id="framelives1">
			<h2 class="wd_tt_2">Information</h2>
			<ul class="wd-information-list">
			<?php
			$this->renderPartial('application.modules.users.views.profile._infomation',array(
				'propertiesInfomation'=>$propertiesInfomation
			));
			?>
		
		
			</ul>
		</div>
	</div>
</div>
<?php
if(file_exists(Yii::getPathOfAlias('rules')."/{$className}.php")){
	@unlink(Yii::getPathOfAlias('rules')."/{$className}.php");
}
?>