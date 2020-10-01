$(document).ready(function() {

		$('#add_experience').click(function(){

				$.post({ method: 'GET', url: 'experience/show',

						success: function(data){

								if (data.i != false){

										var company = $('<input />', {name: 'company_name', type: 'text', class: 'form-control', maxlength: '60'});
										var start_date = $('<input />', {name: 'start_date', type: 'text', class: 'form-control'}).mask('99/99/9999').datetimepicker({format: 'DD/MM/YYYY'});
										var final_date = $('<input />', {name: 'final_date', type: 'text', class: 'form-control'}).mask('99/99/9999').datetimepicker({format: 'DD/MM/YYYY'});
										var description = $('<textarea />', {name: 'description', class: 'form-control', rows: '5'});
										var industry = $('<select />', {name: 'industry_id', class: 'form-control'});
										var occupation = $('<select />', {name: 'occupation_id', class: 'form-control'});

										industry.append($('<option />', {value: ''}).text('Select a industry ...'));
										occupation.append($('<option />', {value: ''}).text('Select a occupation area ...'));

										for (var i = 0; i < data.i.length; i++){

												industry.append($('<option />', {value: data.i[i].id}).text(data.i[i].name));
										}
										for (var j = 0; j < data.o.length; j++){

												occupation.append($('<option />', {value: data.o[j].id}).text(data.o[j].name));
										}

										var row1 = $('<div />', {class: 'row'}).append($('<div />', {class: 'col-sm-6'}).append($('<label />').text('Company Name')).append(company))
										   	.append($('<div />', {class: 'col-sm-3'}).append($('<label />').text('Start Date')).append(start_date))
											 	.append($('<div />', {class: 'col-sm-3'}).append($('<label />').text('Final Date')).append(final_date));

										var row2 = $('<div />', {class: 'row'}).append($('<div />', {class: 'col-sm-6'}).append($('<label />').text('Industry')).append(industry))
												.append($('<div />', {class: 'col-sm-6'}).append($('<label />').text('Occupation Area')).append(occupation));

										var row3 = $('<div />', {class: 'row'}).append($('<div />', {class: 'col-xs-12'}).append($('<label />').text('Description')).append(description));

										var div = $('<div />').append(row1).append($('<br />')).append(row2).append($('<br />')).append(row3);

										bootbox.dialog({
												title: 'Work Experience', message: div, size: "large",
												buttons: {
														cancel: {
																label: "Cancel",
																className: 'btn-danger'
														},
														success: {
																label: "Add",
																className: 'btn-info',
																callback: function(){

																		$.post({ method: 'POST', url: 'experience/store', data: {company: company.val(), start_date: start_date.val(), final_date: final_date.val(), description: description.val(), industry_id: industry.val(), occupation_id: occupation.val(), _token: $("[name=_token]").val()},

																				success: function(data){

																						if (data.error == false){

																								var button = $('<button />', {type: 'button', class: 'btn btn-danger pull-right', onclick: 'delete_experience('+data.x+')'});
																								button.append($('<span />', {class: 'glyphicon glyphicon-trash'}))

																								var tr = $('<tr />', {class: 'exp-'+data.x});
																								tr.append($('<td />').text(company.val())).append($('<td />').text(start_date.val()+' - '+final_date.val())).append($('<td />').append(button));

																								$('#table-experience tbody').append(tr);
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

function delete_experience(code){

		bootbox.confirm({
			message: "Tem certeza que deseja deletar ?",
			callback: function(result){

						if (result == true){

								$.post({ method: 'DELETE', url: 'experience/'+code, data: {_token: $("[name=_token]").val()},

									success: function(data){

												if (data.error == false){

														$('#table-experience > tbody > .exp-'+code).remove();
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
