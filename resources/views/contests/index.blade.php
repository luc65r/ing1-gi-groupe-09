<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contests') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @is('admin')
                    <a href="{{ route('contests.create') }}">
                        Nouveau
                    </a>
                @endis
                <div class="p-6 bg-white border-b border-gray-200">
                    @foreach ($contests as $contest)
                        <div>
                            <a href="{{ route('contests.show', $contest->id) }}">
                                {{ $contest->name }}
                            </a>
                        </div>
                        @is('admin')
                            <form action="{{ route('contests.destroy', $contest->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</button>
                            </form>
                            <div>
                                <a href="{{ route('contests.edit', $contest->id) }}">Modifier</a>
                            </div>
                        @endis
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
