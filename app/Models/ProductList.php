<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductList extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasOne('App\Models\User');
    }

    public function listitem()
    {
        return $this->hasMany('App\Models\ListItem');
    }
}
