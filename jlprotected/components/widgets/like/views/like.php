<?php
$classCheckLike = "";
if($this->self) $classCheckLike = $this->classLike;
else $classCheckLike = $this->classUnlike;

$result = @CMap::mergeArray($result,array('classCheckLike'=>$classCheckLike),array(
	'people'=>$this->outString($result['count'],$result['peopleLiked'])
));

if(currentUser()->isGuest){
?>

<div class="wd-pp-like-content floatL coregreennet-wd-rating" object_id="<?php echo $this->objectId;?>" rating_type="<?php echo $result['type'];?>">
	<a href="#wd-signin-popup" 	
		class="wd-open-popup <?php echo $classCheckLike;?> coregreennet-rating <?php echo $result['classRating'];?>" action="<?php echo $result['action'];?>" rating_value="<?php echo $result['value'];?>" ><?php echo $result['value'];?></a>
	<span id="stringLike<?php echo $strToken;?>">
		<?php echo $result['people'];?>
		
	</span>
</div>
<?php
}else{
?>
<div class="wd-pp-like-content floatL coregreennet-wd-rating" object_id="<?php echo $this->objectId;?>" rating_type="<?php echo $result['type'];?>">
	<a href="javascript:void(0);" 
		actionLike="<?php echo $this->actionLike;?>" 
		nodeId="<?php echo $this->nodeId;?>" 
		acceptClick="true"
		actionUnlike="<?php echo $this->actionUnlike;?>" 
		classLike="<?php echo $this->classLike;?>" 
		classUnlike="<?php echo $this->classUnlike;?>"  
		onclick="initLike('<?php echo $strToken;?>')" 
		id="likeNodeObject<?php echo $strToken;?>" number="<?php echo $result['count'];?>" class="<?php echo $classCheckLike;?> coregreennet-rating <?php echo $result['classRating'];?>" action="<?php echo $result['action'];?>" rating_value="<?php echo $result['value'];?>" ><?php echo $result['value'];?></a>
	<span id="stringLike<?php echo $strToken;?>">
		<?php echo $result['people'];?>
		
	</span>
</div>

<?php
}
?>
