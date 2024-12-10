<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Pedido;
use App\Models\Venta;
use App\Models\DetallePedido;
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

    // Mostrar todos los tracking del usuario autenticado
    public function mostrar()
{
    // Verificar si el usuario está autenticado
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Debes iniciar sesión para ver el tracking.');
    }

    // Obtener el tracking asociado al usuario autenticado, ordenado de último a primero
    $user = Auth::user();
    $tracking = Tracking::whereHas('venta', function ($query) use ($user) {
        $query->where('id_usuario', $user->id);
    })->orderBy('id_tracking', 'desc') // Orden descendente por id_tracking
      ->get();

    // Mostrar la vista con los datos del tracking
    return view('aroma.tracking', compact('tracking'));
}

    // Función para indexar y filtrar los trackings para admin
    public function indexAdmin(Request $request)
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
    public function detalleAdmin($id)
    {
        // Obtener el tracking con sus relaciones necesarias
        $tracking = Tracking::with(['venta.usuario', 'venta.detalles.producto', 'venta.detalles.servicio'])->findOrFail($id);
    
        // Retornar la vista de detalles del tracking
        return view('admin.tracking.detalle', compact('tracking'));
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

    // Formatear fecha_despacho al guardar
    $tracking->update([
        'estado_actual' => $request->estado_actual,
        'fecha_despacho' => $request->fecha_despacho ? date('Y-m-d H:i:s', strtotime($request->fecha_despacho)) : null,
    ]);

    return redirect()->route('admin.tracking.index')->with('success', 'El tracking ha sido actualizado exitosamente.');
}
    // Confirmar despacho de un pedido
    public function confirmarDespacho($id)
    {
        $tracking = Tracking::findOrFail($id);

        // Actualizar la fecha de despacho con la hora actual
        $tracking->update([
            'fecha_despacho' => now(),
        ]);

        return redirect()->route('admin.tracking.show', $id)->with('success', 'La fecha de despacho ha sido registrada exitosamente.');
    }
    public function detalle($id)
{
    // Buscar el tracking por ID
    $tracking = Tracking::with('venta')->findOrFail($id);

    // Verificar si el usuario autenticado es el dueño del pedido
    if ($tracking->venta->id_usuario !== Auth::id()) {
        return redirect()->route('tracking.mostrar')->with('error', 'No tienes acceso a este detalle.');
    }

    // Calcular el progreso dinámico basado en el estado actual
    $estados = ['Preparando envío', 'En proceso', 'Enviado', 'Entregado'];
    $estadoActual = array_search($tracking->estado_actual, $estados); // Posición del estado actual en el array
    $progressPercentage = ($estadoActual / (count($estados) - 1)) * 100; // Porcentaje de progreso

    // Obtener los detalles del pedido (productos y servicios)
    $detalles = DetallePedido::where('id_pedido', $tracking->venta->id_pedido)->get();
    $productos = $detalles->filter(fn($detalle) => !is_null($detalle->id_producto));
    $servicios = $detalles->filter(fn($detalle) => !is_null($detalle->id_servicio));

    // Retornar la vista con los datos necesarios
    return view('aroma.tracking-detalle', compact('tracking', 'productos', 'servicios', 'estados', 'progressPercentage'));
}
    public function verTracking($id)
    {
        // Obtener el tracking con sus relaciones necesarias
        $tracking = Tracking::with(['venta.usuario', 'venta.detalles.producto', 'venta.detalles.servicio'])->findOrFail($id);
    
        // Retornar la vista de detalles del tracking
        return view('admin.tracking-detalle', compact('tracking'));
    }
    
    
}
