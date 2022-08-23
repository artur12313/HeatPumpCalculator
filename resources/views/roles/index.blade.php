<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Lista ról') }}
            </h2>
            <a href="{{ route('roles.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Nowe rola</a>
        </div>
    </x-slot>
    <div class="container mx-auto mt-3">
        @if(session('success'))
        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
            <div class="flex items-center">
              <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
              <div>
                <p class="text-sm font-bold">{{session('success')}}</p>
              </div>
            </div>
          </div>
        @endif
    @if(count($roles) > 0)
    <table class="min-w-full">
        <thead class="border-b bg-gray-800">
        <tr>
            <th scope="col" class="text-sm font-medium text-white px-6 py-4 text-left">Lp.</th>
            <th scope="col" class="text-sm font-medium text-white px-6 py-4 text-left">Nazwa</th> 
            <th scope="col" class="text-sm font-medium text-white px-6 py-4 text-left">Narzędzia</th> 
        </tr>
        </thead>
        <tbody>
            @foreach ($roles as $key => $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('roles.show', $role->id) }}">Pokaz</a>
                </td>
                <td>
                    <a class="btn btn-primary btn-sm" href="{{ route('roles.edit', $role->id) }}">Edytuj</a>
                </td>
                <td>
                    <form method='DELETE' action="{{ route('roles.destroy', $role->id) }}" style='display:inline'>
                        <button type="submit" class="btn btn-danger btn-sm">Usuń</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <p>Brak ról w bazie</p>
    @endif
    </div>
</x-app-layout>