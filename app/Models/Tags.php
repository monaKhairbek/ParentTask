<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model {

    public $table = 'tags';
    
    protected $fillable = [
        'title',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required'
    ];

}
