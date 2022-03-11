<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Country extends Model
{
    use HasFactory;
    use BelongsToUser;

    protected $fillable=['name','user_id'];

    public function campus():HasOne
    {
        return $this->hasOne(Campus::class);
    }
}
