<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RealtorListingAcceptOfferController extends \Illuminate\Routing\Controller
{
    public function __invoke(Offer $offer)
    {   
        $listing = $offer->listing;
        $this->authorize('update', $listing);
        //Accept Offer
        $offer->update(['accepted_at'=>now()]);
        
        $listing->sold_at = now();
        $listing->save();

        //Reject all other offers
        $listing->offers()->except($offer)
            ->update(['rejected_at'=>now()]);
        
        return redirect()->back()->with('success', "Offer #{$offer->id} accepted");
    }
}
