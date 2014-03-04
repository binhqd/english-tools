<?php

class UserProperties extends GNWidget {

	public $zoneId;
	public $prop = null;
	public $type = 'ObjectNode';

	public function run() {
		
		if ($this->prop != null) {
			$properties = $this->prop;
			$this->render('user-properties', array(
				'properties' => $properties,
			));
		} else {
			if(currentUser()->hexID == $this->zoneId){
				
				$userProperties = ProfileController::userProperties(currentUser()->hexID);
				
				$this->render('profile-properties', array(
					'acceptEdit'=>true,
					'constructsBasic'=>$userProperties['constructsBasic'],
					'constructsOther'=>$userProperties['constructsOther'],
					'propertiesInfomation'=>$userProperties['propertiesInfomation'],
					'sumary'=>$userProperties['sumary'],
					'results'=>$userProperties['results'],
					'years'=>$userProperties['years'],
					'days'=>$userProperties['days'],
					'locations'=>$userProperties['locations'],
					'months'=>$userProperties['months'],
					'token'=>!empty($userProperties['token']) ? $userProperties['token'] : "",
				));
				
			}else{
				if($this->type == "ObjectNode"){
					$properties = ZoneInstanceRender::properties($this->zoneId);
					$this->render('user-properties', array(
						'properties' => $properties,
					));
				}else{
					// user view profile 
					$userProperties = ProfileController::userProperties($this->zoneId);
				
					$this->render('profile-properties', array(
						'acceptEdit'=>false,
						'constructsBasic'=>$userProperties['constructsBasic'],
						'constructsOther'=>$userProperties['constructsOther'],
						'propertiesInfomation'=>$userProperties['propertiesInfomation'],
						'sumary'=>$userProperties['sumary'],
						'results'=>$userProperties['results'],
						'years'=>$userProperties['years'],
						'days'=>$userProperties['days'],
						'locations'=>$userProperties['locations'],
						'months'=>$userProperties['months'],
						'token'=>!empty($userProperties['token']) ? $userProperties['token'] : "",
					));
				}
			}
			
		}
		
	}

}