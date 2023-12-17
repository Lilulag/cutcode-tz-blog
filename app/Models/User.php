<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function savedAvatars(): HasMany
    {
        return $this->hasMany(Avatar::class)->where('status', '=', '0');
    }

    /**
     * @return HasMany
     */
    public function avatars(): HasMany
    {
        return $this->hasMany(Avatar::class);
    }

    /**
     * @return string
     */
    public function getAvatarUrlAttribute(): string
    {
        return empty($this->avatar_id) ? '' : url('storage/'.Avatar::find($this->avatar_id)?->path);
    }

    /**
     * @return string
     */
    public function getLastAvatarUrlAttribute(): string
    {
        return $this->savedAvatars->count() > 0 ? url('storage/'.$this->savedAvatars->first()->path) : '';
    }
}
