<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $team->name }}
        </h2>
    </x-slot>
    <a href="javascript:history.back()">Revenir en arrière</a>

</x-app-layout>
