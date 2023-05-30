<x-app-layout>
    <x-slot name="header">
        @if (auth()->user()->id !== $user->id)
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier un utilisateur
        </h2>
        @else
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier profil
        </h2>

        @endif
    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-xl sm:rounded-lg p-6 bg-accueil_pale">
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nom :</label>
                        <input class="rounded-lg w-full" type="text" name="name" id="name" value="{{ $user->name }}" class="form-input w-full">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email :</label>
                        <input class="rounded-lg w-full" type="email" name="email" id="email" value="{{ $user->email }}" class="form-input w-full">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="telephone" class="block text-gray-700 text-sm font-bold mb-2">Telephone :</label>
                        <input class="rounded-lg w-full" type="telephone" name="telephone" id="telephone" value="{{ $user->telephone }}" class="form-input w-full">
                        @error('telephone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    @if ($user->hasRole('student'))
                    <div class="mb-4">
                        <label for="school" class="block text-gray-700 text-sm font-bold mb-2">Ecole :</label>
                        <input class="rounded-lg w-full" type="text" name="school" id="school" value="{{ $user->student->school }}" class="form-input w-full">
                        @error('school')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="education_level" class="block text-gray-700 text-sm font-bold mb-2">Niveau D'éducation :</label>
                        <input type="text" class="rounded-lg w-full" name="education_level" id="education_level" value="{{ $user->student->education_level }}" class="form-input w-full">
                        @error('education_level')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="city" class="block text-gray-700 text-sm font-bold mb-2">Ville :</label>
                        <input type="text" class="rounded-lg w-full" name="city" id="city" value="{{ $user->student->city }}" class="form-input w-full">
                        @error('city')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    @endif

                    @if ($user->hasRole('manager'))
                    <div class="mb-4">
                        <label for="company" class="block text-gray-700 text-sm font-bold mb-2">Entreprise :</label>
                        <input type="text" class="rounded-lg w-full" name="company" id="company" value="{{ $user->manager->company }}" class="form-input w-full">
                        @error('company')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    @endif

                    <div class="flex justify-end">
                        <button type="submit">
                            Enregistrer les modifications
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
