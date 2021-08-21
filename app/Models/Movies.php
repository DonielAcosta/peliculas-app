<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Directores;
use App\Models\Scores;
use App\Models\Users;

class Movies extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = [
        'scores_id',
        'directores_id',
        'name',
        'year',
        'description',
    ];

    /**
     * Function to get Movies of Directores
    */
    public function Directores(){
        return $this->belongsTo(Directores::class, 'directores_id');
    }

    /**
     * Function to get Movies of Scores
    */
    public function Scores(){
        return $this->belongsTo(Scores::class,'scores_id');
    }

    /**
     * Function to get Movies of favorites
    */
    public function favorites(){
        
        return $this->belongsToMany(Users::class, 'favorites','movies_id','users_id');
    }

    // public function Favorites(){
        
    //     return $this->belongsToMany(Movies::class, 'favorites', 'movies_id','users_id');
    // }

}
