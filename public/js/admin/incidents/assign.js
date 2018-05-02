$(function(){		
	$('[data-incident]').on('click',AssignSupportModal);
});

function AssignSupportModal(){
	//id
	var incident_id = $(this).data('incident');
	$('#incident_id').val(incident_id);

	//name
	var support_id = $(this).parent().prev().text();
	$('#support_id').val(support_id);	
}