<?php $this->beginWidget('widgets.JLScriptPacker', array(
	'id'		=> 'notificationData',
	'type'		=> 'js',
	'position'	=> CClientScript::POS_HEAD
))?>
var notifications = <?php echo CJSON::encode($out)?>;
<?php $this->endWidget();?>

<div class="wd-dashboard-full">
	<?php
	GNAssetHelper::init(array(
		'image'		=> 'img',
		'css'		=> 'css',
		'script'	=> 'js'
	));
// 	GNAssetHelper::setBase('application.modules.dashboard.assets');
// 	GNAssetHelper::scriptFile('jlbd.dashboard.review');
	?>
	<div class="wd-left-content">
		<?php $this->widget('widgets.LeftSidebar')?>
	</div>

	<div class="wd-right-content">
		<?php $this->widget('widgets.list-thumbnail.JLBDFriendsThumbnail',array(
			'user' => $currentUser,
		));
		?>
		<?php $this->widget('widgets.friends.JLBDPeopleYouMayKnow',array(
			'user' => $currentUser,
		));
		?>
		<?php
			$this->widget('widgets.compliment.JLBDComplimentRight', array(
				'user' => $currentUser
			));
			if (!currentUser()->isGuest && $currentUser->isCurrent) $this->widget('widgets.friends.JLBDFriendsRecommendations');
		?>
	</div>
	
	<div class="wd-main-content">
		<div class="wd-section" id='your-notifications'>
			<h2 class='wd-title'>
				<span>Your Notifications</span>
			</h2>
			<div id='ctnAllNotifications'></div>
			<script id="tplNotiByDate" type="text/x-jquery-tmpl">
			{{each(_date, group) notifications}}
			<h3 class='heading-date'>Sent ${_date}</h3>
			<ul class="jl-notification-list wd-font-11" id='notification-page'>
				{{each(i, item) group}}
				<li class="noti-item{{if item.is_clicked == 0}} unread{{/if}}" defaultLink="${item.defaultLink}" ref="${item.id}">
					<!-- {{if (item.notifier.type == "bm")}}
					<a class="noti-thumb-avatar" href="${homeURL}/business/details?uid=${item.notifier.id}">
						<img src="${item.filepath}" alt="${item.notifier.bizname}" title="${item.notifier.bizname}">
					</a>
					{{else}}
					<a class="noti-thumb-avatar" href="/profile/?u=${item.notifier.id}">
						<img src="/upload/user-photos/${item.notifier.id}/fill/40-40/${item.avatar.filename}" alt="${item.notifier.displayname}" title="${item.notifier.displayname}">
					</a>
					{{/if}}
					-->
					<div class="jl-notification-content">
						<a class="wd-remove" title="Remove" href="#" ref="${item.id}">Remove</a>
						<h4 class='{{if item.read == 1}}read{{/if}}'>{{html item.message}}</h4>
						
					</div>
				</li>
				{{/each}}
			</ul>
			{{/each}}
			</script>
		</div>	
	</div>
</div>
<script language='javascript'>
$.tmpl($("#tplNotiByDate"), notifications).appendTo("#ctnAllNotifications");
</script>