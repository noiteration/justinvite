<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Invitation extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'token',
        'invited_by',
        'expires_at',
        'accepted_at',
    ];

    public function inviter()
    {
        return $this->belongsTo(User::class, 'invited_by');
    }

    public function isValid(): bool
    {
        return !$this->accepted_at &&
            (!$this->expires_at || now()->lessThan($this->expires_at));
    }

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
