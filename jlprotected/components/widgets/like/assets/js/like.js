function initLike(token, callback){
	var $obj			= $("#likeNodeObject"+token);
	if($obj.attr('acceptClick') == "false") return false;
	$obj.attr('acceptClick',"false");
	
	var $parent			= $obj.parent('.coregreennet-wd-rating');
	var $object_id		= $parent.attr('object_id');
	var $node_id		= $obj.attr('nodeId');
	var $action			= $obj.attr('action');
	
	var $rating_value	= $obj.attr('rating_value');
	var $rating_type	= $parent.attr('rating_type');
	
	var $classLike		= $obj.attr('classLike');
	var $classUnlike	= $obj.attr('classUnlike');
	var $actionLike		= $obj.attr('actionLike');
	var $actionUnlike	= $obj.attr('actionUnlike');

	$.ajax({
		url		: $action,
		type	: 'POST',
		datatype: 'json',
		data	: 'object_id=' + $object_id
					+ '&rating_type=' + $rating_type
					+ '&node_id=' + $node_id
					+ '&rating_value=' + $rating_value,
		success	: function($res){
			if ($res != null) {
				$("#stringLike"+token).html($res.people);
				$obj.attr('rating_value', $res.value);
				$obj.attr('number', $res.number);
				$obj.text($res.value);
				
				if ($res.value=='Like') {
					
					$obj.removeClass($classLike);
					$obj.addClass($classUnlike);
					$obj.attr('action', $actionLike);
				} else {
					$obj.removeClass($classUnlike);
					$obj.addClass($classLike);
					$obj.attr('action', $actionUnlike);
				}
				try{
					$('.wd-tooltip-hover-html').tipsy({html: true,gravity: 's',fade: true});
				}catch(e){
				
				}
				if (typeof callback != "undefined") {
					callback($res);
				}
			}
			$obj.attr('acceptClick',"true");
		},
	});
	
	return false;
}
