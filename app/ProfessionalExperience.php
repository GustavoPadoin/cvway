<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfessionalExperience extends Model
{
    protected $fillable = [
			'company',
			'start_date',
			'final_date',
			'hist_id',
			'hist_date_hour',
			'description',
			'industry_id',
			'occupation_id',
			'user_id'
		];

		public function industry(){

				return $this->belongsTo(Industry::class);
		}

		public function occupation(){

				return $this->belongsTo(OccupationArea::class);
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
