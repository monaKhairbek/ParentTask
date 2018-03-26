<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model {

    public $table = 'order_items';
    protected $fillable = [
        'order_id',
        'name',
        'qnt',
        'value',
        'category',
        'subcategory',
        'collection_id'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'order_id' => 'required',
        'name' => 'required',
        'qnt' => 'required',
        'value' => 'required',
        'category' => 'required',
        'subcategory' => 'required',
        'collection_id' => 'required'
    ];

}

