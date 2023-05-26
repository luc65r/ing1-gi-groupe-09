<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Équipe') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                @is('student')
                    @php
                        $student = Auth::user();
                    @endphp
                @endis

                <x-form
                    action="{{ route('projects.teams.store', ['project' => $project->id, 'student' => $student->id]) }}">
                    <x-form-input name="name" label="Nom de votre équipe" required />
                    <x-form-submit />
                </x-form>
            </div>
        </div>
    </div>
</x-app-layout>
