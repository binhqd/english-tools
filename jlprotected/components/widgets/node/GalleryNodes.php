<?php

class GalleryNodes extends GNWidget {
	
	
	
	public $keyword = null;
	public $page = 'search';
	
	public function init() {
		
	}
	
	public function run() {
		$keyword = $this->keyword;
		
		$categories = ZoneCategories::model()->getCatMenu(5);
		
		$zoneInterestsCategories = ZoneInterestsCategories::model()->getInterestedForUser(currentUser()->id);
		$arrCategory = array();
		if(!empty($categories)){
			foreach($categories as $key=>$value){
				$arrCategory[] = $value->key_search;
			}
		}
		
		$userChooseCategory = array();
		if(!empty($zoneInterestsCategories)){
			foreach($zoneInterestsCategories as $key=>$value){
				if(!empty($value->categories) ){
					$userChooseCategory[$value->categories->source] = $value->categories->key_search;
				}
			}
		}
		$galleryNode = array();
		foreach($arrCategory as $key=>$cat){
			$galleryNode[$cat] = ZoneInstanceRender::search(null,8,0,InterestCondition::getValue($keyword,$cat));
		}
		
		// dump($galleryNode);
		// dump($userChooseCategory,false);
		// dump($arrCategory,false);		
		
		$isInterests = ZoneInterestsUsers::model()->isInterested(currentUser()->id);
		$active = "people";
		if(!$isInterests){
		
		}else{
			if(!empty($isInterests)){
				$category = ZoneCategories::model()->findByPk($isInterests->type_id);
				if(!empty($category)){
					$active = strtolower($category->key_search);
				}
				
			}
		}
		
		// $galleryNode = ZoneInstanceRender::search($keyword,8,0,$active);
		
		$this->render('gallery-nodes',array(
			
			'active'=>$active,
			'galleryNode'=>$galleryNode,
		));
	}
	
}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	