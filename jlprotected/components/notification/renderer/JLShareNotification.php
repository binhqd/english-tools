<?php 
Yii::import("application.components.notification.renderer.JLNotificationRenderer");
class JLShareNotification extends JLNotificationRenderer {
	public function render(&$data) {
		
        $owner = JLUser::model()->getUserInfo(IDHelper::uuidToBinary($data['user_id']));
        $msg = $data['content'];
        $strContentShare = '';
        
        if($data['object_type'] == 'business')
        {
           Yii::import('application.modules.businesses.models.*');
           $uuid = $data['object_id'];
           $objBiz = JLBusiness::model()->findByPk( IDHelper::uuidToBinary($data['object_id']));
           $strContentShare .= "<a href='".JLRouter::createUrl("/business/" . $objBiz->alias)."?rid={$uuid}'>{$objBiz->name}</a>";
          
           if(strlen($msg))
           {
                $strContentShare .= ' with message: "' . $msg . '"';
           }
           
           $data['defaultLink'] = JLRouter::createUrl("/business/" . $objBiz->alias);
        }
        
        if($data['object_type'] == 'list')
        {
           $strContentShare = ' the list ';
           $uuid = $data['object_id'];
           
           Yii::import('lists.models.*');
           try{
            $list = JLPublishedList::model()->getListInfo(IDHelper::uuidToBinary($uuid)); 
           }
           catch(Exception $e)
           {
                return ;
           }

           $strContentShare .= "<a href='".JLRouter::createUrl("/lists/published/view/listID/" .$uuid  )."'>" . $list['info']['title'] . "</a>";
          
           if(strlen($msg))
           {
                $strContentShare .= ' with message: "' . $msg . '"';
           }
           
           $data['defaultLink'] = JLRouter::createUrl("/lists/published/view/listID/" .$uuid  );
        }
        
        if($data['object_type'] == 'review')
        {
            $uuid = $data['object_id'];
            $review = JLReview::model()->findByPk(IDHelper::uuidToBinary($uuid));
			if (empty($review)) return null;
            $strContentShare = ' the review on ';
            $objBiz = $review->business;
            
            $strContentShare .= "<a href='".JLRouter::createUrl("/business/" . $objBiz->alias)."?rid={$uuid}'>{$objBiz->name}</a>";
          
          
           if(strlen($msg))
           {
                $strContentShare .= ' with message: "' . $msg . '"';
           }
           
           $data['defaultLink'] = JLRouter::createUrl("/business/" . $objBiz->alias)."?rid={$uuid}";
        }
		
		return "<a href='".JLRouter::createUrl("/dashboard?u=" . $owner->hexID)."'>{$owner->username}</a> share " . $strContentShare;
	} 
}