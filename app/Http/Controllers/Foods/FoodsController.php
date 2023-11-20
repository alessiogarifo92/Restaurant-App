<?php

namespace App\Http\Controllers\Foods;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\Food\Booking;
use App\Models\Food\Cart;
use App\Models\Food\Checkout;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodsController extends Controller
{

    public function index()
    {
        return $breakfastFoods = Food::select()->take(4)->where('category', 'Breakfast')->get();

        // return view('home', compact('breakfastFoods'));
    }

    public function foodDetails($id)
    {

        $foodItem = Food::find($id);

        //controllo se ho fatto login altrimenti ritorno info foodItem e a display indico che deve essere 
        //effettuato login in file food-details.blade.php
        if (auth()->user()) {
            //verifying if user added item to cart
            $cartVerifying = Cart::where('food_id', $id)
                ->where('user_id', Auth::user()->id)->count();

            return view('foods.food-details', compact('foodItem', 'cartVerifying'));

        }else{
            return view('foods.food-details', compact('foodItem'));
        }

    }

    public function cart(Request $request, $id)
    {

        $cart = Cart::create([
            "user_id" => $request->user_id,
            "food_id" => $request->food_id,
            "name" => $request->name,
            "image" => $request->image,
            "price" => $request->price,
        ]);

        // echo "item added to cart successfully";

        if ($cart) {
            return redirect()->route('food.details', $id)->with(['success' => 'Item added to cart successfully!']);
        }

        // return view('foods.food-details', compact('foodItem'));

    }

    public function displayCartItems()
    {

        //check user logged in otherwise abort
        //I make this check so we won't have laravel errors if I press cart while not logged in yet
        if (Auth::user()) {
            $cartItems = Cart::where('user_id', Auth::user()->id)->get();
            // dd($cartItems);

            //I get the total price of the items in the cart
            $total = Cart::where('user_id', Auth::user()->id)->sum('price');

            return view('foods.food-display-cart', compact('cartItems', 'total'));
        } else {
            abort('404');
        }

    }

    public function deleteCartItems($id)
    {

        $cartItemDelete = Cart::where('id', $id)->delete();

        if ($cartItemDelete) {
            return redirect()->route('food.display.cart')->with(['delete' => 'Item deleted from cart successfully!']);
        }

    }

    public function prepareCheckout(Request $request)
    {
        // dd($request);
        $value = $request->price;

        //vado ad inserire nelle info di sessione il totale e lo prendo con il get per verificare che sia ok
        //questo serve per far poi apparire la pagina di checkout e avere nelle info di sessione il prezzo
        //che nel blade non è visibile
        $request->session()->put('total', $value);
        $newTotal = $request->session()->get('total');

        if ($newTotal > 0) {
            return redirect()->route('foods.checkout', compact('newTotal'));
        }
    }

    public function checkout()
    {

        //controllo che non ci siano gia altri checkout per questo utente che non siano gia stati pagati
        $userCheckoutCheck = Checkout::where('user_id', Auth::user()->id)->where('status', 'to pay')->count();
        if ($userCheckoutCheck > 1) {
            echo 'Altri checkout non ancora pagati!';
        } else {
            return view('foods.checkout');
        }


    }

    public function storeCheckout(Request $request)
    {

        $checkout = Checkout::create([
            'full_name' => $request->name,
            'email' => $request->email,
            'town' => $request->town,
            'country' => $request->country,
            'zip_code' => $request->zip_code,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'user_id' => Auth::user()->id,
            'price' => $request->session()->get('total'),
            'status' => 'to pay',
        ]);

        echo 'Connecting to paypal...';

        if ($checkout) {

            if (session()->get('total') == 0 || is_null(session()->get('total'))) {
                abort('403');
            } else {
                return redirect()->route('foods.pay');

            }
        }

        // return view('foods.food-details', compact('foodItem'));

    }


    public function payWithPaypal()
    {
        if (session()->get('total') == 0 || is_null(session()->get('total'))) {
            abort('403');
        } else {
            return view('foods.pay');
        }
    }

    /**
     * metodo che se pagamento va a buon fine, si occupa di cancellare info cart e fare update dello status del checkout
     */
    public function success()
    {

        // dd(session()->get('total'));

        if (session()->get('total') == 0 || is_null(session()->get('total'))) {
            abort('403');
        }

        $cartItemDelete = Cart::where('user_id', Auth::user()->id)->delete();

        $checkoutStatusUpdate = Checkout::where('user_id', Auth::user()->id)->update(['status' => 'Payed']);

        //rimuovo chiave 'total' dalla sessione
        session()->forget('total');

        if ($cartItemDelete) {
            return redirect()->route('foods.success.view')->with(['success' => 'You payed successfully!']);
        }
    }

    public function successView()
    {

        return view('foods.success');
    }

    public function bookingTables(Request $request)
    {

        //validazione delle info del form e aggiunto errore in home.blade
        $validated = $request->validate([

            "name" => "required | max:40",
            "email" => "required | max:40",
            "date" => "required",
            "num_people" => "required",
            "spe_request" => "required"

        ]);

        //controllo che date sia valida e non nel passato
        $currentDate = date('m/d/Y h:i:sa');
        if ($request->date == $currentDate || $request->date < $currentDate) {
            return redirect()->route('home')->with(['booking-error' => 'You cannot book with current date or with date in the past!']);

        } else {

            // dd($request);
            $bookingTables = Booking::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'email' => $request->email,
                'date' => $request->date,
                'num_people' => $request->num_people,
                'spe_request' => $request->spe_request,
                'status' => 'Booked',
            ]);

            if ($bookingTables) {

                return redirect()->route('home')->with(['booked' => 'You booked a table!']);

            }
        }

    }


    public function menu()
    {

        $breakfastFoods = Food::select()->take(4)->where('category', 'Breakfast')->orderBy('id', 'desc')->get();

        $lunchFoods = Food::select()->take(4)->where('category', 'Launch')->orderBy('id', 'desc')->get();

        $dinnerFoods = Food::select()->take(4)->where('category', 'Dinner')->orderBy('id', 'desc')->get();

        return view('foods.menu', compact('breakfastFoods', 'lunchFoods', 'dinnerFoods'));
    }

}