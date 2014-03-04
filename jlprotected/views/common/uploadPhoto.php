<div style="display:none;">
	<div id="wd-upload-photo" class='upload_photo_form jlbd-popup claim-biz-popup'>
		<div class="wd-popup-content non-border">
			<h4 class="wd-title-addphoto">Upload photos for <?php echo $arrBusiness['name']?></h4>
			<div id="bandwidth" class="usage">
				<p id="bandwidth-left">
				Click on the "Add files" button to select photos from your computer. Then click the "Start upload" button to begin uploading photos.
				</p>
				<p class='note'><b>Note</b>: File types allowed: *.jpg, *.png, *.gif</p>
			</div>
			
			<div class="wd-biz-register-form" id="add_photo" style="margin-top:10px; border-bottom:none">
			<?php
			$max = 10;
			
			$arrParamsUrl = array(
				'uuid'=>$arrBusiness['uuid'],
				'type'=>'member'
			);
			if(!empty($_GET['new'])){
				$arrParamsUrl = array(
					'uuid'=>$arrBusiness['uuid'],
					'type'=>'member',
					'awaiting'=>1
				);
			}
			$arrParamsUrl['size'] = '85-85';
			
			$urlUpload =JLRouter::createAbsoluteUrl('photoBusiness/uploadPhoto',$arrParamsUrl);
			
			if(strtolower(str_replace("-","",IDHelper::uuidFromBinary(currentUser()->id)))==strtolower(str_replace("-","",$arrBusiness['owner_id']))){
				//$max = $max-count($photoOwn);
				$arrParamsUrl = array(
					'uuid'=>$arrBusiness['uuid']
				);
				if(!empty($_GET['new'])){
					$arrParamsUrl = array(
						'uuid'=>$arrBusiness['uuid'],
						'awaiting'=>1
					);
				}
				$urlUpload = JLRouter::createAbsoluteUrl('photoBusiness/uploadPhoto',$arrParamsUrl);
			}
			$this->widget('ext.jqueryupload.JQueryUploadWidget', array(
				'id'	=> 'bizPhoto',
				'url' 	=> JLRouter::createAbsoluteUrl("/photoBusiness/uploadPhoto") . "?uid={$arrBusiness['uuid']}&type=member&size=85-85",
				'name' => 'ContributePhoto',
				'attribute' => 'filename',
				'multiple' => true,
				'options' => array(
					'maxNumberOfFiles' => $max,
					'acceptFileTypes' => 'js:/(\.|\/)(gif|jpe?g|png)$/i',
					'maxFileSize'=>10485760,
				),
				'htmlOptions' => array(
					'class' => 'jlb_row jform',
					'id'	=> 'photoUploader-contribute',
				),
				'htmlUIOptions' => array(
					//'htmlHeader' => '<input type="hidden" name="'.get_class($modelPhoto).'[id]" id="'.get_class($modelPhoto).'" value="1">'
				),
				//'cssFile'=>Yii::app()->baseUrl."../../../../../justlook/img/flick/jquery-ui-1.8.18.custom.css"
			));					
			?>
			</div>
		</div>
	</div>
</div>