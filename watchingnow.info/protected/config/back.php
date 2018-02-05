<?php
	return CMap::mergeArray(
		require(dirname(__FILE__).'/main.php'),
		array(
			// autoloading model and component classes
			'import'=>array(
				'application.components.parsers.*',
			),
			'components'=>array(
				'user'=>array(
					'loginUrl'=>array('site/login'),
				),
				'urlManager'=>array(
					'urlFormat'=>'path',
					'showScriptName'=>false,
					'rules'=>array(
						'gii'=>'gii',
						'gii/<controller:\w+>'=>'gii/<controller>',
						'gii/<controller:\w+>/<action:\w+>'=>'gii/<controller>/<action>',
						'backend'=>'site/index',
						'backend/<_c>'=>'<_c>',
						'backend/<_c>/<_a>'=>'<_c>/<_a>',
					),
				),
			),
		)
	);