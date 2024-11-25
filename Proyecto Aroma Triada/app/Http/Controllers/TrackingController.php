<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Pedido;
use App\Models\Venta;
use App\Models\Tracking;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Expression;
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
    public function index(Request $request)
{
    $search = $request->get('search');
    $query = Tracking::query();

    // Si se proporciona un filtro de búsqueda por ID Tracking
    if ($search) {
        $query->where('id_tracking', $search);
    }

    // Ordenar por ID Tracking en orden descendente y paginar
    $trackings = $query->orderBy('id_tracking', 'desc')->paginate(10);

    return view('admin.tracking.index', compact('trackings'));
}

    // Mostrar y gestionar el tracking específico de un pedido
    public function gestionarTracking($id)
    {
        $tracking = Tracking::findOrFail($id);

        // Obtener los valores del ENUM desde la base de datos
        $type = DB::select("SHOW COLUMNS FROM tracking WHERE Field = 'estado_actual'")[0]->Type;

        // Extraer los valores de ENUM y convertirlos a un array
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enumValues = array_map(function ($value) {
            return trim($value, "'");
        }, explode(',', $matches[1]));

        return view('admin.tracking.show', compact('tracking', 'enumValues'));
    }


    // Actualizar el estado del tracking
    public function updateTracking(Request $request, $id)
{
    $tracking = Tracking::findOrFail($id);

    // Validar la entrada
    $request->validate([
        'estado_actual' => 'required|string|in:En proceso,Enviado,Entregado,Cancelado',
        'fecha_despacho' => 'nullable|date',
    ]);

    // Actualizar los campos permitidos
    $tracking->update([
        'estado_actual' => $request->estado_actual,
        'fecha_despacho' => $request->fecha_despacho,
    ]);

    // Actualizar el estado en la tabla venta
    $venta = $tracking->venta;
    if ($venta) {
        $venta->update(['estado' => $request->estado_actual]);
    }

    return redirect()->route('admin.tracking.index')->with('success', 'El tracking ha sido actualizado exitosamente.');
}
public function confirmarDespacho($id)
{
    $tracking = Tracking::findOrFail($id);

    // Actualizar la fecha de despacho con la hora actual
    $tracking->update([
        'fecha_despacho' => now(),
    ]);

    return redirect()->route('admin.tracking.show', $id)->with('success', 'La fecha de despacho ha sido registrada exitosamente.');
}

}
