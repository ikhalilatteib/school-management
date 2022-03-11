<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountryRequest;
use App\Models\Country;
use Illuminate\Http\Response;

class CountryController extends Controller
{
    /**
     *
     * @return Response
     */
    public function indexCountry()
    {
        $country = Country::with('user')->latest()->get();
        return response(['Country' => $country]);
    }

    /**
     *
     * @param CountryRequest $request
     * @return Response
     */

    public function storeCountry(CountryRequest $request)
    {
        $country = auth()->user()->countries()->create($request->validated());
        return response(['country' => $country]);
    }


    /**
     *
     * @param CountryRequest $request
     * @param Country $country
     * @return Response
     */
    public function updateCountry(CountryRequest $request, Country $country)
    {
        $country->update($request->validated());
        abort_if(!$country->wasChanged(), 404);
        return response(['country' => $country]);
    }

    /**
     *
     * @param Country $country
     * @return Response
     */
    public function destroyCountry(Country $country)
    {
        $country->delete();
        return response(['success' => true]);
    }
}
