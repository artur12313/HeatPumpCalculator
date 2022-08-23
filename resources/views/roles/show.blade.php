<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edycja ') }} {{$role->name}}
            </h2>
        </div>
    </x-slot>
    <div class="container mx-auto mt-3">
        <table class="min-w-full">
            <thead class="border-b bg-gray-800">
                <th scope="col" class="text-sm font-medium text-white px-6 py-4 text-left">Lp.</th>
                <th scope="col" class="text-sm font-medium text-white px-6 py-4 text-left">Nazwa</th>
                <th scope="col" class="text-sm font-medium text-white px-6 py-4 text-left">Ochrona</th> 
            </thead>

            @foreach($rolePermissions as $permission)
                <tr class="bg-gray-100 border-b">
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $permission->name }}</td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $permission->guard_name }}</td>
                </tr>
            @endforeach
        </table>
        <div class="text-sm text-gray-900 font-light whitespace-nowrap flex gap-2 py-4 flex justify-between">
            <a href="{{ route('roles.edit', $role->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Edytuj</a>
            <a href="{{ route('roles.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Wróć</a>
        </div>
    </div>
</x-app-layout>