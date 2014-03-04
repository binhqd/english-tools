<p class="wd-stt">Your interested</p>
<ul class="wd-nav">
<?php
$arrCat = array();

if(!empty($menu)){
	foreach($menu as $key=>$value){
		
		$classActive = "";
		if(currentUser()->isGuest){
			if(empty($_GET['interest']) && $key == 0){
				$classActive = "wd-active";
			}else{
				if(!empty($_GET['interest']) && $_GET['interest'] == $value->key_search){
					$classActive = "wd-active";
				}
			}
		}else{
			if(!$checkInMenu && $key==0){
				$classActive = "wd-active";
			}else{
				if(!empty($isInterests) && $isInterests->type_id == $value->id) $classActive = "wd-active";
			}
		}
		
		
			
		
		$arrCat[] = $value->title;
?>

<li class="<?php echo (!empty($page) && $page =="homepage") ? "" : $classActive;?>">
	<a href="javascript:void(0)" id="saveCategoryNav" typeId="<?php echo IDHelper::uuidFromBinary($value->id,true);?>" key_search="<?php echo $value->key_search;?>">
		<?php echo $value->title;?>
	</a>
</li>
<?php
	}
}
?>

	<li class="wd-addmore wd-loop">
		<?php if(currentUser()->isGuest): ?>
			
		<?php else: ?>
			<a href="<?php echo ZoneRouter::createUrl('/interest');?>" class="wd-more-interest-link">
				<span class="wd-icon"></span>
				<span class="wd-text">more interest...</span>
			</a>
		<?php endif;?>
	</li>

</ul>
