<?php
class UserNodeLabels extends GNWidget {
	public $user;
	
	public function run() {
		$user = $this->user;
		
		$labels = ZoneInstanceRender::labels($user->hexID);
		
		// dump($user->hexID,false);
		// dump($labels);
		$this->render('user-node-label',array(
			'user'=>$user,
			'labels'=>$labels,
			
		));
	}
}