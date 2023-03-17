<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schoolarship extends Model
{
    protected $table = 'schoolarship';
    protected $fillable = [
        'code','name','school','major','presenter','whatsapp'
    ];
}
