<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Post a comment.
     * 
     * @param Illuminate\Http\Request $request
     *  The Request object.
     * @param App\Models\Car $car
     *  The reviewed car.
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function comment(Request $request, Car $car): RedirectResponse
    {
        $form_fields = [];
        $form_fields['comment'] = $request->input('review-comment') ?? '';
        $form_fields['rate_value'] = $request->input('rating-value');
        $form_fields['reviewed_car_id'] = $car->id;
        $form_fields['uid'] = auth()->id();

        Review::create($form_fields);

        return redirect('cars/' . $car->id)->with('message', 'Comment added.');
    }

    /**
     * Delete review.
     * 
     * @param Illuminate\Http\Request $request
     *  The Request object.
     * @param App\Models\Review $review
     *  The review.
     * 
     * @return Illuminate\Http\RedirectResponse
     *  Redirect.
     */
    public function delete(Request $request, Review $review): RedirectResponse
    {
        $review->delete();
        return back()->with('message', 'Review deleted');
    }
}
