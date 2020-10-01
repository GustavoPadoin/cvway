<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TrainingDegree;

class TrainingDegreeController extends Controller
{
		public function show(){

				try{
						$trainings = TrainingDegree::all();

						if (!is_null($trainings)){

								return response()->json(['t' => $trainings]);
						}
				}
				catch (Exception $e){
						return response()->json(['t' => false]);
				}
		}
}
