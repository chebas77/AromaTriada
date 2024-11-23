<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Pedido;
use App\Models\Tracking;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackingController extends Controller
{
    use HasFactory;

    protected $table = 'tracking'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'id_pedido', // Este debe ser cambiado a 'id_venta' si estás trabajando con la tabla venta
        'origen',
        'destino',
        'estado_actual',
        'fecha_despacho',
        'fecha_entrega',
    ];
    public function mostrar()
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para ver el tracking.');
        }

        // Obtener el tracking asociado al usuario autenticado
        $user = Auth::user();
        $tracking = Tracking::whereHas('venta', function ($query) use ($user) {
            $query->where('id_usuario', $user->id);
        })->get();

        // Mostrar la vista con los datos del tracking
        return view('aroma.tracking', compact('tracking'));
    }
}
