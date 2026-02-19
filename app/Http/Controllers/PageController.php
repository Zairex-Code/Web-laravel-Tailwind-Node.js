<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * 🏠 Method: home()
     * ------------------
     * Purpose: The "Menu" of our restaurant. It lists all available questions.
     *
     * Why not iterate questions directly in the view?
     * Because the controller is the "Traffic Cop". It decides WHAT data goes WHERE.
     */
    public function home()
    {
        // 🚀 Eager Loading (The "Combo Meal")
        // with('user', 'category'): "Hey Database, give me ALL questions,
        // AND include their authors and categories in the same shipment."
        //
        // latest(): Is shorthand for ->orderBy('created_at', 'desc').
        // get(): Executes the query and returns a Collection (a super-array).
        $questions = Question::with('user', 'category')->latest()->get();

        // 📦 Delivery
        // We pass the $questions collection to the 'pages.home' view.
        // Blade will unpack this box and display each item.
        return view('pages.home', compact('questions'));
    }
}
