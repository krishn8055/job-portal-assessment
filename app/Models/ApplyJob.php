<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplyJob extends Model
{
    use HasFactory;

    public function jobDetail(){
    return $this->hasOne('App\Models\PostJob','id','job_id');
  }
}
