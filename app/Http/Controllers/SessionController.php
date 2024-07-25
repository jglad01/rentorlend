<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;

class SessionController extends Controller
{
    /**
     * Sets currency for session.
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function setCurrency(Request $request, string $currency): RedirectResponse
    {
        if ($currency === 'PLN' && $request->session()->has('currency')) {
            $request->session()->forget(['currency', 'rate']);
        } else {
            $request->session()->put('currency', $currency);

            $response = Http::withHeaders([
                'Accept' => 'application/json',
            ])->get('http://api.nbp.pl/api/exchangerates/rates/a/' . $currency . '?format=json');

            if ($response->successful()) {
                $rate = $response->json()['rates'][0]['mid'];
            }

            $request->session()->put('rate', $rate);
        }

        return back();
    }
}
