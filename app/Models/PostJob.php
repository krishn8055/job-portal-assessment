<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostJob extends Model
{
    use HasFactory;

    public function applyJobDetail(){
    return $this->hasOne('App\Models\ApplyJob','job_id','id')->where('seeker_id',auth()->user()->id);
  }

  public function jobApplication(){
    return $this->hasOne('App\Models\ApplyJob','job_id','id')->where('emp_id',auth()->user()->id);
  }
}
