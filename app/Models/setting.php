<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class setting extends Model
{
     protected $fillable=['id','logo','site_name','site_email','about','phone','country','city','street'];

}
