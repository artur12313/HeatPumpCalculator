<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Lista pozwoleń') }}
            </h2>
            <a href="{{ route('permissions.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Nowe pozwolenie</a>
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
    @if(count($permissions) > 0)
    <table class="min-w-full">
        <thead class="border-b bg-gray-800">
        <tr>
            <th scope="col" class="text-sm font-medium text-white px-6 py-4 text-left">Lp.</th>
            <th scope="col" class="text-sm font-medium text-white px-6 py-4 text-left">Name</th>
            <th scope="col" class="text-sm font-medium text-white px-6 py-4 text-left">Guard</th> 
            <th scope="col" class="text-sm font-medium text-white px-6 py-4 text-center">Narzędzia</th> 
        </tr>
        </thead>
        <tbody>
            @foreach($permissions as $permission)
                <tr class="bg-gray-100 border-b">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-left">{{ $loop->iteration }}</td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $permission->name }}</td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $permission->guard_name }}</td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap flex gap-2 justify-center">
                        <a href="{{ route('permissions.edit', $permission->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                        <form method='DELETE' action="{{ route('permissions.destroy', $permission->id) }}" style='display:inline'>
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Usuń</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
      @else
        <p>Brak pozwoleń w bazie</p>
    @endif
    </div>
</x-app-layout>