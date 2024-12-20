<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Cóctel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold">Editar Cóctel</h3>

                    <form action="{{ route('cocktails.update', $cocktail->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nombre del Cóctel</label>
                            <input type="text" name="name" id="name" value="{{ $cocktail->name }}" class="mt-1 block w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="category" class="block text-sm font-medium text-gray-700">Categoría</label>
                            <input type="text" name="category" id="category" value="{{ $cocktail->category }}" class="mt-1 block w-full">
                        </div>

                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700">Imagen</label>
                            <input type="url" name="image" id="image" value="{{ $cocktail->image }}" class="mt-1 block w-full" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Actualizar Cóctel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>