<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agenda') }}
        </h2>
    </x-slot>

    @if(session('success'))
    <div class="bg-green-200 relative text-green-600 py-3 px-3 max-w-7xl rounded-lg mx-auto mt-3">
        {{session('success')}}
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-200 relative text-green-600 py-3 px-3 max-w-7xl rounded-lg mx-auto mt-3">
        {{session('error')}}
    </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @livewire('agenda.show')
            </div>
        </div>
    </div>
</x-app-layout>
