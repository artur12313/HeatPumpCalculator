<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dodaj nowego użytkownika') }}
            </h2>
        </div>
    </x-slot>
    <div class="container mx-auto mt-4">
        <form method="POST" action="{{ route('users.store') }}">
            @csrf
            <div class="mb-3">
                <x-jet-label for="name" class="form-label" value="{{ __('Nazwa') }}"/>
                <x-jet-input value="{{ old('name') }}" 
                    type="text" 
                    class="form-control" 
                    name="name" 
                    required/>

                @if ($errors->has('name'))
                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <x-jet-label for="email" class="form-label" value="{{ __('Email') }}"/>
                <x-jet-input value="{{ old('email') }}"
                    type="email" 
                    class="form-control" 
                    name="email" 
                    required/>
                @if ($errors->has('email'))
                    <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <x-jet-label for="specialNumber" class="form-label" value="{{ __('Nr. pełnomocnictwa') }}"/>
                <x-jet-input value="{{ old('specialNumber') }}"
                    type="text" 
                    class="form-control" 
                    name="specialNumber" 
                    placeholder="SBA/01/2020" required/>
                @if ($errors->has('specialNumber'))
                    <span class="text-danger text-left">{{ $errors->first('specialNumber') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <x-jet-label for="phone" value="{{ __('Telefon') }}" />
                <x-jet-input id="phone" class="form-label" type="text" name="phone" :value="old('phone')" required autofocus autocomplete="phone" />
            </div>
            <div class="mb-3">
                <x-jet-label for="password" value="{{ __('Hasło') }}" />
                <x-jet-input id="password" class="form-label" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mb-3">
                <x-jet-label for="password_confirmation" value="{{ __('Potwierdź Hasło') }}" />
                <x-jet-input id="password_confirmation" class="form-label" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="text-sm text-gray-900 font-light whitespace-nowrap flex gap-2 mt-4">
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Zapisz</button>
                <a href="{{ route('users.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Wróć</a>
            </div>
        </form>
    </div>
</x-app-layout>
<script type="text/javascript">
document.getElementById('phone').addEventListener('input', function (e) {
  var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,3})/);
  e.target.value = !x[2] ? x[1] :  x[1] + ' ' + x[2] + (x[3] ? ' ' + x[3] : '');
});
    $(document).ready(function() {
        $('[name="all_permission"]').on('click', function() {

            if($(this).is(':checked')) {
                $.each($('.permission'), function() {
                    $(this).prop('checked',true);
                });
            } else {
                $.each($('.permission'), function() {
                    $(this).prop('checked',false);
                });
            }
            
        });
    });
</script>