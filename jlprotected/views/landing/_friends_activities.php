<?php if (count($friendsActivities)) : ?>
<div class="wd-section-landing-page wd-list-news wd-friends-activities">
	<h2 class="wd-title-landing-page">
		Friends activities
	</h2>
	<ul>
		<?php foreach ($friendsActivities as $index => $friend) : ?>
		<li>
			<a href="<?php echo JLRouter::createUrl('/dashboard?u=' . $friend['id']); ?>" class="wd-thumb" title="<?php echo CHtml::encode($friend['username']); ?>"><img alt="Thumbnail" src="<?php echo $friend['avatar']; ?>"/></a>
			<div class="jlbd-right-content">
			<?php foreach ($friend['activities'] as $activity) : ?>
				<p><?php echo $activity; ?></p>
			<?php endforeach; ?>
			</div>
		</li>
		<?php endforeach; ?>
	</ul>
	<p class="wd-link-view-all"><a href="<?php echo JLRouter::createUrl('/dashboard/friends/viewActivities'); ?>">View all</a></p>
</div>
<?php endif; ?>