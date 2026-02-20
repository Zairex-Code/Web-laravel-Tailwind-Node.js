<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * 🕵️‍♀️ Method: show()
     * ------------------
     * Purpose: Displays a single question with all its juicy details.
     *
     * @param Question $question
     *      ✨ "Route Model Binding" Magic:
     *      Laravel sees the URL is `/questions/{question}` and automatically assumes
     *      you want the Question model with that ID. It fetches it from the DB for you!
     *      So, $question is already the data, not just an ID number.
     */
    public function show(Question $question)
    {
        // 🐢 Lazy Eager Loading
        // We already have the "burger" ($question) in hand (thanks to the magic above).
        // Now, we tell the waiter: "Oh, btw, bring me the fries (answers) and the drink (user) too."
        //
        // Why? To avoid the "N+1 Problem" in the view.
        // Instead of making 1 database query for every single answer to find its author,
        // we load them all at once here. Efficient! ⚡
        $question->load('answers', 'category', 'user');

        // We return the view 'questions.show' (resources/views/questions/show.blade.php)
        // compact('question') creates an array like ['question' => $question] to send data to the view.
        return view('questions.show', compact('question'));
    }
}

