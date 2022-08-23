<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edytuj uzytkownika') }}
            </h2>
        </div>
    </x-slot>
    <div class="container mx-auto mt-4">

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
                <x-jet-label for="email" class="form-label" value="{{ __('Email') }}"/>
                <x-jet-input value="{{ $user->email }}"
                    type="email" 
                    class="form-control" 
                    name="email" 
                    placeholder="Email address" required/>
                @if ($errors->has('email'))
                    <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <x-jet-label for="specialNumber" class="form-label" value="{{ __('Nr. pełnomocnictwa') }}"/>
                <x-jet-input value="{{ $user->specialNumber }}"
                    type="text" 
                    class="form-control" 
                    name="specialNumber" 
                    placeholder="specialNumber" required/>
                @if ($errors->has('specialNumber'))
                    <span class="text-danger text-left">{{ $errors->first('specialNumber') }}</span>
                @endif
            </div>
            <div class="mb-4">
                <x-jet-label for="phone" value="{{ __('Telefon') }}" />
                <x-jet-input id="phone" class="form-control" type="text" name="phone" value="{{ $user->phone }}" required autofocus autocomplete="phone" />
            </div>
            <div class="mb-3">
                <x-jet-label for="role" class="form-label" value="{{ __('Role') }}"/>
                <select class="form-select appearance-none
                block
                px-3
                w-1/6
                py-1.5
                text-base
                font-normal
                text-gray-700
                bg-white bg-clip-padding bg-no-repeat
                border border-solid border-gray-300
                rounded
                transition
                ease-in-out
                m-0
                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" name="role" required>
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
            <div class="text-sm text-gray-900 font-light whitespace-nowrap flex gap-2 mt-4">
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Zapisz</button>
                <a href="{{ route('users.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Wróć</a>
            </div>
        </form>
    </div>
</x-app-layout>
<script>
    document.getElementById('phone').addEventListener('input', function (e) {
      var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,3})/);
      e.target.value = !x[2] ? x[1] :  x[1] + ' ' + x[2] + (x[3] ? ' ' + x[3] : '');
    });
</script>