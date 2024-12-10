<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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
}
