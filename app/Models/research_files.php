<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class research_files extends Model
{
    /** @use HasFactory<\Database\Factories\ResearchFilesFactory> */
    use HasFactory;
        protected $fillable = ['id','research_id','file_name','file_path','category'];

}
