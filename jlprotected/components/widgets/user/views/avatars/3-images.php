<?php 
$mainAvatar = array_shift($avatars);
?>
<style>
ul.user-avatars-3-items {list-style: none;padding-left:0px;}
ul.user-avatars-3-items li {
	float: left;
	margin-left: 9px;
}
ul.user-avatars-3-items li.first {
	margin-left: 0px !important;
}
ul.user-avatars-3-items li img {width: 125px; height:125px;}
</style>
<div class="wd-person-img">
	<ul class="user-avatars-3-items">
		<li class="wd-mlb-img first">
			<a
				href="<?php echo ZoneRouter::createUrl("/photos/viewPhoto?photo_id=".$mainAvatar['photo']['id']."&album_id={$this->strUserID}&type=user")?>"
				class="wd-thumb-img lnkViewPhotoDetail" type='user'
				photo_id='<?php echo $mainAvatar['photo']['id'];?>'
				album_id='<?php echo $this->strUserID;?>'
				filename='<?php echo $mainAvatar['photo']['image'];?>'> 
				<img src="<?php echo ZoneRouter::createUrl("/upload/user-photos/{$this->strUserID}/fill/125-125/{$mainAvatar['photo']['image']}?album_id={$this->strUserID}")?>" alt="<?php echo $this->strUsername?>">
			</a>
		</li>
		<?php foreach($avatars as $avatar):?>
		<li class="wd-mlb-img">
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
