<?php

namespace App\Http\Controllers;

use App\Models\facturalineas;
use App\Models\facturas;
use Illuminate\Http\Request;

class FacturalineasController extends Controller
{
    public function index($factura_id)
    {
        $factura = facturas::findOrFail($factura_id);
        $lineas = facturalineas::where('id_factura', $factura_id)->paginate(10);

        return view('facturas.lineas.index', compact('factura', 'lineas'));
    }

    public function create($factura_id)
    {
        $factura = facturas::findOrFail($factura_id);
        return view('facturas.lineas.create', compact('factura'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');

        $data['base'] = round($data['cantidad'] * $data['precio'], 2);
        $data['importeiva'] = round($data['base'] * $data['iva'] / 100.0, 2);
        $data['importe'] = round($data['base'] + $data['importeiva'], 2);

        $linea = facturalineas::create($data);

        // actualizar totales en la factura
        $factura = facturas::find($data['id_factura']);
        if ($factura) {
            $factura->actualizarTotales();
        }

        return redirect()->route('facturas.lineas', $data['id_factura'])->with('mensaje', 'Línea insertada');
    }

    public function edit($id)
    {
        $linea = facturalineas::findOrFail($id);
        $factura = facturas::findOrFail($linea->id_factura);
        return view('facturas.lineas.edit', compact('linea', 'factura'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->except(['_token', '_method']);

        $data['base'] = round($data['cantidad'] * $data['precio'], 2);
        $data['importeiva'] = round($data['base'] * $data['iva'] / 100.0, 2);
        $data['importe'] = round($data['base'] + $data['importeiva'], 2);

        facturalineas::where('id', $id)->update($data);

        // actualizar totales factura
        if (isset($data['id_factura'])) {
            $factura = facturas::find($data['id_factura']);
            if ($factura) $factura->actualizarTotales();
        }

        return redirect()->route('facturas.lineas', $data['id_factura'])->with('mensaje', 'Línea modificada');
    }

    public function destroy($id)
    {
        $linea = facturalineas::findOrFail($id);
        $factura_id = $linea->id_factura;
        $linea->delete();
        // actualizar totales factura
        $factura = facturas::find($factura_id);
        if ($factura) $factura->actualizarTotales();

        return redirect()->route('facturas.lineas', $factura_id)->with('mensaje', 'Línea borrada');
    }
}
