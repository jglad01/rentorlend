<?php

namespace App\Http\Controllers;

use App\Models\Rate;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RateController extends Controller
{
    /**
     * Assign rate to a user.
     * 
     * @param Illuminate\Http\Request $request
     *  The Request object.
     * @param App\Models\User
     *  User related to the rating.
     * 
     * @return Illuminate\Http\RedirectResponse
     *  Redirect.
     */
    public function rate(Request $request, User $user): RedirectResponse
    {
        $form_fields = [];

        $form_fields['rate_author_id'] = auth()->id();
        $form_fields['rated_user_id'] = $user->id;
        $form_fields['rate_value'] = $request->input('rating-value');

        Rate::create($form_fields);

        return back()->with('message', 'Youve submitted rating');
    }
}
