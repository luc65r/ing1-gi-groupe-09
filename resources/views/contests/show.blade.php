<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('contests.projects.index', ['contest' => $contest->id]) }}">{{ $contest->name }}</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p>Description : {!! \Illuminate\Support\Str::markdown($contest->description) !!}</p>
                    <a href="{{ route('contests.projects.index', ['contest' => $contest->id]) }}">
                        Accéder au projet
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
