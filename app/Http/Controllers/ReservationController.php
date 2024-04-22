<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Reservation;
use App\Models\User;
use DateTime;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Reserve car form.
     * 
     * @param App\Models\Car $car
     *  Car related to the reservation.
     * 
     * @return Illuminate\Http\RedirectResponse
     *  Redirect back if user tries to reserve their own car.
     * @return Illuminate\Contracts\View\View
     *  Reservation form.
     */
    public function reserve(Car $car): RedirectResponse|View
    {
        if ($car->uid == auth()->id()) {
            return back()->with('message', 'You cannot reserve your own car.');
        } else {
            return view('reservation.reserve', ['car' => $car]);
        }
    }

    /**
     * Store the reservation.
     * 
     * @param Illuminate\Http\Request $request
     *  The Request object.
     * @param App\Models\Car $car
     *  Car related to the reservation.
     * 
     * @return Illuminate\Http\RedirectResponse
     *  Redirect.
     */
    public function store(Request $request, Car $car): RedirectResponse
    {
        if (auth()->user() && $car->uid == auth()->user()->id) {
            return back()->with('message', 'You cannot reserve your own car.');
        }

        $form_fields = $request->validate([
            'contact_phone' => 'required',
            'contact_email' => 'required',
        ]);

        $form_fields['uid'] = auth()->id() ?? NULL;
        $form_fields['reserved_car_id'] = $car->id;

        $date_start = new DateTime($request->input('date_start'));
        $date_end = new DateTime($request->input('date_end'));
        $form_fields['total_cost'] = $car->price * ($date_start->diff($date_end)->format('%a'));

        $form_fields['date_start'] = $date_start->format('Y-m-d');
        $form_fields['date_end'] = $date_end->format('Y-m-d');

        Reservation::create($form_fields);

        return redirect('cars/' . $car->id)->with('message', 'Car reserved succesfully!');
    }

    /**
     * Manage reservations View.
     * 
     * @return Illuminate\Contracts\View\View
     *  Manage reservations.
     */
    public function manage(): View
    {
        $my_cars_reserv = collect();
        $my_cars = auth()->user()->cars()->get();

        foreach ($my_cars as $car) {
            $my_cars_reserv = $my_cars_reserv->merge($car->reservations()->get());
        }

        return view('reservation.manage', [
            'car' => Car::class,
            'my_cars_reservations' => $my_cars_reserv,
            'my_reservations' => auth()->user()->reservations()->get(),
        ]);
    }

    /**
     * Show reservation details.
     * 
     * @param App\Models\Reservation $reservation
     *  Current reservation.
     * 
     * @return Illuminate\Contracts\View\View
     *  Reservation details.
     */
    public function show(Reservation $reservation): View
    {
        $car = Car::find($reservation->reserved_car_id);
        $car_owner = User::find($car->uid);

        if (auth()->user()->id != $car_owner->id && auth()->user()->id != $reservation->uid) {
            abort(403, 'You dont have access to this site');
        }

        return view('reservation.show', [
            'reservation' => $reservation,
            'car_owner' => $car_owner,
            'car' => $car,
        ]);
    }
}
