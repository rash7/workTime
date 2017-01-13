<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
     protected $table = 'workers';
     
     protected $fillable = [
         'worker_id',
         'start',
         'stop'
         ];

     public function workers()
    {
        return $this->hasMany('Worker');
    }
    
}
