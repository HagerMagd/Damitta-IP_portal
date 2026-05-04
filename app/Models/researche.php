<?php

namespace App\Models;

use App\Models\committee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class researche extends Model
{
    /** @use HasFactory<\Database\Factories\ResearcheFactory> */
    use HasFactory;
     protected $fillable = ['id','title','desc','status','committee_id','user_id','hash'];
    public function user(){
        return $this->belongsTo(User::class,);
    }
    public function committee(){
        return $this->belongsTo(committee::class,);
    }
    public function ethics_reviews(){
        return $this->hasMany(EthicsReviews::class,);
    }
    public function votes(){
        return $this->hasMany(vote::class,);
    }
    public function decision(){
        return $this->hasOne(decision::class,);
    }
    public function blockchain_logs(){
        return $this->hasMany(BlockchainLogs::class,);
    }
    public function researchesfiles(){
        return $this->hasMany(ResearchFile::class,);
    }
}
