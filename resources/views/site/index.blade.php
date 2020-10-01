<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ asset('css/site.css') }}">
		<link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap.min.css') }}">
		<link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.7/css/select.dataTables.min.css">
		<title></title>
	</head>
	<body>
			<header></header>
			<section>
				<div class="container">

					<div class="row">

						<h1>Create your profile for free</h1>
						<p>and get your next job.</p>

						{{ Form::model(null, ['route' => 'site.saveuser', 'id' => 'form']) }}

						<div class="col-md-6">
							<div class="box">

								<h1>Personal Data</h1>

								@if ($errors->any())
						      <div class="alert alert-danger">
						          <ul style="margin-bottom: 0px;">
						              @foreach ($errors->all() as $error)
						                  <li>{{ $error }}</li>
						              @endforeach
						          </ul>
						      </div>
						    @endif

									{{ Form::label('name', 'Name') }}
									{{ Form::text('name', null, array('class' => 'form-control', 'maxlength' => '60')) }}<br/>

									{{ Form::label('email', 'E-mail') }}
									{{ Form::text('email', null, array('class' => 'form-control', 'maxlength' => '80')) }}<br/>

									{{ Form::label('password', 'Password') }}
									{{ Form::password('password', array('class' => 'form-control', 'maxlength' => '20')) }}
									<span>8 to 20 characters (numbers and letters)</span>

							</div>
						</div>

						<div class="col-md-6">
							<div class="box">

								<h1>Target Jobs</h1>

								{{ Form::button('Add Item', array('class' => 'btn btn-primary', 'id' => 'add_item', 'style' => 'width:100%')) }}<br/><br/>

								<table class="table table-striped" id="table-target">
									<thead>
										<tr>
											<th>Industry</th>
											<th>Function</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
										@if (!is_null($targets))
											@foreach ($targets as $tgt)
												<tr class="{{ $tgt['c'] }}">
													<td>{{ $tgt['industry_id'] }}</td>
													<td>{{ $tgt['occupation_id'] }}</td>
													<td>
														<button type="button" class="btn btn-danger pull-right" onclick="delete_item({{ $tgt['c'] }})">
															<span class="glyphicon glyphicon-trash"></span>
														</button>
													</td>
												</tr>
											@endforeach
										@endif
									</tbody>
								</table>

							</div>
						</div>

						<div style="text-align: center;">
								{{ Form::submit('CONTINUE') }}
						</div>

						{{ Form::close() }}

					</div>

				</div>
			</section>
			<script src="{{ asset('js/jquery.min.js') }}"></script>
			<script src="{{ asset('js/bootstrap.min.js') }}"></script>
			<script src="{{ asset('js/bootbox.min.js') }}"></script>
			<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
			<script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
			<script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
			<script src="{{ asset('js/target_job.js') }}"></script>
	</body>
</html>
