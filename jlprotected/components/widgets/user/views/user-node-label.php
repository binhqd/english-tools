<?php
$selectLabel = !empty($_GET['label']) ? $_GET['label'] : key($labels);
$selected = 'Friend';
$output = "";
foreach ($labels as $key => $val) :
	if ($key == $selectLabel) {
		$selected = $val['name'];
	}
	$hiddenCurrentLabel = "block";
	if(strtolower($selected) == strtolower($val['name'])) $hiddenCurrentLabel = "none";

	$output .= '<li style="display:'.$hiddenCurrentLabel.'"><a params="?id=' . $user->hexID . '&label=' . $key . '&refer=' . @$refer['zone_id'].'" href="' . GNRouter::createUrl("zone/pages/detail?id=" . $user->hexID . '&label=' . $key . '&refer=' . @$refer['zone_id']) . '">'.$val['name'] . '</a></li>';
	
endforeach;
$image = null;
if(!empty($user->profile)) $image = $user->profile->image;
?>
<div class="wd-bottom-header">
	<div class="wd-center">
		<div class="wd-viewed-thumb">
			<a href="<?php echo GNRouter::createUrl("/profile/".$user->username);?>"><img class="me" size="171-147" src="<?php echo ZoneRouter::CDNUrl("/upload/user-photos/".$user->hexID."/fill/171-147/" . $image)?>" alt="<?php echo $user->displayname?>"/> </a>
			<div class="wd-viewed-info">
				<a href="<?php echo GNRouter::createUrl("/profile/".$user->username);?>" class="wd-viewed-name ume"><?php echo $user->displayname?></a>
				<div class="wd-viewed-infolist wd_parenttoggle">
					<a href="javascript:void(0)" class="wd-info-btdd wd_toggle_bt"><?php echo $selected;?>	<span
						class="wd-arrow"></span>
					</a>
					<div class="wd-infolist-toggle <?php ($output == "") ? "" : "wd_toggle";?>">
						<ul>
							<?php
								echo $output;
							?>

						</ul>
					</div>
				</div>
			</div>
		</div>

			<?php
				$user->attachBehavior('UserFriend', 'application.modules.friends.components.behaviors.GNUserFriendBehavior'); // Attach behavior friend for user
				$friends = $user->friends();
				$user->detachBehavior('UserFriend');
				if(!empty($friends)):
			?>
			<div class="wd-connection wd-subject-node-conection responsive">
				<div class="control-div">
					<span id="wd-prev">prev</span> <span id="wd-next">next</span>
				</div>
				<ul class="wd-connec-list">
					<?php foreach ($friends as $friend) : ?>
					<?php $u = ZoneUser::model()->get($friend['user_id']);?>
					<li>
						<a href="<?php echo GNRouter::createUrl('/profile/' . $u['username']); ?>">
							<img src="<?php echo ZoneRouter::createUrl('/'); ?>/upload/user-photos/<?php echo $u['hexID']; ?>/fill/71-71/<?php echo $u['profile']['image']; ?>" alt="<?php echo $u['displayname']; ?>" class="wd-image" height="71" width="71" />
							<span class="wd-name"><?php echo $u['displayname']; ?></span>
						</a>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php else:?>
				<?php
				$this->widget('widgets.node.GalleryNodes', array(
					'page'=>'profile'
				));
				?>
			<?php endif;?>
				
		
		<div class="clear"></div>
	</div>
</div>
