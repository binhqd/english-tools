<?php
if(!empty($listComments)){
	$controller = Yii::app()->controller;
	foreach($listComments as $key=>$comment){
		$comment = (object) $comment;
		
		$controller->renderPartial($viewPath, array(
			'comment'=>$comment,
			'show'=>!empty($show) ? true : false
		));
// 		break;
	}
}
?>