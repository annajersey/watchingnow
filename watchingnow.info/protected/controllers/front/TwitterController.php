<?php

class TwitterController extends Controller
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

	
	
	
	
	public function actiontwitter(){
		$twitter = new Twitter;
		$url = $twitter->getAccessURL();
		 echo $url;
	}
	public function actionlogout(){
		unset($_SESSION['access_token']);
		$this->redirect(array('site/index'));
	}
	public function actiontwitter_oauth(){
		if(!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])){
			$twitter=new Twitter($_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
			$access_token = $twitter->getAccessToken($_GET['oauth_verifier']);
			$_SESSION['access_token'] = $access_token;
			if(Yii::app()->user->id){
				$user = Users::model()->findByPk(Yii::app()->user->id);
				$user->oauth_token=$access_token['oauth_token'];
				$user->oauth_token_secret=$access_token['oauth_token_secret'];
				$user->save(array('oauth_token','oauth_token_secret'));
			}
			//$user_info = $twitter->get('account/verify_credentials');
			//print_r($user_info);
		}
		echo '<script>window.opener.location.reload(false);window.close()</script>';
	}
	public function actiontwitter_post(){
		$twitter = new Twitter($_SESSION['access_token']['oauth_token'], $_SESSION['access_token']['oauth_token_secret']);
		//$user_info = $twitter->get('account/verify_credentials');
		$response = $twitter->post('statuses/update', array(
				'status' => 'New tweet from my app!'.time()
			));
		print_r($response);
		
	}
	
}