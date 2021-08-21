<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Series;

class Seasons extends Model{
    use HasFactory;


    /**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	*/
    protected $fillable = [
     
        'cap',
        'seasons_number'
    ];

    /**
     * Function to get Seasons of series
    */
    public function Series(){

        return $this->hasMany(Series::class,'seasons_id');
    }

}
