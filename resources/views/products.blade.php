<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Productos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex items-center justify-between">
                    <div>
                        Selecciona un producto:

                        <span class="relative bg-gray-100 inline-block rounded-xl">
                            <select class="flex-1 appearance-none bg-transparent py-2 pl-3 pr-9 text-sm font-semibold" onchange="window.location.replace('/products/' + value)">
                                <option value="category" disabled selected>Productos
                                </option>
                                @isset($products)
                                    @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </span>
                    </div>

                    @auth
                    <div>
                        <a href="{{ route('products.create') }}">Añadir producto</a>
                    </div>
                    @endauth

                </div>
            </div>

            <!-- Datos del producto seleccionado -->
            @isset($selectedProduct)
                <div class="mt-3 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nombre
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Dosis
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Concentración
                                        </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{$selectedProduct->name}}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{$selectedProduct->dosis}}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{$selectedProduct->concentration}}</div>
                                        </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Entradas para hacer el calculo -->
                <div class="mt-3 overflow-hidden">
                    <form method="POST" action="{{ route('products.calculate', $selectedProduct->id) }}">
                        @csrf

                        <div>
                            <x-label for="cantidadAnimales" :value="__('Cantidad de Animales')" />

                            @error('cantidadAnimales')
                                <p class="block mt-1 w-full text-red-500">{{ $errors->first('cantidadAnimales') }}</p>
                            @enderror

                            <x-input id="cantidadAnimales" class="block mt-1 w-full" type="text" name="cantidadAnimales" :value="old('cantidadAnimales')" required autofocus />
                        </div>

                        <div>
                            <x-label for="cantidadAlimento" :value="__('Cantidad de Alimento')" />

                            @error('cantidadAlimento')
                                <p class="block mt-1 w-full text-red-500">{{ $errors->first('cantidadAlimento') }}</p>
                            @enderror

                            <x-input id="cantidadAlimento" class="block mt-1 w-full" type="text" name="cantidadAlimento" :value="old('cantidadAlimento')" required/>
                        </div>

                        <div>
                            <x-label for="peso" :value="__('Peso')" />

                            @error('peso')
                                <p class="block mt-1 w-full text-red-500">{{ $errors->first('peso') }}</p>
                            @enderror

                            <x-input id="peso" class="block mt-1 w-full" type="text" name="peso" :value="old('peso')" required/>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-3">
                                Calcular dósis
                            </x-button>
                        </div>
                    </form>
                </div>
            @endisset


            @isset($dosisCalculada)
                <div class="mt-3 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex items-center">
                     Dosis calculada: {{$dosisCalculada}}
                </div>

                <div class="p-6 bg-white border-b border-gray-200 flex items-center">
                     Consumo de Alimento: {{$consumoDeAlimento}}
                </div>

                <div class="p-6 bg-white border-b border-gray-200 flex items-center">
                     Cantidad por tonelada: {{$cantidadPorTonelada}}
                </div>
            </div>
            @endisset
        </div>
    </div>
</x-app-layout>
