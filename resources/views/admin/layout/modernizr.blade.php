<ul class="grid cs-style-3 row">
		@foreach ($itens as $item)
				<li class="col-sm-@if($route == 'product'){{ 2 }}@else {{ 3 }}@endif">
					<figure>
						@if ($route != 'client')
							<img src="{{ asset('storage/'.$route.'/'.$item->photo) }}" @if($route == 'product'){{ 'width=150 height=415' }} @elseif(in_array($route,['catalog','banner'])) {{ 'width=350' }} @endif>
						@else
							<img src="{{ asset('storage/photo/'.$item->photo) }}">
						@endif
						<figcaption>
								@if ($route != 'photo')
									<a href="{{ route($route.'.edit', $item->id) }}"><i class="fa fa-edit"></i> Editar</a>
								@endif
								@if ($route == 'client')
									<a href="{{ route('photo.index', ['id' => $item->id]) }}"><i class="fa fa-picture-o"></i> Fotos</a>
								@endif
								<a onclick="deletar({{ $item->id }})" style="cursor:pointer;color: #FFF;"><i class="fa fa-trash"></i> Deletar</a>
								{{ Form::open(array('route' => array($route.'.destroy', $item->id), 'method' => 'delete', 'id' => 'form'.$item->id)) }}
								{{ Form::close() }}
						</figcaption>
					</figure>
					<h4>
						@if ($route != 'photo')
							@if ($item->status == 1)
								<i class="fa fa-check" style="color: green;"></i>
							@else
								<i class="fa fa-close" style="color: red;"></i>
							@endif
						@endif
						{{ $item->name }}<br/>{{ $item->created_at }}
					</h4>
				</li>
		@endforeach
</ul>
