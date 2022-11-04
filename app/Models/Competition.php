<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Competition extends Model
{
    use HasFactory;

    protected $dates = [
        'created_at',
        'updated_at',
        'start_date',
        'released_at',
    ];

    public function scopeForSessionClient($query)
    {
        $query->where('client_id', session('CLIENT_ID'));
    }

    public function scopeReleased(Builder $query): Builder
    {
        return $query->whereNotNull('released_at');
    }

    public function getFormattedDateAttribute()
    {
        $date = $this->start_date->format('D, d M Y');

        return $date;
    }

    public function getDisplayNameAttribute()
    {
        $name = $this->comp_name;
        if ($this->isPublic == 1) {
            $name = $this->comp_name.' (P)';
        }

        return $name;
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function athlete_competitions(): BelongsToMany
    {
        return $this->belongsToMany(Athlete::class, 'athlete_competitions')
        ->withTimestamps();
    }
}
