<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Symfony\Component\Console\Completion\Suggestion;

class Task extends Model
{
    use HasFactory;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    // protected $attributes = [
    //     'group_id' => Auth::user()->group
    // ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    protected $fillable = [
        'id',
        'group_id',
        // 'user_id',
        'category',
        'title',
        'description',
        'reward',
        'is_done',
        'associated_day',
        'path_icon_todo'
    ];

    public function group(): HasOne
    {
        return $this->hasOne(Group::class);
    }

    public function suggestions(): BelongsToMany
    {
        return $this->belongsToMany(Suggestion::class);
    }
}
