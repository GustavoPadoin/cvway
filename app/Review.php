<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
			'rank', 'reviewer_id', 'user_id', 'occupation_id', 'industry_id'
		];
}
