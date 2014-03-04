<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
		<?php
		//Yii::app()->clientScript->registerCoreScript('jquery');
		GNAssetHelper::init(array(
			'image' => 'img',
			'css' => 'css',
			'script' => 'js',
		));
		GNAssetHelper::setBase('justlook/myzone');
		// --- css
		GNAssetHelper::cssFile('bootstrap');
		GNAssetHelper::cssFile('bootstrap-responsive');
		GNAssetHelper::cssFile('datepicker');
		GNAssetHelper::cssFile('common');
		// --- script
		
		GNAssetHelper::scriptFile('jquery.min' , CClientScript::POS_HEAD);
		GNAssetHelper::scriptFile('bootstrap-transition');
		GNAssetHelper::scriptFile('bootstrap-alert');
		GNAssetHelper::scriptFile('bootstrap-modal');
		GNAssetHelper::scriptFile('bootstrap-dropdown');
		GNAssetHelper::scriptFile('bootstrap-scrollspy');
		GNAssetHelper::scriptFile('bootstrap-tooltip');
		GNAssetHelper::scriptFile('bootstrap-tab');
		GNAssetHelper::scriptFile('bootstrap-popover');
		GNAssetHelper::scriptFile('bootstrap-button');
		GNAssetHelper::scriptFile('bootstrap-collapse');
		GNAssetHelper::scriptFile('bootstrap-carousel');
		GNAssetHelper::scriptFile('bootstrap-typeahead');
		GNAssetHelper::scriptFile('bootstrap-datepicker');
		GNAssetHelper::scriptFile('common');

		?>
		<!-- Fav and touch icons -->
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo GNAssetHelper::getAssetPath()?>ico/apple-touch-icon-144-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo GNAssetHelper::getAssetPath()?>ico/apple-touch-icon-114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo GNAssetHelper::getAssetPath()?>ico/apple-touch-icon-72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="<?php echo GNAssetHelper::getAssetPath()?>ico/apple-touch-icon-57-precomposed.png">
		<link rel="shortcut icon" href="<?php echo GNAssetHelper::getAssetPath()?>ico/favicon.png">
	</head>

	<body>

		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container-fluid">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<a class="brand" href="#">MY ZONE</a>
					<div class="nav-collapse collapse">
						<ul class="nav">
							<li><a href="<?php echo GNRouter::createUrl('/zone/')?>">Home</a></li>
							<li><a href="<?php echo GNRouter::createUrl('/zone/schema')?>">Schema</a></li>
							<li><a href="<?php echo GNRouter::createUrl('/zone/schema?cmd=nodes')?>">Nodes</a></li>
						</ul>
					</div>
					<!-- /.nav-collapse -->
				</div>
			</div>
		</div>

		<div class="container-fluid">
			<div class="row-fluid">
				<?php echo $content ?>
			</div>

			<hr>

			<footer>
				<p>&copy; GREEN GLOBAL 2012</p>
			</footer>

		</div>
		<!-- /.container -->
	</body>
</html>
