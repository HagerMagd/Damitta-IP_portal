<?php

namespace App\Models;

use App\Models\admin;
use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    protected $fillable = ['id','role_name','permissions'];

    public function admins(){
        return $this->hasMany(admin::class
        );
    }


    protected $casts = [
        'permissions'=>'array',
    ]
    
    
    ;

}
