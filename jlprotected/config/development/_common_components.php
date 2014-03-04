<?php 
if (preg_match("/jlframework\.com$/", $_SERVER['HTTP_HOST'])) {
	defined('COOKIE_DOMAIN') or define('COOKIE_DOMAIN', ".localhost.com");
} else {
	defined('COOKIE_DOMAIN') or define('COOKIE_DOMAIN', ".localhost.com");
}

return array(
	'user' => array(
		// enable cookie-based authentication
		'class' => 'RWebUser',
		'allowAutoLogin' => true,
		'loginUrl' => array('/login')
	),
	// session configuration
	'id' => 'myzone',
	'session' => array(
		'savePath' =>  dirname(__FILE__) . '/../../../jlruntime/session/',
		'cookieMode' => 'allow',
		'timeout'=>3600*24*30,
		'cookieParams' => array(
			'lifetime' => 0,
			'path' => '/',
			'domain' => COOKIE_DOMAIN,
			'httpOnly' => true,
		),
	),
	'authManager' => array(
		'class' => 'RDbAuthManager',
		'connectionID' => 'db',
		'itemTable' => 'core_authitem',
		'itemChildTable' => 'core_authitemchild',
		'assignmentTable' => 'core_authassignment',
		'rightsTable' => 'core_rights',
		'defaultRoles' => array('Authenticated', 'Guest'),
	),
	// uncomment the following to use a MySQL database
	'db' => array(
		'connectionString' => "mysql:host=127.0.0.1;dbname=gg-english;port=3306",
		'emulatePrepare' => true,
		'username' => 'binhqd',
		'password' => '123456',
		'charset' => 'utf8',
		'tablePrefix' => '',
	),
	/*'db' => array(
		'connectionString' => "mysql:host=localhost;dbname=myzone;port=3306",
		'emulatePrepare' => true,
		'username' => 'root',
		'password' => '',
		'charset' => 'utf8',
		'tablePrefix' => '',
	),*/
	'mongodb' => array(
		'class'				=> 'EMongoDB',
		'connectionString'	=> "mongodb://{$info['local']['development']['mongodb']['server']}:{$info['local']['development']['mongodb']['port']}",
		'dbName'			=> $info['local']['development']['mongodb']['dbname'],
		'fsyncFlag'			=> true,
		'safeFlag'			=> true,
		'useCursor'			=> false
	),
	'coreMessages'=>array(
		'basePath' => dirname(__FILE__) . '/../../messages',
	),
	'cache'=>array(
		'class'=>'system.caching.CFileCache',
	),

	// Neo4Yii
	'neo4j'=>array(
		'class'	=> 'ENeo4jGraphService',
		'host'	=> $info['local']['development']['neo4j']['server'],
		// 		'host'=>'localhost',
		'port'	=> $info['local']['development']['neo4j']['httpport'],
		'db'	=> 'db/data',
		'queryCacheID'=>'cache',
	),

	// uncomment the following to enable URLs in path-format
	'urlManager' => array(
		'urlFormat' => 'path',
		'showScriptName' => false,
		'rules' 	=> array(
			'profile/edit'			=> 'profile/edit',
			'profile/change_password'			=> 'profile/change_password',
			'recover/change_password'			=> 'users/recoverPassword',
				
			'profile/<username>'	=> 'profile/viewByUsername',
			'profile/wall/<page>'	=> 'profile/wall',
			'profile/id/<id:[a-fA-F]+>'	=> 'profile/view',
				
			'prototype/<action:\w+>'		=> 'prototype/default/<action>',
			'zone/schema/update'=>'zone/schema/update',
			'zone/schema/<id:.*>'=>'zone/schema/index',
			'zone/manageSchema/defaultAttributes/<zone_type_id:.*>'=>'zone/manageSchema/defaultAttributes',
			'zone/type/<zone_id:.*>'=>'zone/type/index',
			'zone/instance/detail/<instance_id:.*>'=>'zone/instance/detail',
			'zone/instance/add/<zone_id:.*>'=>'zone/instance/add',
			//'zone/namespace/<namespace_id:.*>'=>'zone/namespace/index',
			'zone/suggest/instance/<zone_id:.*>'=>'zone/suggest/instance',
			'page/<alias:[a-zA-Z0-9\_\-]+>'=>'page/index',
			'dashboard/index'	=> 'dashboard/review',
			//'user/register'		=> 'site/functionDisabled',
			//''	=> 'publicPages/default',
			'lang/<lang:[\w]{2}>'	=> 'language/switch',
			'<controller:\w+>/<id:\d+>' => '<controller>/view',
			'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
			'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
				
			'minify/<group:[^\/]+>'=>'minify/index',
			// 			'profile/<id:[a-f]+>'	=> 'profile/view'
		)
	),

	'assetManager' => array(
		'basePath' => dirname(__FILE__) . "/../../../wwwroot/jlwebroot/assets/",
		'baseUrl' => "/assets",
		'class'=>'greennet.components.GNAssetManager',
	),
	'themeManager'	=> array(
		'basePath'	=> dirname(__FILE__) . '/../../../wwwroot/jlwebroot/templates/' ,
	),
	'errorHandler' => array(
		// use 'site/error' action to display errors
		'errorAction' => 'site/error',
	),
	'log' => array(
		'class' => 'CLogRouter',
		'routes' => array(
			array(
				'class'=>'CFileLogRoute',
				'levels'=>'error, warning',
			),
			// array(
			// 'class' => 'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
			// 'ipFilters' => array('127.0.0.1', '192.168.1.*', '10.0.0.*'),
			// ),
		),
	),
	'themeManager'	=> array(
		'basePath'	=> dirname(__FILE__) . "/../../views/themes/",
	),
	'mail' => array(
		'class' => 'application.components.JLMailer',
		'transportType'=>'smtp', /// case sensitive!
		'transportOptions'=>array(
			'host'=>'smtp.gmail.com',
			'username' => 'justlookwd@gmail.com',
			'password' => 'toancauxanh',
			'port'=>'465',
			'encryption'=>'ssl',
		),
		'viewPath' => 'application.views.mail',
		'logging' => true,
		'dryRun' => false
	),
	'file'=>array(
		'class'=>'ext.file.CFile',
	),
	'bootstrap'=>array(
		'class'=>'ext.bootstrap.components.Bootstrap'
	),
	'jlbd' => array(
		'class' => 'application.components.jlbd.JLBDLibrary',
		'plugins' => array(
			'dialog' => 'application.components.jlbd.JLBDDialog',
		),
	),
	'clientScript'=>array(
		'class'=>'ExtendedClientScript',
		'combineFiles'	=> false,
		'compressCss'	=> false,
		'compressJs'	=> false,
		'baseDir'		=> "/assets/"
	),
	'shorturl' => array(
		'class' => 'application.components.ShortUrl',
		'apiKey' => 'AIzaSyAk9xU4h5JGccpJK--nC9jcZaYQq474yHQ', // apikey
	),
// 	'cache'	=> array(
// 		'class'=>'greennet.components.cache.memcache.GNMemCache',
// 		'servers'=>array(
// 			array(
// 				'host'=>'192.168.1.110',
// 				'port'=>11211,
// 				'weight'=>60,
// 			),
// 			array(
// 				'host'=>'server2',
// 				'port'=>11211,
// 				'weight'=>40,
// 			),
// 		),
// 	),
);
