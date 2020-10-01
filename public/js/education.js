$(document).ready(function() {

		$('#add_education').click(function(){

				$.post({ method: 'GET', url: 'training_degree/show',

					success: function(data){

								if (data.t != false){

										var institution = $('<input />', {name: 'institution', type: 'text', class: 'form-control', maxlength: '60'});
										var start_date = $('<input />', {name: 'start_date', type: 'text', class: 'form-control'}).mask('99/99/9999').datetimepicker({format: 'DD/MM/YYYY'});
										var final_date = $('<input />', {name: 'final_date', type: 'text', class: 'form-control'}).mask('99/99/9999').datetimepicker({format: 'DD/MM/YYYY'});
										var description = $('<textarea />', {name: 'description', class: 'form-control', rows: '5'});
										var grad_grade = $('<input />', {name: 'grad_grade', type: 'text', class: 'form-control'});
										var training = $('<select />', {name: 'training_degree_id', class: 'form-control'});

										training.append($('<option />', {value: ''}).text('Select a training degree ...'));

										for (var i = 0; i < data.t.length; i++){

												training.append($('<option />', {value: data.t[i].id}).text(data.t[i].name));
										}

										var row1 = $('<div />', {class: 'row'}).append($('<div />', {class: 'col-sm-6'}).append($('<label />').text('Institution Name')).append(institution))
												.append($('<div />', {class: 'col-sm-3'}).append($('<label />').text('Start Date')).append(start_date))
												.append($('<div />', {class: 'col-sm-3'}).append($('<label />').text('Final Date')).append(final_date));

										var row2 = $('<div />', {class: 'row'}).append($('<div />', {class: 'col-sm-6'}).append($('<label />').text('Grade')).append(grad_grade))
												.append($('<div />', {class: 'col-sm-6'}).append($('<label />').text('Training Degree')).append(training));

										var row3 = $('<div />', {class: 'row'}).append($('<div />', {class: 'col-xs-12'}).append($('<label />').text('Description')).append(description));

										var div = $('<div />').append(row1).append($('<br />')).append(row2).append($('<br />')).append(row3);

										bootbox.dialog({
												title: 'Education', message: div, size: "large",
												buttons: {
														cancel: {
																label: "Cancel",
																className: 'btn-danger'
														},
														success: {
																label: "Add",
																className: 'btn-info',
																callback: function(){

																		$.post({ method: 'POST', url: 'formation/store', data: {institution: institution.val(), start_date: start_date.val(), final_date: final_date.val(), description: description.val(), grad_grade: grad_grade.val(), training_degree_id: training.val(), _token: $("[name=_token]").val()},

																				success: function(data){

																						if (data.error == false){

																								var button = $('<button />', {type: 'button', class: 'btn btn-danger pull-right', onclick: 'delete_formation('+data.c+')'});
																								button.append($('<span />', {class: 'glyphicon glyphicon-trash'}))

																								var tr = $('<tr />', {class: 'edu-'+data.c});
																								tr.append($('<td />').text(institution.val())).append($('<td />').text(start_date.val()+' - '+final_date.val())).append($('<td />').append(button));

																								$('#table-formation tbody').append(tr);
																								bootbox.hideAll();
																						}
																						else{
																								bootbox.alert(data.msg);
																						}
																				}
																		});
																		return false;
																}
														}
												}
										});
								}
						}
				});
		});
});

function delete_formation(code){

		bootbox.confirm({
			message: "Tem certeza que deseja deletar ?",
			callback: function(result){

						if (result == true){

								$.post({ method: 'DELETE', url: 'formation/'+code, data: {_token: $("[name=_token]").val()},

									success: function(data){

												if (data.error == false){

														$('#table-formation > tbody > .edu-'+code).remove();
												}
												else{
														bootbox.alert("Nenhum item deletado!");
												}
										}
								});
						}
				}
		});
}
