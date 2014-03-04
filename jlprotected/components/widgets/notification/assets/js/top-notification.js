/**
 * Top notification
 *
 * @author huytbt
 * @date 2012-03-08 3:30:00 PM
 */

;(function($, scope){
	scope['notification'] = {
		elements : {},
		options : {
			timeout : 3000
		},
		timeout : 0,
		showMessage : function(options) {
			$.each(options, function(index, val){
				jlbd.notification.options[index] = val;
			});
			clearTimeout(jlbd.notification.timeout);
			
			$element = $('<div class="ui-corner-all ui-state-highlight"></div>');
			$element.append('<span class="ui-icon ui-icon-circle-close" title="Close"></span>');
			$element.append('<span class="ui-icon ui-icon-info"></span>');
			$element.append('<span class="wd-notification-content">This is a message!</span>');
			$element.hide();
			
			$('.wd-top-notification').append($element); //.html(jlbd.notification.options.text);
			$element.fadeIn();
			jlbd.notification.elements[] = $element;
			
			jlbd.notification.timeout = setTimeout('jlbd.notification.hideMessage()', jlbd.notification.options.timeout);
		},
		hideMessage : function() {
			$('.wd-top-notification').fadeOut();
			clearTimeout(jlbd.notification.timeout);
		},
		init : function(options) {
			$('.wd-top-notification .ui-icon-circle-close').click(function(){
				jlbd.notification.hideMessage();
				return false;
			});
			$('.wd-top-notification').hover(function(){
				clearTimeout(jlbd.notification.timeout);
			}, function(){
				jlbd.notification.timeout = setTimeout('jlbd.notification.hideMessage()', jlbd.notification.options.timeout);
			});
		}
	}
})(jQuery, jlbd);

$(document).ready(function(){
	jlbd.notification.init();
});