<?php 
require_once("twitteroauth/OAuth.php");	
require_once("twitteroauth/twitteroauth.php");	
class Twitter extends TwitterOAuth {
    private $key = "ppCSfQ5GiY6ReibVLV3e5Q";
    private $secret = "vLwo0IQXvuCiIR5YBSiI1CtBvuifgkrD5z5fU0BLPo";
	
    public function __construct($oauth_token = null, $oauth_verifier = null) {
        parent::__construct($this->key, $this->secret, $oauth_token, $oauth_verifier);
    }
	
    public function getAccessURL() {
	////
	//$twitteroauth = new TwitterOAuth($key, $secret);
		$request_token = $this->getRequestToken('http://watchingnow.info/twitter/twitter_oauth');
		$_SESSION['oauth_token'] = $request_token['oauth_token'];
		$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
        return $this->getAuthorizeURL($request_token['oauth_token']);
    }
    public function getUser() {
        return $this->get('account/verify_credentials');
    }
    public function checkUserInSystem() {
        $twitterUser = $this->getUser();
        if (!$twitterUser)
            return false;
        $twitterId = $twitterUser->id;
        if (!$twitterId)
            return false;
       return true;
	 }  
	 public function posttweet($text){
		
		$response = $this->post('statuses/update', array(
				'status' => $text
			));
	 }
}
?>