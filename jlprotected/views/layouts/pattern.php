<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php 
	GNAssetHelper::init(array(
		'image'		=> 'img',
		'css'		=> 'css',
		'script'	=> 'js'
	));
	?>		
	<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<title>HTML Patterns</title>
	<?php GNAssetHelper::setBase('justlook');?>
	<?php GNAssetHelper::cssFile('bt-big-2');?>

	<?php GNAssetHelper::scriptFile('jlbd', CClientScript::POS_END)?>
	<?php GNAssetHelper::cssFile('jlbd.message');?>
	<?php GNAssetHelper::cssFile('jlbd.dialog');?>
	<?php GNAssetHelper::cssFile('jlbd.notify');?>
	<?php GNAssetHelper::scriptFile('jlbd', CClientScript::POS_END)?>
	<?php GNAssetHelper::scriptFile('jlbd.message', CClientScript::POS_END)?>
	<?php GNAssetHelper::scriptFile('jlbd.dialog', CClientScript::POS_END)?>
	<?php GNAssetHelper::scriptFile('jlbd.notify', CClientScript::POS_END)?>
	
	<?php
	GNAssetHelper::setBase('application.modules.reviews.assets');
	GNAssetHelper::scriptFile('jlbd.rating', CClientScript::POS_END);
	?>
	
	<?php
	GNAssetHelper::setBase('application.modules.businesses.assets');
	GNAssetHelper::scriptFile('jlbd.biz', CClientScript::POS_END);
	?>
	
	<?php
	GNAssetHelper::setBase('application.modules.user.assets');
	GNAssetHelper::scriptFile('jlbd.user', CClientScript::POS_END);
	?>
	
	<?php GNAssetHelper::setBase('pattern')?>
	<?php GNAssetHelper::cssFile('reset')?>
	<?php GNAssetHelper::cssFile('common')?>
	<?php GNAssetHelper::cssFile('common-widgets')?>
</head>

<body>

	<!-- wd-container -->
	<div id="wd-container">

		<!-- header -->
		<div id="wd-header">
			<h1><a href="#">HTML Patterns <?php echo "php welcome" ;?></a></h1>
			<a href="http://toancauxanh.vn" id="wd-greenglobal" rel="external"><img src="img/logo-greenglobal.png" alt="Green Global" /></a>
		</div>
		<!-- header.end -->

		<!-- main -->
		<div id="wd-main" class="clearfix">

			<!-- menu -->
			<div id="wd-menu">
			<?php
				$this->widget('zii.widgets.CMenu', array(
						'items'=>array(
							array('label'=>'Common Elements',		'url'=>'index'),							
							array('label'=>'Dashboard ',		'url'=>'dashboard'),							
							array('label'=>'Multilevel Menu ', 		'url'=>'multilevelmenu'),
							array('label'=>'Button ', 				'url'=>'button'),
							array('label'=>'Popup ', 				'url'=>'popup'),
							array('label'=>'Breadcrumb ', 				'url'=>'breadcrumb '),
							array('label'=>'Tooltip ', 				'url'=>'tooltip '),
							array('label'=>'Rating ', 				'url'=>'rating'),
							array('label'=>'List News ', 				'url'=>'listnew'),
							array('label'=>'List Thumbnail ', 				'url'=>'thumbnail'),
							array('label'=>'Note ', 				'url'=>'note'),
							array('label'=>'Link Extra Function ', 				'url'=>'LinkExtra'),
							array('label'=>'Left sidebar', 				'url'=>'LeftSidebar'),
							array('label'=>'Tags', 				'url'=>'tags'),
							array('label'=>'Title List', 				'url'=>'title'),
							array('label'=>'Item Friend Recent Activity', 				'url'=>'FriendRecentActivity'),	
							array('label'=>'List Active Reviews', 				'url'=>'ActiveReviews'),	
							array('label'=>'Comment Box', 				'url'=>'box'),	
							array('label'=>'Review Box', 				'url'=>'reviewBox'),
							array('label'=>'Search Results', 				'url'=>'searchresult', 'items'=>array(
								array('label'=>'Above the List (search item)', 				'url'=>'searchresult_item'),
							)),							
							array('label'=>'Actives List Items', 				'url'=>'ActiveListItem'),
							array('label'=>'Top Status Text', 				'url'=>'TopStatusText'),
							array('label'=>'Jlbd dialog', 				'url'=>'jlbdDialog'),
							array('label'=>'Jlbd message', 				'url'=>'jlbdMessage'),
							array('label'=>'Jlbd Notify', 				'url'=>'jlbdNotify'),
						),
				));
				
			?>
			</div>
			<!-- menu.end -->

			<!-- wd-content -->
			<div id="wd-content">
				<!-- wrapper -->
				<div id="wd-wrapper">
					<?php echo $content; ?>
				</div>
				<!-- wrapper.end -->
			</div>
			<!-- wd-content.end -->
		</div>
		<!-- main.end -->

		<!-- footer -->
		<div id="wd-footer">Version 1.0</div>
		<!-- footer.end -->

	</div>
	

	<!-- script -->
	<?php GNAssetHelper::setBase('pattern')?>
	<?php GNAssetHelper::scriptFile('shCore')?>	
	<?php GNAssetHelper::scriptFile('shBrushCSharp')?>	
	<?php GNAssetHelper::cssFile('shCore')?>	
	<?php GNAssetHelper::cssFile('shThemeDefault')?>		
	<?php //GNAssetHelper::scriptFile('colortip-1.0-jquery')?>		
	<?php //GNAssetHelper::scriptFile('common')?>
	
	<!-- script.end -->
</body>
</html>