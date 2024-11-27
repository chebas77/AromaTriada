<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\Servicio;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // Muestra la lista de productos
    //public function mostrarDetalle($tipo, $id)
    //{
      //  if ($tipo === 'producto') {
        //    $item = Producto::findOrFail($id);  // Encuentra el producto o lanza un 404 si no existe
          //  $tipoItem = 'producto';
        //} elseif ($tipo === 'servicio') {
         //   $item = Servicio::findOrFail($id);  // Encuentra el servicio o lanza un 404 si no existe
          //  $tipoItem = 'servicio';
        //} else {
          //  abort(404);  // Si el tipo no es válido, retorna un error 404
       // }

        // Productos o servicios relacionados (puedes ajustar esta lógica según lo que consideres relacionado)
        //$relacionados = Producto::inRandomOrder()->take(4)->get();

        //return view('aroma.productos', compact('item', 'relacionados', 'tipoItem'));
    //}
}

    // Filtra los productos según ciertos criterios
   