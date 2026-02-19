{{-- Display One Detailed Question --}}
{{--
    🎨 BLADE VIEW: The Artist
    This file's job is to paint data for the user.
    It receives the data (in this case, $question) from the Controller.

    KEY CONCEPT: "Security"
    {{ $variable }} automatically escapes dangerous characters (like <script> tags).
    It's your built-in shield against XSS attacks.
--}}

{{-- Question Title --}}
<h1>
    {{ $question->title }}
</h1>

{{-- Question Description --}}
<p class="text-gray-600 mb-4">
    {{ $question->description }}
</p>

{{--
    🔄 ANSWERS LOOP
    Problem: We have one question, but many potential answers.
    Solution: The @foreach loop.

    Analogy: Like a teacher calling attendance.
    "For each student (answer) in the class (answers list),
    stand up and say your name (display yourself)."
--}}
{{--
    @foreach($question->answers as $answer)
        <div class="answer-card">
            {{ $answer->content }}
        </div>
    @endforeach
--}}
