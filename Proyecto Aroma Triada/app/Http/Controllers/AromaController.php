<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AromaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('aroma.index');
    }
    public function catalogo()
    {
        return view('aroma.catalogo');
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

    public function carrito()
    {
        return view('aroma.carrito');
    }

    public function inicioSesion()
    {
        return view('aroma.inicioSesion');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
