<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Competition extends Model
{
    use HasFactory;

    protected $guarded = [];

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
        if (Carbon::now()->format('Y') == $this->start_date->format('Y')) {
            $date = $this->start_date->format('D, jS M');

            return $date;
        } else {
            $date = $this->start_date->format('D, jS M y');

            return $date;
        }
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

    public function competitors(): BelongsToMany
    {
        return $this->belongsToMany(Competitor::class, 'competition_competitors')
            ->withPivot('entry_status')
        ->withTimestamps();
    }
}
