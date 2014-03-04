<?php
define('APPLICATION_PATH', realpath(dirname(__FILE__). "/../"));
define('APPLICATION_ENV', 'development');
// define('APPLICATION_ENV', 'production');
// define('APPLICATION_ENV', 'test');
// define('APPLICATION_ENV', 'beta');

// nếu chưa config APPLICATION_ENV thì APPLICATION_ENV=production
defined('APPLICATION_ENV')
|| define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

defined('YII_DEBUG') or define('YII_DEBUG', true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);