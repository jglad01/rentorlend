<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Review;
use App\Models\User;
use DateTime;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    // Show all cars.
    public function index(Request $request): View
    {
        return view('car.index', [
            'cars' => Car::latest()->get(),
        ]);
    }

    // Add new car form.
    public function create(): View
    {
        return view('car.create');
    }

    // Store car data.
    public function store(Request $request): RedirectResponse
    {
        $form_fields = $request->validate([
            'make' => 'required',
            'model' => 'required',
            'production_year' => 'required',
            'mileage' => 'required',
            'type' => 'required',
            'location' => 'required',
            'transmission' => 'required',
            'fuel' => 'required',
            'fuel_usage' => 'required',
            'price' => 'required',
            'photos' => [
                'required',
                File::image()
                    ->min('1kb')
                    ->max('10mb')
            ],
        ]);

        $form_fields['photos'] = $request->file('photos')->store('photos', 'public');
        $form_fields['uid'] = auth()->id();

        Car::create($form_fields);

        return redirect('/')->with('message', 'Car added succesfully!');
    }

    // Show single car.
    public function show(Request $request, Car $car): View
    {
        $owner = User::find($car->uid);
        //$owner_rating = $owner->getRating($owner);
        $reviews = $car->reviews()->get();
        $current_user_review = $car->getReviewForUser();

        return view('car.show', [
            'car' => $car,
            'owner' => $owner,
            'reviews' => $reviews,
            'current_user_review' => $current_user_review,
        ]);
    }

    // Edit car info form.
    public function edit(Car $car): View
    {
        return view('car.edit', ['car' => $car]);
    }

    // Update car info.
    public function update(Request $request, Car $car): RedirectResponse
    {
        if ($car->uid != auth()->id()) {
            abort(403, 'You dont have access to this site');
        }

        $form_fields = $request->validate([
            'make' => 'required',
            'model' => 'required',
            'production_year' => 'required',
            'mileage' => 'required',
            'type' => 'required',
            'location' => 'required',
            'transmission' => 'required',
            'fuel' => 'required',
            'fuel_usage' => 'required',
            'price' => 'required',
        ]);

        if ($request->hasFile('photos')) {
            $updated_photo = $request->validate([
                'photos' => [
                    File::image()
                        ->min('1kb')
                        ->max('10mb')
                ],
            ]);
            Storage::delete($car->photos);
            $form_fields['photos'] = $request->file('photos')->store('photos', 'public');
        }

        $car->update($form_fields);

        return redirect('cars/' . $car->id)->with('message', 'Changes saved');
    }

    // Delete car.
    public function delete(Request $request, Car $car): RedirectResponse
    {
        $car->delete();
        return redirect('')->with('message', 'Car deleted');
    }

    // Show manage cars page.
    public function manage(): View
    {
        return view('car.manage', ['cars' => auth()->user()->cars()->get()]);
    }

    /**
     * Show advanced search form.
     * 
     * @return Illuminate\Contracts\View\View
     *  Advanced search form.
     */
    public function search(): View
    {
        /** @var array $makes_list */
        $makes_list = Car::getCurrentMakes();

        if (!request()->search) {
            return view('car.search', [
                'makes_list' => $makes_list,
                'cars' => [],
            ]);
        }

        /** @var Collection $search_result */
        $search_result = Car::getAdvancedSearchResults(request());

        if (request()->date_from || request()->date_to) {
            $query_date_from = new DateTime(request()->date_from);
            $query_date_to = new DateTime(request()->date_to);
            $cars_free = [];

            foreach ($search_result as $car) {
                if ($car->checkReservationOverlap($query_date_from, $query_date_to)) {
                    $cars_free[] = $car;
                }
            }
        }

        /** @var Collection $cars */
        $cars = isset($cars_free) ? collect($cars_free) : $search_result;

        return view('car.search', [
            'makes_list' => $makes_list,
            'cars' => $cars,
        ]);
    }
}
