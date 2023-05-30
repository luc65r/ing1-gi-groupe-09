<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $team->name }}
        </h2>
    </x-slot>
    <a href="javascript:history.back()">Revenir en arrière</a>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if (!auth()->user()->student->teams()->exists())
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex items-center">

                            <form action="{{ route('teams.join', ['team' => $team]) }}" method="POST">
                                @csrf
                                <button type="submit">Rejoindre l'équipe</button>
                            </form>
                        </div>
                    </div>
                @endif

                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="p-6 bg-white border-gray-200">

                        <p><strong>Membres de l'équipe:</strong></p>
                        <ul>
                            @foreach ($team->students as $student)
                                <li>{{ $student->user->name }}</li>
                            @endforeach
                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
