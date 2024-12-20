<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cócteles Disponibles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>Cócteles Disponibles</h1>
                    <div class="row">
                        @forelse ($cocktails as $cocktail)
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="{{ $cocktail['strDrinkThumb'] }}" class="card-img-top" alt="{{ $cocktail['strDrink'] }}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $cocktail['strDrink'] }}</h5>
                                        <p class="card-text"><strong>ID de la bebida:</strong> {{ $cocktail['idDrink'] }}</p>
                                        <form action="{{ route('cocktails.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="name" value="{{ $cocktail['strDrink'] }}">
                                            <input type="hidden" name="image" value="{{ $cocktail['strDrinkThumb'] }}">
                                            <input type="hidden" name="category" value="{{ $cocktail['strCategory'] ?? 'No disponible' }}">
                                            <button type="submit" class="btn btn-primary">Guardar Cóctel</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>No hay cócteles disponibles en este momento.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>