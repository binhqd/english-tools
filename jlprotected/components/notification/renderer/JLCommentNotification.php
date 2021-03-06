<?php 
Yii::import("application.components.notification.renderer.JLNotificationRenderer");

class JLCommentNotification extends JLNotificationRenderer
{
	public function render(&$data)
	{
		Yii::import('application.modules.reviews.models.JLComment');
		$commentor = JLUser::model()->getUserInfo(IDHelper::uuidToBinary($data['commentor_id']));
		if (empty($commentor)) return null;
		
		$object_id = $data['object_id'];
		$object_type = $data['object_type'];
		switch ($object_type) {
			case JLComment::TYPE_REVIEW:
				Yii::import('application.modules.reviews.models.JLReview');
				$review = JLReview::model()->findByPk(IDHelper::uuidToBinary($object_id));
				if (empty($review)) return null;
				Yii::import('application.modules.businesses.models.JLBusiness');
				$business = JLBusiness::model()->getInfo(IDHelper::uuidFromBinary($review->business_id));
				if (empty($business)) return null;
				
				$data['defaultLink'] = JLRouter::createUrl('/business/'.$business['alias']).'?rid='.IDHelper::uuidFromBinary($review->id).'#/section/?highlightreview='.IDHelper::uuidFromBinary($review->id);
				return "<a href='".JLRouter::createUrl("/dashboard?u=" . $commentor->hexID)."'>{$commentor->username}</a> wrote new comment to <a href='{$data['defaultLink']}'>your review</a>";
				
				break;
			case JLComment::TYPE_PHOTO:
			case JLComment::TYPE_CONTRIBUTE_PHOTO:
				$currentUser = currentUser();
				$type = $object_type;
				$src = '';
				$photoID = $object_id;
				$size = array(0,0);
				if ($type == JLComment::TYPE_PHOTO) {
					Yii::import('application.modules.user.models.JLUserAvatar');
					$photo = JLUserAvatar::model()->with($currentUser->hexID)->getAvatar($photoID);
					if ($photo) {
						$src = JLRouter::createUrl('/upload/user-photos/'.$currentUser->hexID.'/fill/400-250/'.$photo->metadata['info']['basename']);
						$linkPhoto = JLRouter::createUrl('/user/photos/showGallery', array('uid'=>$currentUser->hexID, 'imgID'=>$photoID));
						$size = $photo->imageSize;
					}
				} else if ($type == JLComment::TYPE_CONTRIBUTE_PHOTO) {
					Yii::import('application.modules.photo.models.JLContributePhoto');
					$photo = JLContributePhoto::model()->getPhoto($photoID);
					if ($photo) {
						$src = JLRouter::createUrl('/upload/business/fill/400-250/'.$photo->metadata['info']['basename']);
						$linkPhoto = JLRouter::createUrl('/businesses/photos/showGallery', array('uid'=>$currentUser->hexID, 'imgID'=>$photoID));
						$size = $photo->imageSize;
					}
				}
				if (empty($src)) return null;
				
				$data['defaultLink'] = $linkPhoto;
				return "<a href='".JLRouter::createUrl("/dashboard?u=" . $commentor->hexID)."'>{$commentor->username}</a> wrote new comment to <a href='{$linkPhoto}' class='wd-thumbnail viewPhotoDetail' preferWidth='{$size[0]}' preferHeight='{$size[1]}'>your photo</a>";
				
				break;
		}
	} 
}