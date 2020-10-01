<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    protected $fillable = [
			'institution',
			'start_date',
			'final_date',
			'hist_id',
			'hist_date_hour',
			'description',
			'grad_grade',
			'training_degree_id',
			'user_id'
		];

		public function training_degree(){

				return $this->belongsTo(TrainingDegree::class);
		}

		public function user(){

				return $this->belongsTo(User::class);
		}

		public function setStartDateAttribute($value){

				$this->attributes['start_date'] = Funcao::formataData($value);
		}

		public function setFinalDateAttribute($value){

				$this->attributes['final_date'] = Funcao::formataData($value);
		}
}
