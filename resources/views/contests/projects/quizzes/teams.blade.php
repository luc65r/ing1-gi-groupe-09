<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Equipes associées') }}
        </h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <a class="voirP rounded-lg" href="javascript:history.back()">
                Retour à la liste des quiz
            </a>
            <h1 class="italic mt-6">Ensemble des équipes inscrites</h1>
            <div class="overflow-hidden shadow-lg  sm:rounded-lg mt-8">


            @php
                $nb = 0;
            @endphp

            @foreach ($teams as $team)
                @php
                    $nb += 1;
                @endphp
                <a
                    href="{{ route('answers.show', ['quiz' => $quiz->id, 'team' => $team->id]) }}">{{$nb}}) {{ $team->name }}</a>
            @endforeach

        </div>
    </div>

</x-app-layout>
