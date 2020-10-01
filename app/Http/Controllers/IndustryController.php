<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Industry;

class IndustryController extends Controller
{
		public function show(){

				try{
						$industries = Industry::all();

						if (!is_null($industries)){

								return response()->json(['i' => $industries]);
						}
				}
				catch (Exception $e){
						return response()->json(['i' => false]);
				}
		}
}
