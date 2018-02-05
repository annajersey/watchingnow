<?php
	return CMap::mergeArray(
		require(dirname(__FILE__).'/main.php'),
		array(
			// autoloading model and component classes
			'import'=>array(
				'application.components.parsers.*',
			),
			'components'=>array(
				//'request'=>array(
				//	'enableCsrfValidation'=>true,
				//),
				'user'=>array(
					'loginUrl'=>array('site/login'),
					'allowAutoLogin'=>true,
				),
				'urlManager'=>array(
					'urlFormat'=>'path',
					'showScriptName'=>false,
					'rules'=>array(
						'gii'=>'gii',
						'gii/<controller:\w+>'=>'gii/<controller>',
						'gii/<controller:\w+>/<action:\w+>'=>'gii/<controller>/<action>',
						''=>'site/index',
						'lang/<l:\w+>'=>'site/lang',
						'/advice/<login:\w+>'=>'/advice',
						'me/<login:\w+>'=>'site/userfilms',
						'userlist/jeremy'=>array('site/userfilms', 'defaultParams'=>array('login'=>'jenny')),
						'userlist/alpha'=>array('site/userfilms', 'defaultParams'=>array('login'=>'jenny')),
						'userlist/<login:\w+>'=>'site/userfilms',
						'login'=>'site/login',
						'welcome'=>'site/welcome',
						'<controller:\w+>'=>'<controller>/index',
						'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
						'<controller:\w+>/<id:\d+>/<title>'=>'<controller>/view',
						'<controller:\w+>/<id:\d+>'=>'<controller>/view',
						
					),
				),
			),
		)
	);