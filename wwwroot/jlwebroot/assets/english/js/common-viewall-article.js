$(document).ready(function(){
/* sort */
	$('ul.wd-streamstory-lo2 li.wd-streamstory-lo2-item').wookmark({
			itemWidth: "48.5%", // Optional min width of a grid item
			autoResize: true, // This will auto-update the layout when the browser window is resized.
			container: $('.wd-pagelet-stream-wiew'), // Optional, used for some extra CSS styling
			offset: 20, // Optional, the distance between grid items
	});
});