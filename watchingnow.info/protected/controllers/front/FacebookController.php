<?php

class FacebookController extends Controller
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

	
	
	
	public function actionsaveuserdata(){
		$fuid=Yii::app()->request->getPost('fuid');
		$token=Yii::app()->request->getPost('token');
		$id = Yii::app()->user->id;
		if($id){
			$user=Users::model()->findByPk($id );  
			if($fuid) $user->fuid=$fuid;
			$user->fb_token=$token;
			 $user->save();
		}
	}
	public function actionfacebook_logout(){
		require_once("php-sdk/facebook.php");
		$facebook = new Facebook($config);
		$facebook->api("/me/permissions", "DELETE");
			$this->redirect(Yii::app()->request->urlReferrer);
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