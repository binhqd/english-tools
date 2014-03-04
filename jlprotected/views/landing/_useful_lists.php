<?php if (count($usefulLists)) : ?>
<div class="wd-section-landing-page wd-list-news">
	<h2 class="wd-title-landing-page">
		Useful lists
	</h2>
	<ul>
		<?php foreach ($usefulLists as $index => $list) : ?>
		<li <?php if ($index==count($usefulLists)-1) echo 'class="wd-no-border-bottom"'; ?>>
			<a href="<?php echo JLRouter::createUrl('/dashboard?u='.$list['ownerInfo']['id']); ?>" class="wd-thumb" title="<?php echo CHtml::encode($list['ownerInfo']['username']); ?>"><img alt="Thumbnail" src="<?php echo $list['ownerInfo']['avatar']; ?>"/></a>
			<h4 class="wd-title"><a class="jl-biz-name" href="<?php echo JLRouter::createUrl('/lists/published/view?listID='.$list['id']); ?>"><?php echo CHtml::encode($list['title']); ?></a></h4>
			<p class="jlbd-count-biz"><a href="<?php echo JLRouter::createUrl('/lists/published/view?listID='.$list['id']); ?>"><?php echo $list['count_items']; ?></a> <strong><?php echo Yii::t('app', 'Business|Businesses', $list['count_items']); ?></strong> included</p>
			<p class="jlbd-count-biz"><span>Bookmarked by</span> <a href="#" class="jl_lnk_bookmarkers" ref="<?php echo $list['id']; ?>"><?php echo $list['totalBookmarker']; ?></a> <strong>people</strong></p>
		</li>
		<?php endforeach; ?>
	</ul>
	<!--p class="wd-link-view-all"><a href="#">View all</a></p-->
</div>
<?php endif; ?>