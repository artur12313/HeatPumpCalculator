<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dodaj nowego uzytkownika') }}
            </h2>
        </div>
    </x-slot>
    <div class="container mx-auto">
        <form method="POST" action="{{ route('users.store') }}">
            @csrf
            <div class="mb-3">
                <x-jet-label for="name" class="form-label" value="{{ __('Nazwa') }}"/>
                <x-jet-input value="{{ old('name') }}" 
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
                <input value="{{ old('email') }}"
                    type="email" 
                    class="form-control" 
                    name="email" 
                    placeholder="Email address" required/>
                @if ($errors->has('email'))
                    <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input value="{{ old('username') }}"
                    type="text" 
                    class="form-control" 
                    name="username" 
                    placeholder="Username" required/>
                @if ($errors->has('username'))
                    <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Zapisz</button>
            <a href="{{ route('users.index') }}" class="btn btn-default">Wróć</a>
        </form>
    </div>
</x-app-layout>
<script type="text/javascript">
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