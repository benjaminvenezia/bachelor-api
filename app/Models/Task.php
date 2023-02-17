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
        'name',
        'description',
        'reward',
        'isDone',
        'associated_day',
    ];

    // 'id' => 2,
    // 'user_id' => 1,
    // 'category' => 'kitchen',
    // 'name' => "faire à manger",
    // 'description' => "Vous devez préparer le repas.",
    // 'reward' => 12,
    // 'isDone' => false,
    // 'associated_day' => 'lun',

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
