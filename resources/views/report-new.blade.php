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
        <form action="{{route('report.createPDF')}}" method="GET">
            @method('GET')
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
                    <x-jet-input id="heatingArea" class="block mt-1 w-full" type="number" name="heatingArea" onchange="kubatura()" required autofocus />
                </div>
                <div class="w-full">
                    <x-jet-label for="roomHeight" value="{{ __('Wysokość pomieszczeń w cm') }}" />
                    <x-jet-input id="roomHeight" class="block mt-1 w-full" type="number" name="roomHeight" onchange="kubatura()" required autofocus />
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="flex flex-col mt-4 gap-4">
                    <div>
                        <x-jet-label for="buildingInsulation" value="{{ __('Deklarowana izolacja budynku') }}" />
                        <select id="buildingInsulation" name="buildingInsulation" onchange="getvalue()" class="form-select appearance-none
                        block
                        w-full
                        px-3
                        py-1.5
                        text-base
                        font-normal
                        text-gray-700
                        bg-white bg-clip-padding bg-no-repeat
                        border border-solid border-gray-300
                        rounded
                        transition
                        ease-in-out
                        m-0
                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                            <option value="">-Wybierz-</option>
                            <option value="0">Ocieplenie styropian / wełna 5cm</option>
                            <option value="0.3">Ocieplenie styropian / wełna 10cm</option>
                            <option value="0.6">Ocieplenie styropian / wełna 15cm</option>
                            <option value="0.9">Ocieplenie styropian / wełna 20cm</option>
                            <option value="1.2">Ocieplenie styropian / wełna 25cm</option>
                        </select>
                    </div>
                    <div>
                        <x-jet-label for="windows" value="{{ __('Okna') }}" />
                        <select id="windows" name="windows" onchange="getvalue()" class="form-select appearance-none
                        block
                        w-full
                        px-3
                        py-1.5
                        text-base
                        font-normal
                        text-gray-700
                        bg-white bg-clip-padding bg-no-repeat
                        border border-solid border-gray-300
                        rounded
                        transition
                        ease-in-out
                        m-0
                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                            <option value="">-Wybierz-</option>
                            <option value="0">Okna skrzyniowe 1 szybowe</option>
                            <option value="0.4">Okna ciepłe 2 szybowe</option>
                            <option value="0.6">Okna ciepłe 3 szybowe</option>
                        </select>
                    </div>
                    <div>
                        <x-jet-label for="glazing" value="{{ __('Przeszklenia') }}" />
                        <select id="glazing" name="glazing" onchange="getvalue()" class="form-select appearance-none
                        block
                        w-full
                        px-3
                        py-1.5
                        text-base
                        font-normal
                        text-gray-700
                        bg-white bg-clip-padding bg-no-repeat
                        border border-solid border-gray-300
                        rounded
                        transition
                        ease-in-out
                        m-0
                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                            <option value="">-Wybierz-</option>
                            <option value="0">Duże przeszklenia</option>
                            <option value="0.4">Standardowe przeszklenia</option>
                        </select>
                    </div>
                    <div>
                        <x-jet-label for="ceiling" value="{{ __('Strop') }}" />
                        <select id="ceiling" name="ceiling" onchange="getvalue()" class="form-select appearance-none
                        block
                        w-full
                        px-3
                        py-1.5
                        text-base
                        font-normal
                        text-gray-700
                        bg-white bg-clip-padding bg-no-repeat
                        border border-solid border-gray-300
                        rounded
                        transition
                        ease-in-out
                        m-0
                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                            <option value="">-Wybierz-</option>
                            <option value="0.4">Izolowany strop</option>
                            <option value="0">Nie Izolowany strop</option>
                        </select>
                    </div>
                    <div>
                        <x-jet-label for="fuel" value="{{ __('Obecnie stosowane paliwo do ogrzewania') }}" />
                        <select id="fuel" name="fuel" onchange="getvalue()" class="form-select appearance-none
                        block
                        w-full
                        px-3
                        py-1.5
                        text-base
                        font-normal
                        text-gray-700
                        bg-white bg-clip-padding bg-no-repeat
                        border border-solid border-gray-300
                        rounded
                        transition
                        ease-in-out
                        m-0
                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                                <option value="">-Wybierz-</option>
                            @foreach($fuel as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-4 gap-4 flex flex-col">
                    <div>
                        <x-jet-label for="floor" value="{{ __('Podłoga') }}" />
                        <select id="floor" name="floor" onchange="getvalue()" class="form-select appearance-none
                        block
                        w-full
                        px-3
                        py-1.5
                        text-base
                        font-normal
                        text-gray-700
                        bg-white bg-clip-padding bg-no-repeat
                        border border-solid border-gray-300
                        rounded
                        transition
                        ease-in-out
                        m-0
                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                            <option value="">-Wybierz-</option>
                            <option value="0.4">Izolowana podłoga</option>
                            <option value="0">Nie Izolowana podłoga</option>
                        </select>
                    </div>
                    <div>
                        <x-jet-label for="doors" value="{{ __('Drzwi') }}" />
                        <select id="doors" name="doors" onchange="getvalue()" class="form-select appearance-none
                        block
                        w-full
                        px-3
                        py-1.5
                        text-base
                        font-normal
                        text-gray-700
                        bg-white bg-clip-padding bg-no-repeat
                        border border-solid border-gray-300
                        rounded
                        transition
                        ease-in-out
                        m-0
                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                            <option value="">-Wybierz-</option>
                            <option value="0.4">Izolowane drzwi wejściowe</option>
                            <option value="0">Nie Izolowane drzwi wejściowe</option>
                        </select>
                    </div>
                    <div>
                        <x-jet-label for="heaters" value="{{ __('Grzejniki') }}" />
                        <select id="heaters" name="heaters" onchange="getvalue()" class="form-select appearance-none
                        block
                        w-full
                        px-3
                        py-1.5
                        text-base
                        font-normal
                        text-gray-700
                        bg-white bg-clip-padding bg-no-repeat
                        border border-solid border-gray-300
                        rounded
                        transition
                        ease-in-out
                        m-0
                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                            <option value="">-Wybierz-</option>
                            <option value="0.5">Grzejniki niskotemperaturowe</option>
                            <option value="0">Grzejniki wysokotemperaturowe</option>
                        </select>
                    </div>
                    <div>
                        <x-jet-label for="minimalTemperature" value="{{ __('Minimalna Temperatura pracy pompy bez wspomagania') }}" />
                        <select id="minimalTemperature" name="minimalTemperature" onchange="getvalue()" class="form-select appearance-none
                        block
                        w-full
                        px-3
                        py-1.5
                        text-base
                        font-normal
                        text-gray-700
                        bg-white bg-clip-padding bg-no-repeat
                        border border-solid border-gray-300
                        rounded
                        transition
                        ease-in-out
                        m-0
                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                            <option value="">-Wybierz-</option>
                            <option value="-7">-7</option>
                            <option value="-12">-12</option>
                            <option value="-15">-15</option>
                            <option value="-20">-20</option>
                        </select>
                    </div>
                    <div>
                        <x-jet-label for="pump" value="{{ __('Proponowana pompa ciepła') }}" />
                        <select id="pump" name="pump" class="form-select appearance-none
                        block
                        w-full
                        px-3
                        py-1.5
                        text-base
                        font-normal
                        text-gray-700
                        bg-white bg-clip-padding bg-no-repeat
                        border border-solid border-gray-300
                        rounded
                        transition
                        ease-in-out
                        m-0
                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                                <option value="">-Wybierz-</option>
                            @foreach($pump as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="modules">
                <fieldset>
                    <legend><h2 class="font-semibold text-xl text-gray-800 leading-tight my-4">Opcje dodatkowe</h2></legend>
                    @foreach($modules as $item)
                    <div class="form-check">
                        <input type="checkbox" name="modules[]" value="{{ $item->id }}" class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer">
                        <label class="form-check-label inline-block text-gray-800">{{ $item->name }} (+{{ $item->comma_price }}zł)</label>
                    </div>
                    @endforeach
                </fieldset>
            </div>
            <div id="preview" class="mt-6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-6">
                    {{ __('Podgląd') }}
                </h2>
    
                <div class="mt-4">
                    <h3 class="font-semibold text-xl text-gray-800 leading-tight mb-6">
                        {{ __('współczynnik strat ciepła wg. wytycznych VDI 2067') }}
                    </h3>
                        <x-jet-input id="heatLosse" name="heatLosse" class="block mt-1 w-full md:w-1/6" type="text" disabled/>
                </div>
                <div class="mt-4  w-full md:w-1/4">
                    <h3 class="font-semibold text-xl text-gray-800 leading-tight mb-6">
                        {{ __('Założone zapotrzebowanie na ciepło') }}
                    </h3>
                        <div class="flex justify-between w-full gap-4">
                            <div>
                                <x-jet-label for="heatDemand1" value="{{ __('W/m³ (kubik)') }}" />
                                <x-jet-input id="heatDemand1" name="heatDemand1" class="block mt-1 w-full" type="text" disabled/>
                            </div>
                            <div>
                                <x-jet-label for="heatDemand2" value="{{ __('W/m² (1 m² powierzchni)') }}" />
                                <x-jet-input id="heatDemand2" name="heatDemand2" class="block mt-1 w-full" type="text" disabled/>
                            </div>
                        </div>
                </div>
                <input type="hidden" id="kubatura"/>
                <input type="hidden" id="annualEnergyExpenditure"/>
            </div>
        </div>
            <div class="footer-form my-4 flex justify-between container mx-auto">
                <button type="button" class="bg-green-600/75 hover:bg-green-600/50 text-white py-1 px-4 text-lg" id="previewTrigger">Podgląd</button>
                <button type="submit" class="bg-sky-600/75 hover:bg-sky-600/50 text-white py-1 px-4 text-lg">Zapisz</button>
            </div>
        </form>
        <div class="flex justify-start">
        </div>
        
</x-app-layout>
<script>
    var content = document.getElementById('preview');
        content.style.display = "block";

    var previewTrigger = document.getElementById('previewTrigger').addEventListener("click", function () {
        if(content.style.display == 'none')
        {
            content.style.display = "block";
        }else{
            content.style.display = "none";
        }
    });
    function getvalue()
    {
        if(event.target.value != "")
        {
            let buildingInsulation = Number(document.getElementById('buildingInsulation').value == "" ? 0 : document.getElementById('buildingInsulation').value);
            let windows = Number(document.getElementById('windows').value == "" ? 0 : document.getElementById('windows').value);
            let glazing = Number(document.getElementById('glazing').value == "" ? 0 : document.getElementById('glazing').value);
            let ceiling = Number(document.getElementById('ceiling').value == "" ? 0 : document.getElementById('ceiling').value);
            let floor = Number(document.getElementById('floor').value == "" ? 0 : document.getElementById('floor').value);
            let doors = Number(document.getElementById('doors').value == "" ? 0 : document.getElementById('doors').value);
            let heaters = Number(document.getElementById('heaters').value == "" ? 0 : document.getElementById('heaters').value);
            
            return heatLosse(buildingInsulation, windows, glazing, ceiling, floor, doors, heaters);
        }
    }

    function heatLosse(buildingInsulation, windows, glazing, ceiling, floor, doors, heaters)
    {
        let number = parseInt(4);
        let operation = 0;
        let heatLosse = document.getElementById('heatLosse');
        operation = number - (buildingInsulation + windows + glazing + ceiling + floor + doors + heaters);
        heatLosse.value = (operation).toFixed(2);
    }

    function kubatura()
    {
        let heatingArea = Number(document.getElementById('heatingArea').value == "" ? 0 : document.getElementById('heatingArea').value);
        let roomHeight = Number(document.getElementById('roomHeight').value == "" ? 0 : document.getElementById('roomHeight').value);
        var kubatura = document.getElementById('kubatura');

        let kubaturaOperation = heatingArea * (roomHeight / 100);
        kubatura.value = kubaturaOperation;
        console.log(kubaturaOperation);

    }

    function heatDemand()
    {
        let heatDemand1 = Number(document.getElementById('heatDemand1').value == "" ? 0 : document.getElementById('heatDemand1').value);
        let heatDemand2 = Number(document.getElementById('heatDemand2').value == "" ? 0 : document.getElementById('heatDemand2').value);
    }

    function annualEnergyExpenditure()
    {
        let heatLosse = Number(document.getElementById('heatLosse').value == "" ? 0 : document.getElementById('heatLosse').value);
        let kubatura = Number(document.getElementById('kubatura').value == "" ? 0 : document.getElementById('kubatura').value);
        var annualEnergyExpenditure = document.getElementById('annualEnergyExpenditure');

        operation = (heatLosse * kubatura * 23);
        annualEnergyExpenditure.value = operation;

    }
</script>