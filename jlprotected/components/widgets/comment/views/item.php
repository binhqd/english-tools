<div class="wd-content-box item-box <?php echo empty($show) ? "hide-row-comment" : "";?> " style="display:<?php echo empty($show) ? "none" : "block";?>" anchor="<?php echo $comment->commentId;?>">
	<?php
	if(!empty($this->onPopup) && $this->onPopup){
	?>
	<a href="javascript:void(0)" onclick="parent.window.location.href='<?php echo $comment->profileUrl;?>'" class="wd-thumb" title="<?php echo $comment->displayname;?>">
		<img class="avatar"  alt="<?php echo $comment->displayname;?>" src="<?php echo $comment->avatarUrl;?>">
	</a>
	<?php
	}else{
	?>
	<a href="<?php echo $comment->profileUrl;?>" class="wd-thumb" title="<?php echo $comment->displayname;?>">
		<img class="avatar" alt="<?php echo $comment->displayname;?>" src="<?php echo $comment->avatarUrl;?>">
	</a>
	<?php
	}
	?>
	<div class="wd-right-box">
		<p class="wd-commentpost">
			<?php
			if(!empty($this->onPopup) && $this->onPopup){
			?>
				<a href="javascript:void(0)" onclick="parent.window.location.href='<?php echo $comment->profileUrl;?>'" >
					<strong><?php echo $comment->displayname;?></strong>
				</a> 
			<?php
			}else{
			?>
				<a href="<?php echo $comment->profileUrl;?>">
					<strong><?php echo $comment->displayname;?></strong>
				</a> 
			<?php
			}
			?>
			
			<label>
				<label style="display:none">
					<?php echo strip_tags($comment->commentContent,"<p>");?>
				</label>
				<label>
			<?php
				$content = JLStringHelper::char_limiter_word($comment->commentContent,200);
				$threeWord = substr($content, -3);
				echo $content;
				if($threeWord == "30;"){
					echo CHtml::link('See more','javascript:void(0)',array('class'=>'truncate_more_link'));
				}
			?>
				</label>
			</label>
		</p>
		<p class="wd-date-post">
			<label class="timeago" title="<?php echo  date(DATE_ISO8601,strtotime($comment->commentDate));?>"></label>
		</p>
	</div>
</div>