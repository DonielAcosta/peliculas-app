<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Seasons;
use App\Models\Scores;
use App\Models\Directores;

class Series extends Model{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = [
        'scores_id',
        'directores_id',
        'seasons_id',
        'name',
        'year',
        'description',
    ];

    /**
     * Function to get Series of Seasons
    */
    public function Seasons(){
        return $this->belongsTo(Seasons::class, 'seasons_id');
    }

    /**
     * Function to get Series of Scores
    */
    public function Scores(){
        return $this->belongsTo(Scores::class,'scores_id');
    }

    /**
     * Function to get Series of Directores
    */
    public function Directores(){
        return $this->belongsTo(Directores::class, 'directores_id');
    }
}
