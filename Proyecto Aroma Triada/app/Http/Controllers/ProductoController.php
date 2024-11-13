<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\Servicio;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // Muestra la lista de productos
    public function mostrarDetalle($tipo, $id)
    {
        // Obtener el elemento en función del tipo y el ID
        if ($tipo === 'producto') {
            $item = Producto::findOrFail($id);
            $relacionados = Producto::where('id_categoria', $item->id_categoria)
                                    ->where('id_producto', '!=', $id)
                                    ->take(4)
                                    ->get();
        } elseif ($tipo === 'servicio') {
            $item = Servicio::findOrFail($id);
            $relacionados = Servicio::where('id_categoria', $item->id_categoria)
                                    ->where('id_servicio', '!=', $id)
                                    ->take(4)
                                    ->get();
        } else {
            abort(404); // Si el tipo no es producto o servicio, se retorna un error 404
        }

        return view('aroma.productos', compact('item', 'relacionados', 'tipo'));
    }

    // Filtra los productos según ciertos criterios
    public function filtro(Request $request)
    {
        // Lógica para filtrar productos según el request
    }
}
