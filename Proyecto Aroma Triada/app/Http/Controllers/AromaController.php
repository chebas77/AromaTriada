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
    
        // Ejecutar las consultas para obtener los datos
        $productos = $productos->get();
        $servicios = $servicios->get();
        
        // Obtener solo los IDs de los productos y servicios
        $productoIds = $productos->pluck('id'); // Esto obtiene una colección solo de IDs de productos
        $servicioIds = $servicios->pluck('id'); // Esto obtiene una colección solo de IDs de servicios
    
        // Guardar los IDs en la sesión (opcional)
        session()->put('producto_ids', $productoIds);
        session()->put('servicio_ids', $servicioIds);
    
        // Calcular el total de resultados
        $totalResultados = $productos->count() ;
    
        // Pasar los datos a la vista
        return view('aroma.catalogo', compact('categorias', 'productos', 'servicios', 'totalResultados'));
    }
    

    public function index()
    {
        // Obtener todos los productos destacados (puedes personalizar esta lógica)
        $productosDestacados = Producto::all();

        // Obtener todas las categorías
        $categorias = Categoria::all();

        // Verificar si hay productos destacados para mostrar en la vista de inicio
        if ($productosDestacados->isEmpty()) {
            return "No se encontraron productos";  // Mensaje útil para depuración
        }

        // Pasar los datos a la vista
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
