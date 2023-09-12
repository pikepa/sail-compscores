<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeThisClients($query)
    {
        return $query->where('client_id', session('CLIENT_ID'));
    }

    public function users(): BelongsToMany
    {
        return $this->BelongsToMany(User::class, 'client_users', 'client_id', 'user_id');
    }

    // public function client_users(): BelongsToMany
    // {
    //     return $this->belongsToMany(User::class, 'client_users', 'client_id', 'user_id')
    //     ->orderByDesc('users.created_at')
    //     ->withTimestamps();
    // }

    public function competitions(): HasMany
    {
        return $this->hasMany(Competition::class);
    }

    public function invitees(): HasMany
    {
        return $this->hasMany(Invitee::class);
    }
}
