<?php

class ZoneController extends GNController {
	public $categories = array();
	public function init(){
		
		if(currentUser()->isGuest){
			$this->categories = ZoneCategories::model()->getCategories(10);
		}else{
			$zoneInterestsCategories = ZoneInterestsCategories::model()->getInterestedForUser(currentUser()->id);
			$countInterestCat = ZoneInterestsCategories::model()->countInterested(currentUser()->id);
			
			// if(!empty($zoneInterestsCategories) && (Yii::app()->getModule('interest')->limitTopic - $countInterestCat)<=0 ){
			if(!empty($zoneInterestsCategories)){
				foreach($zoneInterestsCategories as $key=>$value){
					$this->categories[] = (object) $value->categories->attributes;
				}
			}else{
				$this->categories = ZoneCategories::model()->getCategories(10);
				// $this->redirect(ZoneRouter::createUrl('/interest'));
			}
		}
		
	
		parent::init();
	}
}