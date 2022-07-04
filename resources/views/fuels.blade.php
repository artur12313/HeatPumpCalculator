<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista paliw do ogrzewania') }}
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
        @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif
    <table class="table table-striped" id="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nazwa</th>
                <th scope="col">Miejscowość</th>
                <th scope="col">Adres</th>
                <th scope="col">Nr.tel</th>
                <th scope="col">Dodano przez</th>
                <th scope="col" class="text-center">Narzędzia</th>
            </tr>
        </thead>
        <tbody>
            
            <tr>
                <td>1</td>
                <td>
                    name
                </td>
                <td>asas</td>
                <td>dasd</td>
                <td>asdad</td>
                <td>asdd</td>
                <td class="d-flex justify-content-center">
                    <a href="#" class="btn btn-secondary btn-sm">                    
                        Pokaż
                    </a>
                    <a href="#" class="btn btn-primary btn-sm ml-2">Edytuj</a>
                </td>
            </tr>
            
        </tbody>
    </table>
    </div>
</x-app-layout>