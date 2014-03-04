<?php
if($this->loadJsTimeAgo){
	$this->widget('ext.timeago.JTimeAgo', array(
		'selector' => ' .timeago',
	));
}
?>
<script>
$().ready(function(e){
	$('#textareaReview<?php echo $this->strToken;?>').autosize();
});


</script>
<?php if($this->alwayShow):?>
<div class="wd-comment-box">
<?php else: ?>
<div class="wd-comment-box" style="display:<?php echo ($this->countComment==0) ? "block" : "none";?>">
<?php endif; ?>

	<?php
	$this->render($this->viewFormPath);
	?>

	<div id="contentComments<?php echo $this->strToken;?>" class="custom-list-comments ">
	<?php
	
	$this->render('widgets.comment.views.listComment',array(
		'listComments'=>$this->listComment,
		'show'=>true,
		'loadJsTimeAgo'=>true,
		'viewPath'=>$this->viewItemPath
	));
	?>
	
	</div>
	<?php
	if($this->viewMore && $this->countComment>=$this->limit && ($this->countComment - $this->limit)>0 ){
	
	?>
	<div class="wd-content-box wd-viewall-box">
		<a href="javascript:void(0)" viewPath="<?php echo $this->viewItemPath;?>" onclick="viewMore('<?php echo $this->strToken;?>')" id="viewMore<?php echo $this->strToken;?>" limit="<?php echo $this->limit;?>" objectId="<?php echo $this->objectId;?>" ref="<?php echo GNRouter::createUrl('/comments/comment/lists')?>" startList="<?php echo $this->limit;?>" totalRecord="<?php echo $this->countComment;?>">
			View <label><?php echo ( ($this->countComment - $limit) >= $limit ) ? $limit : $this->countComment - $limit;?></label> more comments...
		</a>
		<span id="loadingComment<?php echo $this->strToken;?>" style="display:none">
			<div class="loader-show-more-comment" >
				<img src="<?php echo GNRouter::createUrl('/');?>/myzone_v1/img/front/ajax-loader.gif" alt="loading">
			</div>
		</span>
	</div>
	<?php
	}
	?>
	
</div>