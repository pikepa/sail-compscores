<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    protected $guarded = [];
    
    protected $dates = [
        'created_at',
        'updated_at',
        'event_date',
    ];

    use HasFactory;

    public function getFormattedEventDateAttribute()
    {
        if(Carbon::now()->format('Y') == $this->event_date->format('Y'))
        {
            $date = $this->event_date->format('D, jS M');

            return $date;  
        }
        else{
            $date = $this->event_date->format('D, jS M y');

            return $date;
        }

    }

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
