<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    protected $fillable = [
        'name', 'main_no', 'tree_no', 'comment', 'capacity', 'category_id', 'is_show', 'is_delete', 'deleted_at', 'deleted_user', 'created_at','updated_at'
        ];
}
