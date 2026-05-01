<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class decision extends Model
{
    /** @use HasFactory<\Database\Factories\DecisionFactory> */
    use HasFactory;
    protected $fillable = ['id','research_id','result'];


    public function research()
{
    return $this->belongsTo(researche::class);
}
     
    

}
