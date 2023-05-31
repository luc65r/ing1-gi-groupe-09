<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contests') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <form action="{{ route('contests.update', $contest) }}" method="POST">
                @csrf
                @method('PUT')

                <x-form action="{{ route('contests.update', $contest) }}">
                    <x-form-input name="name" label="Nom" value="{{ $contest->name }}" required />
                    <x-form-textarea name="description" label="Description" required />
                    <x-form-input name="start" label="Début" value="{{ $contest->start }}" required />
                    <x-form-input name="end" label="Fin" value="{{ $contest->end }}" required />
                    <x-form-submit />
                </x-form>
            </form>

        </div>
    </div>
</x-app-layout>
