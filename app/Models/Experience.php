<?php


namespace App\Models;
use App\Models\DetailExperience;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Experience extends Model
{
    
    public function experience(): HasMany
    {
        return $this->hasMany(DetailExperience::class, 'id_experiences', 'id');
    }
    
}
