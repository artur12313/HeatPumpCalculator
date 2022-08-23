<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edytuj role') }} {{ $role->name }}
            </h2>
        </div>
    </x-slot>
    <div class="container mx-auto mt-3">
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
                <div class="mb-3">
                    <x-jet-label for="name" class="form-label" value="{{ __('Nazwa') }}"/>
                    <x-jet-input value="{{ $role->name }}" 
                        type="text" 
                        class="form-control" 
                        name="name" 
                        placeholder="Nazwa" required />
                </div>

                    <table class="min-w-full">
                        <thead class="border-b bg-gray-800">
                            <th scope="col" class="text-sm font-medium text-white px-6 py-4 text-left">Lp.</th>
                            <th scope="col" class="text-sm font-medium text-white px-6 py-4 text-left"><input
                                type="checkbox" 
                                name="all_permission" onclick="allPermission(this)" /></th>
                            <th scope="col" class="text-sm font-medium text-white px-6 py-4 text-left">Name</th>
                            <th scope="col" class="text-sm font-medium text-white px-6 py-4 text-left">Guard</th> 
                        </thead>
    
                        @foreach($permissions as $permission)
                            <tr class="bg-gray-100 border-b">
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    <input type="checkbox" 
                                    name="permission[{{ $permission->name }}]"
                                    value="{{ $permission->name }}"
                                    class='permission'
                                    {{ in_array($permission->name, $rolePermissions) 
                                        ? 'checked'
                                        : '' }}>
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $permission->name }}</td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $permission->guard_name }}</td>
                            </tr>
                        @endforeach
                    </table>
            </div>
            <div class="text-sm text-gray-900 font-light whitespace-nowrap flex gap-2 py-4 flex justify-between">
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Zapisz</button>
                <a href="{{ route('roles.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Wróć</a>
            </div>
        </form>
    </div>
</x-app-layout>
<script type="text/javascript">
    function allPermission(oInput)
    {
        var checkboxes = document.querySelectorAll('input[class="permission"]');
        if(event.target.checked == true){
            for (var i = 0; i < checkboxes.length; i++) {
             if (checkboxes[i].type == 'checkbox')
               checkboxes[i].checked = true;
            }
        }else {
            for (var i = 0; i < checkboxes.length; i++) {
             if (checkboxes[i].type == 'checkbox')
               checkboxes[i].checked = false;
            }
        }
    }
</script>