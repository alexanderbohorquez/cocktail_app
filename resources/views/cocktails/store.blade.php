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
                    <h3 class="text-lg font-semibold">Cócteles guardados por ti</h3>
                    <div class="row mt-4">
                        @if($cocktails->isEmpty())
                            <p>No has guardado cócteles todavía.</p>
                        @else
                            @foreach ($cocktails as $cocktail)
                                <div class="col-md-4 mb-4">
                                    <div class="card">
                                        <img src="{{ $cocktail->image }}" class="card-img-top" alt="{{ $cocktail->name }}">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $cocktail->name }}</h5>
                                            <p class="card-text"><strong>Categoría:</strong> {{ $cocktail->category ?? 'No disponible' }}</p>
                                            <p class="card-text"><strong>ID:</strong> {{ $cocktail->id }}</p>

                                            <div class="d-flex">
                                                <!-- Botón de editar -->
                                                <a href="{{ route('cocktails.edit', $cocktail->id) }}" class="btn btn-warning mr-2">Editar</a>

                                                <!-- Formulario para eliminar -->
                                                <form action="{{ route('cocktails.destroy', $cocktail->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
