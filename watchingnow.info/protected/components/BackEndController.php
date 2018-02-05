<?php
	class BackEndController extends CController
	{
		public $layout='application.views.back.layouts.main';
		public $menu=array();
		public $breadcrumbs=array();

		public function filters()
		{
			return array(
				'accessControl',
			);
		}

		public function accessRules()
		{
			return array(
				array('allow',
					'users'=>array('?'),
					'actions'=>array('login'),
				),
				array('allow',
					'roles'=>array('admin'),
				),
				array('deny',
					'users'=>array('*'),
				),
			);
		}
	}