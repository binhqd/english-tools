<?php if (count($notifications)) : ?>
<div class="wd-section-landing-page wd-list-news wd-list-in-focus">
	<h2 class="wd-title-landing-page">
		You are in focus
	</h2>
	<ul>
		<?php $index=0;
		foreach ($notifications as $notification) : ?>
		<?php
			$class = Yii::import($notification->type);
			$renderer = new $class;
			try {
				$message = $renderer->render($notification->data);
				if (empty($message)) continue;
			} catch (Exception $ex) {
				continue;
			}
			$notifier = JLUser::model()->getUserInfo(IDHelper::uuidToBinary($notification->notifier_id));
			if (empty($notifier)) continue;
			$avatar = $notifier->avatar;
		?>
		<li class="<?php if ($index%2!=0) echo 'wd-even'; ?> <?php if ($index>=count($notifications)-($index%2==0?2:1)) echo 'wd-no-border'; ?>">
			<a class="wd-thumb" href="<?php echo JLRouter::createUrl('/dashboard?u='.$notifier->hexID); ?>"><img src="<?php echo $avatar['isExist'] ? JLRouter::createUrl("/upload/user-photos/".$notifier->hexID."/fill/40-40/{$avatar['filename']}") : JLRouter::createUrl("/justlook/img/front/img-no-avatar.png");?>" alt="Thumbnail"></a>
			<?php echo JLStringHelper::char_limiter_word($message, 300); ?>
		</li>
		<?php $index++; ?>
		<?php endforeach; ?>
	</ul>
</div>
<?php endif; ?>