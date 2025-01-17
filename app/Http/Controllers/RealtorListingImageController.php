<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use App\Models\ListingImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RealtorListingImageController extends Controller
{
    public function create(Listing $listing) {
        $listing->load(['images']);
        return inertia(
            'Realtor/ListingImage/Create',
            ['listing'=>$listing]
        );
    }

    public function store(Listing $listing, Request $request) {
        $request->validate([
            'images.*' => 'max:5000|mimes:png,jpg,jpeg'
        ], [
            'images.*.mimes' => 'The file should be in one of the formats: jpg, png, jpeg',
            'images.*.max' => 'Image max filesize 5MB'
        ]);
        if($request->hasFile('images')){
            foreach($request->file('images') as $file){
                $path = $file->store('images', 'public');

                $listing->images()->save(new ListingImage(['filename'=>$path]));
            }
        }

        return redirect()->back()->with('success', 'Images Uploaded!');
    }

    public function destroy($listing, ListingImage $image) {
        Storage::disk('public')->delete($image->filename);
        $image->delete();

        return redirect()->back()->with('success', 'Image was deleted!');
    }
}
