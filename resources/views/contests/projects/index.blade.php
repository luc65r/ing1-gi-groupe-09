<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projets') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a class="voirP rounded-lg" href="javascript:history.back()">Revenir à l'évènement</a>

            @is('admin')
                <a class="voirP rounded-lg" href="{{ route('contests.projects.create', ['contest' => $contest]) }}">
                    Ajouter un projet à l'évènement
                </a>
            @endis
            <div class="overflow-hidden shadow-lg  sm:rounded-lg mt-8">
                <div class="p-6 bg-white border-b border-gray-200">

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($projects->sortBy('start') as $project)
                                <tr >

                                    @if (auth()->user()->student || auth()->user()->admin)
                                        <td class="px-6 py-4 text-center">{{ $project->name }}</td>
                                        <td class="px-6 py-4 text-center">
                                            <div class="flex justify-center text-center">
                                                <a class="voirP rounded-lg mr-2"
                                                    href="{{ route('projects.show', $project->id) }}">
                                                    {{ 'Voir détails' }}
                                                </a>
                                                @is('admin')
                                                    <form action="{{ route('projects.destroy', $project->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="voirP rounded-lg mr-2"
                                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce projet ?')">Supprimer</button>
                                                    </form>
                                                        <a class="voirP rounded-lg"
                                                            href="{{ route('projects.edit', $project->id) }}">Modifier</a>
                                                </div>
                                                    <form
                                                        action="{{ route('projects.assign', ['project' => $project->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                            <label for="manager-choice">Sélectionner un
                                                                manager :</label>
                                                            <input list="list-manager" id="manager-choice"
                                                                name="manager-choice" autocomplete="off">
                                                            <datalist id="list-manager">
                                                                @foreach ($managers as $manager)
                                                                    <option
                                                                        value="{{ $manager->user->name }}">
                                                                @endforeach
                                                            </datalist>
                                                        
                                                        <button class="voirP rounded-lg" type="submit">Assigner</button>
                                                    </form>
                                            @endis
                                    @elseif (auth()->user()->manager)
                                        @if ($project->managers->contains(auth()->user()->manager))
                                            <td class="px-6 py-4 text-center">{{ $project->name }}</td>
                                            <td  class="px-6 py-4 text-center ">
                                                <a class="voirP rounded-lg" href="{{ route('projects.show', $project->id) }}">
                                                    {{ 'Voir détails' }}
                                                </a>
                                                </td>
                                        @endif
                                    @endif

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
