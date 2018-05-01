$(function(){		
	$('[data-profile]').on('click',editProfileModal);
});

function editProfileModal(){
	//id
	var profile_id = $(this).data('profile');
	$('#profile_id').val(profile_id);

	//name
	var profile_name = $(this).parent().prev().text();
	$('#profile_name').val(profile_name);	
}