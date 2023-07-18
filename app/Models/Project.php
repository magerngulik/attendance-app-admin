<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Project extends Model
{
 
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    
}
