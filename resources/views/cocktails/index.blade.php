<x-app-layout>
<head>
    <!-- Otros recursos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            
            <!-- Enlace con contador de cócteles -->
            <a href="{{ route('cocktails.store') }}" class="ml-2 badge badge-primary">
    <i class="fa fa-cocktail"></i> Cócteles Guardados {{ $cocktailsCount }}
</a>

        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                    @foreach ($cocktails as $cocktail)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition duration-300 ease-in-out">
                            <img src="{{ $cocktail['strDrinkThumb'] }}" class="w-full h-48 object-cover" alt="{{ $cocktail['strDrink'] }}">
                            <div class="p-4">
                                <h5 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">{{ $cocktail['strDrink'] }}</h5>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4"><strong>ID de la bebida:</strong> {{ $cocktail['idDrink'] }}</p>
                                
                                <!-- Formulario para guardar el cóctel -->
                                <form action="{{ route('cocktails.store') }}" method="POST" class="saveCocktailForm">
                                    @csrf
                                    <input type="hidden" name="name" value="{{ $cocktail['strDrink'] }}">
                                    <input type="hidden" name="image" value="{{ $cocktail['strDrinkThumb'] }}">
                                    <input type="hidden" name="category" value="{{ $cocktail['strCategory'] ?? 'No disponible' }}">
                                    <button type="submit" class="w-full py-2 bg-black text-white font-semibold rounded-md hover:bg-gray-800 transition duration-200">
    Guardar Cóctel
</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>


    @push('scripts')
        <script>
            // Usamos AJAX para evitar la recarga de la página
            document.querySelectorAll('.saveCocktailForm').forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    // Enviar el formulario usando AJAX
                    fetch(form.action, {
                        method: 'POST',
                        body: new FormData(form),
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Incrementar el contador de cócteles guardados
                        if (data.success) {
                            let counter = document.getElementById('cocktailCounter');
                            let currentCount = parseInt(counter.innerText.trim());
                            counter.innerText = currentCount + 1; // Incrementamos el contador
                        }
                    })
                    .catch(error => console.error('Error:', error));
                });
            });
        </script>
    @endpush
</x-app-layout>
