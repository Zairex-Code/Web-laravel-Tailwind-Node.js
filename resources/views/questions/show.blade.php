{{--
    🎨 BLADE VIEW: The Artist (show.blade.php)
    This file's job is to paint data for the user.
    It receives the data (in this case, $question) from the Controller.

    KEY CONCEPT: "Security"
    {{ $variable }} automatically escapes dangerous characters (like <script> tags).
    It's your built-in shield against XSS attacks.
--}}

{{-- 🏗️ LAYOUT: We wrap everything ins ide our main app layout component --}}
<x-forum.layouts.app>
    <div class="flex items-center gap-2 w-full my-8">
        {{-- Placeholder for the "Heart/Like" button --}}
        <div>&hearts;</div>

        <div class="w-full">
            {{-- 📌 QUESTION TITLE --}}
            <h2 class="text-2xl font-bold md:text-3xl">
                {{ $question->title }}
            </h2>

            <div class="flex justify-between">
                {{-- 👤 QUESTION METADATA: Author, Category, and Time --}}
                <p class="text-xs text-gray-500">
                    <span class="font-semibold">
                        {{ $question->user->name }}
                    </span> |
                    {{ $question->category->name }} |
                    {{-- 🕒 diffForHumans() turns "2023-10-01 12:00:00" into "3 hours ago" --}}
                    {{ $question->created_at->diffForHumans() }}
                </p>

                <div class="flex items-center gap-2">
                    <a href="#" class="text-xs font-semibold hover:underline">
                        Edit
                    </a>

                    {{-- 🗑️ DELETE FORM --}}
                    <form action="#" onsubmit="return confirm('¿Estás seguro de eliminar esta pregunta?');">
                        {{-- 🛡️ @csrf: Cross-Site Request Forgery protection. Mandatory for POST/PUT/DELETE forms in Laravel. --}}
                        @csrf
                        {{-- 🔄 @method('DELETE'): HTML forms only support GET and POST. This fakes a DELETE request. --}}
                        @method('DELETE')
                        <button type="submit" class="rounded-md bg-red-600 hover:bg-red-500 px-2 py-1 text-xs font-semibold text-white cursor-pointer">
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="my-4">
        {{-- 📝 QUESTION DESCRIPTION --}}
        <p class="text-gray-200">
            {{ $question->description }}
        </p>

        {{--
            🍅 POLYMORPHIC RELATIONSHIP: QUESTION COMMENTS
            "Hey Database, give me all the comments where commentable_type is 'Question'
            and commentable_id is this question's ID."

            ⚡ LIVEWIRE COMPONENT CALL
            <livewire:comment /> tells Laravel to render the 'comment.blade.php' Volt component.
            :commentable="$question" passes the current Question model into the component's state.
            The colon (:) is crucial! It tells Laravel to evaluate "$question" as PHP code, not as a plain string.
        --}}
        <livewire:comment :commentable="$question"/>
    </div>

    {{--
        🍟 ONE-TO-MANY RELATIONSHIP: ANSWERS
        "Give me all the answers that belong to this question."
    --}}
    <ul class="space-y-4">
        @foreach ($question->answers as $answer)
        <li>
            <div class="flex items-start gap-2">
                <div>&hearts;</div>

                <div>
                    {{-- 💬 ANSWER CONTENT --}}
                    <p class="text-sm text-gray-300">
                        {{ $answer->content }}
                    </p>
                    <p class="text-xs text-gray-500">
                        {{ $answer->user->name }} |
                        {{ $answer->created_at->diffForHumans() }}
                    </p>

                    {{--
                        🍅 NESTED POLYMORPHIC RELATIONSHIP: ANSWER COMMENTS
                        "Now, for THIS specific answer, give me all its comments."
                        Notice how we use $answer->comments, NOT $question->comments.

                        ⚡ LIVEWIRE COMPONENT CALL
                        Here we reuse the EXACT SAME component we used for the Question.
                        But this time, we pass the $answer model instead of the $question model.
                        The component's internal logic handles the polymorphic relationship automatically!
                    --}}
                    <ul class="my-4 space-y-2">

                        <livewire:comment :commentable="$answer"/>
                    </ul>
                </div>
            </div>
        </li>
        @endforeach
    </ul>

</x-forum.layouts.app>
