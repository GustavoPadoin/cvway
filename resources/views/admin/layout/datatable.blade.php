<!-- Example DataTables Card-->
    <div class="table-responsive">
      <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
              <th width="10">Status</th>
              <th width="10">Id</th>
              <th>Nome</th>
							@if ($route == 'product')
								<th>Categoria</th>
							@endif
              <th>Data Cadastro</th>
              <th width="50">Ações</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($itens as $item)
              <tr>
                  <td>
                    @if ($item->status == 1)
                      <i class="fa fa-check" style="color: green;"></i>
                    @else
                      <i class="fa fa-close" style="color: red;"></i>
                    @endif
                  </td>
                  <td>{{ $item->id }}</td>
									<td>
										@if ($route == 'catalog')
											{{ $item->photo }}
										@else
											{{ $item->name }}
										@endif	
									</td>
									@if ($route == 'product')
										<td>{{ $item->category }}</td>
									@endif
                  <td>{{ $item->created_at }}</td>
                  <td>
                      <div class="btn-group">
                          <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                            <i class="fa fa-fw fa-gear"></i>
                            <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="{{ route($route.'.edit', $item->id) }}"><i class="fa fa-edit"></i>&nbsp;Editar</a></li>
                            <li><a onclick="deletar({{ $item->id }})" style="cursor: pointer;"><i class="fa fa-trash"></i> Deletar</a></li>
                            {{ Form::open(array('route' => array($route.'.destroy', $item->id), 'method' => 'delete', 'id' => 'form'.$item->id)) }}
                            {{ Form::close() }}
                          </ul>
                        </div>
                  </td>
              </tr>
          @endforeach
        </tbody>
      </table>
    </div>
