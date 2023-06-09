<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contests') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @is('admin')
                <a class="voirP rounded-lg" href="{{ route('contests.create') }}">
                    Créer un nouvel évènement
                </a>
            @endis

            <div class="overflow-hidden shadow-lg  sm:rounded-lg mt-8">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Type</th>
                                <th>Début</th>
                                <th>Fin</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contests->sortBy('start') as $contest)
                                
                                <tr>

                                    @if (auth()->user()->student || auth()->user()->admin)
                                        <td class="px-6 py-4 text-center">{{ $contest->name }}</td>
                                        <td class="px-6 py-4 text-center uppercase">{{ $contest->type }}</td>
                                        <td class="px-6 py-4 text-center">{{ $contest->start }}</td>
                                        <td class="px-6 py-4 text-center">{{ $contest->end }}</td>
                                        <td class="px-6 py-4 text-center">
                                            <a class="voirP rounded-lg"
                                                href="{{ route('contests.show', $contest->id) }}">
                                                {{ 'Voir détails' }}
                                            </a>
                                        @elseif (auth()->user()->manager)
                                            @if (
                                                $contest->projects->contains(function ($project) {
                                                    return $project->managers->contains(auth()->user()->manager);
                                                }))
                                        <td class="px-6 py-4 text-center">{{ $contest->name }}</td>
                                        <td class="px-6 py-4 text-center uppercase">{{ $contest->type }}</td>
                                        <td class="px-6 py-4 text-center">{{ $contest->start }}</td>
                                        <td class="px-6 py-4 text-center">{{ $contest->end }}</td>
                                        <td class="px-6 py-4 text-center">
                                            <a class="voirP rounded-lg"
                                                href="{{ route('contests.show', $contest->id) }}">
                                                {{ 'Voir détails' }}
                                            </a>
                                        </td>
                                    @endif
                            @endif
                            @is('admin')
                                    <a style="margin-left:1rem" class="voirP rounded-lg"
                                        href="{{ route('contests.edit', $contest->id) }}">Modifier</a>
                                
                            @endis

                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

                
            </div>
        </div>
    </div>
</x-app-layout>
