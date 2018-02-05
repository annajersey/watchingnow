<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $login
 * @property string $password
 * @property string $role
 * @property string $name
 *
 * The followings are the available model relations:
 * @property Advice[] $advices
 * @property Advice[] $advices1
 */
class FacebookObject extends CFormModel
{	


	// protected function fb_checkuser($fuid){
	
		// $id = Yii::app()->user->id;
		// if($id){
			// $user=Users::model()->findByPk($id );  
			// if($user->fuid!=$fuid)
    		  // $user->fuid=$fuid;
			  // $user->save(array('fuid'));
		// }
			
	// }
	public function getcookiename(){
		$id = Yii::app()->user->id;
		$user=Users::model()->findByPk($id );  
		if($user->fb_token){
			$cookie_value=$user->fb_token;
			require_once("php-sdk/facebook.php");
			$facebook = new Facebook($config);
			$base_domain = 'watchingnow.info';
			$cookie_name = 'fbsr_618216678224484';
			$_COOKIE[$cookie_name] = $cookie_value;
			$expire = time() + 31556926;
			setcookie($cookie_name, $cookie_value, $expire, '/', '.'.$base_domain);
		}
	}
	public function setAccessToken($token){
			require_once("php-sdk/facebook.php");
			$facebook = new Facebook($config);
			$facebook->setAccessToken($token);
			$facebook->setExtendedAccessToken();
	}
	public function GetButton(){
		@session_start();
		require_once("php-sdk/facebook.php");
		$facebook = new Facebook($config);
		$user_id = $facebook->getUser();
		if($user_id){
		try {
				$user_profile = $facebook->api('/me','GET');
				//var_dump($user_profile);
				//$this->fb_checkuser($user_profile['id']);
				$fb_button=$user_profile['name'];
				$fb_button.=' (<a href="facebook/facebook_logout">Logout</a>)';

		} catch(FacebookApiException $e) {

		
        $login_url = $facebook->getLoginUrl(array(
                       'scope' => 'publish_stream'
                       )); 
		$fb_button="<a 
		onclick='window.open(\"{$login_url}\", \"fblogin\", 
		\"width=600,height=650,resizable=yes,scrollbars=yes,status=yes\")' 
		href='#'>Login</a>";
        error_log($e->getType());
		error_log($e->getMessage());

      } 

}  else {
	$login_url = $facebook->getLoginUrl(array(
                       'scope' => 'publish_stream'
                       ));

	$fb_button="<a 
		onclick='window.open(\"{$login_url}\", \"fblogin\", 
		\"width=600,height=650,resizable=yes,scrollbars=yes,status=yes\")' 
		href='#'>Login</a>";
}
	return $fb_button;

	}
	
	
	
}
