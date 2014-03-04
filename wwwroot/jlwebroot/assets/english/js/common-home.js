$(document).ready(function(){
	//external
    $('a[rel="external"]').attr('target', '_blank');
	/* placehorder */
	$('input, textarea').placeholder();
	jQuery("input[type=checkbox].wd-check-cus-2,input[type=radio].wd-radio-cus,select.wd-custome-select").uniform();

});