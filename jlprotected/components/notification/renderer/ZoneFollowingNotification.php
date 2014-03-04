<?php 
Yii::import("application.components.notification.renderer.JLNotificationRenderer");
class ZoneFollowingNotification extends JLNotificationRenderer
{
	public function render(&$data) {
		$notifier = ZoneUser::model()->getUserInfo(IDHelper::uuidToBinary($data['notifier_id']));
		if (empty($notifier)) return null;
		$node = $this->_getNodeInfo($data['object_id']);
		if(empty($data['type'])) return null;
		switch ($data['type']) {
			case "followNode":
				$data['defaultLink'] = GNRouter::createUrl("/zone/pages/detail/id/".$node['zone_id']);
				
				$image = '<span class="floatR"><span class="wd-fr-img"><img src="'.ZoneRouter::CDNUrl("/upload/gallery/fill/50-50/{$node['image']}").'" width="47" height="47" class="wd-jr" alt=""></span></span>';
				
				$message = $image.'<div class="of_1">
					<p class="wd_tt_mn"><span>'.$notifier->displayname.'</span>  following topic <span>'.$node['name'].'</span></p>
					<p class="wd-posttime"><span class="wd-icon-16 wd-icon-following-ntf"></span><span class="timeago" title="'.$data['created'].'"></span></p>
				</div>';
				
				return $message;
				// return "<a href='".GNRouter::createUrl("/profile/" . $notifier->username)."'>{$notifier->displayname}</a> follow <a href='".GNRouter::createUrl("/zone/pages/detail", array('id'=>$node['zone_id']))."'>{$node['name']}</a>";
				break;
		}
	}

	/**
	 * This method is used to get node information
	 * @param String $strNodeId IS of node
	 */
	private function _getNodeInfo($strNodeId)
	{
		$image = null;
		$resourceImage = ZoneResourceImage ::getNamespaceImage($strNodeId);
		if (!empty($resourceImage))
			$image = $resourceImage->image;
		$node = (ZoneInstance::initNode($strNodeId) != null ) ? ZoneInstance::initNode($strNodeId)->node->getProperties() : null;
		if (empty($node)) return null;
		return array(
			'zone_id'	=> $node['zone_id'],
			'name'		=> $node['name'],
			'image'		=> $image,
		);
	}
}