<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Użytkownik') }} {{ $user->name }}
            </h2>
        </div>
    </x-slot>
    <div class="container mx-auto mt-4">
        <div class="text-sm font-medium text-gray-900 py-2 text-left">
            Nazwa: <span class="font-bold">{{ $user->name }}</span>
        </div>
        <div class="text-sm font-medium text-gray-900 py-2 text-left">
            Email: <span class="font-bold">{{ $user->email }}</span>
        </div>
        <div class="text-sm font-medium text-gray-900 py-2 text-left">
            Nr. pełnomocnictwa: <span class="font-bold">{{ $user->specialNumber }}</span>
        </div>
        <div class="text-sm font-medium text-gray-900 py-2 text-left">
            Nr. telefonu: <span class="font-bold">{{ $user->phone }}</span>
        </div>
        <div class="text-sm font-medium text-gray-900 py-2 text-left">
            Posiada konto od: <span class="font-bold">{{ date('d.m.Y', strtotime($user->created_at)) }}</span>
        </div>
        <div class="text-sm text-gray-900 font-light whitespace-nowrap flex gap-2 mt-4">
            <a href="{{ route('users.edit', $user->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Edytuj</a>
            <a href="{{ route('users.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Wróć</a>
        </div>
    </div>
</x-app-layout>