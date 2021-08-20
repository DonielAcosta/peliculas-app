<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Series;
use App\Models\Movies;
use App\Models\Users;

class Scores extends Model{
    use HasFactory;



    /**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	*/
    protected $fillable = [
        'puntuation',
        'users_id',
        'description',
    ];

    /**
     * Function to get Scores of Series
    */
    public function Series(){

        return $this->hasMany(Series::class,'scores_id');
    }

    /**
     * Function to get Scores of Movies
    */
    public function Movies(){

        return $this->hasMany(Movies::class,'scores_id');
    }

    /**
     * Function to get Scores of users
    */
    public function Users(){

        return $this->belongsTo(Users::class,'scores_id');
    }
}
