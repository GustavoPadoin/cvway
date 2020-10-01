$(document).ready(function() {

		$('#add_item').click(function(){

				$.post({ method: 'GET', url: 'industry/show',

					success: function(data){

								if (data.i != false){

										var tableResp = $('<div />', {class: 'table-responsive'});
										var table = $('<table />', {class: 'table table-striped', id: 'dataTable', width: '100%', cellspacing: '0'});
										var thead = $('<thead />').append($('<tr />').append($('<th />', {width: '10'}).text('id')).append($('<th />').text('Name')));
										var tbody = $('<tbody />');

										for (var i = 0; i < data.i.length; i++){

												tbody.append($('<tr />').append($('<td />').text(data.i[i].id)).append($('<td />').text(data.i[i].name)));
										}

										tableResp.append(table.append(thead).append(tbody));

										bootbox.dialog({
												title: 'Step 1 - Select Industry',
												message: tableResp,
												size: "large",
												buttons: {
													cancel: {
															label: "Cancel",
															className: 'btn-danger'
													},
													success: {
															label: "Add",
															className: 'btn-info',
															callback: function(){

																	var industry = $('.selected').children()[0].textContent + '-' + $('.selected').children()[1].innerText;

																	open_occupation(industry);
															}
													}
												}
										});

										$('#dataTable').dataTable({ select: { style: 'single' }, paging: false, searching: false });
								}
						}
				});
		});
});

function open_occupation(industry){

		$.post({ method: 'GET', url: 'occupation_area/show',

			success: function(data){

						if (data.o != false){

								var tableResp = $('<div />', {class: 'table-responsive'});
								var table = $('<table />', {class: 'table table-striped', id: 'dataTable2', width: '100%', cellspacing: '0'});
								var thead = $('<thead />').append($('<tr />').append($('<th />', {width: '10'}).text('id')).append($('<th />').text('Name')));
								var tbody = $('<tbody />');

								for (var i = 0; i < data.o.length; i++){

										tbody.append($('<tr />').append($('<td />').text(data.o[i].id)).append($('<td />').text(data.o[i].name)));
								}

								tableResp.append(table.append(thead).append(tbody));

								bootbox.dialog({
										title: 'Step 2 - Select Function<br/>Industry: '+industry,
										message: tableResp,
										size: "large",
										buttons: {
											cancel: {
													label: "Cancel",
													className: 'btn-danger'
											},
											success: {
													label: "Add",
													className: 'btn-info',
													callback: function(){

															var occupation = $('.selected').children()[0].textContent + '-' + $('.selected').children()[1].innerText;

															$.post({ method: 'POST', url: 'targetjob/store', data: {_token: $("[name=_token]").val(), industry_id: industry, occupation_id: occupation},

																success: function(data){

																			if (data.error == false){

																					var button = $('<button />', {type: 'button', class: 'btn btn-danger pull-right', onclick: 'delete_item('+data.c+')'});
																					button.append($('<span />', {class: 'glyphicon glyphicon-trash'}))

																					var tr = $('<tr />', {class: data.c});
																					tr.append($('<td />').text(industry)).append($('<td />').text(occupation)).append($('<td />').append(button));

																					$('#table-target tbody').append(tr);
																			}
																			else{
																					bootbox.alert("Industry and Function Already Selected!");
																			}
																	}
															});
													}
											}
										}
								});

								$('#dataTable2').dataTable({ select: { style: 'single' }, paging: false, searching: false });
						}
				}
		});
}

function delete_item(code){

		bootbox.confirm({
			message: "Tem certeza que deseja deletar ?",
			callback: function(result){

						if (result == true){

								$.post({ method: 'DELETE', url: 'targetjob/'+code, data: {_token: $("[name=_token]").val()},

									success: function(data){

												if (data.error == false){

														$('#table-target > tbody > .'+code).remove();
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
