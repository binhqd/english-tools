<?php
class Filter extends GNWidget {
	public	$url		= null;
	public $strToken = null;
	public $containerShow = "#articleSelector";
	
	
	public function init() {
		GNAssetHelper::init(array(
			'image'		=> 'img',
			'css'		=> 'css',
			'script'	=> 'js',
		));
		GNAssetHelper::setBase("widgets.filter.assets");
		
		GNAssetHelper::scriptFile('filter', CClientScript::POS_END);
	}
	
	public function run() {
		
		
		$this->strToken = md5(uniqid(32));
		
		$this->render('index');
	}
	
}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	