<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.bxslider.js"></script>
<?php if(Yii::app()->user->isGuest){ ?>

<script>
$(document).ready(function(){
  $('#examples').bxSlider({
    
    pager:false,
    slideMargin: 10
  });
});
</script>
<div id="about"> 
				<div><small>What movie are you watching now? Save and share in one click.</small></div>
		<div id="title">Welcome to Watchingnow.info!</div>

		<div>You might like <a href="userinfo/register">to try</a> it if you </div>
			<ul>
			<li>love to watch good movies</li>
			<li>want to share your taste with other people on social networks</li>
			<li>interested in what your friends are currently watching</li>
			<li>want to have a nice and simple watchlists - for future plans and previous watchings</li>
			<li>and explore watchlists of other members</li>
			</ul>
		<div>A couple examples:</div>
	<div id="examples">
		<div class="slide"><img  src="<?php echo Yii::app()->request->baseUrl; ?>/images/exampl/1.jpg" /></div>
		<div class="slide"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/exampl/2.jpg" /></div>
		<div class="slide"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/exampl/3.jpg" /></div>
	</div>
</div>
<? }else{ ?> 
<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<script src="//vk.com/js/api/openapi.js" type="text/javascript"></script>
<script type="text/javascript" src="http://connect.facebook.net/en_US/all.js"></script>
<?php 
$cs = Yii::app()->getClientScript();
//$cs->registerScriptFile(Yii::app()->baseUrl.'/js/fb.js');
$cs->registerScriptFile(Yii::app()->baseUrl.'/js/vk.js');
$user = Users::model()->findByPk(Yii::app()->user->id);
 ?>
 
<?php
    if (isset($_REQUEST['state']) && isset($_REQUEST['code'])) {
        echo "<script>
            window.close();
    window.opener.location.reload();
        </script>";
} 
?>
<script>


// function loggedin() {
   
    // $('#fb_logout').css('display','inline');
    // $('#fb_login').css('display','none');

    // FB.api('/me', function(response){
        // $('#fb_userinfo').html(response.name);
    // });
	
// }
// $(document).ready(function(){
	// FB.init({appId: '618216678224484', status: true, cookie: true, xfbml: true});
	
// FB.getLoginStatus(function(response) {
	  // if (response.status === 'connected') {
		 // loggedin();
	  // }  else {
		 // loggedout();
	  // }
	 // });

// });
 
$(document).ready(function(){


VK.Auth.getLoginStatus(function(response){
		if(response.session){
			   
			$('.vk-logout').show(); vuid=response.session['mid'];
			VK.Api.call('users.get', {uids: response.session['mid']}, function(r) {
				if(r.response) {
					$('#vk-text').text(r.response[0].first_name+' '+r.response[0].last_name);
				}
			}); 
		}else{
			$('.vk-login').show();
		}
	});
	
});
</script>
<h1 id="pagetitle"><?php echo Yii::t('t','What are you watching now? Share with your friends!') ?></h1>
<div class="container main" id="page">			
				<input id="watchingnow" name="watchingnow" value="<?php echo Yii::t('t','Movie Name');?>"/>
			
			
		
<div id="social">
  <input type="checkbox" value="facebook" name="social[]" id="fb"><label><img class="social_icon" height="24" src="<?php echo Yii::app()->request->baseUrl."/images/fb_logo.png"; ?>">
 <?php echo $facebook_link; ?></label>
  <!--<span id="fb_login" style="display:none">
            <a href="javascript:;"><?php echo Yii::t('t','Login'); ?></a>
        </span>
		<span id="fb_userinfo"></span>
		<span id="fb_logout" style="display:none">
            <a href="facebook/facebook_logout">(<?php echo Yii::t('t','Logout'); ?>)</a>
        </span>-->
		&nbsp;&nbsp;&nbsp;
  <input type="checkbox" value="vkontakte" name="social[]" id="vk" ><label><img height="24" class="social_icon" src="<?php echo Yii::app()->request->baseUrl."/images/vk_logo.png"; ?>"> 
    <span id="vk-text"></span><a href="#" id="vk-login" class="vk-login" style="display:none"><?php echo Yii::t('t','Login'); ?></a><span class="vk-logout" style="display:none"> <a href="#" id="vk-logout" >(<?php echo Yii::t('t','Logout'); ?>)</a></span></label>
	&nbsp;&nbsp;&nbsp;
	<input type="checkbox" value="twitter" name="social[]" id="tw" ><label><img height="24" class="social_icon" src="<?php echo Yii::app()->request->baseUrl."/images/tw_logo.png"; ?>"> 
	<?php if( $tittercheck){ ?><?php echo $twitter_name; ?>&nbsp;<a href="<?php echo $twitter_url; ?>">(<?php echo Yii::t('t','Logout'); ?>)</a><?php } 
	else{ ?><a href="<?php echo $twitter_url; ?>" onclick='window.open("<?php echo $twitter_url; ?>","JSSite", "width=500,height=150,resizable=yes,scrollbars=no,status=yes"); return false;' >Login</a>
	<?php } ?></label>
	&nbsp;&nbsp;<input type="checkbox" value="group" name="social[]" id="group" checked="checked"><label><img height="24" class="social_icon" src="<?php echo Yii::app()->request->baseUrl."/images/vk_logo.png"; ?>"> <a href="http://vk.com/watchingnow"><?php echo Yii::t('t','Our Community'); ?></a></span></label>
	&nbsp;&nbsp;&nbsp;
	</div>
	<div id="images_wrapper"><div id="filmimages"></div></div>
	<div id="moreoptions_link" onclick="$('#more_options').slideToggle()"><span>&#187;</span>&nbsp;more options</div>

	<div id="more_options">
	<!--<div><label>Image</label><input type="text" name="imageurl" id="imageurl" /></div>-->
	<div><label>where</label><input type="text" name="where" id="where" /></div>
	<div><label>when</label><input type="text" name="when" id="when" placeholder="Y-m-d H:m"/></div>
	<!--<div><label>with</label><input type="text" name="with" id="with" /></div>-->
	</div>
  <br /><br /><input type="button" value="<?php echo Yii::t('t','Save and Share'); ?>" id="submit">


<div class="success_container"><div class="message_success" style="display:none;"></div></div>
<script>


function Send(){
	var fb = $('#fb:checked').val(); var tw = $('#tw:checked').val();  var where = $('#where').val();
	$.post( "site/share", { watchingnow: $('#watchingnow').val(), fb:fb, tw:tw, where:where,when:$('#when').val()})
	.done(function( data ) { MessageAlert(data);
		//if(data=='error') MessageAlert("<?php echo Yii::t('t','Error'); ?>");
		//else MessageAlert("<?php echo Yii::app()->user->id ? Yii::t('t','Done') : Yii::t('t','Done :) Register to create your own watchlists'); ?>");
		$('#watchingnow').val('');
		$('#feed').load('site/widgetupdate');
	});
}

$(document).ready(function(){
$('#submit').click(function(){
	if($('#watchingnow').val()=='' || $('#watchingnow').val()=='<?php echo Yii::t('t','Movie Name');?>') {MessageAlert("<?php echo Yii::t('t','Nothing?') ?>"); return false;}
	if($('#where').val()!=''){
		var where_message="\n&#64; "+$('#where').val();
	}else{
		var where_message="";
	}
	if($('#vk').is(':checked') && vuid>0){ console.log(vuid);
			VK.api("wall.post", {
				owner_id: vuid,
				message: '#WatchingNow : '+$('#watchingnow').val()+where_message+" \n<?php echo $link; ?>",
				
			}, function (data) {
				for(var key in data) {
					console.log(data[key]);
				}
				if($('#group').is(':checked')){
					VK.api("wall.post", {
					owner_id: '-76708397',
					from_group: 1,
					signed: 1,
					message: '#WatchingNow : '+$('#watchingnow').val()+where_message+" \n<?php echo $link; ?>"
					}, function (data) {
					for(var key in data) {
						console.log(data[key]);
					}});
				}
				Send();
			
			});
			
	}else{
	if($('#group').is(':checked')){
					VK.api("wall.post", {
					owner_id: '-76708397',
					from_group: 1,
					signed: 1,
					message: '#WatchingNow : '+$('#watchingnow').val()+where_message+" \n<?php echo $link; ?>"
					}, function (data) {
					for(var key in data) {
						console.log(data[key]);
					}});
				}
	Send();
	}
	
});
});
$(document).ready(function(){
$("#watchingnow").autocomplete("site/autocomplete");
$("#with").autocomplete("site/autocompletewith");
$("#where").autocomplete("site/autocompletewhere");
$("#watchingnow").bind( "click keypress contextmenu",function(){if($(this).val()=='<?php echo Yii::t('t','Movie Name');?>'){$(this).val('')}});
$("#watchingnow").focus();

$("#watchingnow").blur(function(){
		$('#filmimages').load('site/getimages?i='+encodeURIComponent($(this).val()),function(){
			
			var intervalID = setInterval(function(){
				
				if ($('#images_wrapper img').length>4){
					TestMe();
					clearInterval(intervalID);
				}else{
					console.log($('#images_wrapper img').length);
				}
			}, 1000);  
		
			
		});
		
});
function TestMe(){
	$('#images_wrapper img').click(function(){ 
		$('#filmimages img').each(function(){$(this).removeClass('selectedimg');});
		$(this).addClass('selectedimg');
		$('#imageurl').val($(this).attr('src'));
	});
  

}
});	
</script>
<div id="fb-root"></div>

 


<?php 

// echo 'fousquare test:<br />';

  
// $ip=$_SERVER['REMOTE_ADDR'];  

// /* Now get ip details  with geoplugin.net      */  
  
// $url='http://api.hostip.info/get_html.php?ip='.$ip.'&position=true';  
  
// $data=file_get_contents($url);
	// $a=array();
	// $keys=array('Latitude','Longitude');
	// $keycount=count($keys);
	// for ($r=0; $r < $keycount ; $r++)
	// {
		// $sstr= substr ($data, strpos($data, $keys[$r]), strlen($data));
		// if ( $r < ($keycount-1))
			// $sstr = substr ($sstr, 0, strpos($sstr,$keys[$r+1]));
		// $s=explode (':',$sstr);
		// $a[$keys[$r]] = trim($s[1]);
	// }
 
	// $lat = (float) $a['Latitude']; 
	// $lon = (float) $a['Longitude'];

 // $loc= $lat.','.$lon;
 // echo $loc;
 // $url = "https://api.foursquare.com/v2/venues/search?client_id=SQPDYCAKQYXJIU1FB4PM4FAFRIICBQMUHK2HM1WFBM301NT4&client_secret=JCGWXUO1VJOEB3QDSRZX2CDBSTAMV1JYH4IY0BLOIY5LUPDM&v=".date('Ymd',time())."&intent=checkin&radius=100&ll=".$loc;

// $ch = curl_init(); 
// curl_setopt($ch, CURLOPT_URL,$url); // set url to post to 

// curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // return into a variable 



// $result = curl_exec($ch); // run the whole process 
// curl_close($ch);  
// $result1=json_decode($result,true);
// foreach( $result1['response']['venues'] as $r){
	// echo $r['name'].'<br />';
//}
  ?>

</div>
<?php } ?>