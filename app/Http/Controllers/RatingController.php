<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use App\Review;

class RatingController extends Controller
{
    public function index(){

					$users = User::all();
					return view ('admin.rating.index', compact('users'));
		}

		public function store(Request $request){

				try{
						$validator = $this->validacao($request);

						if ($validator->fails())
								return redirect('rating')->withErrors($validator->errors()->first());
						else{
								$data = $request->all();

								$r1 = $data['rating1'];
								$r2 = $data['rating2'];
								$r3 = $data['rating3'];

								if ( ($r1 == $r2) || ($r1 == $r3) || ($r2 == $r3))
										return redirect('rating')->withErrors("The ratings must be different.");
								else{
										for ($i = 1; $i <=3; $i++){
												Review::create([
													'rank' => $data['rating'.$i],
													'reviewer_id' => Auth::user()->id,
													'user_id' => $data['user'.$i],
													'occupation_id' =>
													'industry_id'
												]);
										}
								}
						}
				}
				catch (Exception $e){
						return redirect('rating')->withErrors($e->message());
				}
		}

		public function validacao($request){

				$rules = [
					'rating1' => 'required|in:1,2,3',
					'rating2' => 'required|in:1,2,3',
					'rating3' => 'required|in:1,2,3',
					'user1' => 'required|numeric',
					'user2' => 'required|numeric',
					'user3' => 'required|numeric'
				];

				return Validator::make($request->all(), $rules);
		}
}
