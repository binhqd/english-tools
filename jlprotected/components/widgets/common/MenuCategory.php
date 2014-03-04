<?php
class MenuCategory extends GNWidget {
	public $page = null;
	public function run() {
		
		$menu = array();
		$arrId = array();
		if(currentUser()->isGuest){
			$menu = ZoneCategories::model()->getCategories(10);
		}else{
			$isInterests = ZoneInterestsUsers::model()->isInterested(currentUser()->id);
			$zoneInterestsCategories = ZoneInterestsCategories::model()->getInterestedForUser(currentUser()->id);
			
			if(!empty($zoneInterestsCategories)){
				foreach($zoneInterestsCategories as $key=>$value){
					
					$arrId[] = $value->categories->id;
					$menu[] = (object) $value->categories->attributes;
					
				}
			}
		}
		
		//TODO: 
		if(empty($menu)){
			$menu = ZoneCategories::model()->getCategories(10);
			foreach($menu as $item){
				$arrId[] = $item->id;
			}
		}
		
		$this->render('menu',array(
			'page'=>$this->page,
			'menu'=>$menu,
			'isInterests'=>(!empty($isInterests)) ? $isInterests : null,
			'zoneInterestsCategories'=>(!empty($zoneInterestsCategories)) ? $zoneInterestsCategories : null,
			'checkInMenu'=>(!empty($isInterests) && in_array($isInterests->type_id,$arrId)) ? true : false
		));
	}
};