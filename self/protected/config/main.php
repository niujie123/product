<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool

		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123456',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),

	),

	// application components
	'components'=>array(

		'user'=>array(
			// enable cookie-based authentication
//			'allowAutoLogin'=>true,
            'class' => 'FUser',
		),
		'wuser'=>array(
			// enable cookie-based authentication
//			'allowAutoLogin'=>true,
            'class' => 'WUser',
		),

		// uncomment the following to enable URLs in path-format

		'urlManager'=>array(
            'urlFormat'=>'path',
            'showScriptName'=>false,    // 这一步是将代码里链接的index.php隐藏掉。
            'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',

                '<controller:login>'						=>	'login/login',
                '<controller:logout>'						=>	'login/logout',
                '<controller:site>'						=>	'site/index',
			),
		),


		// database settings are configured in database.php
        'db' => array(
            'class' => 'FDbConnection',
            'connectionString' => "mysql:host=localhost;dbname=ceshi;port=3306",
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'UTF8',
            'tablePrefix' => 'nj_',
            'enableProfiling'=>YII_DEBUG,
            'enableParamLogging' => YII_DEBUG,
            //'schemaCacheID' => 'cache',
            'schemaCachingDuration' => FF_DEBUG ? 0 : 1800,
            'slaves' => array(
                array(
                    'connectionString' => "mysql:host=localhost;dbname=ceshi;port=3306",
                    'emulatePrepare' => true,
                    'username' => 'root',
                    'password' => '',
                    'charset' => 'UTF8',
                    'tablePrefix' => 'nj_',
                    'enableProfiling'=>YII_DEBUG,
                    'enableParamLogging' => YII_DEBUG,
                    'schemaCacheID' => 'cache',
                    'schemaCachingDuration' => 0,
                )
            )
        ),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>YII_DEBUG ? null : 'site/error',
		),
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'info,error,warning,trace',
                ),
                // uncomment the following to show log messages on web pages

                array(
                    'class'=>'CWebLogRoute',
                    'levels'=>'trace, info, error, warning, xdebug',
                    'categories' =>'system.*'
				),

			),
		),

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);
