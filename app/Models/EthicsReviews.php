<?php

namespace App\Models;

use App\Models\researche;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EthicsReviews extends Model
{
    /** @use HasFactory<\Database\Factories\EthicsReviewsFactory> */
    use HasFactory;
    protected $fillable = ['id','research_id','reviewer_id','decision','notes'];

    public function research()
{
    return $this->belongsTo(researche::class);
}
    public function reviewer()
{
    return $this->belongsTo(User::class,'reviewer_id');
}
}
