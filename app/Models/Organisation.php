<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'owner_id',
        'contact_name',
        'contact_email',
        'contact_phone'
    ];
}
