<?php
GNAssetHelper::init(array(
	'image' => 'img',
	'css' => 'css',
	'script' => 'js',
));
GNAssetHelper::setBase('myzone_v1');
GNAssetHelper::scriptFile('zone.gallery.node', CClientScript::POS_END);


?>

<div class="wd-connection wd-subject-node-conection  responsive wd-bg-scroll-<?php echo $active;?>" id="wd-connection-landingpage">

<?php

if(!empty($galleryNode)){
	$cnt = 0;
	foreach($galleryNode as $key=>$nodes){
		$keyGalerry = $key;
?>
	

		<ul class="wd-connec-list-2 gallery-landingpage-<?php echo $keyGalerry;?>  <?php echo ($key == $active) ? "un-gallery-active" : "un-gallery-unactive";?> " id="ul-gallery-<?php echo ($key == $active) ? "first" : "other";?>" key_search="<?php echo $key;?>">
			<?php
			if(!empty($nodes)){
				foreach($nodes as $key=>$node){
					$images = ZoneInstanceRender::getResourceImage(array(
						'zone_id'=>$node['zone_id'],
						'image'=>array()
					));
			?>
			<li>
				<a href="<?php echo ZoneRouter::createUrl('/zone/pages/detail',array('id'=>$node['zone_id']));?>">
					
					
					<?php
					if(!empty($images['image']['name'])){
						
					?>
						<img src="<?php echo ZoneRouter::CDNUrl('/');?>/upload/gallery/fill/243-108/<?php echo $images['image']['name'];?>?album_id=<?php echo $node['zone_id'];?>" alt="<?php echo $images['image']['title'];?>" width="243" height="108" />
					<?php
					}else{
					?>
						<img src="<?php echo GNRouter::createUrl('/site/placehold',array('t'=>'243x108-282828-969696'));?>" alt="" width="243" height="108" />
					<?php
					}
					?>
					
					
					
					<p>
						<span class="wd-name"><?php echo $node['name'];?></span>
						<span class="wd-job"><?php echo $node['label'];?></span>
					</p>
				</a>
			</li>
			<?php
				}
			}
			
			?>
		</ul>
		
		<div class="control-div">
			<span id="wd-prev-<?php echo $keyGalerry;?>">prev</span>
			<span id="wd-next-<?php echo $keyGalerry;?>">next</span>
		</div>
		

<?php
		
		$cnt++;
	}
}
?>
	
</div>
<div class="clear"></div>	
<script>
$().ready(function(e){
	zone.GalleryLandingPage.obj.gallery = <?php echo @CJSON::encode($galleryNode);?>;
	zone.GalleryLandingPage.init();
});

</script>