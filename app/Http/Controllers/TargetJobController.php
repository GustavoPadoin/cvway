<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Funcao;

class TargetJobController extends Controller
{
		public function store(Request $request){

				$cont = 0;
				$data = $request->all();

				$target = $request->session()->get('target');

				if (is_null($target)){

						$data['c'] = 1;
						$request->session()->put('target', [$data]);
				}
				else{

						foreach ($target as $tgt) {

								if (empty(array_diff($data, $tgt))){
										$cont++;
								}
						}

						if ($cont == 0){

								$data['c'] = end($target)['c'] + 1;
								$target[] = $data;
								$request->session()->put('target', $target);
						}
						else{
								return response()->json(['error' => true]);
						}
				}

				return response()->json(['error' => false, 'c' => $data['c']]);
		}

		public function destroy(Request $request, $id){

				if (Funcao::numeric($id)){

						$target = $request->session()->get('target');

						if (!is_null($target)){

								foreach ($target as $key => $value) {

										if ($value['c'] == $id){

												unset($target[$key]);
										}
								}

								if (empty($target)){
										$target = null;
								}

								$request->session()->put('target', $target);
								return response()->json(['error' => false]);
						}
				}
				return response()->json(['error' => true]);
		}
}
