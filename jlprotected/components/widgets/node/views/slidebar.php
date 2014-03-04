<?php
if (!empty($relateds)) {
	$labels = $relateds['labels'];
	$node = $relateds['node'];
	$refer = $relateds['refer'];
	$relateds = $relateds['relateds'];
	$this->render('application.modules.zone.views.pages.node_related', compact(
					'relateds', 'node', 'refer', 'labels'
	));
}

?>