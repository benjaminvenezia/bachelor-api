<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category',
        'title',
        'description',
        'reward',
        'isDone',
        'associated_day',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
