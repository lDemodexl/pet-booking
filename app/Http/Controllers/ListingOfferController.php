<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Listing;
use Illuminate\Http\Request;
use App\Notifications\OfferMade;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ListingOfferController extends \Illuminate\Routing\Controller 
{
    use AuthorizesRequests;
    public function store(Listing $listing, Request $request) {
        $this->authorize('view', $listing);
        $offer = $listing->offers()->save(
            Offer::make(
                $request->validate([
                    'amount'=> 'required|integer|min:1'
                ])
            )->bidder()->associate($request->user())
        );

        $listing->owner->notify(
            new OfferMade($offer)
        );

        return redirect()->back()->with('success', 'Offer was made!');
    }
}
