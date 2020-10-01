@extends('admin.layout.site')

@section('css')
	 <link rel="stylesheet" href="{{ asset('css/lionbars.css') }}">
	 <style media="screen">
	 		body{
				font-size: 16px;
			}
		 .box {
				height: 600px;
				overflow:auto;
			}
			input[type="submit"]{
				width: 200px;
				margin-top: 20px;
				font-size: 16px;
			}
		</style>
@endsection

@section('content')

		<?php
			function format_date($date){
					$d = explode("-", $date);
					return $d[2] . "/" . $d[1] . "/" . $d[0];
			}
		?>

    <h2><i class="fa fa-fw fa-file-text-o"></i> Curriculum</h2>

    @if ($errors->any())
      <div class="alert alert-danger">
          <ul style="margin-bottom: 0px;">
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif

		@if ($users->count() > 0)
			{{ Form::model(null, ['route' => 'rating.store', 'method' => 'POST']) }}
				<div class="row">
					<?php $cont = 1; ?>
					 @foreach($users as $user)
							<div class="col-sm-4">
									<div class="box box-primary">
											<div class="box-header">
													<h2 class="box-title">Curriculum: {{ $user->id }}</h2>
											</div>
											<div class="box-body">
												<h4>Educations</h3>
												@foreach($user->formations as $formation)
													<table class="table table-striped" id="table-target">
														<tbody>
																<tr>
																	<td><strong>Institution:</strong> {{ $formation->institution }}</td>
																</tr>
																<tr>
																	<td>
																		<strong>Start Date:</strong> {{ format_date($formation->start_date) }}
																		<strong>Final Date:</strong> {{ format_date($formation->final_date) }}
																	</td>
																</tr>
																<tr>
																	<td><strong>Grade:</strong> {{ $formation->grad_grade }}</td>
																</tr>
																<tr>
																	<td><strong>Training Degree:</strong> {{ $formation->training_degree->name }}</td>
																</tr>
																<tr>
																	<td><strong>Description:</strong> {{ $formation->description }}</td>
																</tr>
														</tbody>
													</table><br/>
												@endforeach
												<h4>Work Experience</h4>
												@foreach ($user->experiences as $experience)
													<table class="table table-striped" id="table-target">
														<tbody>
																<tr>
																	<td><strong>Company:</strong> {{ $experience->company }}</td>
																</tr>
																<tr>
																	<td>
																		<strong>Start Date:</strong> {{ format_date($experience->start_date) }}
																		<strong>Final Date:</strong> {{ format_date($experience->final_date) }}
																	</td>
																</tr>
																<tr>
																	<td><strong>Industry:</strong> {{ $experience->industry->name }}</td>
																</tr>
																<tr>
																	<td><strong>Occupation Area:</strong> {{ $experience->occupation->name }}</td>
																</tr>
																<tr>
																	<td><strong>Description:</strong> {{ $experience->description }}</td>
																</tr>
														</tbody>
													</table><br/>
												@endforeach
											</div>
									</div>
									<div class="alert" style="background: #fff;">
										{{ Form::radio('rating'.$cont, 1) }} First
										{{ Form::radio('rating'.$cont, 2) }} Second
										{{ Form::radio('rating'.$cont, 3) }} Third
										{{ Form::hidden('user'.$cont, $user->id) }}
									</div>
							</div>
							<?php $cont++; ?>
					 @endforeach
				</div>
				<div class="row">
					<div class="col-xs-12" style="text-align: center;">
						{{ Form::submit('Cancel', array('class' => 'btn btn-danger', 'style' => 'margin-right: 15px;')) }}
						{{ Form::submit('Next >>', array('class' => 'btn btn-success')) }}
					</div>
				</div>
			{{ Form::close() }}
		@else
			<div class="alert alert-info">There are no registered Curriculum.</div>
		@endif

@endsection

@section('js')
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	 <script src="{{ asset('js/lionbars.js') }}"></script>
	 <script>
		$(document).ready(function() {
			$('.box').lionbars();
		});
		</script>
@endsection
