<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Venta;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
     // Muestra el formulario de registro de usuario
     public function dashboard()
{
    $connectedUsers = DB::table('sessions')->whereNotNull('user_id')->count();
    $totalSales = DB::table('venta')->count();
    $newUsers = DB::table('users')->count();

    return view('admin.indexadmin', compact('connectedUsers', 'totalSales', 'newUsers'));
}
public function show()
{
    // Obtener las ventas (pedidos) del usuario autenticado
    $ventas = Auth::user()->ventas()->with('detalles.producto')->get();

    // Pasar las ventas a la vista
    return view('perfil', compact('ventas'));
}
}
