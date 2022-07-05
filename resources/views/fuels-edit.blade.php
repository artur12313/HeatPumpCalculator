<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edycja ') }} {{$fuel->name}}
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
    <form class="w-full max-w-lg mx-auto" action="/fuels" method="POST">
      @csrf
      <div>
        <div class="mt-4 flex justify-between items-center gap-2">
          <div class="md:w-1/2">
            <x-jet-label for="name" value="{{ __('Nazwa') }}"/>
            <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus value="{{$fuel->name}}"/>
          </div>
          <div class="md:w-1/2">
            <x-jet-label for="efficiency" value="{{ __('Sprawność (%)') }}"/>
            <x-jet-input id="efficiency" class="block mt-1 w-full" type="number" name="efficiency" required autofocus value="{{$fuel->efficiency}}"/>
          </div>
        </div>
        <div class="flex mt-4 justify-between items-end gap-2">
          <div class="md:w-1/3">
            <x-jet-label for="caloricValue" value="{{ __('Wartość kaloryczna') }}"/>
            <x-jet-input id="caloricValue" class="block mt-1 w-full" type="number" name="caloricValue" required autofocus value="{{$fuel->caloricValue}}"/>
          </div>
          <div class="md:w-1/3">
            <x-jet-label for="unit" value="{{ __('Jednostka') }}"/>
            <select id="unit" name="unit" class="form-select appearance-none block w-full text-base font-normal mt-1 text-gray-700 bg-white bg-clip-padding bg-no-repeat
            border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
              <option value=" ">-Brak-</option>
              <option value="kJ/kg">kJ/kg</option>
              <option value="kJ/m3">kJ/m3</option>
            </select>
          </div>
          <div class="md:w-1/3">
            <x-jet-label for="price" value="{{ __('Cena (zł/kg)') }}"/>
            <x-jet-input id="price" class="block mt-1 w-full" type="text" name="price" required autofocus value="{{$fuel->comma_price}}"/>
          </div>
        </div>
      </div>
      <div class="footer-form mt-4 flex justify-end">
        <button type="submit" class="bg-sky-600/75 hover:bg-sky-600/50 text-white py-1 px-4 text-lg">Zapisz</button>
    </div>
    </form>
  </div>
</x-app-layout>