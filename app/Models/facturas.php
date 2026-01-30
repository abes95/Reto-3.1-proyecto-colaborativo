<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class facturas extends Model
{
    public function cliente()
    {
        return $this->belongsTo('App\Models\clientes');
    }

    public function lineas()
    {
        return $this->hasMany('App\Models\facturalineas', 'id_factura');
    }

    /**
     * Recalcula y actualiza los totales de la factura a partir de sus líneas.
     */
    public function actualizarTotales()
    {
        $sums = $this->lineas()
            ->selectRaw('COALESCE(SUM(base),0) as base_sum, COALESCE(SUM(importeiva),0) as iva_sum, COALESCE(SUM(importe),0) as imp_sum')
            ->first();

        $this->base = $sums->base_sum ?? 0;
        $this->importeiva = $sums->iva_sum ?? 0;
        $this->importe = $sums->imp_sum ?? 0;
        $this->save();
    }
}
