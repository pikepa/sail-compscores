<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Competitor extends Model
{
    protected $guarded = [];

    use HasFactory;

    public function getDisplayTypeAttribute()
    {
        if ($this->is_team) {
            $type = 'Team';
        } else {
            $type = 'Indiv';
        }

        return $type;
    }

    public function getDisplayNameAttribute()
    {
        if ($this->is_team) {
            $name = $this->team_name;
        } else {
            $name = $this->first_name.' '.$this->surname;
        }

        return $name;
    }

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'competitor_events')
        ->withTimestamps();
    }

    public function competitions(): BelongsToMany
    {
        return $this->belongsToMany(Competition::class, 'competition_competitors')
            ->withTimestamps();
    }
}
