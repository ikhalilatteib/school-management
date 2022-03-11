<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class School extends Model
{
    use HasFactory;
    use BelongsToUser;

    protected $fillable = ['name', 'user_id'];

    public function campuses(): HasMany
    {
        return $this->hasMany(Campus::class);
    }
}
