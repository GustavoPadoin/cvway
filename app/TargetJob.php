<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TargetJob extends Model
{
    protected $fillable = [
				'industry_id',
				'occupation_id',
				'user_id'
		];

		public function user(){

				return $this->belongsTo(User::class);
		}

		public function industry(){

				return $this->belongsTo(Industry::class);
		}

		public function occupation(){

				return $this->belongsTo(OccupationArea::class);
		}

		public function setIndustryIdAttribute($value){

				$attr = explode("-", $value);
				$this->attributes['industry_id'] = $attr[0];
		}

		public function setOccupationIdAttribute($value){

				$attr = explode("-", $value);
				$this->attributes['occupation_id'] = $attr[0];
		}
}
