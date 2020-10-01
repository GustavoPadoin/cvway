<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Funcao;
use Validator;

class SiteController extends Controller
{
    public function index(Request $request){

				$targets = $request->session()->get('target');
				return view('site.index', compact('targets'));
		}

		public function saveuser(Request $request){

				try{
						$validator = $this->validacao($request);

						if ($validator->fails())
								return redirect('/')->withErrors($validator->errors()->first());
						else{

								$data = $request->all();

								$email = User::where('email', $data['email'])->get();

								if ($email->count() > 0)
										return redirect('/')->withErrors(['E-mail already registered.'])->withInput();
								else{

										$target = $request->session()->get('target');

										if (is_null($target))
												return redirect('/')->withErrors(['Target Jobs cannot be empty.'])->withInput();
										else{
												unset($data["_token"]);
												$data["password"] = bcrypt($data['password']);

												$request->session()->put('user', $data);
												return redirect()->route('site.teste');
										}
								}
						}
				}
				catch (Exception $e){
						return redirect('/')->withErrors([$e->message()]);
				}
		}

		public function teste(Request $request){

				$formations = $request->session()->get('formation');
				$experiences = $request->session()->get('experience');

				return view('site.teste', compact('formations', 'experiences'));
		}

		public function store(Request $request){

				try{

						$users = $request->session()->get('user');
						$target = $request->session()->get('target');

						if ( (is_null($users)) || (is_null($target)) )
								return redirect('/')->withErrors(['User or Target Job cannot be empty.'])->withInput();
						else{

								 $formation = $request->session()->get('formation');
								 $experience = $request->session()->get('experience');

								 if ( (is_null($formation)) || (is_null($experience)) )
											return redirect('teste')->withErrors(['Education or Work Experience cannot be empty.'])->withInput();
								 else{

											$user = User::create($users);

											foreach ($target as $tgt) {
													$user->targetjobs()->create($tgt);
											}

											foreach ($formation as $fmt) {
													$user->formations()->create($fmt);
											}

											foreach ($experience as $exp) {
													$user->experiences()->create($exp);
											}

											session()->forget(['user', 'target', 'formation', 'experience']);
											return redirect('site/final');
								}
						}
				}
				catch (Exception $e){
						return redirect('/')->withErrors([$e->message()]);
				}
		}

		public function final(){

				return view('site.final');
		}

		public function validacao($request){

				$rules = [
					'name' => 'required|min:10',
					'email' => 'required|email',
					'password' => ['required', 'min:8', 'regex:/(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]/']
				];

				return Validator::make($request->all(), $rules);
		}
}
