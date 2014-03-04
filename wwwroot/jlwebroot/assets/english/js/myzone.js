/**
 * Application js core
 *
 * JQUERY versions 1.7+
 * 
 * MyZone CMS - Content Management System and Framework Powerfull by Cakephp
 * Copyright 2012, GREEN GLOBAL CO., LTD (toancauxanh.vn)
 * 
 * jQuery(tm) Copyright 2011, John Resig http://jquery.org/license
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @author        Technology Lab No.I <tech1@toancauxanh.vn>
 * @link          
 * @package       MyZone.Theme
 * @since         MyZone v 1.0
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

var MyZone = {
	URL: ''
};

(function($) {

	var $_behaviors = {},
			$_locale = {code: '', strings: {}};

	$.extend(MyZone, {
		/**
		 * Register callbacks method to a behavior.
		 */
		attach: function(behavior, methods) {
			if (!$_behaviors[behavior]) {
				$_behaviors[behavior] = {};
			}
			$.extend($_behaviors[behavior], methods);
		},
		/**
		 * Unregistered callbacks method from a behavior.
		 */
		detach: function(behavior, keys) {
			if (!$_behaviors[behavior]) {
				return false;
			}
			if (!$.isArray(keys)) {
				keys = $.makeArray(keys);
			}
			for (var key in keys) {
				key = keys[key];
				delete $_behaviors[behavior][key];
			}
			return true;
		},
		/**
		 * Trigger registered behaviors from a page element.
		 */
		trigger: function(method, params, options) {
			if ($.isEmptyObject($_behaviors)) {
				return true;
			}
			if (params != undefined && !$.isArray(params)) {
				params = [params];
			}
			options = $.extend({
				breaks: true,
				breakOn: false,
				collect: false
			}, options);
			var result = true, collect = [];
			$.each($_behaviors, function() {
				if ($.isFunction(this[method])) {
					result = this[method].apply(null, params || []);
					if (options.collect) {
						collect.push(result);
					}
					if (options.breaks && (result === options.breakOn ||
							($.isArray(options.breakOn) && $.inArray(result, options.breakOn)))) {
						return false;
					}
				}
			})
			return options.collect ? collect : result;
		},
		/**
		 * Replace placeholders with sanitized values in a string. supported %s or %s1$s
		 */
		format: function(str, args) {
			var regex = /%(\d+\$)?(s)/g,
					i = 0;
			return str.replace(regex, function(substring, valueIndex, type) {
				var value = valueIndex ? args[valueIndex.slice(0, -1) - 1] : args[i++];
				switch (type) {
					case 's':
						return String(value);
					default:
						return substring;
				}
			});
		},
		/**
		 * Repeat a string.
		 */
		repeat: function(str, count) {
			return count < 1 ? "" : (new Array(count + 1)).join(str);
		},
		/**
		 * Trigger registered behaviors from a page element.
		 */
		i18n: function(message) {
			$.extend($_locale.strings, message || {});
		},
		/**
		 * Translate strings to the page language or a given language.
		 */
		t: function(str, args) {
			if ($_locale.strings[str]) {
				str = $_locale.strings[str];
			}
			if (args === undefined) {
				return str;
			}
			if (!$.isArray(args)) {
				args = $.makeArray(arguments);
				args.shift();
			}
			return MyZone.format(str, args);
		}
	});

	/**
	 * Additions to jQuery.support.
	 */
	$(function() {
		/**
		 * Boolean indicating whether or not position:fixed is supported.
		 */
		if ($.support.positionFixed === undefined) {
			var el = $("<div style=\"position:fixed; top:10px\" />").appendTo(document.body);
			$.support.positionFixed = el[0].offsetTop === 10;
			el.remove();
		}
	});

	//Attach all behaviors.
	$(function() {
		try {
			MyZone.trigger("setup");
		} catch (e) {
			throw  e;
		}
	});

})(jQuery);

var __ = MyZone.t;
// debug function
var debug = function() {
	if (jQuery.browser.mozilla) {
		console.debug.apply(null, jQuery.makeArray(arguments));
	}
}
// stack track
var trace = function() {
	if (jQuery.browser.mozilla) {
		console.trace();
	}
}