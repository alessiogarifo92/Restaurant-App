<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Testimonial;
use Illuminate\Http\Request;

/**
 * Summary of HomeController
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //  $breakfastFoods = app('App\Http\Controllers\Foods\FoodsController')->index()->all();
        //  dd($breakfastFoods);
        //  dd($breakfastFoods[0]);
        //  dd($breakfastFoods[0]->all());
        // $food =new FoodsController();
        // $food->index();
        $breakfastFoods = Food::select()->take(4)->where('category', 'Breakfast')->orderBy('id','desc')->get();
        // dd($breakfastFoods);
        $lunchFoods = Food::select()->take(4)->where('category', 'Launch')->orderBy('id','desc')->get();

        $dinnerFoods = Food::select()->take(4)->where('category', 'Dinner')->orderBy('id','desc')->get();

        $testimonials = Testimonial::select()->take(4)->orderBy('id','desc')->get();

    return view('home', compact('breakfastFoods','lunchFoods','dinnerFoods','testimonials'));
        
    }

    public function about()
    {

    return view('pages.about');
        
    }

    public function services()
    {

    return view('pages.services');
        
    }
    
    public function contacts()
    {

    return view('pages.contacts');
        
    }
    
}
