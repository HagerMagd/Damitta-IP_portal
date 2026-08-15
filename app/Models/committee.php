<?php

namespace App\Models;

use App\Models\researche;
use App\Models\specialization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class committee extends Model
{
    /** @use HasFactory<\Database\Factories\CommitteeFactory> */
    use HasFactory;
     protected $fillable = ['id','name','type','specialization_id'];
     public function specialization(){
        return $this->belongsTo(specialization::class);
     }
      public function researches(){
        return $this->hasMany(researche::class);
     }
     public function members()
{
    return $this->hasMany(CommitteeMember::class);
}

}
