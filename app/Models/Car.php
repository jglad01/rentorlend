<?php

namespace App\Models;

use DateTime;
use App\Models\User;
use App\Models\Review;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Car extends Model
{
    use HasFactory;

    protected $fillable = ['model', 'make', 'production_year', 'mileage', 'transmission', 'fuel', 'photos', 'fuel_usage', 'type', 'price', 'location', 'uid'];

    // Relationship to user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id');
    }

    // Relationship to reviews.
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'reviewed_car_id');
    }

    // Relationship to reservations.
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class, 'reserved_car_id');
    }

    /**
     * Gets the average rating for the car.
     * 
     * @return float
     *  Rating.
     */
    public function getAvgCarRating(): float
    {
        return round($this->reviews()->get()->avg('rate_value'), 1);
    }

    /**
     * Checks if current user has already reviewed the car.
     * 
     * @return Illuminate\Database\Eloquent\Collection
     *  Result of the query.
     */
    public function getReviewForUser(): Collection
    {
        return $this->reviews()->where('uid', auth()->id())->get();
    }

    /**
     * Results of the AJAX front page search.
     * 
     * @return string
     *  Rendered search results.
     */
    public function getSearchResults()
    {
        $search = request()->search;
        $response = '';
        $curr = request()->session()->get('currency') ?? 'PLN';
        $rate = request()->session()->get('rate') ?? 1;

        $query = Car::query()
            ->where('make', 'like', '%' . $search . '%')
            ->orWhere('model', 'like', '%' . $search . '%')
            ->orWhere('production_year', 'like', '%' . $search . '%')
            ->orWhere('location', 'like', '%' . $search . '%')
            ->orWhere('fuel', 'like', '%' . $search . '%')
            ->get();

        foreach ($query as $record) {
            $response .= view('components.car-card', ['car' => $record, 'curr' => $curr, 'rate' => $rate])->render();
        }

        return $response;
    }

    /**
     * Gets current car makes. Used in advanced search.
     */
    public static function getCurrentMakes()
    {
        return Car::query()
            ->distinct()
            ->get('make');
    }

    /**
     * Checks if the given period overlaps with existing reservations. Used in reservation calendar.
     * 
     * @return bool
     *  Whether time period overlaps already existing reservations.
     */
    public function checkReservationOverlap(DateTime $query_date_start, DateTime $query_date_end): bool
    {
        $reservations = $this->reservations()->get();
        $reserv_overlaping = [];

        foreach ($reservations as $key => $reservation) {
            $reserv_date_start = new DateTime($reservation->date_start);
            $reserv_date_end = new DateTime($reservation->date_end);

            if ($reserv_date_start < $query_date_end && $reserv_date_end > $query_date_start) {
                $reserv_overlaping[] = $reservation;
            }
        }

        return empty($reserv_overlaping);
    }

    /**
     * Queries the database to get the advanced search results.
     * 
     * @return Illuminate\Database\Eloquent\Collection
     *  Results of the advanced search
     */
    public static function getAdvancedSearchResults(Request $request): Collection
    {
        return Car::query()
            ->where('make', 'LIKE', request()->make == 'all' ? '%' : request()->make)
            ->where('type', 'LIKE', request()->type == 'all' ? '%' : request()->type)
            ->where('location', 'LIKE', request()->location == 'all' ? '%' : request()->location)
            ->where('transmission', 'LIKE', request()->transmission == 'all' ? '%' : request()->transmission)
            ->where('fuel', 'LIKE', request()->fuel == 'all' ? '%' : request()->fuel)
            ->whereBetween('production_year', [request()->year_from == 'all' ? 1990 : request()->year_from, request()->year_to == 'all' ? 2024 : request()->year_to])
            ->get();
    }
}
