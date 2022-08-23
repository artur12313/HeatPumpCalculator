<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edytuj pozwolenie') }}
            </h2>
        </div>
    </x-slot>
    <div class="container mx-auto">
        <form method="POST" action="{{ route('permissions.update', $permission->id) }}">
            @method('patch')
            @csrf
            <div class="mb-3">
                <x-jet-label for="name" class="form-label" value="{{ __('Nazwa') }}"/>
                <x-jet-input value="{{ $permission->name }}" 
                    type="text" 
                    class="form-control" 
                    name="name" 
                    placeholder="Nazwa" required>

                @if ($errors->has('name'))
                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Zapisz</button>
            <a href="{{ route('permissions.index') }}" class="btn btn-default">Wróć</a>
        </form>
    </div>
</x-app-layout>