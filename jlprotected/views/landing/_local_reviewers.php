<?php if (count($localReviewers)) : ?>
<?php
GNAssetHelper::init(array(
	'image' => 'img',
	'css' => 'css',
	'script' => 'js',
));
GNAssetHelper::setBase('widgets.left-sidebar.assets');
GNAssetHelper::scriptFile('jlbd.friend.request', CClientScript::POS_END);
GNAssetHelper::setBase('justlook');
GNAssetHelper::scriptFile('jlbd-follow-reviewer', CClientScript::POS_END);
?>
<div class="wd-section-landing-page">
	<h2 class="wd-title-landing-page">
		Local reviewers
	</h2>
	<?php foreach ($localReviewers as $index => $reviewer) : ?>
	<?php $avatar = $reviewer['user']->avatar;  ?>
	<div class="wd-above-list <?php if ($index==count($localReviewers)-1) echo 'wd-above-list-no-border'; ?>">
		<div class="wd-above-infor">
			<div class="wd-thumbnail-user">
				<a href="<?php echo JLRouter::createUrl('/dashboard?u='.$reviewer['user']->hexID); ?>" class="wd-avatar"><img alt="Thumbnail" src="<?php echo $avatar['isExist'] ? JLRouter::createUrl("/upload/user-photos/".$reviewer['user']->hexID."/fill/100-100/{$avatar['filename']}") : JLRouter::createUrl("/upload/user-photos/{$avatar['filename']}");?>"></a>
				<?php
					if (!$reviewer['friend_status']['isFriend']) {
						if (!$reviewer['friend_status']['isPending'])
							if (!$reviewer['friend_status']['isPendingMe'])
								echo '<a title="Add as a friend" href="'.JLRouter::createUrl('/dashboard/friends/sendRequest', array('strUserID'=>$reviewer['user']->hexID)).'" class="wd-add-thumb wd-request-friend jlbd-tiptip-top"></a>';
							else
								echo '<a title="Accept as a friend" href="'.JLRouter::createUrl('/dashboard/friends/sendRequest', array('strUserID'=>$reviewer['user']->hexID)).'" class="wd-add-thumb wd-request-friend wd-accept-friend jlbd-tiptip-top"></a>';
						else
							echo '<a title="Friend request pending" href="#" class="wd-add-thumb wd-pending-friend jlbd-tiptip-top"></a>';
					}
				?>
				<p class="wd-bt-container-land">
					<?php
					
						$urlFollow = JLRouter::createUrl('/followings/follow/followReviewer', array('strFollowerID'=>$reviewer['user']->hexID));
						$titleFollow = "Follow";
						$backgroundFollow = "";
						$isFollow = 'true';
						if(!empty($reviewer['isFollow']) && $reviewer['isFollow']['isFollower']==true){
							$isFollow = 'false';
							$urlFollow = JLRouter::createUrl('/followings/follow/stop', array('strFollowerID'=>$reviewer['user']->hexID));
							$titleFollow = "Stop following";
							$backgroundFollow = "background:#d1d1d1";
						}
					?>
					<a follow="<?php echo $isFollow;?>" class="wd-follow-land wd-follow-reviewer-of-user follow" style="<?php echo $backgroundFollow;?>" ref="<?php echo $urlFollow; ?>" user-id="<?php echo $reviewer['user']->hexID; ?>" href="javascript:void(0)" title="<?php echo $titleFollow;?>">Follow</a>
					<a title="Send message" class="wd-send-mail-land" href="<?php echo JLRouter::createUrl('/messages?prt=node#w/0/0/'.$reviewer['user']->hexID); ?>"><span>Send</span></a>
				</p>
			</div>
			<div class="wd-list-latest-reviews wd-list-news">
				<span class="wd-arrow-left-land"></span>
				<p class="wd-infor-reviewer-landing">
					<a href="<?php echo JLRouter::createUrl('/dashboard?u='.$reviewer['user']->hexID); ?>" class="jl-friend-name"><?php echo $reviewer['user']->displayname;?></a>
					<span class="jl-number-diagram"><?php echo $reviewer['user']->stats['points'];?></span>
					<span class="jl-number-friend"><?php echo $reviewer['user']->stats['friends'];?></span>
					<span class="jl-number-review"><?php echo $reviewer['user']->stats['reviews'];?></span>
					<span class="jl-number-list"><?php echo $reviewer['user']->stats['lists'];?></span>
				</p>
				<ul class="jlbd-review-you-friend">
					<?php 
					foreach ($reviewer['reviews'] as $ir => $review) : 
						//Thinh fix
						$ext = @CJSON::decode($value->business->_ext);
						$tmpAvatar = "";
						if(!empty($ext) && !empty($ext['avatar'])){
							$tmpAvatar = $ext['avatar'];
						}
					?>
					<li <?php if ($ir==count($reviewer['reviews'])-1) echo 'class="wd-list-latest-no-border"'; ?>>
						<a class="wd-thumb" href="<?php echo JLRouter::createUrl('/business/' . $review->business->alias); ?>" title="<?php echo CHtml::encode($review->business->name); ?>"><img src="<?php echo JLBusinessHelper::renderImgBiz(array('uuid' => IDHelper::uuidFromBinary($review->business->id),'name'=>$tmpAvatar,'width' => 40,'height' => 40), 'business', true); ?>" alt="Thumbnail"></a>
						<div class="jlbd-right-content">
							<h4 class="wd-title"><a class="jl-biz-name" href="<?php echo JLRouter::createUrl('/business/' . $review->business->alias); ?>"><?php echo CHtml::encode($review->business->name); ?></a></h4>
							<div class="wd-rating wd-rating-green">
								<div class="wd-rating-static">
									<p class="star-lv-<?php echo $review->rate * 2; ?>"></p>
								</div>
								<label class="jl-date">(<?php echo date(Yii::app()->params['formats']['date'], strtotime($review->created)); ?>)</label>
							</div>
							<a class="jl-status-review" href="<?php echo JLRouter::createUrl('/business/' . $review->business->alias).'?rid='.IDHelper::uuidFromBinary($review->id).'#/section/?highlightreview='.IDHelper::uuidFromBinary($review->id); ?>"><?php echo JLStringHelper::char_limiter_word($review->content, 75); ?></a>
						</div>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
			
		</div>
	</div>
	<?php endforeach; ?>
</div>
<?php endif; ?>