<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Añadir Productos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('products') }}">
            @csrf

            <div>
                Selecciona una especie:

                <span class="relative bg-gray-100 inline-block rounded-xl">
                    <select name="species_id" class="flex-1 bg-transparent py-2 pl-3 pr-9 text-sm font-semibold">
                        <option value="species" disabled selected>Especies
                        </option>
                        @isset($species)
                            @foreach($species as $specie)
                            <option value="{{ $specie->id }}">{{ $specie->name }}</option>
                            @endforeach
                        @endisset
                    </select>
                </span>
                @error('species_id')
                    <p class="block mt-1 w-full text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <x-label for="name" :value="__('Nombre')" />

                @error('name')
                    <p class="block mt-1 w-full text-red-500">{{ $errors->first('name') }}</p>
                @enderror

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <div>
                <x-label for="dosis" :value="__('Dosis')" />

                @error('dosis')
                    <p class="block mt-1 w-full text-red-500">{{ $errors->first('dosis') }}</p>
                @enderror

                <x-input id="dosis" class="block mt-1 w-full" type="text" name="dosis" :value="old('dosis')" required/>
            </div>

            <div>
                <x-label for="concentration" :value="__('Concentración')" />

                @error('concentration')
                    <p class="block mt-1 w-full text-red-500">{{ $errors->first('concentration') }}</p>
                @enderror

                <x-input id="concentration" class="block mt-1 w-full" type="text" name="concentration" :value="old('concentration')" required/>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-3">
                    Añadir
                </x-button>
            </div>
        </form>
        </div>
    </div>
</x-app-layout>
