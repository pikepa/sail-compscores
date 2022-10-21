<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;

    protected $dates = [
        'created_at',
        'updated_at',
        'start_date'
    ];
    public function getFormattedDateAttribute() {
        $date = $this->start_date->format('D, d M Y');
        return $date; 
    }


}
