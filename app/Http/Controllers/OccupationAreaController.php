<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OccupationArea;

class OccupationAreaController extends Controller
{
		public function show(){

				try{
						$occupations = OccupationArea::all();

						if (!is_null($occupations)){

								return response()->json(['o' => $occupations]);
						}
				}
				catch (Exception $e){
						return response()->json(['o' => false]);
				}
		}
}
