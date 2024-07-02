<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RealtorListingController extends \Illuminate\Routing\Controller 
{
    use AuthorizesRequests;
    public function __construct()
    {
        $this->authorizeResource(Listing::class, 'listing');
    }

    public function index(Request $request) {

        $filters = [
            'deleted' => $request->boolean('deleted'),
            ...$request->only(['by', 'order'])
        ];

        return inertia(
            'Realtor/Index', 
            [
                'filters' => $filters,
                'listings' => Auth::user()
                    ->listings()
                    ->filter($filters)
                    ->withCount('images')
                    ->withCount('offers')
                    ->paginate(5)
                    ->withQuerystring()]
        );
    }

    public function show(Listing $listing) {
        return inertia('Realtor/Show',
            [
                'listing' => $listing->load('offers', 'offers.bidder')
            ]
            );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $this->authorize('create', Listing::class);
        return inertia('Realtor/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->user()->listings()->create(
            $request->validate([
                'beds' => 'required|integer|min:0|max:20',
                'baths' => 'required|integer|min:0|max:20',
                'area' => 'required|integer|min:30|max:300',
                'city' => 'required',
                'code' => 'required',
                'street' => 'required',
                'street_nr' => 'required|integer|min:1',
                'price' => 'required|integer|min:100',

            ])
        );

        return redirect()->route('realtor.listing.index')->with('success', 'Listing was created!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        return inertia('Realtor/Edit', [
            'listing' => $listing
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
        $listing->update([
            $request->validate([
                'beds' => 'required|integer|min:0|max:20',
                'baths' => 'required|integer|min:0|max:20',
                'area' => 'required|integer|min:30|max:300',
                'city' => 'required',
                'code' => 'required',
                'street' => 'required',
                'street_nr' => 'required|integer|min:1',
                'price' => 'required|integer|min:100',

            ])
        ]);

        return redirect()->route('realtor.listing.index')->with('success', 'Listing was updated!');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        $listing->deleteOrFail();

        return redirect()->back()->with('success', 'Listing was deleted!');
    }

    public function restore(Listing $listing) {
        $listing->restore();
        
        return redirect()->back()->with('success', 'Listing was restored!');
    }
}
