<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projects') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <form action="{{ route('projects.update', $project) }}" method="POST">
                @csrf
                @method('PUT')

                <x-form action="{{ route('projects.update', $project) }}">
                    <x-form-input name="name" label="Nom" value="{{ $project->name }}" required />
                    <x-form-textarea name="description" label="Description" required />
                    <x-form-submit />
                </x-form>
            </form>

        </div>
    </div>
</x-app-layout>
