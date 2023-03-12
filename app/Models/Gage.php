<?php

namespace App\Models;

use App\Traits\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gage extends Model
{
    use HasFactory;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'is_done' => 0,
        'date_string' => "2023-03-12",
    ];

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
        'is_done',
        'cost',
        'date_string',
        'day',
        'month',
        'year',
        'timestamp',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
