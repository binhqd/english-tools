<?php
GNAssetHelper::init(array(
	'image'		=> 'img',
	'css'		=> 'css',
	'script'	=> 'js'
));

GNAssetHelper::setBase('application.modules.friends.assets');
GNAssetHelper::scriptFile('script.friends', CClientScript::POS_BEGIN);
GNAssetHelper::setBase('myzone_v1');
GNAssetHelper::scriptFile('zone.like.notification', CClientScript::POS_END);
?>

<script id="tmpNotiItem" type="text/x-jquery-tmpl">
<li class="wd-jewelItem item-notification bdtno">
	
	<a class="wd-jewelMainLink" href="${defaultLink}">
		<img  alt="${notifier.displayname}" src="${homeURL}/upload/user-photos/${notifier.id}/fill/50-50/${avatar}" class="wd-jl"/>
		<div class="wd-jItermContent">
			{{html message}}
		</div>
	</a>
	
	
		
	<span class="wd-x-act"></span>
</li>
</script>

<script id="tmpNotiItemRequestFriend" type="text/x-jquery-tmpl">
<li class="wd-jewelItem js-friend-request-remove-this" data-user_id="${user_id}">
	<a class="wd-jewelMainLink" href="/profile/${username}">
		<img width="34" height="34" alt="${displayname}" src="/upload/user-photos/${user_id}/fill/171-147/${avatar}" class="wd-jl">
	</a>
	<div class="wd-jItermContent">
		{{if isFriend}}
			<div class="floatR wd-jItermContentButton">
				<a href="javascript:void(0)" class="wd-friend-bt js-friend-request" data-action="unfriend" data-user_id="${user_id}">Friend</a>
			</div>
		{{else}}
			<div class="floatR wd-jItermContentButton">
				<a href="javascript:void(0)" class="wd-form-bt-1 wd-save-button js-friend-request" data-action="accept" data-user_id="${user_id}">Confirm</a>
				<a href="javascript:void(0)" class="wd-form-bt-1 wd-notnow-button js-friend-request" data-action="deny" data-user_id="${user_id}">Not now</a>
			</div>
		{{/if}}
		<div class="of_1 font_11">
			<p class="wd_tt_mn"><span><a href="/profile/${username}">${displayname}</a></span></p>
			{{if countMutualFriends > 0}}
			<p class="wd-posttime"><span>${countMutualFriends} mutual friend{{if countMutualFriends!=1}}s{{/if}}</span></p>
			{{/if}}
		</div>
	</div>
</li>
</script>

<div class="wd-notifiheader wd-notifi-request wd_parenttoggle">
	<span id="jl-notification-number-request-friend" class="wd-notif-new" <?php if ($this->countRequestFriend == 0) echo 'style="display:none"'; ?>><?php echo $this->countRequestFriend; ?></span>
	<a href="javascript:void(0)" class="wd-notif-bt wd-notifrequest-bt js-notifications-request-friend wd_toggle_bt"></a>
	<div class="wd-jewelcontainer-list wd_toggle js-popup-request-friend-notofications">
		<span class="wd-uparrow"></span>
		<div class="wd-jewelcontainer-content">
			<div class="wd-topcontent">
				<h4 class="wd_tt_st_2 floatL">Notifications</h4>
				
			</div>
			<div class="wd-middlecontent notification-friend" style="height:402px;" id="pane-friend">
				<ul class="wd-jewelItemList" id="listRequestFriendNotifications"></ul>
				
			</div>
			<div class="wd-bottomcontent">
				<a class="wd-seemore" href="javascript:void(0)" id="see-all-notifi-friend">
				<img src="<?php echo baseUrl();?>/img/38-1.gif" alt="loading" style="display:none">
				See all</a>
			</div>
		</div>
	</div>
</div>

<div class="wd-notifiheader wd-notif-info wd_parenttoggle">
	<a href="javascript:void(0)"  class="wd-notif-bt wd-notif-info-bt js-notifications wd_toggle_bt"></a>
	<span class="wd-notif-new" id='jl-notification-number' <?php if ($this->count == 0) echo 'style="display:none"'; ?>><?php echo $this->count?></span>
	<div class="wd-jewelcontainer-list wd_toggle" id="notification-content">
		<span class="wd-uparrow"></span>
		<div class="wd-jewelcontainer-content">
			<div class="wd-topcontent">
				<h4 class="wd_tt_st_2 floatL">Notifications</h4>
				
			</div>
			
			<div class="wd-middlecontent notification-other" style="height:402px;" id="pane-other">
				<ul class="wd-jewelItemList not-load" id='listNotifications'></ul>
			</div>
			<div class="wd-bottomcontent">
				<a class="wd-seemore" href="javascript:void(0)" id="see-all-notifi-other">
				<img src="<?php echo baseUrl();?>/img/38-1.gif" alt="loading" style="display:none">
				See all</a>
			</div>
			
			
		</div>
	</div>
</div>