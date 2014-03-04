<?php 
$mainAvatar = array_shift($avatars);
?>

<div class="wd-person-img">
	<a
		href="<?php echo ZoneRouter::createUrl("/photos/viewPhoto?photo_id=".$mainAvatar['photo']['id']."&album_id={$this->strUserID}&type=user")?>"
		class="wd-main-image lnkViewPhotoDetail" type='user'
		photo_id='<?php echo $mainAvatar['photo']['id'];?>'
		album_id='<?php echo $this->strUserID;?>'
		filename='<?php echo $mainAvatar['photo']['image'];?>'> 
		<img src="<?php echo ZoneRouter::createUrl("/upload/user-photos/{$this->strUserID}/fill/193-193/{$mainAvatar['photo']['image']}?album_id={$this->strUserID}")?>" alt="<?php echo $this->strUsername?>">
	</a>
	
	<ul class="wd-gallery-1">
		<?php 
		$cnt = 0;
		foreach($avatars as $avatar):
		$cnt++;
		?>
		<li class="wd-mlb-img <?php echo $cnt == 1 ? 'wd-first-elm' : ''?>">
			<a
				href="<?php echo ZoneRouter::createUrl("/photos/viewPhoto?photo_id=".$avatar['photo']['id']."&album_id={$this->strUserID}&type=user")?>"
				class="wd-thumb-img lnkViewPhotoDetail" type='user'
				photo_id='<?php echo $avatar['photo']['id'];?>'
				album_id='<?php echo $this->strUserID;?>'
				filename='<?php echo $avatar['photo']['image'];?>'> 
				<img src="<?php echo ZoneRouter::createUrl("/upload/user-photos/{$this->strUserID}/fill/125-125/{$avatar['photo']['image']}?album_id={$this->strUserID}")?>" alt="<?php echo $this->strUsername?>">
			</a>
		</li>
		<?php endforeach;?>
	</ul>
</div>