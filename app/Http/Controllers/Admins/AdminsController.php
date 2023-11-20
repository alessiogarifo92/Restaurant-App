<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use App\Models\Food;
use App\Models\Food\Booking;
use App\Models\Food\Checkout;
use File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller
{

    public function viewLogin()
    {

        return view('admins.login');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();

        return redirect()->route('view.login');
    }


    public function checkLogin(Request $request)
    {

        //logica per il remember me del login
        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {

            return redirect()->route('admins.dashboard');
        }
        return redirect()->back()->with(['error' => 'error logging in']);

    }

    public function index()
    {

        //prendo il conteggio delle info da mostrare a schermo
        $foodCount = Food::select()->count();
        $ordersCount = Checkout::select()->count();
        $bookingCount = Booking::select()->count();
        $adminCount = Admin::select()->count();
        // dd($foodCount);

        return view("admins.dashboard", compact('foodCount', 'ordersCount', 'bookingCount', 'adminCount'));

    }


    public function allAdmins()
    {

        //prendo info di tutti gli admins presenti in mainDB
        $allAdmins = Admin::select()->orderBy('id', 'asc')->get();


        return view("admins.alladmins", compact('allAdmins'));

    }

    public function allOrders()
    {

        //prendo info di tutti gli admins presenti in mainDB
        $allOrders = Checkout::select()->orderBy('id', 'asc')->get();


        return view("admins.allorders", compact('allOrders'));

    }


    public function editOrders($id)
    {

        $order = Checkout::find($id);


        return view("admins.editorder", compact('order'));

    }


    public function updateOrders(Request $request, $id)
    {

        $order = Checkout::find($id);
        $order->update($request->all());


        if ($order) {

            return redirect()->route('orders.all')->with(['success' => 'Order updated successfully']);

        }
    }

    public function deleteOrder($id)
    {
        Checkout::where('id', $id)->delete();

        return redirect()->route('orders.all')->with(['success' => 'Order deleted successfully']);
    }


    public function allBookings()
    {

        //prendo info di tutti gli admins presenti in mainDB
        $allBookings = Booking::select()->orderBy('id', 'asc')->get();


        return view("admins.allbookings", compact('allBookings'));

    }

    public function editBooking($id)
    {

        $booking = Booking::find($id);


        return view("admins.editbooking", compact('booking'));

    }


    public function updateBooking(Request $request, $id)
    {

        $booking = Booking::find($id);
        $booking->update($request->all());


        if ($booking) {

            return redirect()->route('bookings.all')->with(['success' => 'Bookiing updated successfully']);

        }
    }

    public function deleteBooking($id)
    {
        Booking::where('id', $id)->delete();

        return redirect()->route('bookings.all')->with(['success' => 'Booking deleted successfully']);
    }



    public function allFoods()
    {

        //prendo info di tutti gli admins presenti in mainDB
        $allFoods = Food::select()->orderBy('id', 'asc')->get();


        return view("admins.allfoods", compact('allFoods'));

    }


    public function createFood()
    {

        return view("admins.createfood");

    }

    public function storeFood(Request $request)
    {

        // validazione delle info del form
        Request()->validate([

            "name" => "required | max:40",
            "price" => "required | max:40",
            "category" => "required",
            "image" => "required",
            "description" => "required",

        ]);

        //gestione delle nuove immagini
        $destinationPath = 'assets/img/';
        $myimage = $request->image->getClientOriginalName();
        $request->image->move(public_path($destinationPath), $myimage);

        $newFood = Food::create([
            "name" => $request->name,
            "price" => $request->price,
            "category" => $request->category,
            "image" => $myimage,
            "description" => $request->description,


        ]);

        if ($newFood) {

            return redirect()->route('foods.all')->with(['success' => 'Food created successfully']);

        }

    }

    public function deleteFood(Request $request)
    {

        // dd($request->image);

        //dopo aver cancellato record in mainDb, cancello anche immagine da path assets
        if (File::exists(public_path('assets/img/' . $request->image))) {
            File::delete(public_path('assets/img/' . $request->image));
        } else {
            dd('File does not exists.');
        }

        Food::where('id', $request->id)->delete();

        return redirect()->route('foods.all')->with(['success' => 'Food deleted successfully']);
    }


    public function createAdmins()
    {

        return view("admins.createadmins");

    }


    public function storeAdmins(Request $request)
    {

        //validazione delle info del form
        Request()->validate([

            "name" => "required | max:40",
            "email" => "required | max:40",
            "password" => "required",

        ]);

        //nel creare richiamo model Hash per creare l'hash della password
        $newAdmin = Admin::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),

        ]);

        if ($newAdmin) {

            return redirect()->route('admins.all')->with(['success' => 'Admin created successfully']);

        }

    }


}