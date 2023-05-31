<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Messages') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a class="voirP rounded-lg" href="javascript:history.back()">Boîte de réception</a>

            @php
                $msgCount = count($messages);
            @endphp
            
            <div class="p-6 bg-white border-b border-gray-200 shadow-lg mt-6">
                @if ($msgCount === 0)
                    <p>Pas de messages envoyés</p>
                @endif

                <table class="min-w-full divide-y divide-gray-200">
                    @foreach ($messages as $msg)
  
                        <div>
                            <tr>
                                <td class="px-6 py-1 mess">
                                    <a href="{{ route('messages.show', $msg->id) }}">
                                        {{ $msg->subject }}
                                    </a>
                                </td>
                            </tr>
                        </div>
                    @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
