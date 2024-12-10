<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Venta;

class PDFController extends Controller
{
    public function generarPDF(Request $request)
{
    // Recibir los datos del formulario
    $fecha_inicio = $request->input('fecha_inicio');
    $fecha_fin = $request->input('fecha_fin');
    $columnas = $request->input('columnas', []);

    // Obtener las ventas con los filtros aplicados y ordenar por fecha descendente
    $ventas = Venta::query()
        ->when($fecha_inicio, fn($query) => $query->where('fecha', '>=', $fecha_inicio))
        ->when($fecha_fin, fn($query) => $query->where('fecha', '<=', $fecha_fin))
        ->orderBy('id_pedido', 'desc') // Ordenar por fecha descendente
        ->get();

    // Renderizar la vista del PDF
    $html = view('admin.ventas_pdf', compact('ventas', 'columnas'))->render();

    // Generar el PDF
    $pdf = Pdf::loadHTML($html);

    // Descargar el archivo PDF
    return $pdf->stream('ventas.pdf');
}

}
