<?php

namespace App\Models;

use App\Models\committee;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class specialization extends Model
{
    /** @use HasFactory<\Database\Factories\SpecializationFactory> */
    use HasFactory;
    protected $fillable = ['id','name'];

    public function users(){
        return $this->hasMany(User::class);
    }
    public function committee(){
        return $this->hasOne(committee::class);
    }
}
