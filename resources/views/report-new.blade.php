<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nowy raport') }}
        </h2>
    </x-slot>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container mx-auto mt-3">
        <form method="POST" action="/report-new">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Klient') }}
                </h2>
                <div class="flex flex-row mt-4 justify-between mt-4 gap-4 justify-center">
                    <div class="w-full">
                        <x-jet-label for="clientName" value="{{ __('Imię i nazwisko') }}" />
                        <x-jet-input id="clientName" class="block mt-1 w-full" type="text" name="clientName" required autofocus />
                    </div>
                    <div class="w-full">
                        <x-jet-label for="address" value="{{ __('Ulica nr') }}" />
                        <x-jet-input id="address" class="block mt-1 w-full" type="text" name="address" required autofocus />
                    </div>
                    <div class="w-full">
                        <x-jet-label for="city" value="{{ __('Miejscowość') }}" />
                        <x-jet-input id="city" class="block mt-1 w-full" type="text" name="city" required autofocus />
                    </div>
                    <div class="w-full">
                        <x-jet-label for="phone" value="{{ __('numer telefonu') }}" />
                        <x-jet-input id="phone" class="block mt-1 w-full" type="text" name="phone" required autofocus />
                    </div>
                </div>
            </div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-4">
                {{ __('Kalkulator doboru pompy ciepła') }}
            </h2>
            <div class="flex flex-row mt-4 gap-4 justify-center">
                <div class="w-full">
                    <x-jet-label for="heatingArea" value="{{ __('Powierzchnia ogrzewania w m2') }}" />
                    <x-jet-input id="heatingArea" class="block mt-1 w-full" type="text" name="heatingArea" required autofocus />
                </div>
                <div class="w-full">
                    <x-jet-label for="roomHeight" value="{{ __('Wysokość pomieszczeń w cm') }}" />
                    <x-jet-input id="roomHeight" class="block mt-1 w-full" type="text" name="roomHeight" required autofocus />
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div class="flex flex-col mt-4 gap-4">
                    <div>
                        <x-jet-label for="buildingInsulation" value="{{ __('Deklarowana izolacja budynku') }}" />
                        <select id="buildingInsulation" name="buildingInsulation">
                            <option value="0">Ocieplenie styropian / wełna 5cm</option>
                            <option value="0.3">Ocieplenie styropian / wełna 10cm</option>
                            <option value="0.6">Ocieplenie styropian / wełna 15cm</option>
                            <option value="0.9">Ocieplenie styropian / wełna 20cm</option>
                            <option value="1.2">Ocieplenie styropian / wełna 25cm</option>
                        </select>
                    </div>
                    <div>
                        <x-jet-label for="windows" value="{{ __('Okna') }}" />
                        <select id="windows" name="windows">
                            <option value="0">Okna skrzyniowe 1 szybowe</option>
                            <option value="0.4">Okna ciepłe 2 szybowe</option>
                            <option value="0.6">Okna ciepłe 3 szybowe</option>
                        </select>
                    </div>
                    <div>
                        <x-jet-label for="glazing" value="{{ __('Przeszklenia') }}" />
                        <select id="glazing" name="glazing">
                            <option value="0">Duże przeszklenia</option>
                            <option value="0.4">Standardowe przeszklenia</option>
                        </select>
                    </div>
                    <div>
                        <x-jet-label for="glazing" value="{{ __('Strop') }}" />
                        <select id="glazing" name="glazing">
                            <option value="0.4">Izolowany strop</option>
                            <option value="0">Nie Izolowany strop</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4 gap-4 flex flex-col">
                    <div>
                        <x-jet-label for="floor" value="{{ __('Podłoga') }}" />
                        <select id="floor" name="floor">
                            <option value="0.4">Izolowana podłoga</option>
                            <option value="0">Nie Izolowana podłoga</option>
                        </select>
                    </div>
                    <div>
                        <x-jet-label for="doors" value="{{ __('Drzwi') }}" />
                        <select id="doors" name="doors">
                            <option value="0.4">Izolowane drzwi wejściowe</option>
                            <option value="0">Nie Izolowane drzwi wejściowe</option>
                        </select>
                    </div>
                    <div>
                        <x-jet-label for="heaters" value="{{ __('Grzejniki') }}" />
                        <select id="heaters" name="heaters">
                            <option value="0.5">Grzejniki niskotemperaturowe</option>
                            <option value="0">Grzejniki wysokotemperaturowe</option>
                        </select>
                    </div>
                    <div>
                        <x-jet-label for="minimalTemperature" value="{{ __('Minimalna Temperatura pracy pompy bez wspomagania') }}" />
                        <select id="minimalTemperature" name="minimalTemperature">
                            <option value="1">-7</option>
                            <option value="1.3">-12</option>
                            <option value="1.6">-15</option>
                            <option value="1.8">-20</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="footer-form mt-4 flex justify-end">
                <button class="bg-sky-600/75 hover:bg-sky-600/50 text-white py-1 px-4 text-lg">Zapisz</button>
            </div>
        </form>
    </div>
</x-app-layout>