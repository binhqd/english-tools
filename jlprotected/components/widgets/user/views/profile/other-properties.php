<?php
$arrClassModel = array();
if(!empty($constructsOther)):
	foreach($constructsOther as $key=>$value):
		
		$valueConstruct = $value;
		
		$name = "";
		$tmpNameType = "tmp";
		if(!empty($value[0]['name']))  $tmpNameType = $value[0]['name'];
		$tmpNameType = str_replace("/","",$tmpNameType);
		
		$className = "ZonePropertiesForm".$tmpNameType."".currentUser()->hexID;
		$arrClassModel[] = $className;
		$model = new $className;
		
		// save tmp constructs other
		$tmpConstructs = @CJSON::encode($value);

		ZoneInstanceManager::removeValue($token,$value[0]['name'] );
?>
	<style>
	form#frmZoneOtherForm<?php echo $className;?> .wd-input label{display:block}
	form#frmZoneOtherForm<?php echo $className;?> .wd-input span.required{float:none; width:auto; color:red;}
	form#frmZoneOtherForm<?php echo $className;?> .wd-input span.error{font-weight:normal; color:red;}
	form#frmZoneOtherForm<?php echo $className;?> .special input.wd-input-1,{display:none}
	form#frmZoneOtherForm<?php echo $className;?> .wd-textarea span.error{margin-top:20px; margin-left:-10px}
	</style>
	<div class="wd-left-block" attr="<?php echo @CJSON::encode($value);?>">
		<h2 class="wd_tt_2"><?php echo (!empty($value[0]['label'])) ? $value[0]['label'] : "";?></h2>
		<ul class="wd-list-2">
			<?php if( !empty($acceptEdit) && $acceptEdit ) : ?>
			<li class="wd-add-new-item wd-edit-block">
				<a class="wd-show-entire-section" href="javascript:void(0)" onclick="showForm('<?php echo $tmpNameType;?>');"  id="frame<?php echo $tmpNameType;?>1"><span class="wd-edit-add">Add <?php echo (!empty($value[0]['label'])) ? $value[0]['label'] : "";?></span></a>
					<div class="wd-popup-add-newItem-lc wd-experience-addnew" id="frame<?php echo $tmpNameType;?>3">
					
					<?php /** @var BootActiveForm $form */
					$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
						'id'=>'frmZoneOtherForm'.$className,
						'action'=>GNRouter::createUrl('/users/edit/prop'),
						'enableClientValidation' => true,
						'enableAjaxValidation' => true,
						'clientOptions'=> array(
							'validateOnSubmit'=>true,
							'validateOnChange'=>false,
							// 'beforeValidate'=>'js:beforefpw',
							'afterValidate'=>'js:submitPropOther'
						),
						'htmlOptions'=>array('class'=>'well', 'enctype' => 'multipart/form-data','str_id'=>"pushProp".$tmpNameType,'nameType'=>$tmpNameType),
					)); ?>
					
					<fieldset class="wd-edit-form-lc">
						<?php
						if(!empty($value[2])){
						?>
						<textarea name="constructs" style="display:none"><?php echo $tmpConstructs;?></textarea>
						<?php
							foreach($value[2] as $key=>$prop){
								
								$value = (object) $prop;
								$tmpLabel = strtolower($value->label);
								$tmpLabel = str_replace(" ","",$tmpLabel);
								$tmpLabel = str_replace(",","",$tmpLabel);
								$tmpLabel = str_replace("-","",$tmpLabel);
								echo '<div class="wd-input">';
								
								// Create ID HTML string for form.
								$strIdInputForm = strtolower($value->label);
								$strIdInputFormFirst = str_replace(" ","",$strIdInputForm);
								$strIdInputForm = "#{$className}_".$strIdInputFormFirst;
								$strIdInputFormTmp = "{$className}_".$strIdInputFormFirst."_tmp_";
								
								switch($value->type){
									case "text":
										if($value->suggest){
											$pos = strpos($value->expected, 'location');
											if ($pos === false) {
												// Input suggest values.
												echo "<label>{$value->label}</label>";
												echo "<input type='text' class='wd-input-1' id='{$strIdInputFormTmp}'>";
												// echo $formModelZoneInfomationForm->textFieldRow($modelZoneInfomationForm,$tmpLabel , array('class'=>'wd-input-1'));
												echo $form->hiddenField($model,$tmpLabel , array('class'=>'wd-input-1'));
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
											}else{
												echo $form->hiddenField($model,$tmpLabel , array('class'=>'wd-input-1'));
												echo $form->labelEx($model,$tmpLabel);
												echo CHtml::dropDownList('location', $tmpLabel, $locations,array(
													'empty' => array('Select a location'),
													'class'=>'wd-input-1'
												));
												echo $form->error($model,$tmpLabel);
											}
										}else{
											if(!empty($value->expected) && $value->expected == "/type/datetime") {
												$first = false;
												switch($tmpLabel){
													case "from":
														$tmpLabel = "to";
														$first = false;
													break;
													case "to":
														$tmpLabel = "from";
														$first = true;
													break;
													case "enddate":
														$tmpLabel = "startdate";
														$first = true;
													break;
													case "startdate":
														$tmpLabel = "enddate";
														$first = false;
													break;
												}
												echo $form->labelEx($model,$tmpLabel);
												
												echo $form->hiddenField($model,$tmpLabel , array('class'=>'wd-input-1'));
												
												$pos = strpos($key, 'employment');
												if ($pos === false) {
													$pos = strpos($key, 'education');
													if ($pos === false) {
														$pos = strpos($key, 'live');
														if ($pos === false) {
															echo CHtml::dropDownList('month', $tmpLabel, $months,array(
																'style'=>'width:31%;margin-right:10px;',
																'class'=>'month'
															));
															echo CHtml::dropDownList('day', $tmpLabel, $days,array(
																'style'=>'width:30%; margin-right:10px;',
																'class'=>'day'
															));
															echo CHtml::dropDownList('year', $tmpLabel, $years,array(
																'style'=>'width:30%; margin-right:10px;',
																'class'=>'year'
															));
														}else{
															// PLACES LIVES
															echo CHtml::dropDownList('month_live', $tmpLabel, $months,array(
																'style'=>'width:24%;margin-right:10px;',
																'class'=>'month'
															));
															echo CHtml::dropDownList('year_live', $tmpLabel, $years,array(
																'style'=>'width:22%; margin-right:10px;',
																'class'=>'year'
															));
															if($first){
																
															}else{
																echo '<div class="wd-timeperiod-enddate  custom-check-box-edit" >';
																	echo '<div class="wd-current-position" >Present</div>';
																	echo '<label class="still-here" >';
																		echo '<input type="checkbox" class="wd-still-here-checkbox current-enddate"  value="current-enddate" name="current-enddate">';
																		echo 'I currently live here';
																	echo '</label>';
																echo '</div>';
															}
														}
														
													}else{
														// EDUCATIONS
														echo CHtml::dropDownList('year_education', $tmpLabel, $years,array(
															'style'=>'width:22%; margin-right:10px;',
															'class'=>'year'
														));
													}
													
												}else{
													// EMPLOYMENT
													echo CHtml::dropDownList('month_employment', $tmpLabel, $months,array(
														'style'=>'width:24%;margin-right:10px;',
														'class'=>'month'
													));
													echo CHtml::dropDownList('year_employment', $tmpLabel, $years,array(
														'style'=>'width:22%; margin-right:10px;',
														'class'=>'year'
													));
													if($first){
														
													}else{
														echo '<div class="wd-timeperiod-enddate custom-check-box-edit" >';
															echo '<div class="wd-current-position" >Present</div>';
															echo '<label class="still-here" >';
																echo '<input type="checkbox" class="wd-still-here-checkbox current-enddate"  value="current-enddate" name="current-enddate">';
																echo 'I currently work here';
															echo '</label>';
														echo '</div>';
													}
													
												}
												
												
												
												echo $form->error($model,$tmpLabel);
											}else{
												echo $form->textFieldRow($model,$tmpLabel , array('class'=>'wd-input-1'));
												
												
											}
											
											
										}
										
									break;
									case "select":
										echo $form->dropDownListRow($model,$tmpLabel, $value->options, array('class'=>'wd-input-1','prompt'=>'---'));
									break;
								}
								echo '</div>';
								
							}
						}
						?>
						<input type="hidden" name="token" value="" class="token<?php echo $tmpNameType;?>">
						<div class="wd-submit">
							<input type="submit" id="sbmFormExper" value="Save" class="wd-form-bt-1 wd-save-button wd-close-edit mz-submit">
							<input type="reset"  style="display:none">
							<input type="button" onclick="cancel('<?php echo $tmpNameType;?>',0);" value="Cancel" class="wd-form-bt-1 cancel wd-cancel-button wd-close-edit">
						</div>
					</fieldset>
					<?php $this->endWidget(); ?>
					</div>
			</li>
			<?php endif;?>
			
			
			
			<?php
			/**
			 * load data 
			 **/
			
			if(!empty( $results['value'][$valueConstruct[0]['name']] )){
				$nodeProp = $results['value'][$valueConstruct[0]['name']];
				foreach($nodeProp as $keyNodeProp=>$valueNodeProp){
					$this->widget('widgets.user.EditProfileNodeProperties',array(
						'nodes'=>$valueNodeProp,
						'acceptEdit'=>( !empty($acceptEdit) && $acceptEdit ) ? true : false,
						'nameType'=>$tmpNameType
					));
				}
				
				
			}
			
			?>
			<div class="pushProp<?php echo $tmpNameType;?>"></div>
		</ul>
	</div>
<?php
	endforeach;
endif;

if(!empty($arrClassModel)){
	foreach($arrClassModel as $key=>$keyFile){
		if(file_exists(Yii::getPathOfAlias('rules')."/{$keyFile}.php")){
			// @unlink(Yii::getPathOfAlias('rules')."/{$keyFile}.php");
		}
	}
}
?>