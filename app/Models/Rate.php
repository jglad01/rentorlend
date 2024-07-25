<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rate extends Model
{
    use HasFactory;

    protected $fillable = ['rated_user_id', 'rate_author_id', 'rate_value'];

    // Relationship to Rate author.
    public function rateAuthor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id');
    }

    // Relationship to Rated user.
    public function ratedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id');
    }
}
