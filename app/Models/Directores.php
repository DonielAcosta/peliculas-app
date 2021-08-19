<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Series;
use App\Models\Movies;

class Directores extends Model
{
    use HasFactory;


    /**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	*/
    protected $fillable = [
        'name',
        'lastname',
        'dascription',
    ];

    /**
     * Function to get Directores of Series
    */
    public function Series(){

        return $this->hasMany(Series::class,'directores_id');
    }

    /**
     * Function to get Directores of Movies
    */
    public function Movies(){

        return $this->hasMany(Movies::class,'directores_id');
    }
}
