<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory;
    use BelongsToUser;

    protected $fillable = ['name', 'campus_id', 'user_id'];

    public function campus(): BelongsTo
    {
        return $this->belongsTo(Campus::class);
    }
}
