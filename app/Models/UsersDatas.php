<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Users;
use App\Models\SexUsersDatas;

class UsersDatas extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = [
        'users_id',
        'sex_users_datas_id',
        'name',
        'lastname',
        'date_of_birth',
        'phone',
    ];

    /**
     * Function to get User
    */
    public function Users(){
        return $this->belongsTo(Users::class,'users_id');
    }

    /**
     * Function to get UsersDatas of SexUsersDatas
    */
    public function SexUsersDatas(){
        return $this->belongsTo(SexUsersDatas::class, 'sex_users_datas_id');
    }

}
