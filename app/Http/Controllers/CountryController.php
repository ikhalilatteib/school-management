<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountryRequest;
use App\Http\Resources\CountryResource;
use App\Models\Country;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class CountryController extends Controller
{
    /**
     *
     * @return AnonymousResourceCollection
     */
    public function indexCountry()
    {
        $country = Country::with('user')->latest()->get();
        return CountryResource::collection($country);
    }

    /**
     *
     * @param CountryRequest $request
     * @return CountryResource
     */

    public function storeCountry(CountryRequest $request)
    {
        $country = auth()->user()->countries()->create($request->validated());
        return new CountryResource($country);
    }


    /**
     *
     * @param CountryRequest $request
     * @param Country $country
     * @return CountryResource
     */
    public function updateCountry(CountryRequest $request, Country $country)
    {
        $country->update($request->validated());
        abort_if(!$country->wasChanged(), 403);
        return new CountryResource($country);
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
