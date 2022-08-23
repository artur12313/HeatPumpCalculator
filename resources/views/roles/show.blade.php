<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edycja ') }} {{$role->name}}
            </h2>
        </div>
    </x-slot>
    <div class="container mx-auto">
        <table class="table table-striped">
            <thead>
                <th scope="col" width="20%">Name</th>
                <th scope="col" width="1%">Guard</th> 
            </thead>

            @foreach($rolePermissions as $permission)
                <tr>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->guard_name }}</td>
                </tr>
            @endforeach
        </table>
        <div class="mt-4">
            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-info">Edytuj</a>
            <a href="{{ route('roles.index') }}" class="btn btn-default">Wróć</a>
        </div>
    </div>
</x-app-layout>