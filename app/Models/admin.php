<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class admin extends  Authenticatable 
{
     protected $fillable = ['id','name','email','password','image_path','role_id'];

     public function roles(){
        return $this->belongsTo(role::class);
     }
      protected $hidden = [
        'password',
        'remember_token',
    ];
     protected $casts = [
        'email_verified_at' => 'datetime',
        'password'=>'hashed',
    ];

    
}
