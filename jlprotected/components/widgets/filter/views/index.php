<div class="wd-wall">
	<div class="sort-wall">
		<h4 class="wd-sort-label">Activities</h4>
		<div class="sort-wall-text">
			<div class="wd-setting-streamstory wd_parenttoggle">
				<label class="text wd_toggle_bt">Sort
					<span>
					<?php
					if(!empty($_GET['sort'])){
						if($_GET['sort'] == "top") echo " : Top Stories";
						else if($_GET['sort'] == "old") echo " : Old Stories";
						else if($_GET['sort'] == "most") echo " : Most Recent";
					}else{
						echo " : Most Recent";
					}
					?>
					</span>
					
				</label>
					<span class="wd-icon-arrow-4 wd_toggle_bt wd-toggle-bt-active"></span>
				<div  class="wd-setting-stream-content wd_toggle wd_toggle_open">
					<span class="wd-uparrow-1 wd_toggle_bt"></span>
					<ul>
						<li><a href="<?php echo ZoneRouter::createUrl(Yii::app()->request->pathInfo."?sort=top");?>" class="sort" type="top">Top Stories</a></li>
						<li><a href="<?php echo ZoneRouter::createUrl(Yii::app()->request->pathInfo."?sort=old");?>" class="sort" type="old">Old Stories</a></li>
						<li><a href="<?php echo ZoneRouter::createUrl(Yii::app()->request->pathInfo."?sort=most");?>" class="sort" type="most">Most Recent</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
						
<!--
<div class="wd-wall">
	<div class="sort-wall">
		<div class="sort-wall-text">
			<div class="wd-setting-streamstory wd_parenttoggle">
				
				<label class="text wd_toggle_bt">
					Sort
					<span>
					<?php
					if(!empty($_GET['sort'])){
						if($_GET['sort'] == "top") echo " : Top Stories";
						else if($_GET['sort'] == "old") echo " : Old Stories";
						else if($_GET['sort'] == "most") echo " : Most Recent";
					}else{
						echo " : Most Recent";
					}
					?>
					</span>
				</label>
				<span class="icon wd-icon-16 wd-icon-setting-stream-story wd_toggle_bt wd-toggle-bt-active"></span>
				
				<div class="wd-setting-stream-content wd_toggle wd_toggle_open" style="display: none;">
					<span class="wd-uparrow-1"></span>
					<ul>
						<li><a href="<?php echo ZoneRouter::createUrl(Yii::app()->request->pathInfo."?sort=top");?>" class="sort" type="top">Top Stories</a></li>
						<li><a href="<?php echo ZoneRouter::createUrl(Yii::app()->request->pathInfo."?sort=old");?>" class="sort" type="old">Old Stories</a></li>
						<li><a href="<?php echo ZoneRouter::createUrl(Yii::app()->request->pathInfo."?sort=most");?>" class="sort" type="most">Most Recent</a></li>
					</ul>
				</div>
			</div>

		</div>
		
	</div>
</div>
-->