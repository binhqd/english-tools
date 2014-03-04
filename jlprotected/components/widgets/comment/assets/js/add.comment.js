function viewMore(token){
	var _this = $("#viewMore"+token);
	$("#loadingComment"+token).show();
	var startList = _this.attr('startList');
	var totalRecord = _this.attr('totalRecord');
	var limit = _this.attr('limit');
	
	var href= _this.attr('ref');
	$.ajax({
		url			: href,
		data		: {
			'startList':startList,
			'objectId':_this.attr('objectId'),
			'limit':_this.attr('limit'),
			'path':_this.attr('viewPath'),
		},
		type		:'GET',
		success		: function (res) {
			$("#contentComments"+token).append(res);
			$('.hide-row-comment').fadeIn(1000);
			$("#loadingComment"+token).hide();
			try{
				 jQuery(" .timeago").timeago([]);
			}catch(etime){
				console.log(etime.message);
			}
			var startPage = 0;
			if($.isNumeric($("#contentComments"+token +" .item-box").length)){
				startPage = $("#contentComments"+token +" .item-box").length;
			}
			if(startPage >= totalRecord) _this.remove();
			_this.attr('startList',startPage);
			if(totalRecord - startPage <limit) _this.find('label').html(totalRecord - startPage);
			
		},error: function (xhr, ajaxOptions, thrownError) {
			console.log(xhr.responseText);
			
		}
	});
}
$().ready(function(e){
	$("a.truncate_more_link").on('click',function(e){
		var _this = $(this);
		// var content = _this.parent().attr('content');
		
		_this.parent().parent().find('label:first').show();
		_this.parent().parent().find('label:last').hide();
		// _this.parent().html(content);
	});
});
