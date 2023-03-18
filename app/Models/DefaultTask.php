<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefaultTask extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'category',
        'reward',
        'path_icon_todo',
    ];

    use HasFactory;
}
