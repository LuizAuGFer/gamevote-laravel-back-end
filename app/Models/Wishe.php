<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishe extends Model
{
    use HasFactory;

    /**
     * The table associated with the model
     *
     * @var string
     */
    public $table = 'wishes';
    
    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    public $fillable = [
        'user_id',
        'game_id',
        'category_id',
        'voting_id'
    ];

    /**
     * The attributes that should be casted to native types
     *
     * @var array
     */
    protected $casts = [
        'user_id'       => 'integer',
        'game_id'       => 'integer',
        'category_id'   => 'integer',
        'voting_id'     => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id'       => 'required',
        'game_id'       => 'required',
        'category_id'   => 'required',
        'voting_id'     => 'required'
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
