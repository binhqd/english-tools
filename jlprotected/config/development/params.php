<?php

// this contains the application parameters that can be maintained via GUI
return array(
	// this is displayed in the header section
	'title' => 'Justlook',
	// this is used in error pages
	'adminEmail' => '',
	'systemSalt' => '',
	'sitename' => "JustLook",
	'mailer' => array(
		'host' => '',
		'port' => '',
		'secure' => '',
		'username' => '',
		'password' => '',
		'name' => '',
	),
	'roles' => array(
		'SADMIN' => '',
		'ADMIN' => '',
		'BUSINESS' => '',
		'AWAITING' => '',
		'MEMBER' => ''
	),
	'formats' => array(
		'date' => 'd M Y',
		'datetime' => 'd M Y H:i',
	),
	// the copyright information displayed in the footer section
	'copyrightInfo' => 'Copyright &copy; 2012 by Green Global.',
	// FB APP ID
	'fbAppId' => '',
	// FB APP Secret
	'fbAppSecret' => '',
	// Justlook Page ID
	'fbPageId' => '',
	// FB admin
	'fbAdmin' => '',
	'gearmanPort' => '5900',
	'cacheResetTime' => 1800,
	'mailContact' => array(
		'mail' => ''
	),
	'device' => array(
		'type' => 'pc'
	),
	'neo4j' => array(
		'host' => '192.168.1.110',
		'port' => '7485',
		//'host' => 'localhost',
		//'port' => '7474',
		'username' => '',
		'password' => '',
		'https' => false,
		//'enableProfiling' => false
	),
	'OAuth'	=> array(
		'Gmail'	=>	array(
			'application_name' => '',
			'oauth2_client_id' => '',
			'oauth2_client_secret' => '',
			'site_name' => 'myzone.localhost.com',
			'oauth2_redirect_uri'	=> 'http://myzone.localhost.com/google/connect',
		),
		'Yahoo'		=> array(
			'app_id'			=> '',
			'consumer_key'		=> '',
			'consumer_secret'	=> '',
			'connected_path' 	=> 'Connected.php',
			're_url'			=> "Connected.php"
		),
		'Facebook'	=> array(
			'appId'  => '',
			'secret' => '',
			'cookie' => true
		)
	),
	//'CDN'	=> 'http://d1synugzxoq5oj.cloudfront.net/'
	//'CDN'	=> '/'
	'AWS'	=> array(
		'CDN'	=> 'http://myzone.localhost.com',
		'S3URL'	=> 'http://static.youlook.net',
		'S3'	=> array(
			'upload'	=> array(
				'accessKey'	=> '',
				'secretKey'	=> '',
				'bucket'	=> '',
			)
		)
	)
);
