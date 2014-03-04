<?php

$includePath = get_include_path();
set_include_path($includePath . PATH_SEPARATOR . dirname(__FILE__) . '/../../jlprotected/extensions');

// có thể config trong file .htaccess bằng cách sử dụng: SetEnv APPLICATION_ENV development
require(dirname(__FILE__) . '/../../jlprotected/config/constants.php');

// change the following paths if necessary
$yii = dirname(__FILE__) . '/../../frameworks/yii/yii.php';
$greennet = dirname(__FILE__) . '/../../frameworks/greennet/greennet.php';
$classmaps = dirname(__FILE__) . '/../../jlprotected/config/class_maps.php';

$config = dirname(__FILE__) . '/../../jlprotected/config/' . APPLICATION_ENV . '/config.php';

require_once($yii);
require_once($classmaps);
require_once($greennet);

Yii::setPathOfAlias("framework", realpath(dirname($yii)));
Yii::setPathOfAlias("greennet", realpath(GNBase::getFrameworkPath()));

$app = Yii::createWebApplication($config);

Yii::import("ext.zendAutoloader.EZendAutoloader", true);


EZendAutoloader::$prefixes = array('Zend', 'Custom');

Yii::registerAutoloader(array("EZendAutoloader", "loadClass"));
// spl_autoload_register(array('GNBase','autoload'));
Yii::registerAutoloader(array('GNBase','autoload'), true);

Yii::app()->onError = array("GNErrorHandler", "handlingError");
Yii::app()->onException = array("GNErrorHandler", "handlingException");
Yii::setPathOfAlias('Everyman', Yii::getPathOfAlias('ext.neo4jphp.lib.Everyman'));

Yii::app()->onBeginRequest = array("GNAuthHandler", "checkAuth");
Yii::app()->onBeginRequest = array("GNRequestHandler", "checkDevice");

$app->run();
