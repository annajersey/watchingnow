<?php

class FilmsController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	
	
	
	
	public function actionIndex(){
		// $id = Yii::app()->user->id;
		// if(!$id) $this->redirect(array('site/login'));
		// $model=$this->loadModel($id);
		// $films=Films::model()->findAllByAttributes(array('user_id'=>$id),array('order'=>'timestamp DESC')); 
		
		$model=new Films('filmlist');
		$model->unsetAttributes();  
		if(isset($_GET['Films']))
		$model->attributes=$_GET['Films'];
		
		$this->render('index',array(
				
				'model'=>$model,
				
			));
	}
	public function actionOrder(){
		$order = Yii::app()->getRequest()->getParam('order'); 
	
		Todo::model()->Resort(explode('&',$order));
	}
	public function actionFavorite(){
		$id = Yii::app()->user->id;
		if(!$id) $this->redirect(array('site/login'));
		$filmid = Yii::app()->getRequest()->getParam('filmid');
		$film=Films::model()->findByAttributes(array('id'=>$filmid,'user_id'=>$id));
		
		if($film->favorite==1)	 $film->favorite=0;
		else 	$film->favorite=1;
		$film->save(array('favorite'));
		die('ok');
	}
	public function actionDeletetodo(){
		$id = Yii::app()->user->id;
		if(!$id) $this->redirect(array('site/login'));
		$todoid = Yii::app()->getRequest()->getParam('todoid'); 
		
		$todo=Todo::model()->findByAttributes(array('id'=>$todoid,'user_id'=>$id));
		if(!empty($todo)){
		if(!$todo->delete()) {foreach($todo->getErrors() as $error) echo $error[0];}
		}
		$list=Todo::model()->findAllByAttributes(array('user_id'=>$id),array('order'=>'position ASC')); 
		$this->renderPartial('list_',array('list'=>$list));
		die();
	}
	public function actionDelete(){
		$userid = Yii::app()->user->id;
		if(!$userid) $this->redirect(array('site/login'));
		$film_id = Yii::app()->getRequest()->getQuery('id'); 
		
		$film=Films::model()->findByAttributes(array('id'=>$film_id,'user_id'=>$userid));
		if(!empty($film)){
		if(!$film->delete()) {foreach($film->getErrors() as $error) echo $error[0];}
		}
		die('ok');
	}
	public function actionWatchlist(){
		$id = Yii::app()->user->id;
		if(!$id) $this->redirect(array('site/login'));
		$list=Todo::model()->findAllByAttributes(array('user_id'=>$id),array('order'=>'position ASC'));
		$this->render('list',array('list'=>$list,'model'=>Todo::model()));
	}
	public function actionTodo(){
		$id = Yii::app()->user->id;
		if(!$id) $this->redirect(array('site/login'));
		$info = Yii::app()->getRequest()->getParam('Todo');
		
		
		$todo = new Todo();
		
				$todo->name=$info['name'];
				$todo->user_id=$id;
				$todo->timestamp=time();
				
		if(!$todo->save()) {foreach($todo->getErrors() as $error) echo $error[0];}
		$list=Todo::model()->findAllByAttributes(array('user_id'=>$id),array('order'=>'timestamp DESC')); 
		$this->renderPartial('list_',array('list'=>$list));
		die();
	}
	public function loadModel($id)
	{
		$model=Users::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='users-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
}