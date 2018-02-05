


function loggedout() {
	$('#fb_logout').css('display','none');
    $('#fb_login').css('display','inline').unbind().click(function(){
        FB.login(function(response){
			if (response.authResponse) {
				 var access_token =   FB.getAuthResponse()['accessToken'];
				 FB.api('/me', function(response) {
					$.post( "facebook/saveuserdata", { token: access_token, fuid:response.id})
				 });
			   } else {
				 console.log('User cancelled login or did not fully authorize.');
			   }
           loggedin();
        },{scope: 'publish_stream'});
    });;
}

