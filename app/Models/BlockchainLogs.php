<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockchainLogs extends Model
{
    /** @use HasFactory<\Database\Factories\BlockchainLogsFactory> */
    use HasFactory;
    protected $fillable=['id','research_id','transaction_hash','type'];
    public function research() {
        return $this->belongsTo(researche::class);
    }

}

