<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['rate_value', 'comment', 'reviewed_car_id', 'uid'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class, 'id');
    }

    public function getReviewAuthor(): User
    {
        return User::find($this->uid);
    }
}
