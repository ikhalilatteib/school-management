<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Campus extends Model
{
    use HasFactory;
    protected $fillable =['name','campus_id','school_id'];

    public function school():BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function country():BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
