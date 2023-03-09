<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'user_id1',
        'user_id2',
    ];

    /**
     * Get the user that owns the group.
     */
    public function user()
    {
        return $this->hasMany(User::class);
    }
}
