<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    protected $guarded = [];

    use HasFactory;

    public function competition(): BelongsTo
    {
        return $this->belongsTo(Competition::class);
    }

    public function athlete_events(): BelongsToMany
    {
        return $this->belongsToMany(Athlete::class, 'athlete_events')
        ->withTimestamps();
    }
}
