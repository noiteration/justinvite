<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Invitation extends Model
{
    protected $fillable = [
        'email',
        'token',
        'invited_by',
        'expires_at'
    ];

    public static function createInvite(string $email, ?int $inviterId = null): self
    {
        return self::create([
            'email' => $email,
            'token' => Str::random(40),
            'invited_by' => $inviterId,
            'expires_at' => now()->addDays(7)
        ]);
    }

}
