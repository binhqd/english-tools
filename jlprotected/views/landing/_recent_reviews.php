<?php if (count($recentReviews)) : ?>
<div class="wd-section-landing-page wd-list-news">
	<h2 class="wd-title-landing-page">
		Recent reviews
	</h2>
	<ul class="jlbd-review-you-friend">
		<?php 
		foreach ($recentReviews as $index => $review) :
		//Thinh fix
		$ext = @CJSON::decode($value->business->_ext);
		$tmpAvatar = "";
		if(!empty($ext) && !empty($ext['avatar'])){
			$tmpAvatar = $ext['avatar'];
		}
		?>
		<li <?php if ($index==count($recentReviews)-1) echo 'class="wd-no-border-bottom"'; ?>>
			<a class="wd-thumb" href="<?php echo JLRouter::createUrl('/business/' . $review->business->alias); ?>" title="<?php echo CHtml::encode($review->business->name); ?>"><img src="<?php echo JLBusinessHelper::renderImgBiz(array('uuid' => IDHelper::uuidFromBinary($review->business->id),'name'=>$tmpAvatar,'width' => 54,'height' => 54), 'business', true); ?>" alt="Thumbnail"></a>
			<div class="jlbd-right-content">
				<h4 class="wd-title"><a class="jl-biz-name" href="<?php echo JLRouter::createUrl('/business/' . $review->business->alias); ?>"><?php echo CHtml::encode($review->business->name); ?></a></h4>
				<div class="wd-rating wd-rating-green">							
					<div class="wd-rating-static">
						<p class="star-lv-<?php echo $review->rate * 2; ?>"></p>
					</div>
					<label class="jl-date">(<?php echo date(Yii::app()->params['formats']['date'], strtotime($review->created)); ?>)</label>
				</div>
				<a class="jl-status-review" href="<?php echo JLRouter::createUrl('/business/' . $review->business->alias).'?rid='.IDHelper::uuidFromBinary($review->id).'#/section/?highlightreview='.IDHelper::uuidFromBinary($review->id);; ?>"><?php echo JLStringHelper::char_limiter_word($review->content, 80); ?></a>
			</div>
		</li>
		<?php endforeach; ?>
	</ul>
	<!--p class="wd-link-view-all"><a href="#">View all</a></p-->
</div>
<?php endif; ?>