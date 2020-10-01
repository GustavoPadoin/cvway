<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Funcao;
use Validator;

class FormationController extends Controller
{
    public function store(Request $request){

				try{
						$validator = $this->validacao($request);

						if ($validator->fails())
								return response()->json(['error' => true, 'msg' => $validator->errors()->first()]);
						else{

								$data = $request->all();

								$start = Funcao::formataData2($data['start_date']);
								$final = Funcao::formataData2($data['final_date']);

								if ( (strtotime($start)) >= (strtotime($final)))
										return response()->json(['error' => true, 'msg' => 'The Start Date cannot be greater than the End Date']);
								else{

										unset($data['_token']);

										$formation = $request->session()->get('formation');

										if (is_null($formation)){

												$data['c'] = 1;
												$request->session()->put('formation', [$data]);
										}
										else{

												$data['c'] = end($formation)['c'] + 1;
												$formation[] = $data;
												$request->session()->put('formation', $formation);
										}

										return response()->json(['error' => false, 'c' => $data['c']]);
								}
						}
				}
				catch (Exception $e){
						return response()->json(['error' => true, 'msg' => $e->message()]);
				}
		}

		public function destroy(Request $request, $id){

				if (Funcao::numeric($id)){

						$formation = $request->session()->get('formation');

						if (!is_null($formation)){

								foreach ($formation as $key => $value) {

										if ($value['c'] == $id){

												unset($formation[$key]);
										}
								}

								if (empty($formation)){
										$formation = null;
								}

								$request->session()->put('formation', $formation);
								return response()->json(['error' => false]);
						}
				}

				return response()->json(['error' => true]);
		}

		public function validacao($request){

				$rules = [
					'institution' => 'required|min:10',
					'start_date' => 'required|date_format:d/m/Y',
					'final_date' => 'required|date_format:d/m/Y',
					'grad_grade' => 'required',
					'training_degree_id' => 'required|numeric',
					'description' => 'required|min:10'
				];

				return Validator::make($request->all(), $rules);
		}
}
