$(document).ready(function(){
	var i=1;
	$('#add').click(function(){
		i++;
		$('#dynamic_field').append('<tr id="row'+i+'"><td><select class="form-control" id="equipe_id" name="equipe[]" >' +
		'<option value="2">Desenvolvimento Front-End</option>' +
		'<option value="1">Desenvolvimento Back-End</option><option value="3">Tester</option>  </select></td></td><td><input type="text" name="precedencia[]" placeholder="Precedência" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
	});
	
	
	$(document).on('click', '.btn_remove', function(){
		var button_id = $(this).attr("id"); 
		$('#row'+button_id+'').remove();
	});
	
});