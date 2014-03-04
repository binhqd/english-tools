<!DOCTYPE HTML>
<html lang="en">
<head>
	<!-- Force latest IE rendering engine or ChromeFrame if installed -->
	<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<?php
		GNAssetHelper::init(array(
			'image'		=> 'img',
			'css'		=> 'css',
			'script'	=> 'js',
		));
		GNAssetHelper::setBase('themes.bootstrap');
		GNAssetHelper::cssFile('main');
		//GNAssetHelper::scriptFile('common', CClientScript::POS_HEAD);

		Yii::app()->jlbd->register(); // Register JLBD Library

		Yii::app()->bootstrap->register(); // Register bootstrap
	?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<!--[if lt IE 7]><link rel="stylesheet" href="http://blueimp.github.com/cdn/css/bootstrap-ie6.min.css"><![endif]-->
	<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>

<body>
<?php 
$menu = array();
if (currentUser()->isGuest) {
	$menu[] = array(
		'class'=>'bootstrap.widgets.TbMenu',
		'htmlOptions'=>array('class'=>'pull-right'),
		'items'	=> array(
			array('label'=>'Login with Facebook', 'url'=>array('/facebook'))
		)
		
	);
} else {
	$menu[] = array(
		'class'=>'bootstrap.widgets.TbMenu',
		'htmlOptions'=>array('class'=>'pull-right'),
		'items'	=> array(
			array('label'=>'Logout', 'url'=>array('/logout'))
		)
	);
	$menu[] = array(
		'class'=>'bootstrap.widgets.TbMenu',
		'htmlOptions'=>array('class'=>'pull-right'),
		'items'	=> array(
			array('label'=>'Profile', 'url'=>array('/profile'))
		)
	);
	
}
// dump($menu);
?>

<?php $this->widget('bootstrap.widgets.TbNavbar', array(
	// 'type'=>'inverse', // null or 'inverse'
	'brand'=>CHtml::encode(Yii::app()->name),
	'brandUrl'=>'/',
	'collapse'=>true, // requires bootstrap-responsive.css
	'items'	=> $menu
)); ?>

<div class="container" id="page">
	<?php echo $content; ?>
</div><!-- page -->

</body>
</html>
