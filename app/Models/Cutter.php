<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class Cutter extends Model
{

    /**
     *
     */
    const LIMIT_SYMBOLS = 9;
    /**
     * @var string[]
     */
    protected $fillable = [
        'link',
        'hash',
        'life_time',
        'limit',
    ];

}