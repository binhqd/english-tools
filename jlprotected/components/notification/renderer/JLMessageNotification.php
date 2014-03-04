<?php 
Yii::import("application.components.notification.renderer.JLNotificationRenderer");
class JLMessageNotification extends JLNotificationRenderer {
	public function render(&$data){
		if($data['label']=='people'){
			$prf_link = '/profile?u='.$data['sender_id'];
			$msg_link = '/messages?prt=node#m/'.$data['message_id'];
			$message = '<a href="'.$prf_link.'">'.$data['sender_name'].'</a> sent you a message. <a href="'.$msg_link.'">Read it</a>';	
		}
		else{
			Yii::import('application.modules.messages.components.PMAssistant');
			$uid = currentUser()->hexID;
			$prf_link = '/business/details?uuid='.$data['sender_id'];
			$msg_link = '/messages?prt=node#m/'.$data['message_id'];
			if($data['biz_owner']==$uid){
				$message = 'New message from <a href="'.$prf_link.'">'.$data['sender_name'].'</a>. <a href="'.$msg_link.'">Read it</a>';	
			}
			else{
				$message = 'New message to your business <a href="'.$prf_link.'">'.$data['sender_name'].'</a>. <a href="'.$msg_link.'">Read it</a>';	
			}
		}
		$data['defaultLink'] = $msg_link;
		return $message;
	} 
	
}