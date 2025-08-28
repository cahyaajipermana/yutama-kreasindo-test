<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(ItemCategory::class, 'category_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
