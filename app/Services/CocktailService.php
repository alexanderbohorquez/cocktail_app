<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CocktailService
{
    public function getCocktails()
    {
        $response = Http::get('https://www.thecocktaildb.com/api/json/v1/1/filter.php?c=Ordinary_Drink');
        
        // Verifica si la respuesta fue exitosa y si la clave 'drinks' está presente
        if ($response->successful() && isset($response->json()['drinks'])) {
            return $response->json()['drinks']; // Devuelve la lista de cócteles
        }

        return []; // Devuelve un array vacío si no hay resultados
    }
}
