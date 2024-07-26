<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['rate_value', 'comment', 'reviewed_car_id', 'uid'];

    // Relationship to user.
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id');
    }

    // Relationship to car.
    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class, 'id');
    }

    /**
     * Gets the author of the review.
     * 
     * @return App\Models\User
     *  Author of the review.
     */
    public function getReviewAuthor(): User
    {
        return User::find($this->uid);
    }
}
