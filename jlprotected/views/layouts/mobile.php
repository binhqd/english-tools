<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<?php 
	GNAssetHelper::init(array(
		'image'		=> 'img',
		'css'		=> 'css',
		'script'	=> 'js',
	));
	?>
	<?php GNAssetHelper::setBase('back_end');?>
		<?php
			GNAssetHelper::setBase('justlook');
			GNAssetHelper::setPriority(100);
			GNAssetHelper::scriptFile('jlbd', CClientScript::POS_HEAD);
			GNAssetHelper::cssFile('jlbd.message');
			GNAssetHelper::cssFile('jlbd.dialog');
			GNAssetHelper::cssFile('jlbd.notify');
			GNAssetHelper::cssFile('jl-alert-bootraps');
			GNAssetHelper::cssFile('jquery.fancybox-1.3.4');
			GNAssetHelper::cssFile('validationEngine.jquery');
			/** Add css file : Disable item menu is null **/
			GNAssetHelper::cssFile('menu-mutil-disable');
			GNAssetHelper::cssFile('admin-manage-business');
			
			GNAssetHelper::scriptFile('jlbd.message', CClientScript::POS_END);
			GNAssetHelper::scriptFile('jlbd.dialog', CClientScript::POS_END);
			GNAssetHelper::scriptFile('jlbd.notify', CClientScript::POS_END);
			GNAssetHelper::scriptFile('jquery.fancybox-1.3.4.pack');
			GNAssetHelper::scriptFile('jquery.validationEngine', CClientScript::POS_END);
			GNAssetHelper::scriptFile('jquery.validationEngine-en', CClientScript::POS_END);
			
			GNAssetHelper::setBase('ext.bootstrap.assets', 'bootstrap');
			GNAssetHelper::cssFile('bootstrap');
			GNAssetHelper::cssFile('bootstrap-responsive');
			
			GNAssetHelper::scriptFile('bootstrap-tooltip', CClientScript::POS_BEGIN);
			GNAssetHelper::scriptFile('bootstrap-popover', CClientScript::POS_BEGIN);
			GNAssetHelper::scriptFile('bootstrap-dropdown', CClientScript::POS_BEGIN);
			GNAssetHelper::scriptFile('bootstrap-collapse', CClientScript::POS_BEGIN);
		?>
		
		<style>
		.required span{color:red;}
		</style>
	</head>

	<body>
		<div style="margin:0 auto;">
			<?php echo $content;?>
		</div>
		
		<?php $this->beginWidget('widgets.JLScriptPacker', array(
			'id'	=> 'dashboardLayoutScript',
			'type'	=> 'js',
			'position'	=> CClientScript::POS_READY
		))?>
			// loading for autocomplete
			var __response = $.ui.autocomplete.prototype._response;
			$.ui.autocomplete.prototype._response = function(content) {
				__response.apply(this, [content]);
				this.element.trigger("autocompletesearchcomplete", [content]);
			};
		<?php $this->endWidget();?>
		
	</body>
</html>
