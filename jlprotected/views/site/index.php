<div class='row-fluid'>
	<ul class="thumbnails">
		<?php foreach ($users as $user):?>
		<li class='span2'>
			<div class="thumbnail">
			<a href='<?php echo GNRouter::createUrl('/site/listDataset?id=' . IDHelper::uuidFromBinary($user->id, true));?>'>
			<img width='54' height='54' src='<?php echo GNRouter::createUrl('/upload/user-photos/' . IDHelper::uuidFromBinary($user->id, true) . '/fill/54-54/' . $user->profile->image)?>'/>
			<?php echo $user->username?>
			</a>
			</div>
		</li>
		<?php endforeach;?>
	</ul>
</div>