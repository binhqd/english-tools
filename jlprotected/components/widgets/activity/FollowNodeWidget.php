<?php
/**
 * This widget is used to render activity on wall
 * @author huytbt
 * @version 1.0
 * @created 2013-07-12 01:58 PM
 */
class FollowNodeWidget extends GNWidget
{
	public $activity;

	/**
	 * This method is used to run widget
	 */
	public function run()
	{
		// Set view path for render
		$viewPath = 'application.views.common.activity.follow_node';

		// Get node information
		$node = $this->_getNodeInfo(IDHelper::uuidFromBinary($this->activity->object_id, true));
		if (empty($node)) return;

		// Get user information
		$user = ZoneUser::model()->getUserInfo($this->activity->user_id);
		if (empty($user) || $user->isGuest) return;

		$owner = ZoneUser::model()->getUserInfo(IDHelper::uuidToBinary($node['owner_id']));

		// Action follow
		$isFollowing = false;
		if (!currentUser()->isGuest) {
			currentUser()->attachBehavior('UserFollowing', 'application.modules.followings.components.behaviors.GNUserFollowingBehavior'); // Attach behavior following for user
			$isFollowing = currentUser()->isFollowing(IDHelper::uuidToBinary($node['zone_id']));
			currentUser()->detachBehavior('UserFollowing');
		}
		Yii::import('application.modules.followings.models.ZoneFollowing');
		$countFollowers = ZoneFollowing::model()->countFollowers(IDHelper::uuidToBinary($node['zone_id']));

		// Render view
		$this->render($viewPath, array(
			'node'			=> $node,
			'user'			=> $user,
			'owner'			=> $owner,
			'isFollowing'	=> $isFollowing,
			'countFollowers'=> $countFollowers,
		));
	}

	/**
	 * This method is used to get node information
	 * @param String $strNodeId IS of node
	 */
	private function _getNodeInfo($strNodeId)
	{
		$image = null;
		$album_id = null;
		$resourceImage = ZoneResourceImage::getNamespaceImage($strNodeId);
		if (!empty($resourceImage)) {
			$image = $resourceImage->image;
			$album_id = $resourceImage->albumID;
		}
		$node = ZoneInstance::initNode($strNodeId);
		$properties = null;
		if (!empty($node))
			$properties = $node->node->getProperties();
		if (empty($properties)) return null;
		$owner = $node->getOwner();
		$description = '';
		try {
			$extraProperties = ZoneInstanceRender::properties($strNodeId);
			if (isset($extraProperties['/common/topic/description'][1][0]['value']))
				$description = $extraProperties['/common/topic/description'][1][0]['value'];
		} catch (Exception $ex) {}

		return array(
			'zone_id'		=> $properties['zone_id'],
			'owner_id'		=> $owner['zone_id'],
			'album_id'		=> $album_id,
			'name'			=> $properties['name'],
			'image'			=> $image,
			'description'	=> $description,
		);
	}
}