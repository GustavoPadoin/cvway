<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Industry;
use App\OccupationArea;
use App\Funcao;
use Validator;

class ProfessionalExperienceController extends Controller
{
		public function show(){

				try{
						$industries = Industry::all();
						$occupations = OccupationArea::all();

						if ( (!is_null($industries)) && (!is_null($occupations)) ){

								return response()->json(['i' => $industries, 'o' => $occupations]);
						}
				}
				catch (Exception $e){
						return response()->json(['i' => false]);
				}
		}

		public function store(Request $request){

				try{
						$validator = $this->validacao($request);

						if ($validator->fails())
								return response()->json(['error' => true, 'msg' => $validator->errors()->first()]);
						else{

								$data = $request->all();

								$start = Funcao::formataData2($data['start_date']);
								$final = Funcao::formataData2($data['final_date']);

								if ( (strtotime($start)) >= (strtotime($final)) )
										return response()->json(['error' => true, 'msg' => 'The Start Date cannot be greater than the End Date']);
								else{

										unset($data['_token']);

										$experience = $request->session()->get('experience');

										if (is_null($experience)){

												$data['x'] = 1;
												$request->session()->put('experience', [$data]);
										}
										else{

												$data['x'] = end($experience)['x'] + 1;
												$experience[] = $data;
												$request->session()->put('experience', $experience);
										}

										return response()->json(['error' => false, 'x' => $data['x']]);
								}
						}
				}
				catch (Exception $e){
						return response()->json(['error' => true, 'msg' => $e->message()]);
				}
		}

		public function destroy(Request $request, $id){

				if (Funcao::numeric($id)){

						$experience = $request->session()->get('experience');

						if (!is_null($experience)){

								foreach ($experience as $key => $value) {

										if ($value['x'] == $id){

												unset($experience[$key]);
										}
								}

								if (empty($experience)){
										$experience = null;
								}

								$request->session()->put('experience', $experience);
								return response()->json(['error' => false]);
						}
				}

				return response()->json(['error' => true]);
		}

		public function validacao($request){

				$rules = [
					'company' => 'required|min:10',
					'start_date' => 'required|date_format:d/m/Y',
					'final_date' => 'required|date_format:d/m/Y',
					'industry_id' => 'required|numeric',
					'occupation_id' => 'required|numeric',
					'description' => 'required|min:10'
				];

				return Validator::make($request->all(), $rules);
		}
}
