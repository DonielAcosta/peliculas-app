<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UsersDatas;

class SexUsersDatas extends Model{
    use HasFactory;

    /**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	*/
    protected $fillable = [
        'name', 
    ];

    /**
     * Function to get SexUsersDatas of UsersDatas
    */
    public function UsersDatas(){

        return $this->hasMany(UsersDatas::class,'sex_users_datas_id');
    }
}
