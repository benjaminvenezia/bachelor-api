<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gage extends Model
{
    use HasFactory;


    //     title: string;
    //   description: string;
    //   category: string;
    //   isDone: boolean;
    //   dateString: string;
    //   day: number;
    //   month: number;
    //   year: number;
    //   timestamp: number;

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
}
