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

    // Relationship to cars.
    public function cars(): HasMany
    {
        return $this->hasMany(Car::class, 'uid');
    }

    // Relationship to given ratings.
    public function ratingsGiven(): HasMany
    {
        return $this->hasMany(Rate::class, 'rate_author_id');
    }

    // Relationship to received ratings.
    public function ratingsReceived(): HasMany
    {
        return $this->hasMany(Rate::class, 'rated_user_id');
    }

    /**
     * Gets the average user rating.
     * 
     * @return float
     *  Rating.
     */
    public function getUserRating(): float
    {
        return round($this->ratingsReceived()->get()->avg('rate_value'), 1);
    }

    // Relationship to reviews.
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'uid');
    }

    // Relationship to reservations.
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class, 'uid');
    }
}
