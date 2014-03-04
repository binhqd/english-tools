<!DOCTYPE html >
<html>
<head>
	<?php 
	GNAssetHelper::init(array(
		'image'		=> 'img',
		'css'		=> 'css',
		'script'	=> 'js'
	));
	?>
	<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<?php GNAssetHelper::setBase('search_engine');?>
	<?php GNAssetHelper::cssFile('demo');?>
</head>
<body>
<!-- HEADER -->
<div class="demo_header">
	<div class="demo_bg_banner">
		<div class="demo_bg_top">
			<div class="demo_clear">&nbsp;</div>
			<form action="<?php echo $this->createAbsoluteUrl('/search/business/') ?>">
			<div class="demo_search">
				
				<?php 
				if(isset($_GET['keyword']))
					$keyword = $_GET['keyword'];
				else
					$keyword = '';
				
				$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
					'name'=>'keyword',
					'value'=> $keyword,
					'source'=>$this->createAbsoluteUrl('/search/autocompleteKeyword'),
					// additional javascript options for the autocomplete plugin
					'options'=>array(
							'showAnim'=>'fold',
							'minLength' => '3',
							'autoFocus' => true,
					),
					'htmlOptions'=>array(
						'class'=>'demo_search_first'
					),
				));
				?>

				<?php 
				if(isset($_GET['location']) && $_GET['location'] != "")
				{
					$location = $_GET['location'];
				}					
				else
					$location = 'Sydney , NSW';
					
				$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
					'name' => 'location',
					'value' =>  $location,
					'source'=>$this->createAbsoluteUrl('/search/autocompleteLocation'),
					// additional javascript options for the autocomplete plugin
					'options'=>array(
							'showAnim'=>'fold',
							'minLength' => '3',
							'autoFocus' => true,
					),					
					'htmlOptions'=>array(
						'class'=>'demo_search_last'
					),
				));
				?>
				
			
			</div>
			<div class='demo-button-search'>
				<div class="demo-bt-search">
					<input type="submit" value="">	
				</div>
			</div>
			</form>
		</div>
		<!-- MENU -->
		<?php
		$arrMenu = array(
			array(
				'label'		=>	'user home',
				'url'		=>	'',
				'itemOptions' => array('class' => 'wd-home'),
				'items'		=>	null,
			),
			array(
				'label'		=>	'reviews',
				'url'		=>	'',			
				'items'		=>	null,
			),
			array(
				
				'label'		=>	'list',
				'url'		=>	'#',
				'items'		=>	null,
			),
			array(
				'label'		=>	'gallery',
				'url'		=>	'#',
				'items'		=>	null,
			),
			array(
				'active'	=> false,
				'label'		=>	'favourite',
				'url'		=>	'',
				'items'		=>	null,
			),
			array(
				
				'label'		=>	'searches',
				'url'		=>	'#',
				'items'		=>	null,
			),
			array(
				'label'		=>	'friends',
				'url'		=>	'#',
				'items'		=>	array(
					array(
						'label'		=>	'recent activities',
						'url'		=>	'#',
						'items'		=>	null,
					),
					array(
						'label'		=>	'find friend',
						'url'		=>	'#',
						'items'		=>	null,
					),
					array(
						'label'		=>	'friend manager',
						'url'		=>	'',
						'items'		=>	null,
					),
					array(
						'label'		=>	'group',
						'url'		=>	'#',
						'items'		=>	array(
							array(
								'label'		=>	'recent activities',
								'url'		=>	'#',
								'items'		=>	null,
							),
							array(
								'label'		=>	'find friend',
								'url'		=>	'',
								'items'		=>	null,
							),
							array(
								'label'		=>	'friend manager',
								'url'		=>	'#',
								'items'		=>	null,
							),
							array(
								'label'		=>	'group',
								'url'		=>	'#',
								'items'		=>	null,
							),
						)
					),
				)
			),
			array(					
				'label'		=>	'reviewers',
				'url'		=>	'#',
				'items'		=>	null,
			),
			array(
				
				'label'		=>	'websites',
				'url'		=>	'#',
				'items'		=>	null,
			),
		);			
		$this->widget('widgets.multi-menu.JLBDUserMenu', array(
			'htmlOptions' 	=> array("class" => 'wd-dropdownMenu'),
			'id'=>'wd-top-menu',
			'encodeLabel' => false,	
			//'imgHome'	=>	'nav-avatar.jpg',
			'arrMenu' => $arrMenu,
		));			
		?>		
		<!-- END MENU -->
	</div>
</div>
<!-- END HEADER -->
<?php echo $content;?>
<!-- BOTTOM -->
<div class="demo_bottom"></div>
<!-- END BOTTOM -->	

</body>
</html>
