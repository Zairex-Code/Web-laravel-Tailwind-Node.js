<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     * 
     * 👷 THE SEEDER = THE PRODUCTION MANAGER
     * This file has the "ON" button.
     * It is in charge of calling the Factories (molds) and telling them how many copies to make.
     */
    public function run(): void
    {
        // 1. "User Machine! Make me 20 random copies"
        $users = User::factory(20)->create();

        // 2. "Now make ONE specific one for me!" (So I can log in myself)
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // 3. "Category Machine! Make me 4 variations"
        $categories = Category::factory()->count(4)->create();

        // 4. "Question Machine! Make 30, but assign random users and categories from the ones that already exist"
        $questions = Question::factory(30)->create([
            'user_id' => fn () => User::inRandomOrder()->first()->id, # Assign a random user to each question
            'category_id' => fn () => $categories->random()->id, # Assign a random category to each question
        ]);

        // 5. "Answer Machine! Make 100 copies"
        $answers = Answer::factory(100)->create([
            'question_id'=> fn() => $questions-> random()->id,
            'user_id'=> fn () => $users->random()->id,
        ]);

        // 6. "Comment Machine! Create comments for Answers"
        Comment::factory(200)->create([
           'user_id'=> fn () => $users->random()->id,
           'commentable_id' => fn () => $answers->random()->id,
           'commentable_type' => Answer::class,
        ]);

        // 7. "Comment Machine! Create comments for Questions"
        Comment::factory(200)->create([
           'user_id'=> fn () => $users->random()->id,
           'commentable_id' => fn () => $questions->random()->id,
           'commentable_type' => Question::class,
        ]);





        
    }
}
