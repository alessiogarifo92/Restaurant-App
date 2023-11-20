<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Food\Booking;
use App\Models\Food\Checkout;
use App\Models\Users\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function getBookings()
    {
        $allBookings = Booking::where('user_id', Auth::user()->id)->get();
        // dd($allBookings);
        return view('users.bookings', compact('allBookings'));
    }

    public function getOrders()
    {
        $allOrders = Checkout::where('user_id', Auth::user()->id)->get();
        // dd($allOrders);
        return view('users.orders', compact('allOrders'));
    }

    public function review()
    {

        return view('users.review');
    }

    public function storeReview(Request $request)
    {

        //validazione delle info del form 
        $validated = $request->validate([

            "review" => "required",

        ]);


            $review = Review::create([
                'user_id' => Auth::user()->id,
                'review' => $request->review,
            ]);

            if ($review) {

                return redirect()->route('home')->with(['review' => 'Thank you for your feedback!']);

            }
        }
}