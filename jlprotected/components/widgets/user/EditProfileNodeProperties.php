<?php
class EditProfileNodeProperties extends GNWidget {
	public $nodes;
	public $nameType;
	public $acceptEdit = true;
	
	public function run() {
		
		$zoneId = "";
		if(!empty($this->nodes['node']['zone_id'])){
			$zoneId = $this->nodes['node']['zone_id'];
		}
		$objNode = ZoneInstance::initNode($zoneId);
		$Manager = new ZoneInstanceManager('/people/user');
		// $eduration = ZoneInstance::initNode($node)->properties();
		$results = $Manager->values($objNode);
		$token = "";
		if(!empty($results['token'])) $token = $results['token'];
		
		
		
		$data = array();
		$properties = $objNode->properties;
		// dump($properties,false);
		$arrDataSingle = array();
		if(!empty($properties)):
			$tmpCnt = 0;
			foreach($properties as $key=>$property):
				// dump($property,false);
				list($prop, $values) = $property;
				
				// dump($prop,false);
				if(is_array($values[0])){
					if(!empty($values[0]['zone_id']) ){
						if($values[0]['zone_id']!= currentUser()->hexID){
							$data['title'][$tmpCnt]['name'] = $values[0]['name'];
							$data['title'][$tmpCnt]['zone_id'] = $values[0]['zone_id'];
							
							
							$arrDataSingle[$tmpCnt]['name'] = $values[0]['name'];
							$arrDataSingle[$tmpCnt]['zone_id'] =  $values[0]['zone_id'];
							$arrDataSingle[$tmpCnt]['label'] = $prop['name'];
							$arrDataSingle[$tmpCnt]['expected'] = $prop['expected'];
							$tmpLabel = strtolower($prop['name']);
							$tmpLabel = str_replace(" ","",$tmpLabel);
							$tmpLabel = str_replace(",","",$tmpLabel);
							$tmpLabel = str_replace("-","",$tmpLabel);
							$arrDataSingle[$tmpCnt]['tmp'] = $tmpLabel;
						}
						
					}else{
						$data['title'][$tmpCnt]['name'] = "";
						$data['title'][$tmpCnt]['zone_id'] = "";
					}
					
				}else{
					
					if($prop['expected'] == "/type/datetime"){
						$data['other']['/type/datetime'][] = $values[0];
						
						$arrDataSingle[$tmpCnt]['label'] = $prop['name'];
						$tmpLabel = strtolower($prop['name']);
						$tmpLabel = str_replace(" ","",$tmpLabel);
						$tmpLabel = str_replace(",","",$tmpLabel);
						$tmpLabel = str_replace("-","",$tmpLabel);
						$arrDataSingle[$tmpCnt]['tmp'] = $tmpLabel;
						$arrDataSingle[$tmpCnt]['name'] = $values[0];
						$arrDataSingle[$tmpCnt]['zone_id'] = '';
						$arrDataSingle[$tmpCnt]['expected'] = $prop['expected'];
					}else{
						$data['other']['text'] = $values[0];
					}
				}
				
				$tmpCnt++;
				// dump($prop,false);
				// dump($values[0],false);

			endforeach;
		endif;
		if(!empty($data['title'])) sort($data['title']);
		if(!empty($arrDataSingle)) sort($arrDataSingle);
		// dump($data,false);
		
		
		$this->render('edit-user-properties',array(
			'properties'=>$objNode->properties,
			'acceptEdit'=>$this->acceptEdit,
			'objNode'=>$objNode,
			'data'=>$data,
			'token'=>$token,
			'arrDataSingle'=>$arrDataSingle,
			'nameType'=>$this->nameType,
			
		));
	}
	public static function renderFailDate($s,$e) { 
		$start = explode("-",$s);
		$end = explode("-",$e);
		$strDate = "";
		switch(count($start)){
			case 3:
				// TODO:
			break;
			case 2:
				switch(count($end)){
					case 0:
						$strDate = date("M",strtotime("1970-".$start[1]."-01")) ." ". $start[0] ." to ".$end;
					break;
					case 1:
						$strDate = date("M",strtotime("1970-".$start[1]."-01")) ." ". $start[0] ." to ". $end[0];
					break;
					case 2:
						$strDate = date("M",strtotime("1970-".$start[1]."-01")) ." ". $start[0] ." to ". date("M",strtotime("1970-".$end[1]."-01")) . " " . $end[0] ;
					break;
				}
				
			break;
			case 1:
				switch(count($end)){
					case 0:
						$strDate = $start[0] ." to ".$end;
					break;
					case 1:
						$strDate = $start[0] ." to ". $end[0];
					break;
					case 2:
						$strDate = $start[0] ." to ". date("M",strtotime("1970-".$end[1]."-01")) . " " . $end[0] ;
					break;
				}
			break;
		}
		echo $strDate;
	}
	public static function checkDate($mydate) { 
	
		return MyZoneHelper::checkDate($mydate);
		
		
	} 
}