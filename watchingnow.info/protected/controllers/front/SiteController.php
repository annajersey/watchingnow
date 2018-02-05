<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	  public function actionwelcome(){
		$this->layout = "welcome";
		$this->render('welcome');
	  }
	  public function actionAutocompletewith(){
		if(Yii::app()->request->isAjaxRequest)
        {
		 $result = array();
		 $term = $_GET['q']; 
		
		 $criteria = new CDbCriteria(array('alias' => 'u', 'select'=>'u.login','condition'=>'u.login LIKE "'.$term.'%" || u.name LIKE "'.$term.'%"'));
         $users = Users::model()->findAll($criteria);
		 foreach($users as $user){
			$result[] = $user->login;
		 }
		 
		sort($result);
		
		$i=0;
		 foreach($result as $key=>$value){
			 echo $value.'
			 
			 ';
			 if($i>20) break;
			 $i++;
		 }
		Yii::app()->end();
	   }
	 }
	 public function actionAutocompletewhere(){
		if(Yii::app()->request->isAjaxRequest)
        {
		 $result = array();
		 $term = Yii::app()->request->getQuery('q');
		 $criteria = new CDbCriteria;
		 $criteria->select = 'place';
		 $criteria->condition = "place LIKE :term";
		$criteria->params = array(':term' => $term . '%');
		 
		 // $criteria = new CDbCriteria();
		 // $criteria->select = 'place';
		 // $criteria->condition = 'place LIKE "%:term%"';
		 // $criteria->params = array(':term'=>$term);
         $films = Films::model()->findAll($criteria);
		 foreach($films as $film){
			$result[] = $film->place;
		 }
		 
		sort($result);
		
		$i=0;
		 foreach($result as $key=>$value){
			 echo $value.'
			 
			 ';
			 if($i>20) break;
			 $i++;
		 }
		Yii::app()->end();
	   }
	 }
	 public function actionAutocomplete(){
		if(Yii::app()->request->isAjaxRequest)
        {
		 $result = array();
		 $term = $_GET['q']; 
		
		 $criteria = new CDbCriteria(array('alias' => 'f', 'select'=>'f.name','condition'=>'f.name LIKE "'.$term.'%"'));
         $films = Films::model()->findAll($criteria);
		 foreach($films as $film){
			$result[] = $film->name;
		 }
		 $criteria = new CDbCriteria(array('alias' => 't', 'select'=>'t.name','condition'=>'t.name LIKE "'.$term.'%"'));
         $films = Todo::model()->findAll($criteria);
		 foreach($films as $film){
			$result[] = $film->name;
		 }
		sort($result);
		$result=array_unique($result);
		//echo CJSON::encode($result);
		$i=0;
		 foreach($result as $key=>$value){
			 echo $value.'
			 
			 ';
			 if($i>20) break;
			 $i++;
		 }
		Yii::app()->end();
	   }
	 }
	 public function actionLang(){
		$l = Yii::app()->request->getQuery('l');
		Yii::app()->session['lan']=$l ;
		$this->redirect(array('index'));
	 }
	 public function actionShare(){
		$watchingnow = Yii::app()->request->getPost('watchingnow');
		$where = Yii::app()->request->getPost('where');
		$when = Yii::app()->request->getPost('when');
		$when = strtotime($when);
		$time = $when ? $when : time();
		if($watchingnow && $watchingnow!=Yii::t('t','Movie Name')){
			if($id = Yii::app()->user->id){
				$row = Yii::app()->db->createCommand()
                ->select('name')
                ->from('films')
				->where('user_id=:id', array(':id'=>Yii::app()->user->id))
                ->order('id DESC')
                ->queryRow();
				if(empty($row) || $row['name']!=$watchingnow){
					$film = new Films();
					$film->name=$watchingnow;
					$film->user_id=$id;
					$film->place=$where;
					$film->timestamp=$time;
					if($watchingnow!='test') $film->save();
				}
				
				$iswatchlist = Todo::model()->findByAttributes(array('name'=>$watchingnow,'user_id'=>$id));
				if(!empty($iswatchlist)) $iswatchlist->delete();
			}else{
				$film = new Films();
				$film->name=$watchingnow;
				$film->user_id=0;
				$film->place=$where;
				$film->timestamp=$time;
				if($watchingnow!='test') $film->save();
			}
			$fb=Yii::app()->request->getPost('fb');
			$link=$this->getLink();
		
			//$with = Yii::app()->request->getPost('with');
			
			if(!(empty($where))){
				 $where="\n@ ".$where;
			}else{
				 $where="";
			}
			// if(!(empty($with))){$with='
			// with: '.$with;}
			if($fb=='facebook'){
						try {
								require_once("php-sdk/facebook.php");
								$facebook = new Facebook($config);
								
								$user=Users::model()->FindByPk(Yii::app()->user->id);
								if(false && $user->fb_token){
									//echo $user->fb_token.' ';
									$facebook->setAccessToken($user->fb_token);
									$facebook->setExtendedAccessToken();
								}
								$fuser_id = $facebook->getUser();
								$ret_obj = $facebook->api('/me/feed', 'POST',
                                    array(
                                      //'link' => 'www.watchingnow.info',
                                      'message' => "#WatchingNow: ".$watchingnow.$where."
									".$link
                                 ));
							
							
							} catch(FacebookApiException $e) {
								error_log($e->getType());
								error_log($e->getMessage());
								//echo $fuser_id;
								//$user_profile = $facebook->api('/me','GET');
								echo 'Facebook error. ';
								//echo($e->getMessage());
						  } 
						
			}
			$tw=Yii::app()->request->getPost('tw');
			if($tw=='twitter'){
				$message = "#WatchingNow: ".$watchingnow.$where."
				".$link;
				try {
				$twitter = new Twitter($_SESSION['access_token']['oauth_token'], $_SESSION['access_token']['oauth_token_secret']);
				$twitter->posttweet($message);
				}catch(FacebookApiException $e) {echo 'error';} 
			}
			echo Yii::app()->user->id ? Yii::t('t','Done') : Yii::t('t','Done :) Register to create your own watchlists');
		}
	 }
	public function actionIndex()
	 {	if(Yii::app()->user->isGuest){
			$this->redirect(array('welcome'));
		}
		
		if(isset($_SESSION['access_token'])){
		$twitter = new Twitter($_SESSION['access_token']['oauth_token'], $_SESSION['access_token']['oauth_token_secret']);
		$tittercheck=true;
		$twitter_url='twitter/logout';
		$twitter_name=$_SESSION['access_token']['screen_name'];
		}else{
		$twitter = new Twitter();
		$tittercheck=false;
		$twitter_url=$twitter->getAccessURL();
		$twitter_name='';
		}
		$link=$this->getLink();
		
		
		$facebook = new FacebookObject;
		$facebook_link = $facebook->GetButton();
		
		$this->render('index',array('facebook_link'=>$facebook_link,'twitter_url'=>$twitter_url,'tittercheck'=>$tittercheck,'twitter_name'=>$twitter_name,'link'=>$link) );
	}
	private function getLink(){
		$user_id=Yii::app()->user->id;
		$user = Users::model()->findByPk($user_id);
		if($user) $link='http://watchingnow.info/userlist/'.$user->login;
		else $link='http://watchingnow.info';
		return $link;
	}
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{	
		$model = new Users('login');
		if (isset($_POST['Users'])) {
			$model->attributes=$_POST['Users'];
			if ($model->validate()) { 
				$user = Users::model()->findByPk(Yii::app()->user->id);
				if($user->oauth_token && $user->oauth_token_secret){
					$_SESSION['access_token']['oauth_token'] = $user->oauth_token;
					$_SESSION['access_token']['oauth_token_secret'] = $user->oauth_token_secret;
					$twitter=new Twitter($user->oauth_token, $user->oauth_token_secret);
					$user_info = $twitter->get('account/verify_credentials');
					$_SESSION['access_token']['screen_name'] = $user_info->screen_name;
				}
				 if(false && $user->fb_token){
					 $facebook=new FacebookObject;
					 $facebook->setAccessToken($user->fb_token);
					
				 }
				$this->redirect(Yii::app()->homeUrl);
			}else{
			foreach($model->getErrors() as $error){
			Yii::app()->user->setFlash('error', $error[0]);
			}
			
			
			}
			//$this->redirect(Yii::app()->user->returnUrl);
		}
		
		// display the login form
		$this->render('login',array('model'=>$model));
	}
	
	
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{	//require_once("php-sdk/facebook.php");	
		Yii::app()->user->logout();
		Yii::app()->session->destroy();
		Yii::app()->request->cookies->clear();
		foreach ($_COOKIE as $key => $value) {
			unset($value);
			setcookie($key, '', time() - 3600);
		}
		
		$this->redirect(Yii::app()->homeUrl);
	}
	public function actionUserFilms(){
		if(!isset($_GET['login'])) $this->redirect(Yii::app()->homeUrl);
		$username=Yii::app()->request->getQuery('login');
		$model=new Films('userfilmlist');
		$model->unsetAttributes();  
		if(isset($_GET['Films']))
		$model->attributes=$_GET['Films'];
		
		$this->render('userfilms',array(
				'username'=>$username,
				'model'=>$model,
				
			));
	}
	public function actionwidgetupdate(){
		return $this->widget('application.components.Feed');
	}
	 
	
	public function actiongetImages(){
		$term = Yii::app()->request->getQuery('i');
		if(strlen($term)<3 || $term== Yii::t('t','Movie Name')) die();
		$json = $this->get_url_contents('http://ajax.googleapis.com/ajax/services/search/images?v=1.0&as_filetype=png&rsz=5&imgsz=medium&q=movie+"'.urlencode($term).'"');
		$data = json_decode($json);

		foreach ($data->responseData->results as $result) {
			$results[] = array('url' => $result->url, 'alt' => $result->title);
		}
		$return='';
		foreach($results as $image): 		
		
			$return.= '<img width="120" height="120" src="'.urldecode( $image['url']).'" />&nbsp';
		endforeach;
		echo $return;		
		die();
	}
	private function get_url_contents($url) {
		$crl = curl_init();

		
		curl_setopt($crl, CURLOPT_URL, $url);
		curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($crl, CURLOPT_CONNECTTIMEOUT, 5);

		$ret = curl_exec($crl);
		curl_close($crl);
		return $ret;
	}
	
}