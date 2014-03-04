<a href="#wd-add-interest-popup" class="wd-call-pp-load-page" ></a>
<!--- add your interests --->
<div class="wd-st-pp">
	<div id="wd-add-interest-popup" class="wd-container-popup wd-add-interest-container-popup">
		<div class="wd-popup-content">
			<h2 class="wd-tt-pp-3">Add your interests</h2>
			
			<p class="wd-dis">Get your prominence scores and let people see what you’re interested in! </p>
			<div class="wd-form-content">
				<form method="post" action="<?php echo ZoneRouter::createUrl('search?keyword=');?>" id="userLoginForm" class="well form-vertical">
					<fieldset class="wd-main-form wd-add-interest">
						<div class="wd-input-search">
							<input type="text" class="wd-text-search" placeholder="Find & Add your interests">
							<input type="submit" class="wd-submit" value="">
						</div>
						<p class="wd-dis" style="margin:0px; color:red" id="msg"> </p>
						<div class="wd-interest-search-result">
							<?php
							if(!empty($model)){
								
								foreach($model as $key=>$category){
									$isInterested = $category->isInterested();
									$peopleInterested = ZoneInterestsCategories::model()->peopleInterested($category->id);
									
							?>
								<div class="wd-interest-item">
									<div class="wd-interest-image">
										<img src="<?php echo ZoneRouter::CDNUrl('/upload/categories/fill/145-145/');?>/<?php echo $category->image;?>" alt="<?php echo $category->title;?>" height="145" width="145"/>
										<?php
										if($isInterested){
										?>
											<a href="javascript:void(0)" style="display:none" class="wd-add-interest-bt" id="add-interests" tid="<?php echo IDHelper::uuidFromBinary($category->id,true);?>"><span class="wd-icon"></span><span class="wd-text">Add Interest</span></a>
											<a href="javascript:void(0)"  class="wd-add-interest-bt wd-add-interested-bt" tid="<?php echo IDHelper::uuidFromBinary($category->id,true);?>" id="remove-interests"><span class="wd-icon"></span><span class="wd-text">Remove</span></a>
										<?php
										}else{
										?>
											<a href="javascript:void(0)" class="wd-add-interest-bt" id="add-interests" tid="<?php echo IDHelper::uuidFromBinary($category->id,true);?>"><span class="wd-icon"></span><span class="wd-text">Add Interest</span></a>
											<a href="javascript:void(0)" style="display:none" class="wd-add-interest-bt wd-add-interested-bt" tid="<?php echo IDHelper::uuidFromBinary($category->id,true);?>" id="remove-interests"><span class="wd-icon"></span><span class="wd-text">Remove</span></a>
										<?php
										}
										?>
										
									</div>
									<h4 class="wd-tt-pp-4"><?php echo $category->title;?></h4>
									<p class="wd-count"><?php echo $peopleInterested;?> <?php echo ($peopleInterested == 1) ? 'Interest' : 'Interests';?> </p>
								</div>
							<?php
								}
							}
							?>
						
							
						</div>
						<div class="wd-submit">
							<button class="btn btn-continue" type="submit" name="yt0">Continue</button>
							<span class="wd-or">Or</span><a href="javascript:void(0)" onclick="$('.mfp-close').trigger('click');" class="wd-cancel">Cancel</a>
						</div>
						
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>
<?php
if(!empty( Yii::app()->session['firtLoginedMyZone'] )  && Yii::app()->session['firtLoginedMyZone'] == true)
{
?>
<script>
$().ready(function(e){
	
	$(".wd-call-pp-load-page").magnificPopup({tClose: "Close (Esc)",closeBtnInside:false}).trigger("click");
});
</script>
<?php
	Yii::app()->session['firtLoginedMyZone'] = null;
}
?>
