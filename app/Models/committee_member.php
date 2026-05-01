<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class committee_member extends Model
{
    /** @use HasFactory<\Database\Factories\CommitteeMemberFactory> */
    use HasFactory;
    protected $fillable = ['id', 'committee_id', 'user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function committee()
    {
        return $this->belongsTo(committee::class);
    }
}
