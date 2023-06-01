@php
$user = Auth::user();
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $team->name }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a class="voirP rounded-lg" href="javascript:history.back()">Revenir au projet</a>

            <div class="p-6 bg-white border-b border-gray-200 mt-6">
                    <div class="p-6 bg-white border-gray-200">

                        <p><strong>Membres de l'équipe:</strong></p>
                        <ul>
                            @foreach ($team->students as $student)
                                <li>{{ $student->user->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @if ($user->student->teams()->where('id', $team->id)->exists())
                    <x-form action="{{ route('teams.submit', compact('team')) }}" method="PUT">
                        <x-form-input type="url" name="code" label="Rendu du code" value="{{ $team->code }}" required />
                        <x-form-submit class="voirP rounded-lg" />
                    </x-form>
                @endif
                </div>

                @is('student')
                @if (!$user->student->teams()->whereBelongsTo($team->project)->exists())
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex items-center">
                            <form action="{{ route('teams.join', ['team' => $team]) }}" method="POST">
                                @csrf
                                <button type="submit">Rejoindre l'équipe</button>
                            </form>
                        </div>
                    </div>
                @elseif ($user->student->teams()->where('id', $team->id)->exists())
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex items-center">
                            <form action="{{ route('teams.quit', ['team' => $team]) }}" method="POST">
                                @csrf
                                <button class="voirP rounded-lg" type="submit">Quitter l'équipe</button>
                            </form>
                        </div>
                    </div>
                @endif                    
                @endis

        </div>
    </div>
</x-app-layout>
