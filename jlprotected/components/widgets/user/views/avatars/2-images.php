<?php 
$mainAvatar = array_shift($avatars);
$avatar = array_shift($avatars);
?>
<style>
ul.user-avatars-2-items {list-style: none;padding-left:0px;}
ul.user-avatars-2-items li {
	float: left;
}
ul.user-avatars-2-items li.first {
	margin-right: 10px;
}
ul.user-avatars-2-items li img {width: 193px; height:193px;}
</style>
<div class="wd-person-img">
	<ul class="user-avatars-2-items">
		<li class="wd-mlb-img first">
			<a
				href="<?php echo ZoneRouter::createUrl("/photos/viewPhoto?photo_id=".$mainAvatar['photo']['id']."&album_id={$this->strUserID}&type=user")?>"
				class="wd-thumb-img lnkViewPhotoDetail" type='user'
				photo_id='<?php echo $mainAvatar['photo']['id'];?>'
				album_id='<?php echo $this->strUserID;?>'
				filename='<?php echo $mainAvatar['photo']['image'];?>'> 
				<img src="<?php echo ZoneRouter::createUrl("/upload/user-photos/{$this->strUserID}/fill/193-193/{$mainAvatar['photo']['image']}?album_id={$this->strUserID}")?>" alt="<?php echo $this->strUsername?>">
			</a>
		</li>
		<li class="wd-mlb-img">
			<a
				href="<?php echo ZoneRouter::createUrl("/photos/viewPhoto?photo_id=".$avatar['photo']['id']."&album_id={$this->strUserID}&type=user")?>"
				class="wd-thumb-img lnkViewPhotoDetail" type='user'
				photo_id='<?php echo $avatar['photo']['id'];?>'
				album_id='<?php echo $this->strUserID;?>'
				filename='<?php echo $avatar['photo']['image'];?>'> 
				<img src="<?php echo ZoneRouter::createUrl("/upload/user-photos/{$this->strUserID}/fill/193-193/{$avatar['photo']['image']}?album_id={$this->strUserID}")?>" alt="<?php echo $this->strUsername?>">
			</a>
		</li>
	</ul>
</div>
