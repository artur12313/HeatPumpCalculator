<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edycja ') }} {{ $user->name }}
            </h2>
        </div>
    </x-slot>
    <div class="container mx-auto">
        <div>
            Name: {{ $user->name }}
        </div>
        <div>
            Email: {{ $user->email }}
        </div>
        <div>
            Username: {{ $user->username }}
        </div>
        <div class="mt-4">
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info">Edit</a>
            <a href="{{ route('users.index') }}" class="btn btn-default">Back</a>
        </div>
    </div>
</x-app-layout>