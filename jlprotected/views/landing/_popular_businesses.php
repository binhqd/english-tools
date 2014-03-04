<?php if (count($popularBusinesses)) : ?>
<div class="wd-section-landing-page">
	<h2 class="wd-title-landing-page">
		Popular <?php echo $category; ?> in <?php echo $location; ?> 
	</h2>
	<?php $index = 0; foreach ($popularBusinesses as $business) : $index++; ?>
	<?php
		unset($business['attrs']['id']);
		$address = $business['attrs']['address'];
		$location	=	$business['attrs']['location'];
		$lnkalias = JLBusinessHelper::createLinkAlias($business['attrs']);
		$addedFavourite = $business['attrs']['addedFavourite'];
	?>
	<div class="biz-item wd-comment-box-547" id='search-<?php echo $business['attrs']['uuid'];?>' ref='<?php echo $business['attrs']['uuid'];?>'>
		<span style='display:none' class='biz-attributes'><?php echo @CJSON::encode($business['attrs'])?></span>
		<div class="wd-above-list <?php if ($index==count($popularBusinesses)) echo 'wd-above-list-no-border'; ?>">
			<div class="wd-above-infor">
				<div class="wd-thumbnail-user">
					<a href="<?php echo $lnkalias;?>" class="wd-avatar"><img src="<?php echo JLBusinessHelper::renderImgBiz(array('uuid' => $business['attrs']['uuid'],'name'=>$business['attrs']['avatar'],'width' => 100,'height' => 100), 'business', true); ?>" alt="Thumbnail"></a>
				</div>
				<div class="wd-above-infor-content">
					<div class="wd-rating-review wd-rating-average biz-rating-placholder"></div>
					<div class="wd-list-header">
						<h3 class="wd-title">
							<a href="<?php echo $lnkalias;?>" class="wd-biz-name"><?php echo CHtml::encode($business['attrs']['name']); ?></a> 
						</h3>
					</div>
					<p class="jlbd-count-reviews"><a href="<?php echo $lnkalias;?>"><?php echo $business['attrs']['reviews']; ?>&nbsp;<?php echo Yii::t('app', 'review|reviews', $business['attrs']['reviews']); ?></a></p>
					<div class="jlbd-above-info-lc">
						<p class="wd-buz-address"><span class="wd-address"><?php echo $address . ($address?', ':''); ?></span></p>
						<p><span class="wd-location"><?php echo $location; ?></span></p>
						<?php if ($business['attrs']['landline']): ?><p class="wd-buz-address"><label>Phone:</label> <?php echo $business['attrs']['landline']; ?></p><?php endif; ?>
					</div>
				</div>
				<div class="wd-container-link">
					<p class="wd-link-action">
						<a title="<?php echo $addedFavourite?'Remove from Favourite':'Add to Favourite'; ?>" href="<?php echo JLRouter::createUrl('/dashboard/favourites/remove', array('business_id' => $business['attrs']['uuid'])); ?>" ref="<?php echo $business['attrs']['uuid']; ?>" class="wd-favourite jlbd-tiptip-top <?php  echo $addedFavourite?"wd-favourite-remove":"wd-favourite-add" ?>" bt-xtitle="<?php echo $addedFavourite?'Remove from Favourite':'Add to Favourite'; ?>" onclick="return false;">Favourite</a>
						<a title="Add to List" href="#" class="wd-add-list jlbd-tiptip-top jl_add_to_list" bt-xtitle="Add to List" ref="<?php echo $business['attrs']['uuid']; ?>">Add to List</a>
						<a class="wd-send-mail jlbd-tiptip-top" href="<?php echo JLRouter::createUrl('messages');?>?prt=node#w/0/0/<?php echo $business['attrs']['uuid'];?>/B" title="Send a message">Send mail</a>
						<a title="Share friend" href="<?php echo JLRouter::createUrl('/share/business', array('uuid' => $business['attrs']['uuid'])); ?>" class="wd-share-friend jlbd-tiptip-top" bt-xtitle="Share friend" onclick="return false;">Share friend</a>
					</p>
					<p class="wd-link-extra">
						<?php
						if(!currentUser()->isGuest && strtolower(str_replace("-","",$business['attrs']['owner_id'])) == strtolower(str_replace("-","",IDHelper::uuidFromBinary(currentUser()->id))) ){
						?>
							<a class="wd-link-text wd-edit-modify no-margin-left" href="<?php echo Yii::app()->createUrl("business/edit/uuid/{$business['attrs']['uuid']}") ?>">Click here to edit business</a>
						<?php	
						}else if(str_replace("-","",$business['attrs']['owner_id'])==""){
						?>
							<a class="wd-link-text wd-write-review" ref="<?php echo $business['attrs']['uuid']; ?>" href="#">Write a new review</a>
							<a class="wd-link-text wd-claim-buz jl_lnk_claim_business" id="claim-<?php echo $business['attrs']['uuid'];?>" href="#wd-popup-claim-business" ref="<?php echo $business['attrs']['uuid'];?>" link-alias="<?php echo $lnkalias;?>" text-review="<?php echo $business['attrs']['reviews']; ?>&nbsp;<?php echo Yii::t('app', 'review|reviews', $business['attrs']['reviews']); ?>">Claim this business</a>
							<label style="display:none;" id="dataRow"><?php echo @CJSON::encode($business);?></label>
						<?php						
						}else{
						?>
							<a class="wd-link-text wd-write-review" ref="<?php echo $business['attrs']['uuid']; ?>" href="#">Write a new review</a>
							<a class="wd-link-text wd-send-mail-buz" href="<?php echo JLRouter::createUrl("/messages?prt=node#w/0/0/{$business['attrs']['uuid']}/B")?>">Send to owner business</a>
						<?php
						}
						?>
					</p>
				</div>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
</div>
<?php endif; ?>