<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edycja ') }} {{$module->name}}
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
    <div class="container">
    <form class="w-full max-w-lg mx-auto" action="{{route('modules.update', $module->id)}}" method="POST">
      @csrf
      @method('PUT')
      <div>
        <div class="mt-4 flex justify-between items-center gap-2">
          <div class="w-full">
            <x-jet-label for="name" value="{{ __('Nazwa') }}"/>
            <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus value="{{$module->name}}"/>
          </div>
        </div>
          <div class="md:w-1/3">
            <x-jet-label for="price" value="{{ __('Cena') }}"/>
            <input id="price" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" type="text" name="price" required autofocus value="{{$module->comma_price}}"/>
          </div>
        </div>
      </div>
      <div class="footer-form mt-4 flex justify-end">
        <button type="submit" class="bg-sky-600/75 hover:bg-sky-600/50 text-white py-1 px-4 text-lg">Zapisz</button>
    </div>
    </form>
  </div>
  </div>
</x-app-layout>