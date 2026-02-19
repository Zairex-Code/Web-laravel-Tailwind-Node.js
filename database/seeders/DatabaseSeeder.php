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
     * This file has the "ON" button for the factory machines.
     * It commands the Factories (molds) on HOW MANY copies to make and in WHAT ORDER.
     */
    public function run(): void
    {
        // 1. "User Machine! Make me 20 random workers"
        // We save them in $users to use their IDs later.
        $users = User::factory(20)->create();

        // 2. "Now make ONE specific user for ME!" 
        // (So I can log in and test without guessing random emails)
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // 3. "Category Machine! Make me 4 variations of topics"
        $categories = Category::factory()->count(4)->create();

        // 4. "Question Machine! Make 30 questions."
        // LOGIC: A question cannot exist without an owner (user) and a topic (category).
        // So we pick random IDs from the existing users and categories we just made.
        $questions = Question::factory(30)->create([
            'user_id' => fn () => User::inRandomOrder()->first()->id, 
            'category_id' => fn () => $categories->random()->id, 
        ]);

        // 5. "Answer Machine! Make 100 answers."
        // We link them to random questions and random users.
        $answers = Answer::factory(100)->create([
            'question_id'=> fn() => $questions-> random()->id,
            'user_id'=> fn () => $users->random()->id,
        ]);

        // 6. "Comment Machine! Create comments for Answers."
        // Polymorphic Relation: Comments can belong to many things (Answers, Questions, etc.)
        Comment::factory(200)->create([
           'user_id'=> fn () => $users->random()->id,
           'commentable_id' => fn () => $answers->random()->id,
           'commentable_type' => Answer::class,
        ]);

        // 7. "Comment Machine! Create comments for Questions."
        Comment::factory(200)->create([
           'user_id'=> fn () => $users->random()->id,
           'commentable_id' => fn () => $questions->random()->id,
           'commentable_type' => Question::class,
        ]);





        
    }
}
