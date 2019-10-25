<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Status;
use App\User;

class Status extends Model
{
    protected $fillable = [
    	'id','nama',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
