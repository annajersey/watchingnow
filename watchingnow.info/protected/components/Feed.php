<?php
class Feed extends CWidget {
 
    public $feedlist;
    
 
    public function run() {
	
		$feedlist=Films::model()->findAll( array(
	"order" => "timestamp desc",
	"limit" => 10,
	'condition'=>'user_id>0'
	)  );
		 $this->render('feed',array('feedlist'=>$feedlist));
    }
 
}
?>
