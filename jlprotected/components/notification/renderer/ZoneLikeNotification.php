<?php 
Yii::import("application.components.notification.renderer.JLNotificationRenderer");
class ZoneLikeNotification extends JLNotificationRenderer {
	public function render(&$data) {
		$notifier = ZoneUser::model()->getUserInfo(IDHelper::uuidToBinary($data['notifier_id']));
		if (empty($notifier)) return null;
		$receive = null;
		if(!empty($data['receive_id'])){
			$receive = ZoneUser::model()->getUserInfo(IDHelper::uuidToBinary($data['receive_id']));
		}
		
		if (empty($receive)) return null;
		$object = null;
		if(empty($data['type'])) return null;
		switch($data['type']){
			case "likeArticle":
				$object = ZoneArticle::model()->findByPk(IDHelper::uuidToBinary($data['object_id']));
				if (empty($object)) return null;
				$article_id = IDHelper::uuidFromBinary($object->id,true);
				$data['defaultLink'] = ZoneRouter::createUrl("/article?article_id=".$article_id);
				
				$format = '%s likes article %s';
				$userLink = "<a href='".ZoneRouter::createUrl("/profile/{$notifier->username}")."'>{$notifier->displayname}</a>";
				$article = "<a class='like-article-notification' href='".ZoneRouter::createUrl("/article?article_id={$article_id}")."'>{$object->title}</a>";
				
				
				
				$strImage = "";
				if(!empty($object->image)){
					$strImage = '<span class="floatR"><span class="wd-fr-albimg"></span><span class="wd-fr-img"><img src="'.ZoneRouter::CDNUrl("/upload/gallery/fill/50-50/{$object->image}").'" width="47" height="47" class="wd-jr" alt=""></span></span>';
				}
				$message = $strImage.'<div class="of_1">
					<p class="wd_tt_mn"><span>'.$notifier->displayname.'</span> like article <span>'.$object->title.'</span></p>
					<p class="wd-posttime"><span class="wd-icon-16 wd-icon-likes-ntf"></span><span class="timeago" title="'.$data['created'].'"></span></p>
				</div>';
				
				// $message = sprintf($format, $userLink,$article);
				return $message;
				
			break;
			case "likeAlbum":
				
				
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
				$format = '%s likes album %s';
				$userLink = "<a href='".ZoneRouter::createUrl("/profile/{$notifier->username}")."'>{$notifier->displayname}</a>";
				$album = "<a  href='".ZoneRouter::createUrl("/photos/viewPhoto?photo_id={$photo_id}&album_id={$album_id}")."' album_id='{$album_id}' photo_id='{$photo_id}' filename='{$images->image}'  class='lnkViewPhotoDetail like-album-notification'>{$object->title}</a>";
				
				$message = $strImage.'<div class="of_1">
					<p class="wd_tt_mn"><span>'.$notifier->displayname.'</span> like album <span>'.$object->title.'</span></p>
					<p class="wd-posttime"><span class="wd-icon-16 wd-icon-likes-ntf"></span><span class="timeago" title="'.$data['created'].'"></span></p>
				</div>';
				
				// $message = sprintf($format, $userLink,$album);
				return $message;
				
			break;
			case "likeImage":
				$object = ZoneResourceImage::model()->findByPk(IDHelper::uuidToBinary($data['object_id']));
				if (empty($object)) return null;
				
				$images = $object;
				$album_id = IDHelper::uuidFromBinary($object->album_id,true);
				$photo_id = IDHelper::uuidFromBinary($images->id,true);
				$format = '%s likes photo for album %s';
				$userLink = "<a href='".ZoneRouter::createUrl("/profile/{$notifier->username}")."'>{$notifier->displayname}</a>";
				$album = "<a href='".ZoneRouter::createUrl("/photos/viewPhoto?photo_id={$photo_id}&album_id={$album_id}")."' album_id='{$album_id}' photo_id='{$photo_id}' filename='{$images->image}'  class='lnkViewPhotoDetail'>{$object->title}</a>";
				
				
				$message = sprintf($format, $userLink,$album);
				return $message;
				
			break;
			case "likeStatus":
				$object = ZoneStatus::model()->findByPk(IDHelper::uuidToBinary($data['object_id']));
				if (empty($object)) return null;
				$format = '%s likes  status: "'.JLStringHelper::char_limiter_word($object->title,100).'"';
				$userLink = "<a href='".ZoneRouter::createUrl("/profile/{$notifier->username}")."' class='like-status' status_id='".IDHelper::uuidFromBinary($object->id,true)."'>{$notifier->displayname}</a>";
				
				
				$message = '<div class="of_1">
						<p class="wd_tt_mn">'.$userLink.' like status "'.JLStringHelper::char_limiter_word($object->title,100).'"</p>
						<p class="wd-posttime"><span class="wd-icon-16 wd-icon-likes-ntf"></span><span class="timeago" title="'.$data['created'].'"></span></p>
					</div>';
				
				// $message = sprintf($format, $userLink);
				return $message;
				
				
			break;
		}
		
		
		
		
	}
}