<?php

namespace App\Models;

use App\Models\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Athlete extends Model
{
    use HasFactory;

    public function athlete_events(): BelongsToMany
    {
        return $this->belongsToMany(Athlete::class, 'athlete_events')
        ->withTimestamps();
    }
    
    public function athlete_competitions(): BelongsToMany
    {
        return $this->belongsToMany(Competition::class, 'athlete_competitions')
        ->withTimestamps();
    }


}
