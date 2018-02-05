

 var vuid=0;   	


    


$(document).ready(function(){
	$('a#vk-login').click(function(event){
				event.preventDefault();

			VK.Auth.login(function(response) {
				console.log(response);
			   if(response.session){
					$('.vk-logout').show();$('.vk-login').hide(); vuid=response.session['mid'];sid=response.session['sid'];
					$.post( "userinfo/savevkuid", { vuid: vuid,sid: sid})
					VK.Api.call('users.get', {uids: response.session['mid']}, function(r) {
						if(r.response) {
							$('#vk-text').text(r.response[0].first_name+' '+r.response[0].last_name);
						}
					}); 
				}else{$('.vk-login').show();}
			}); 
	});
	$('a#vk-logout').click(function(event){
		event.preventDefault();
		VK.Auth.logout(function(){
			location.reload();
		});
	});
VK.init({
        apiId: 4046540  
		});
	
});
