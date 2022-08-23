<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edytuj uzytkownika') }}
            </h2>
        </div>
    </x-slot>
    <div class="container mx-auto">

        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @method('patch')
            @csrf
            <div class="mb-3">
                <x-jet-label for="name" class="form-label" value="{{ __('Nazwa') }}"/>
                <x-jet-input value="{{ $user->name }}"  
                    type="text" 
                    class="form-control" 
                    name="name" 
                    placeholder="Nazwa" required/>

                @if ($errors->has('name'))
                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input value="{{ $user->email }}"
                    type="email" 
                    class="form-control" 
                    name="email" 
                    placeholder="Email address" required/>
                @if ($errors->has('email'))
                    <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="specialNumber" class="form-label">special Number</label>
                <input value="{{ $user->specialNumber }}"
                    type="text" 
                    class="form-control" 
                    name="specialNumber" 
                    placeholder="specialNumber" required/>
                @if ($errors->has('specialNumber'))
                    <span class="text-danger text-left">{{ $errors->first('specialNumber') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-control" 
                    name="role" required>
                    <option value="">Select role</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}"
                            {{ in_array($role->name, $userRole) 
                                ? 'selected'
                                : '' }}>{{ $role->name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('role'))
                    <span class="text-danger text-left">{{ $errors->first('role') }}</span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Zapisz</button>
            <a href="{{ route('users.index') }}" class="btn btn-default">Wróć</a>
        </form>
    </div>
</x-app-layout>