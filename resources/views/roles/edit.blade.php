<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edytuj role') }}
            </h2>
        </div>
    </x-slot>
    <div class="container mx-auto">
        @if ($errors->any())
        <div role="alert">
          <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
            Błąd
          </div>
          <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        </div>
    
        @endif

        <form method="POST" action="{{ route('roles.update', $role->id) }}">
            @method('patch')
            @csrf
            <div class="mb-3">
                <x-jet-label for="name" class="form-label" value="{{ __('Nazwa') }}"/>
                <x-jet-input value="{{ $permission->name }}" 
                    type="text" 
                    class="form-control" 
                    name="name" 
                    placeholder="Nazwa" required>

                    <x-jet-label for="name" class="form-label" value="{{ __('przypisz pozwolenie') }}"/>

                    <table class="table table-striped">
                        <thead>
                            <th scope="col" width="1%"><input type="checkbox" name="all_permission"></th>
                            <th scope="col" width="20%">Name</th>
                            <th scope="col" width="1%">Guard</th> 
                        </thead>
    
                        @foreach($permissions as $permission)
                            <tr>
                                <td>
                                    <input type="checkbox" 
                                    name="permission[{{ $permission->name }}]"
                                    value="{{ $permission->name }}"
                                    class='permission'
                                    {{ in_array($permission->name, $rolePermissions) 
                                        ? 'checked'
                                        : '' }}>
                                </td>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->guard_name }}</td>
                            </tr>
                        @endforeach
                    </table>
            </div>

            <button type="submit" class="btn btn-primary">Zapisz</button>
            <a href="{{ route('roles.index') }}" class="btn btn-default">Wróć</a>
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