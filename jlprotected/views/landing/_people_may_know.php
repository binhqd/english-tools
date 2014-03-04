<?php if (count($peopleMayKnow)) : ?>
<div class="wd-section-landing-page wd-list-thumb">
	<h2 class="wd-title-landing-page">
		People you might know
	</h2>
	<ul class="rtlt-block">
		<?php foreach ($peopleMayKnow as $index => $people) : ?>
		<?php $avatar = $people['userInfo']->avatar;  ?>
		<li <?php if ($index % 4 == 3) echo 'class="no-padding-right"'; ?>>
			<a class="wd-thumb snapshot" snapshot='{"userid":"<?php echo $people['userInfo']->hexID; ?>", "position": "center-left", "type":"user"}' href="<?php echo JLRouter::createUrl('/dashboard?u='.$people['userInfo']->hexID); ?>"><img src="<?php echo $avatar['isExist'] ? JLRouter::createUrl("/upload/user-photos/".$people['userInfo']->hexID."/fill/72-72/{$avatar['filename']}") : JLRouter::createUrl("/upload/user-photos/{$avatar['filename']}");?>" alt="Thumbnail"></a>
			<?php
				if (!$people['friend_status']['isFriend']) {
					if (!$people['friend_status']['isPending'])
						if (!$people['friend_status']['isPendingMe'])
							echo '<a title="Add as a friend" href="'.JLRouter::createUrl('/dashboard/friends/sendRequest', array('strUserID'=>$people['userInfo']->hexID)).'" class="wd-add-thumb wd-request-friend jlbd-tiptip-top"></a>';
						else
							echo '<a title="Accept as a friend" href="'.JLRouter::createUrl('/dashboard/friends/sendRequest', array('strUserID'=>$people['userInfo']->hexID)).'" class="wd-add-thumb wd-request-friend wd-accept-friend jlbd-tiptip-top"></a>';
					else
						echo '<a title="Friend request pending" href="#" class="wd-add-thumb wd-pending-friend jlbd-tiptip-top"></a>';
				}
			?>
		</li>
		<?php endforeach; ?>
	</ul>
	<p class="wd-link-view-all"><a href="<?php echo JLRouter::createUrl('/dashboard/friends/find'); ?>">Find friends</a></p>
</div>
<?php endif; ?>