<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Messages') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a class="voirP rounded-lg" href="{{ route('messages.create') }}">
                Nouveau
            </a>
            <a class="voirP rounded-lg ml-2" href="{{ route('messages.sent') }}">
                Boîte d'envoi
            </a>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                
                <div class="p-6 bg-white border-b border-gray-200">
                        @php
                            $msgCount = count($messages);
                        @endphp

                        @if ($msgCount === 0)
                            <p>Pas de messages</p>
                        @endif
                    <table class="min-w-full divide-y divide-gray-200">

                        @foreach ($messages as $msg)
                            <div>
                                <tr>
                                    <td class="px-6 py-1- mess">
                                        <a href="{{ route('messages.show', $msg->id) }}">
                                            {{ $msg->subject }}
                                        </a>
                                    </td>
                                </tr>
                            </div>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
