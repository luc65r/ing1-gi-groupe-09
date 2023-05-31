<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Messages') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <a href="{{ route('messages.create') }}">
                    Nouveau
                </a>
                <a href="{{ route('messages.sent') }}">
                    Boîte d'envoi
                </a>
                <div class="p-6 bg-white border-b border-gray-200">
                    @foreach ($messages as $msg)
                        <div>
                            <a href="{{ route('messages.show', $msg->id) }}">
                                {{ $msg->subject }}
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
