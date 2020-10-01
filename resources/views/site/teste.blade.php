<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ asset('css/site.css') }}">

		<link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.min.css') }}">
		<title></title>
	</head>
	<body>
			<header></header>
			<section>
				<div class="container">

					<div class="row">

						<h1>Create your profile for free</h1>
						<p>and get your next job.</p>

						{{ Form::model(null, ['route' => 'site.store', 'id' => 'form']) }}

						<div class="col-md-6">
							<div class="box">

								<h1>Education</h1>

								@if ($errors->any())
									<div class="alert alert-danger">
											<ul style="margin-bottom: 0px;">
													@foreach ($errors->all() as $error)
															<li>{{ $error }}</li>
													@endforeach
											</ul>
									</div>
								@endif
								
								{{ Form::button('Add Item', array('class' => 'btn btn-primary', 'id' => 'add_education', 'style' => 'width:100%')) }}<br/><br/>

								<table class="table table-striped" id="table-formation">
									<thead>
										<tr>
											<th>Institution</th>
											<th>Period</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
										@if (!is_null($formations))
											@foreach ($formations as $fmt)
												<tr class="edu-{{ $fmt['c'] }}">
													<td>{{ $fmt['institution'] }}</td>
													<td>{{ $fmt['start_date'] . ' - ' . $fmt['final_date'] }}</td>
													<td>
														<button type="button" class="btn btn-danger pull-right" onclick="delete_formation({{ $fmt['c'] }})">
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

						<div class="col-md-6">
							<div class="box">

									<h1>Work Experience</h1>

									{{ Form::button('Add Item', array('class' => 'btn btn-primary', 'id' => 'add_experience', 'style' => 'width:100%')) }}<br/><br/>

									<table class="table table-striped" id="table-experience">
										<thead>
											<tr>
												<th>Company</th>
												<th>Period</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody>
											@if (!is_null($experiences))
												@foreach ($experiences as $exp)
													<tr class="exp-{{ $exp['x'] }}">
														<td>{{ $exp['company'] }}</td>
														<td>{{ $exp['start_date'] . ' - ' . $exp['final_date'] }}</td>
														<td>
															<button type="button" class="btn btn-danger pull-right" onclick="delete_experience({{ $exp['x'] }})">
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

			<script src="{{ asset('js/moment-with-locales.js') }}"></script>
			<script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
    	<script src="{{ asset('js/jquery.mask.min.js') }}"></script>

			<script src="{{ asset('js/education.js') }}"></script>
			<script src="{{ asset('js/work_experience.js') }}"></script>
	</body>
</html>
