<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Car;
use App\Models\Rate;
use App\Models\Reservation;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
        'avatar',
        'password',
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

    public function cars(): HasMany
    {
        return $this->hasMany(Car::class, 'uid');
    }

    public function ratingsGiven(): HasMany
    {
        return $this->hasMany(Rate::class, 'rate_author_id');
    }

    public function ratingsReceived(): HasMany
    {
        return $this->hasMany(Rate::class, 'rated_user_id');
    }

    public function getUserRating(): float
    {
        return round($this->ratingsReceived()->get()->avg('rate_value'), 1);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'uid');
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class, 'uid');
    }
}
