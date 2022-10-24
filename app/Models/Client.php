<?php

namespace App\Models;

use App\Models\Competition;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Client extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function client_users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'client_users')
        ->withTimestamps();
    }

    public function competitions(): HasMany
    {
        return $this->hasMany(Competition::class);
    }
    public function invitees(): HasMany
    {
        return $this->hasMany(Invitee::class);
    }
}
