<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gage extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'description',
        'category',
        'isDone',
        'dateString',
        'day',
        'month',
        'year',
        'timestamp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
