<!-- mutual friend .end -->
<!-- summary -->
<?php
$content = @$properties['/common/topic/description'][1];
unset($properties['/common/topic/description']);
?>
<div class="wd-left-block">
	<h2 class="wd_tt_2">
		Summary
		<?php
		InstanceCrawler::addLinkHolder('property', 'Crawl summary', array('/common/topic/article'));
		?>
	</h2>
	<p id="properties-summary" content="<?php //echo trim(@$content[0]['value']);        ?>">
		<?php
		//$summary = JLStringHelper::char_limiter_word(trim(@$content[0]['value']),350);
		$summary = trim(@$content[0]['value']);
		//$threeWord = substr($summary, -3);
		echo $summary;
// 		if($threeWord == "30;"){
// 			echo CHtml::link('see more','javascript:void(0)',array('class'=>'truncate_more_link_summary',
// 				'onClick'=>"$('#properties-summary').html($('#properties-summary').attr('content'));"
// 			));
// 		}
		?>
	</p>
</div>
<?php ?>

<!-- summary .end -->
<!---Information -->
<div class="wd-left-block">
	<?php if ($this->zoneId == currentUser()->hexID): ?>
		<a href="#" class="wd-update-infor-link">
			<span class="wd-icon-16 wd-icon-update-info"></span>
			<span class="wd-text">Updates infomation</span>
		</a>
	<?php endif; ?>

	<h2 class="wd_tt_2">Information</h2>
	<div class="wd-left-block-content-toggle " style="display:block">
		<ul class="wd-information-list">
			<?php foreach ($properties as $i => $row) : ?>
				<?php
				if (!empty($row[0]['feature'])) {
					continue;
				}
				unset($properties[$i]);
				$Property = ZoneProperty::initNode($row[0]);
				//$isEnum = ZoneProperty::initNode($row[0])->getExpected()->isEnumeration();
				?>
				<li>
					<label><?php echo $row[0]['name']; ?>:</label>
					<span class="wd-value-text">
						<?php
						$output = array();
						$hasGroup = count($row[1]) > 5;
						foreach ($row[1] as $value) {
							if (!empty($value['node'])) {
								if ($Property->isLinkable()) {
									$output[] = '<a href="' . JLRouter::createUrl('zone/pages/detail/?id=')
											. $value['node']['zone_id'] . '">' . $value['node']['name'] . '</a>';
								} else {
									$output[] = $value['node']['name'];
								}
							} else {
								$output[] = $value['value'];
							}
							if (count($output) == 5 && $hasGroup) {
								$output[4] .= '<span class="view-more-properties" style="display:none;">';
							}
						}
						// format date & height //MyZoneHelper::checkDate($mydate)
						switch ($row[0]['expected']) {
							case "/type/datetime":
								$date = implode(', ', $output);
								$day = date("d", strtotime($date));
								echo date("M {$day}S,Y", strtotime(implode(', ', $output)));
								break;
							case "/type/float":
								echo MyZoneHelper::formatHeightValue(implode(', ', $output), $row[0]['name']);




								break;
							default:
								echo implode(', ', $output);
								break;
						}

						if ($hasGroup) {
							echo ' </span><em style="cursor: pointer;" class="information-view-more"> ...[+]</em>';
						}
						?>
					</span>
				</li>
			<?php endforeach; ?>
		</ul>

	</div>
</div>


<?php foreach ($properties as $row) : ?>
	<?php
	$Property = ZoneProperty::initNode($row[0]);
	$values = $row[1];
	?>
	<div class="wd-left-block ">
		<span class="wd-toggle-bt-1 floatR  wd-toggle-bt-active wd-toggle-bt-active-custom"></span>
		<h2 class="wd_tt_2"><?php echo $Property->node->name; ?></h2>
		<div class="wd-left-block-content-toggle " style="display:block">
			<div class="wd-follow-block">
				<?php
				$node['zone_id'] = $this->zoneId;
				$this->render('application.modules.zone.views.pages.feature', compact('Property', 'values', 'node'));
				?>
			</div>
		</div>
	</div>
<?php endforeach; ?>
<style>
	.wd-information-list li span{
		display: inline;
	}
	.prop-description{
		color: #888;
		font-size: .9em;
	}
	.prop-description a{
		display: inline !important;
		color: #1451FB;
	}
	.information-view-more{
		color: #71B43B !important;
		font-style: normal !important;
	}
</style>
<script>
	$().ready(function(e) {

		$('.view-more-properties').next('em').click(function() {
			var $elm = $(this).prev('.view-more-properties');
			if ($elm.is(':hidden')) {
				$(this).html(' [-]');
			} else {
				$(this).html(' ...[+]');
			}
			$elm.toggle();
		});

	});
</script>