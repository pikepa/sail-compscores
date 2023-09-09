<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'event_date' => 'datetime',
    ];

    use HasFactory;

    public function getFormattedEventDateAttribute()
    {
        if (Carbon::now()->format('Y') == $this->event_date->format('Y')) {
            $date = $this->event_date->format('D, jS M');

            return $date;
        } else {
            $date = $this->event_date->format('D, jS M y');

            return $date;
        }
    }

    public function competition(): BelongsTo
    {
        return $this->belongsTo(Competition::class);
    }

    public function competitors(): BelongsToMany
    {
        return $this->belongsToMany(Competitor::class, 'competitor_events')
        ->withTimestamps();
    }
}
