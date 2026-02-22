<?php

use function Livewire\Volt\{state};

/**
 * ⚡ LIVEWIRE VOLT COMPONENT: The Comment System
 * This is a Single File Component (SFC). It contains both the PHP logic (backend)
 * and the Blade view (frontend) in one place.
 */

// 1️⃣ STATE: The variables that Livewire will track and update automatically.
// Think of this as the "memory" of our component.
state([
    // $commentable holds the Model we are commenting on (either a Question or an Answer).
    // It is passed from the parent view like this: <livewire:comment :commentable="$question" />
    'commentable' => null,

    // $showForm is a boolean flag to toggle the visibility of the comment textarea.
    'showForm' => false,

    // $body holds the actual text the user types into the textarea.
    // It is bound to the input using wire:model="body".
    'body' => '',
]);

// 2️⃣ ACTIONS: The functions that run when the user interacts with the component.
// This function is triggered when the form is submitted (wire:submit="store").
$store = function () {
    // Step A: Validation. Ensure the user actually typed something before saving.
    $this->validate([
        'body' => 'required|string|max:1000',
    ]);

    // Step B: Save to Database.
    // We use the polymorphic relationship 'comments()' defined in the Question/Answer models.
    // Laravel automatically fills in the 'commentable_id' and 'commentable_type' for us!
    $this->commentable->comments()->create([
        'body' => $this->body,
        'user_id' => auth()->id(), // Attach the comment to the currently logged-in user.
    ]);

    // Step C: Reset the state.
    // Clear the textarea and hide the form so the user sees their new comment immediately.
    $this->body = '';
    $this->showForm = false;
};

?>

<div>
    {{-- 3️⃣ DISPLAY EXISTING COMMENTS --}}
    {{-- We loop through the 'comments' relationship of whatever model was passed to us. --}}
    <ul class="space-y-2 mb-4">
        @foreach ($commentable->comments as $comment)
            <li class="bg-gray-800 p-3 rounded-lg">
                <p class="text-sm text-gray-300">{{ $comment->body }}</p>
                <p class="text-xs text-gray-500 mt-1">
                    {{ $comment->user->name }} | {{ $comment->created_at->diffForHumans() }}
                </p>
            </li>
        @endforeach
    </ul>

    {{-- 4️⃣ TOGGLE FORM BUTTON --}}
    {{--
        wire:click="$toggle('showForm')" is a Livewire magic method.
        It flips the boolean value of $showForm (true -> false -> true) without writing a custom PHP function.
    --}}
    <button
        wire:click="$toggle('showForm')"
        class="text-xs text-blue-400 hover:underline mb-2"
    >
        {{ $showForm ? 'Cancelar' : 'Agregar comentario' }}
    </button>

    {{-- 5️⃣ THE COMMENT FORM --}}
    {{-- Only render this HTML if $showForm is true --}}
    @if ($showForm)
        {{-- wire:submit="store" prevents the default page reload and calls our $store function in PHP instead. --}}
        <form wire:submit="store" class="mt-2">

            {{--
                wire:model="body" creates a two-way data binding.
                Whatever the user types here instantly updates the $body variable in our PHP state above.
            --}}
            <textarea
                wire:model="body"
                rows="2"
                class="w-full rounded-md bg-gray-900 border-gray-700 text-white text-sm p-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Escribe tu comentario aquí..."
            ></textarea>

            {{-- Display validation errors if the user tries to submit an empty comment --}}
            @error('body') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

            <div class="mt-2 flex justify-end">
                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-500 text-white text-xs font-semibold px-3 py-1 rounded-md"
                >
                    Comentar
                </button>
            </div>
        </form>
    @endif
</div>
