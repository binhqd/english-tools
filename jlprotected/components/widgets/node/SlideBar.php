<?php

class SlideBar extends GNWidget {
	// public	$url		= null;
	public $nodeId = null;
	
	
	
	
	public function init() {
		
	}
	
	public function run() {
		
		$relateds = ZoneArticleNamespace::model()->nodeToolBar($this->nodeId);
		// dump($relateds);
		$this->render('slidebar',array(
			
			'relateds'=>$relateds
		));
	}
	
}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	