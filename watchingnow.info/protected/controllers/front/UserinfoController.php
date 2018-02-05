<?php

class UserInfoController extends Controller
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

	
	
	public function actionchange_password(){
		$id = Yii::app()->user->id;
		$model=$this->loadModel($id);
		
		$model->setScenario('changepass');
		
		$this->performAjaxValidation($model);
		if(isset($_POST['Users']))
		{
		$model->attributes=$_POST['Users'];
		if (!empty($model->password) && !empty($model->password2)) {
					 $model->password = md5($model->password);
					 $model->password2 = md5($model->password2);
		
			if($model->save('password')){
					Yii::app()->user->setFlash('success', Yii::t('t',"Your password was changed"));
					$this->redirect(array('change_password'));
			}
		}else{
			Yii::app()->user->setFlash('error', Yii::t('t',"You enter empty password"));
		}
		}
		$model->password=$model->password2='';
		$this->render('change_password',array(
			'model'=>$model,
		));
	}
	
	
	public function actionfacebook_logout(){
		require_once("php-sdk/facebook.php");
		$facebook = new Facebook($config);
		$facebook->api("/me/permissions", "DELETE");
			$this->redirect(array('index'));
	}
	
	public  function actionsavevkuid(){
		$vuid=Yii::app()->request->getPost('vuid');
		$sid=Yii::app()->request->getPost('sid');
		$id = Yii::app()->user->id;
		if($id){
			$user=Users::model()->findByPk($id );  
			$user->vuid=$vuid; 
			$user->sid=$sid;
			$user->save();
		}
	}
	public function actionIndex(){
	require_once("php-sdk/facebook.php");
	$id = Yii::app()->user->id;
	if(!$id) $this->redirect(array('site/login'));
	$model=$this->loadModel($id);
	
	//bof fb
		
		$facebook = new FacebookObject;
		$fb_button = $facebook->GetButton();

	//eof fb	
		
	
		//$model->password=$model->password2='';
		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			$model->attributes=Yii::app()->getRequest()->getParam('Users'); //$_POST['Users'];
			
			$model->image=CUploadedFile::getInstance($model,'image');
			 // if (!empty($model->password)) {
					 // $model->password = md5($model->password);
					 // $model->password2 = md5($model->password2);
			 // }
			
			if($model->save(array('name','email'))){ 
				if($model->image) $model->image->saveAs('images/'.$model->id.'.jpg');
				Yii::app()->user->setFlash('success', "Your information was updated");
				$this->redirect(array('index'));
				}
		}

		$this->render('index',array(
			'model'=>$model,
			'fb_button'=>$fb_button,
			
		));
	}
	public function actionActivate(){ 
		$key = Yii::app()->getRequest()->getQuery('key');
		if(!empty($key)){  
			$user = Users::model()->findByAttributes(array('activation_key'=>$key)); 
			if($user){ 
				$user->active=1;
				$user->password2=$user->password;
				if ($user->save(array('active'))) {
					$identity=new UserIdentity($user->login,'');
					$identity->setID($user->id); /* had to add WebUser::setID() since WebUser::$_id is private */
					$identity->errorCode=UserIdentity::ERROR_NONE;
					Yii::app()->user->login($identity,0);

					//Yii::app()->user->setFlash('success', Yii::t('t',"Thank you. You can now login."));
					$this->redirect(array('site/index'));
				}else{
				Yii::app()->user->setFlash('success', "Error");
				
				}
			}else{
			Yii::app()->user->setFlash('success', "Error");
			}
		}
		$this->render('activate');
	}
	public function actionRegister()
	{
		$model=new Users('create');

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			if (!empty($model->password)) {
					 $model->password = md5($model->password);
					 $model->password2 = md5($model->password2);
			}
			$model->role='user';
			$model->activation_key = sha1(mt_rand(10000, 99999).time().$model->email);
			if($model->save()){
				
				Emails::SendActivateKey($model);
				//$model = new Users('login');
				
					//$model->attributes=$_POST['Users'];
					//if ($model->validate()) { 
						Yii::app()->user->setFlash('success', Yii::t("t","Check your email for activation key"));
						$this->redirect(array('activate'));
					//}
					
				
			}
				
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	public function actionBlacklist(){
		$blacklist=BanUsers::model()->GetBlacklist();
		
		$this->render('blacklist',array(
			'blacklist'=>$blacklist,
		));
	}
	public function actionUnban(){
		$bid =  Yii::app()->getRequest()->getParam('bid');
		$ban_user=BanUsers::model()->findByPk($bid);
		$ip=$ban_user->ip; $bu=$ban_user->ban_user_id;
		if($ban_user->delete()) {
		if($ip) Yii::app()->user->setFlash('success', "IP unbaned");
		if($bu) Yii::app()->user->setFlash('success', "User unbaned");}
		 $ban_user->delete();
		$blacklist=BanUsers::model()->GetBlacklist();
		
		$this->renderPartial('black_list',array('blacklist'=>$blacklist));
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