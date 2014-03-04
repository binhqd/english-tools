<?php $mainAvatar = array_shift($avatars);?>
<div class="wd-person-img">
	<a
		href="<?php echo ZoneRouter::createUrl("/photos/viewPhoto?photo_id=".$mainAvatar['photo']['id']."&album_id={$this->strUserID}&type=user")?>"
		class="wd-thumb-img lnkViewPhotoDetail" type='user'
		photo_id='<?php echo $mainAvatar['photo']['id'];?>'
		album_id='<?php echo $this->strUserID;?>'
		filename='<?php echo $mainAvatar['photo']['image'];?>'> 
		<img src="<?php echo ZoneRouter::createUrl("/upload/user-photos/{$this->strUserID}/fill/398-210/{$mainAvatar['photo']['image']}?album_id={$this->strUserID}")?>" alt="<?php echo $this->strUsername?>">
	</a>
</div>
