<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    protected $table = 'times';
    
    protected $fillable = [
        'worker_id',
        'start',
        'stop'
        ];
    public function timeWhereId($id)
    {
        return Time::where('id', $id)->get();
    }
}
