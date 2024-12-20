<!-- resources/views/cocktails/manage.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cócteles Guardados') }}
        </h2>
    </x-slot>

    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($cocktails as $cocktail)
                        <div class="bg-white dark:bg-gray-700 rounded-lg shadow-lg overflow-hidden">
                            <img src="{{ $cocktail->image }}" class="w-full h-48 object-cover" alt="{{ $cocktail->name }}">
                            <div class="p-4">
                                <h5 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $cocktail->name }}</h5>
                                <p class="text-sm text-gray-600 dark:text-gray-400"><strong>Categoría:</strong> {{ $cocktail->category }}</p>
                                <div class="flex justify-between mt-3 space-x-4">
    <a href="{{ route('cocktails.edit', $cocktail->id) }}" class="w-full py-2 text-blue-600 font-semibold text-center hover:text-blue-500 transition duration-200 text-sm">Editar</a>
    <a href="{{ route('cocktails.destroy', $cocktail->id) }}" class="w-full py-2 text-red-600 font-semibold text-center hover:text-red-500 transition duration-200 text-sm" 
       onclick="event.preventDefault(); document.getElementById('delete-form-{{ $cocktail->id }}').submit();">
        Eliminar
    </a>
    <form id="delete-form-{{ $cocktail->id }}" action="{{ route('cocktails.destroy', $cocktail->id) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

</x-app-layout>
