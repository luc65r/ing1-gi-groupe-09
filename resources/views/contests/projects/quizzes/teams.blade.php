<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('QCM Correction') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach ($teams as $team)
                <a
                    href="{{ route('answers.show', ['quiz' => $quiz->id, 'team' => $team->id]) }}">{{ $team->name }}</a>
            @endforeach

        </div>
    </div>

</x-app-layout>
