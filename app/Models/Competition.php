<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;

    protected $dates = [
        'created_at',
        'updated_at',
        'start_date',
        'released_at'
    ];

public function scopeReleased(Builder $query): Builder
{
    return $query->whereNotNull('released_at');
}



    public function getFormattedDateAttribute() {
        $date = $this->start_date->format('D, d M Y');
        return $date; 
    }


}
