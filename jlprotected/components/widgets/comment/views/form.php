<?php 
if (!isset($token)) $token = $this->strToken;

if(!currentUser()->isGuest):
?>
<span class="wd-arrow-up"></span>
<div class="wd-content-box <?php if(empty($this->listComment)) echo "bdbno";?>" id="box-comment-<?php echo $token;?>">
	<?php
	if(!empty($this->onPopup) && $this->onPopup){
	?>
	<a class="wd-thumb" href="javascript:void(0)" onclick="parent.window.location.href='<?php echo GNRouter::createUrl('/profile');?>'" title="<?php echo (!$this->currentUser->isGuest) ? $this->currentUser->displayname : "";?>">
		<img class="avatar" width="34" height="34" alt="<?php echo (!$this->currentUser->isGuest) ? $this->currentUser->displayname : "";?>" src="<?php echo (!$this->currentUser->isGuest) ? GNRouter::createUrl("/upload/user-photos/".IDHelper::uuidFromBinary($this->currentUser->id, true)."/fill/32-32/" . $this->currentUser->profile->image) : GNRouter::createUrl('/site/placehold',array('t'=>'32x32-282828-969696'));?>">
	</a>
	<?php
	}else{
	?>
	<a class="wd-thumb" href="<?php echo GNRouter::createUrl('/profile');?>" title="<?php echo (!$this->currentUser->isGuest) ? $this->currentUser->displayname : "";?>">
		<img class="avatar" width="34" height="34" alt="<?php echo (!$this->currentUser->isGuest) ? $this->currentUser->displayname : "";?>" src="<?php echo (!$this->currentUser->isGuest) ? GNRouter::createUrl("/upload/user-photos/".IDHelper::uuidFromBinary($this->currentUser->id, true)."/fill/32-32/" . $this->currentUser->profile->image) : GNRouter::createUrl('/site/placehold',array('t'=>'32x32-282828-969696'));?>">
	</a>
	<?php
	}
	?>
	
	<div class="wd-right-box">
		<div class="wd-inputbox">
			<form id="frmAddReview<?php echo $token;?>" method="POST" action="<?php echo GNRouter::createUrl('/comments/comment/addComment')?>">
				<input type="hidden" value="<?php echo $token;?>" name="strTokenComment">
				<input type="hidden" value="<?php echo $this->objectId;?>" name="objectId">
				<input type="hidden" value="<?php echo $this->viewItemPath;?>" name="viewItemPath">
				<textarea name="contentComment" class="wd-font-11" cols="97" rows="2" value="" onkeydown="submitReview('<?php echo $token;?>',event)" id="textareaReview<?php echo $token;?>"></textarea>
			</form>
		</div>
	</div>
</div>
<?php endif;?>