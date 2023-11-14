<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    /**
     * The table associated with the model
     *
     * @var string
     */
    public $table = 'games';
    
    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    public $fillable = [
        'name',
        'photo',
        'year',
        'developer'
    ];

    /**
     * The attributes that should be casted to native types
     *
     * @var array
     */
    protected $casts = [
        'name'      => 'string',
        'photo'     => 'string',
        'year'      => 'date',
        'developer' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name'      => 'required',
        'photo'     => 'required',
        'year'      => 'required',
        'developer' => 'required',
    ];

    /**
     * The accessors to append to the model's array form
     *
     * @var array
     */
    protected $appends = [
        'readable_created_at',
        'readable_updated_at',
    ];

    // =========================================================================
    // Relationships
    // =========================================================================

}
