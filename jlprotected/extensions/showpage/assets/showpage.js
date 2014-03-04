$.fn.loadCssPagination = function(options){
	var object = {
		page : null
	};
	var options = $.extend(object, options);
	$("ul#yiipager").find('li a').each(function(index, element) {
		$(this).parent().removeClass('selected');
		if($.trim($(this).html())==options.page){
			$(this).parent().addClass('selected');
		}
	});	
};
$.fn.loadFirst = function(options){
	var object = {		
		data : null,
		url: null,
		f : null,
		l : null,
	};
	var options = $.extend(object, options);
	for(var i=1;i<=options.f+options.l ; i++){
		var url =options.url+"&page="+i; 
		$.ajax({
			type : "GET",
			url: url,
			success: function(data) {
				var json = $.parseJSON(data);
				ddJson[i] = json;				
			}
		});			
	}

};

$.fn.showpage = function(options){
	var object = {
		page : 1,
		itemTotal: 5,
		total : null,
		data : null,
		id : null,
		url : null
	};
	var options = $.extend(object, options);
		var _id_show_page	=	$(this);
		var first 	= '<li ><a href="javascript:void(0)" id="first">First</a></li><li class="previous"><a href="javascript:void(0)" id="previous">Previous</a></li>';
		var last 	= '<li ><a href="javascript:void(0)" id="next">Next</a></li><li><a href="javascript:void(0)" id="last">Last</a></li>';
		var end_postion = "";
		var first_postion = "";
		
		var total	=	options.total;
		var page	=	options.page;
		
		var __temp_page = page-1;
		var currentPage = parseFloat(page);
		//var row		=	options.itemTotal;
		var offset 		=	options.itemTotal;
		//var _item	=	Math.ceil(total/row);
		var numOfPage=	Math.ceil(total/offset);
		
		
		var pageStart = parseFloat(currentPage) - 2/*parseFloat(offset)*/;
		var pageEnd = parseFloat(currentPage) + 3/*parseFloat(offset)*/;
		var numPage = new String();
		if(numOfPage < 1) return false;		
		
		if(currentPage > 1) numPage += '<li class="previous"><a href="javascript:void(0)" id="first" name="'+(parseFloat(currentPage) - 1)+'">&laquo;</a></li>';
		else numPage += '<li class="wd-disable  previous"><a href="javascript:void(0)" id="previous" name="1">&laquo;</a></li>';		
		
		if(currentPage > parseFloat((offset + 1))){
			numPage += '<li><a href="javascript:void(0)" name="1">1</a></li><li class="spacing-dot"> ... </li>';
		}
		for(i = 1; i <= numOfPage; i++){
			if(pageStart <= i && pageEnd >= i){
				if(i == currentPage) numPage += '<li class="page selected"><a href="javascript:void(0)" name="'+i+'">'+i+'</a></li>';
				else numPage += '<li class="page"><a href="javascript:void(0)" name="'+i+'">'+i+'</a></li>';
			}
		}
		//if(numOfPage > pageEnd) numPage += '<li class="spacing-dot"> ... </li><li><a href="javascript:void(0)" name="'+numOfPage+'">'+numOfPage+'</a></li>';
		if(currentPage < numOfPage) numPage += '<li class="next"><a href="javascript:void(0)" name="'+(parseFloat(currentPage) + 1)+'" id="next">&raquo;</a></li>';
		else numPage += '<li class="wd-disable next"><a href="javascript:void(0)" id="last">&raquo;</a></li>';

		$(this).html('<li class="first"><a href="javascript:void(0)" name=1>First</a></li>'+numPage+'<li class="last"><a href="javascript:void(0)" name="'+numOfPage+'">Last</a>');
		$(this).find('li a').each(function(x,y){
			var _page = parseInt($(this).attr('name'));
			$(this).click(function(e){
				loadingBizList();
				if(options.data[_page]!=null){
					$("#"+options.id).assignHtml({
						page : _page,
						data : options.data,
						status : 1
					});
					$("ul#yiipager").showpage({
						page : _page,
						itemTotal: options.itemTotal,
						total : options.total,
						data : options.data,
						id : options.id,
						url : options.url
					});		
					closeBizList();
					return false;
				}else{
					$.ajax({
						type : "GET",
						url: options.url+"&page="+_page,
						success: function(data) {
							var json = $.parseJSON(data);
							options.data[_page] = json;
							//console.log(options.data)
							$("#"+options.id).assignHtml({
								page : _page,
								data : options.data,
								status : 0
							});
							//console.log(_id_show_page.html())
							//alert(_page)
							$("ul#yiipager").showpage({
								page : _page,
								itemTotal: options.itemTotal,
								total : options.total,
								data : options.data,
								id : options.id,
								url : options.url
							});
							closeBizList();
						}
					});
				}
			});
		});
		
}