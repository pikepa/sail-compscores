<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompetitionCompetitor extends Model
{
    use HasFactory;

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function getFormattedEntryDateAttribute()
    {
        if (Carbon::now()->format('Y') == $this->created_at->format('Y')) {
            $date = $this->created_at->format('D, jS M');

            return $date;
        } else {
            $date = $this->created_at->format('D, jS M y');

            return $date;
        }
    }

}
