<?php

namespace App\Http\Controllers;

use App\Models\facturas;
use App\Models\Clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 



class FacturasController extends Controller
{

    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $datos['facturas'] = Facturas::paginate(10);

        return view('facturas.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $clientes = Clientes::all();

        return view('facturas.create', compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $datos = $request->except('_token');

        Facturas::insert($datos);

        return redirect('facturas')->with('mensaje','Factura insertada');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $factura = Facturas::with(['lineas', 'cliente'])->findOrFail($id);

        return view('facturas.show', compact('factura'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $factura = Facturas::findOrFail($id);
        $clientes = Clientes::all();

        return view('facturas.edit', compact('factura', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $datos = $request->except(['_token', '_method']);

        Facturas::where('id', '=' , $id)->update($datos);

        return redirect('facturas')->with('mensaje', 'Factura modificada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Facturas::destroy($id);

        return redirect('facturas')->with('mensaje', 'Factura borrada.');
    }



    public function facturascliente($cliente_id)
{
        $query = DB::table('facturas')
            ->join('clientes', 'facturas.cliente_id', '=', 'clientes.id')
            ->select('facturas.*', 'clientes.nombre')
            ->where('facturas.cliente_id', '=', $cliente_id)
            ->orderBy('id');

        $facturas = $query->cursorPaginate(10);

        // totales agregados por cliente
        $totales = DB::table('facturas')
            ->where('cliente_id', $cliente_id)
            ->selectRaw('COALESCE(SUM(base),0) as base_sum, COALESCE(SUM(importeiva),0) as iva_sum, COALESCE(SUM(importe),0) as importe_sum')
            ->first();

        $facturascliente = true;

        return view('facturas.index', compact('facturas', 'facturascliente', 'totales'));
}
}

