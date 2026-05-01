<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vote extends Model
{
    /** @use HasFactory<\Database\Factories\VoteFactory> */
    use HasFactory;
    protected $fillable = ['id','research_id','user_id','comment','vote'];
    public function research(){
        return $this->belongsTo(researche::class);
    }
    public function user(){
        return $this->belongsTo(user::class);
    }
    
}
