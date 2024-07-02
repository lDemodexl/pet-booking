<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingController extends \Illuminate\Routing\Controller 
{
    use AuthorizesRequests;
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->authorizeResource(Listing::class, 'listing');
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only([
            'priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo'
        ]);
        return inertia('Listing/Index',
            [
                'filters' => $filters,
                'listings' => Listing::MostRecent()
                    ->filter($filters)
                    ->withoutSold()
                    ->paginate(10)
                    ->withQueryString()
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        // if(Auth::user()->cannot('view',$listing)){
        //     abort(403);
        // };

        // $this->authorize('view', $listing);
        $listing->load(['images']);
        $offer = !Auth::user() ? null : $listing->offers()->byMe()->first();
            // dd($offer);
        return inertia('Listing/Show',
            [
                'listing' => $listing,
                'offerMade' => $offer
            ]
        );
    }
    
}
