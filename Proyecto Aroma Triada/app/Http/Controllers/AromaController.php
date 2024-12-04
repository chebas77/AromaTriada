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
    
    $categorias = Categoria::all(); // Obtener todas las categorías
    $productosQuery = Producto::query(); // Iniciar query de productos
    $serviciosQuery = Servicio::query(); // Iniciar query de servicios

    // Filtrado por categorías
    if ($request->filled('categorias')) {
        $productosQuery->whereIn('id_categoria', $request->categorias);
        $serviciosQuery->whereIn('id_categoria', $request->categorias);
    }

    // Obtener los productos y servicios filtrados
    $productos = $productosQuery->get();
    $servicios = $serviciosQuery->get();

    // Calcular el total de resultados
    $totalResultados = $productos->count() + $servicios->count();

    // Pasar datos a la vista
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

    //para verificar lo del carrusel

    $productos = Producto::where('destacado', true)->get();
    
    return view('aroma.index', compact('productos'));
}


    public function carrito()
    {
        $servicios=Servicio::all();
        // Aquí puedes agregar la lógica para mostrar el carrito
        return view('aroma.carrito', compact('servicios'));
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
