<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchFile  extends Model
{
    /** @use HasFactory<\Database\Factories\ResearchFilesFactory> */
    use HasFactory;
        protected $fillable = ['id','research_id','file_name','file_path','category'];
    public function research(){
        return $this->belongsTo(researche::class,);
    }
}
