<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Servicio;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AromaController extends Controller
{
    public function catalogo(Request $request)
    {
        $categorias = Categoria::all();
        $productos = Producto::query();
        $servicios = Servicio::query();

        if ($request->filled('categoria_id')) {
            $productos->where('id_categoria', $request->categoria_id);
            $servicios->where('id_categoria', $request->categoria_id);
        }

        $productos = $productos->get();
        $servicios = $servicios->get();
        $totalResultados = $productos->count() + $servicios->count();

        return view('aroma.catalogo', compact('categorias', 'productos', 'servicios', 'totalResultados'));
    }

    public function index()
    {
        $productosDestacados = Producto::all();
        $categorias = Categoria::all(); // Agregar esta línea para obtener las categorías

        if ($productosDestacados->isEmpty()) {
            return "No se encontraron productos";  // Esto puede ser útil para depuración
        }

        return view('aroma.index', compact('productosDestacados', 'categorias'));
    }
    public function carrito()
    {
        // Aquí puedes agregar la lógica para mostrar el carrito
        return view('aroma.carrito');
    }
    public function perfil()
    {
        return view('aroma.perfil');
    }

    public function registro()
    {
        return view('aroma.registro');
    }

    public function nosotros()
    {
        return view('aroma.nosotros');
    }

    public function preguntas()
    {
        return view('aroma.preguntas');
    }

    public function productos()
    {
        return view('aroma.productos');
    }

    public function inicioSesion()
    {
        return view('aroma.inicioSesion');
    }
}
