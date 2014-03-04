<?php
if(!empty($data)):
	// dump($this->acceptEdit);
?>
<li class="li-item-<?php echo $token;?>">
	<div class="wd-edit-block">
		
		<div class="wd-popup-edit-lc wd-experience-edit-content">
			<span class="wd-icon-edit-2"></span>
		</div>
		
		<div class="pull-item-node-prop">
			<div style="display:none" class="pullData">
				<?php echo @CJSON::encode($arrDataSingle);?>
			</div>
			<?php if( !empty($acceptEdit) && $acceptEdit ) : ?>
			<span class="wd-icon-edit-28 edit-user-properties icon-edit-prop" nameType="<?php echo $nameType;?>"  token="<?php echo $token;?>"></span>
			<?php endif;?>
			<?php
			
			if(!empty($data['title'])){
				foreach($data['title'] as $key=>$value){
					
						if($key==0){
							echo '<h3 class="wd_tts_1">';
								echo CHtml::link($value['name'],ZoneRouter::createUrl('/zone/pages/detail',array('id'=>$value['zone_id'])));
							echo '</h3>';
						}else{
							echo CHtml::link($value['name'],ZoneRouter::createUrl('/zone/pages/detail',array('id'=>$value['zone_id'])));
						}
					
				}
				
			}
			if(!empty($data['other'])){
				foreach($data['other'] as $key=>$value){
					switch($key){
						case "/type/datetime":
							list($start, $end) = $value;
							
							
							echo '<p class="wd-gray-cl">';
							
							if($this->checkDate($start) && $this->checkDate($end)){
								// dump($start,false);
								// dump($end,false);
								$this->widget('ext.timestring.TimeString', array(
									'startDate'=>$start, // assuming $data->start_date is "2012-12-25"
									'endDate'=>$end,     // assuming $data->end_date is "2012-12-31"
									'duration'=>false,
								));
							}else{
								$this->renderFailDate($start,$end);
								
							}
							echo '</p>';
						break;
						default:
							echo "<p>{$value}</p>";
						break;
					}
				}
			}
			?>
			
			
			
		</div>
	</div>
</li>
<?php
endif;
?>