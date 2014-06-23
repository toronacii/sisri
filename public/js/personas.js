$(function(){

	$('table.datatable').dataTable({
		serverSide: true,
		ajax: base_url + '/persona/get_ajax_personas'
	});

});