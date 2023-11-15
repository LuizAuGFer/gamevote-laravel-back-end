<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voting extends Model
{
    use HasFactory;

    /**
     * The table associated with the model
     *
     * @var string
     */
    public $table = 'votings';
    
    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    public $fillable = [
        'name',
        'photo',
        'expires_in',
        'is_active'
    ];

    /**
     * The attributes that should be casted to native types
     *
     * @var array
     */
    protected $casts = [
        'name'          => 'string',
        'photo'         => 'string',
        'expires_in'    => 'date',
        'is_active'     => 'boolean',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name'          => 'required',
        'photo'         => 'required',
        'expires_in'    => 'required',
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
