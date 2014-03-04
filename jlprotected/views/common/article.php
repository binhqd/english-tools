<?php

$fullName = "";
$objectId = "";
$articleId = IDHelper::uuidFromBinary($article->id,true);
$avatar = "";
if(!empty($article->author->user)){
	$fullName = $article->author->user->displayname;
	$objectId = IDHelper::uuidFromBinary($article->author->user->id,true);
	
	$avatar = ZoneRouter::CDNUrl('/')."/upload/user-photos/{$objectId}/fill/40-40/{$article->author->user->profile->image}";


	$images = $article->getImages($article->id,1);
	

	$countComment = ZoneComment::model()->countComments($articleId);

?>

<li class="wd-stream-story <?php echo (!empty($hide)) ? "fade-item-article": "";?>" id="article-item" article_id="<?php echo IDHelper::uuidFromBinary($article->id,true);?>" style="display:<?php echo (!empty($hide)) ? "none": "block";?>">
	<div class="wd-story-content">
		<div class="wd-head-storycontent">			
			<a href="<?php echo ( IDHelper::uuidFromBinary($article->author->user->id,true) == currentUser()->hexID ) ? GNRouter::createUrl('/profile') : GNRouter::createUrl('/profile/'.$article->author->user->username);?>" class="wd-avatar"><img
				src="<?php echo $avatar;?>" alt="<?php echo $fullName;?>"
				height="40" width="40" />
			</a>
			
			<div class="wd-head-storyinnercontent">
				<h3 class="wd_tt_n1">
					
					<a href="<?php echo ( IDHelper::uuidFromBinary($article->author->user->id,true) == currentUser()->hexID ) ? GNRouter::createUrl('/profile') : GNRouter::createUrl('/profile/'.$article->author->user->username);?>" class="wd-name"><?php echo $fullName;?></a>
					
					<?php
					
					
					
					$node = null;
					if(!empty($article->namespace)){
						$node = $article->namespace->nodeInfo(IDHelper::uuidFromBinary($article->namespace->holder_id,true));
						echo "posted new article for ";
						echo CHtml::link($node['name'],ZoneRouter::createUrl('/zone/pages/detail',array('id'=>$node['zone_id'])));
					}else{
						echo "posted new article ";
					}
					
					
						
						
					
						
						
					$removeBorderDash = "border:none";
					
					
					?>
					
					<!--<a href="#">article</a>.-->
				</h3>
				<p class="wd-date-post timeago" title="<?php echo  date(DATE_ISO8601,strtotime($article->created));?>">10 minutes ago</p>
			</div>
			<span class="wd-arrow-down"></span>
			<div class="clear"></div>
		</div>
		<div class="wd-addnew-content bbor-solid-1">
			<?php if(!empty($images)):?>
				<?php
				$image = $images[0];
				$urlPhotoPopup = GNRouter::createUrl('/photos/viewPhoto',array('photo_id'=>IDHelper::uuidFromBinary($image->id,true),'article_id'=>IDHelper::uuidFromBinary($article->id,true)));
				?>
				<a class="wd-addnew-image lnkViewPhotoDetail" href="<?php echo $urlPhotoPopup;?>" photo_id="<?php echo IDHelper::uuidFromBinary($image->id, true);?>" album_id="<?php echo IDHelper::uuidFromBinary($article->id,true);?>" 
					filename="<?php echo $image->image;?>">
					<img src="<?php echo ZoneRouter::CDNUrl('/').'/upload/gallery/fill/165-165/'.$image->image.'?album_id='.IDHelper::uuidFromBinary($article->id,true);?>"  height="70" width="70">
				</a>
			<?php endif;?>
			<div class="wd-addnew-text">
				<div class="wd-nameposter">
					<h3 class="wd_tt_n1"><a href="<?php echo GNRouter::createUrl('/article?article_id='.IDHelper::uuidFromBinary($article->id,true));?>" class="wd-title"><?php echo $article->title;?></a> </h3>
					<p class="wd-user-post">written by 
					<a href="<?php echo ( IDHelper::uuidFromBinary($article->author->user->id,true) == currentUser()->hexID ) ? GNRouter::createUrl('/profile') : GNRouter::createUrl('/profile/'.$article->author->user->username);?>" >
						<?php echo $fullName;?>
					</a>
					</p>
				</div>
				<div class="wd-disc">
					<p><?php echo JLStringHelper::char_limiter_word(strip_tags($article->content,""),100);?></p>
				</div>
			</div>
		</div>
		
		
		
		
		<div class="wd-action-storycontent">
			<?php
			
			$this->widget('widgets.like.Like', array(
				'objectId'=>$articleId,
				'nodeId'=>($node == null) ? 0 : $node['zone_id'],
				'actionLike'=> GNRouter::createUrl('like/liked/liked'),
				'actionUnlike'=> GNRouter::createUrl('like/liked/like'),
				'modelObject'	=> 'application.modules.like.models.LikeObject',
				'modelStatistic'	=> 'application.modules.like.models.LikeStatistic',
				'classUnlike'=>'wd-like-bt',
				'classLike'=>'wd-like-bt wd-liked-bt',
				
			));

			?>
			<div class="wd-pp-comment-info wd-pp-comment-info-bt"><span class="wd-comment-bt"></span><span><?php echo $countComment;?>
			<?php echo ($countComment==1) ? "comment" : "comments";?></span></div>
			<div class="clear"></div>
		</div>
		<?php
		
		$this->widget('widgets.comment.Comment', array(
			'objectId'=>$articleId,
			'countComment'=>$countComment,
			'viewMore'=>true,
			'loadJsTimeAgo'=>false,
			'limit'=>5,
			'viewItemPath'=>'widgets.comment.views.item'
		));
		?>
		
	</div>
</li>
<?php
}else{
	dump($article->attributes,false);
}
?>