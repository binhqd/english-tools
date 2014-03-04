<?php 
Yii::import("application.components.notification.renderer.JLNotificationRenderer");
class ZoneCommentNotification extends JLNotificationRenderer {
	public function render(&$data) {
		
		$notifier = ZoneUser::model()->getUserInfo(IDHelper::uuidToBinary($data['notifier_id']));
		if (empty($notifier)) return null;
		
		$receive = null;
		
		if(!empty($data['receive_id'])){
			$receive = ZoneUser::model()->getUserInfo(IDHelper::uuidToBinary($data['receive_id']));
		}
		
		if (empty($receive)) return null;
		// dump($data);
		$object = null;
		if(empty($data['type'])) return null;
		switch($data['type']){
			case "commentAlbum":
			
			
				$object = ZoneResourceAlbum::model()->findByPk(IDHelper::uuidToBinary($data['object_id']));
				if (empty($object)) return null;
				$album_id = IDHelper::uuidFromBinary($object->id,true);
			
				$data['defaultLink'] = ZoneRouter::createUrl('/resource/album?album_id=' . $album_id);
			
				$images = ZoneResourceImage::model()->findByAttributes(array(
					'album_id'=>$object->id
				));
				$strImage = "";
				if(empty($images)) return null;
				else{
					$strImage = '<span class="floatR"><span class="wd-fr-albimg"></span><span class="wd-fr-img"><img src="'.ZoneRouter::CDNUrl("/upload/gallery/fill/50-50/{$images->image}").'" width="47" height="47" class="wd-jr" alt=""></span></span>';
				}
				$photo_id = IDHelper::uuidFromBinary($images->id,true);
				$format = '%s comment on album: %s';
				$userLink = "<a href='".ZoneRouter::createUrl("/profile/{$notifier->username}")."'>{$notifier->displayname}</a>";
				$album = "<a href='".ZoneRouter::createUrl("/photos/viewPhoto?photo_id={$photo_id}&album_id={$album_id}")."' album_id='{$album_id}' photo_id='{$photo_id}' filename='{$images->image}'  class='lnkViewPhotoDetail'>{$object->title}</a>";
				
				$message = $strImage.'<div class="of_1">
					<p class="wd_tt_mn"><span>'.$notifier->displayname.'</span>  commented on <span>'.$object->title.'</span> album.</p>
					<p class="wd-posttime"><span class="wd-icon-16 wd-icon-commented-ntf"></span><span class="timeago" title="'.$data['created'].'"></span></p>
				</div>';
				
				// $message = sprintf($format, $userLink,$album);
				return $message;
				
			break;
			case "commentStatus":
				$author = null;
				if(!empty($data['author_id'])){
					$author = ZoneUser::model()->getUserInfo(IDHelper::uuidToBinary($data['author_id']));
				}
				
				if (empty($author)) return null;
				$object = ZoneStatus::model()->findByPk(IDHelper::uuidToBinary($data['object_id']));
				if (empty($object)) return null;
				
				$userLink = "<a href='".ZoneRouter::createUrl("/profile/{$notifier->username}")."' class='comment-status' comment_id='".$data['comment_id']."' status_id='".IDHelper::uuidFromBinary($object->id,true)."'>{$notifier->displayname}</a>";
				
				if(empty($data['content'])){
					$format = '<p class="wd_tt_mn"><span>'.$notifier->displayname.'</span>  commented on <span>'.$author->displayname.'</span> status.</p>';
				}else{
					$format = '<p class="wd_tt_mn"><span>'.$notifier->displayname.'</span>  commented on <span>'.$author->displayname.'</span> status "'.JLStringHelper::char_limiter_word($data['content'],150).'"</p>';
				}
				if(empty($data['comment_id']))
					$receiveLink = "<a href='".ZoneRouter::createUrl("/profile/{$author->username}")."' >{$author->displayname}</a>";
				else
					$receiveLink = "<a href='".ZoneRouter::createUrl("/profile/{$author->username}")."' class='notiCommentStatus' object_id='".$data['object_id']."' comment_id='".$data['comment_id']."'>{$author->displayname}</a>";
				
				
				$message = '<div class="of_1">'.$format.'
					<p class="wd-posttime"><span class="wd-icon-16 wd-icon-commented-ntf"></span><span class="timeago" title="'.$data['created'].'"></span></p>
				</div>';
				
				// $message = sprintf($format, $userLink,$receiveLink);
				
				
				return $message;
				
				
			break;
		}
		
		
		
		
	}
}