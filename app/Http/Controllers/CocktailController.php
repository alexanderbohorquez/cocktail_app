<?php

namespace App\Http\Controllers;

use App\Models\Cocktail;
use App\Services\CocktailService;
use Illuminate\Http\Request;

class CocktailController extends Controller
{
    protected $cocktailService;

    // Constructor para inyectar el servicio
    public function __construct(CocktailService $cocktailService)
    {
        $this->cocktailService = $cocktailService;
    }

    // Método para mostrar los cócteles de la API
    public function index()
{
    // Obtener cócteles desde la API
    $cocktails = $this->cocktailService->getCocktails();

    // Obtener la cantidad de cócteles guardados en la base de datos
    $cocktailsCount = Cocktail::count();

    // Pasar los cócteles y el contador a la vista
    return view('cocktails.index', compact('cocktails', 'cocktailsCount'));
}




// Método para guardar un cóctel en la base de datos
public function store(Request $request)
{
    // Validar los datos recibidos
    $request->validate([
        'name' => 'required|string|max:255',
        'image' => 'required|url',
        'category' => 'nullable|string|max:255',
    ]);
    
    // Crear un nuevo cóctel
    Cocktail::create([
        'name' => $request->name,
        'image' => $request->image,
        'category' => $request->category,
        'user_id' => auth()->id(),
    ]);
    
    // Redirigir a la página de cócteles guardados o a la vista principal de cócteles
    return redirect()->route('cocktails.index')->with('success', 'Cóctel guardado correctamente');
}
    



public function manage()
{
    // Obtener todos los cócteles desde la base de datos
    $cocktails = Cocktail::all();
    
    // Pasar los cócteles a la vista de gestión
    return view('cocktails.manage', compact('cocktails'));
}

    // Método para editar un cóctel
    public function edit($id)
{
    // Buscar el cóctel por su ID
    $cocktail = Cocktail::findOrFail($id);

    // Pasar el cóctel a la vista de edición
    return view('cocktails.edit', compact('cocktail'));
}
    // Método para actualizar un cóctel en la base de datos
    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|url',
            'category' => 'nullable|string|max:255',
        ]);
    
        // Buscar el cóctel por su ID
        $cocktail = Cocktail::findOrFail($id);
    
        // Actualizar los datos del cóctel
        $cocktail->update([
            'name' => $request->name,
            'image' => $request->image,
            'category' => $request->category,
        ]);
    
        // Redirigir con un mensaje de éxito
        return redirect()->route('cocktails.store')->with('success', 'Cóctel actualizado correctamente');
    }

    // Método para eliminar un cóctel
    public function destroy($id)
    {
        // Buscar el cóctel por su ID
        $cocktail = Cocktail::findOrFail($id);
    
        // Eliminar el cóctel
        $cocktail->delete();
    
        // Redirigir con un mensaje de éxito
        return redirect()->route('cocktails.store')->with('success', 'Cóctel eliminado correctamente');
    }
}