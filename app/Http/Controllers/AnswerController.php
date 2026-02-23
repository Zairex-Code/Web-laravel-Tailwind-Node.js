<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Store a newly created answer in storage.
     * 
     * @param Request $request The incoming HTTP request containing the form data.
     * @param Question $question The question model automatically resolved by Laravel (Route Model Binding).
     */
    public function store(Request $request, Question $question)
    {
        // 1. Validate the incoming request data
        // Ensure 'content' is provided, is a string, and has at least 3 characters.
        $request->validate([
            'content' => 'required|string|min:3',
        ]);

        // 2. Create the answer using the relationship
        // This automatically sets the 'question_id' on the new answer.
        $question->answers()->create([
            'content' => $request->content,
            // Hardcoded user ID for testing purposes (should be auth()->id() in production)
            'user_id' => 20, // Fallback to 1 if not logged in for testing
        ]);

        // 3. Redirect the user back to the question view
        return redirect()->route('questions.show', $question);
    }
}
