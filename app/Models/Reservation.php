<?php

namespace App\Models;

use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ['date_start', 'date_end', 'reserved_car_id', 'uid', 'total_cost', 'contact_phone', 'contact_email'];

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
     * Gets the days when specified car is already reserved. Used in Reservation calendar via AJAX request.
     * 
     * @return string|FALSE
     *  JSON encoded dates or FALSE when failed.
     */
    public function getBlockedDays(): string|FALSE
    {
        $car_id = request()->carid;
        $blocked_dates = [];

        $query = Reservation::query()
            ->where('reserved_car_id', 'LIKE', $car_id)
            ->get(['date_start', 'date_end']);

        foreach ($query as $record) {
            $date_start = new DateTime($record->date_start);
            $date_end = new DateTime($record->date_end);

            $interval = new DateInterval('P1D');
            $period = new DatePeriod($date_start, $interval, $date_end);

            foreach ($period as $date) {
                $blocked_dates[] = $date->format('m/d/Y');
            }

            $blocked_dates[] = $date_end->format('m/d/Y');
        }

        return json_encode($blocked_dates);
    }
}
