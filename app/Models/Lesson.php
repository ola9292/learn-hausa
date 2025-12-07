<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    public $fillable = ['user_id','prompt', 'reply'];

    protected $casts = [
        'reply' => 'array',
    ];
    
}
