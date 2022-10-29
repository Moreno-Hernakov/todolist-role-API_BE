<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class todo extends Model
{
    protected $todo = 'todo';
    protected $connection = 'mongodb';
    protected $guarded = ['id'];
    use HasFactory;
}
