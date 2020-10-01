<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

		public function targetjobs(){

				return $this->hasMany(TargetJob::class);
		}

		public function formations(){

				return $this->hasMany(Formation::class);
		}

		public function experiences(){

				return $this->hasMany(ProfessionalExperience::class);
		}

		public static function list(){

				return DB::table('users AS u')
						->select('u.id', 'i.name AS industry', 'o.name AS occupation')
						->join('target_jobs AS t', 't.user_id', '=', 'u.id')
						->join('industries AS i', 'i.id', '=', 't.industry_id')
						->join('occupation_areas AS o', 'o.id', '=', 't.occupation_id')->get();
	//					->join('formations AS f', 'f.user_id', '=', 'u.id')
		//				->join('training_degrees AS d', 't.id', '=', 'f.training_degree_id')
			//			->join('professional_experiences as p', 'p.user_id', '=', 'u.id')->get()
		}
}
