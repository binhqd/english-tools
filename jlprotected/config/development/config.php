<?php
require "constants.php";

// uncomment the following to define a path alias
require(dirname(__FILE__) . '/_path-aliases.php');

require(dirname(__FILE__) . "/../function_alias.php");
$info = require_once(dirname(__FILE__) . '/../server-info.php');

//GNBase::loadModule('articles');
GNBase::loadModule('comment');

return 
	array(
		'onBeginRequest'	=> array('GNRequestHandler', 'LocaleHandler'),
		'sourceLanguage'	=> 'en',
		'language' 			=> 'en',
		'basePath' 			=> dirname(__FILE__) . '/../..',
		'runtimePath'		=> dirname(__FILE__) . '/../../../jlruntime',
		'name' 				=> 'English for GreenGlobaler',
		'theme'				=> 'bootstrap',
		'controllerMap'		=> CMap::mergeArray(require(Yii::getPathOfAlias('greennet') . '/controller_maps.php'),
			array(
				'article'	=> 'application.modules.articles.controllers.ViewArticleController',
				'profile'	=> array(
					'class'	=> 'application.modules.users.controllers.ProfileController'
				),
				'photo' 	=> 'application.modules.photos.controllers.DefaultController',
				'article'	=> 'application.modules.articles.controllers.ViewArticleController',
				'pull'		=> 'application.modules.notifications.controllers.PullController',
				'resource'		=> 'application.modules.resources.controllers.ZoneResourceImageController',
				'userphotos'	=> 'application.modules.photos.controllers.UserPhotosController',
			)
		),
		// preloading 'log' component
		'preload'			=> array('log'),
		'import'			=> require(dirname(__FILE__) . '/_common_imported.php'),
		'modules'			=> require(dirname(__FILE__) . '/_modules.php'),
		'components' 		=> require(dirname(__FILE__) . '/_common_components.php'),
		'params'			=> require(dirname(__FILE__) . '/params.php'),
	);
