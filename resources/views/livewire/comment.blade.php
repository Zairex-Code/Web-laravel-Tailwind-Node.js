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
        'content' => $this->body,
        'user_id' => 20, // Attach the comment to the currently logged-in user.
    ]);

    // Step C: Reset the state.
    // Clear the textarea and hide the form so the user sees the updated comments immediately.
    $this->body = '';
    $this->showForm = false;
};

?>

<div>
    {{-- 3️⃣ DISPLAY EXISTING COMMENTS --}}
    {{-- We loop through the 'comments' relationship of whatever model was passed to us. --}}
    <ul class="space-y-2 mb-4">
        @foreach ($commentable->comments as $comment)
            <li class="bg-white/10 p-3 rounded-lg">
                <span>
                    <p class="text-sm text-gray-300">{{ $comment->content }}</p>
                    <p class="text-xs text-gray-500 mt-1">
                        {{ $comment->user->name }} | {{ $comment->created_at->diffForHumans() }}
                    </p>
                </span>
                

            </li>
        @endforeach
    </ul>

    {{-- 4️⃣ TOGGLE FORM BUTTON --}}
    @if (!$showForm)
    <p class="mt-2">
        <a href="#" wire:click.prevent="$toggle('showForm')" class="text-xs text-blue-400 hover:underline">
            Agregar comentario
        </a>
    </p>
    @else
    {{-- 5️⃣ THE COMMENT FORM --}}
    <div class="mt-2">
        <span class="text-xs text-gray-400">Formulario de comentario:</span>
        <form wire:submit="store" class="mt-1">
            <div class="flex gap-2">
                <input type="text" wire:model="body" class="w-full rounded-md bg-gray-900 border-gray-700 text-white text-xs p-2 focus:ring-gray-800 focus:border-blue-500 outline-none" placeholder="Escribe tu comentario aquí..." required autofocus>
                <button type="button" wire:click="$toggle('showForm')" class="text-xs text-gray-300 hover:underline cursor-pointer">
                    Cancelar
                </button>
                <button type="submit" class="text-xs text-white bg-blue-600 hover:bg-blue-500 rounded-md px-3 py-1 cursor-pointer">
                    Comentar
                </button>
            </div>
            @error('body') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </form>
    </div>
    @endif
</div>
