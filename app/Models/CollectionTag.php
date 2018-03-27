<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollectionTag extends Model {

    public $table = 'collection_item_tags';
    
    protected $fillable = [
        'collection_id',
        'tag_id'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'collection_id' => 'required',
        'tag_id' => 'required'
    ];

}
